var cc = new Castjs();

cc.on("available", () => {
    // $('#cast').removeClass('disabled')
    $(".cast-icon").attr("src", "./assets/images/telkom/cast.png");
});

cc.on("session", () => {
    // $("#cast").removeClass("disabled");
    // $("#cast").addClass("session");

    // if (cc.paused) {
    //     $("#play").removeClass("fa-pause").addClass("fa-play");
    // } else {
    //     $("#play").removeClass("fa-play").addClass("fa-pause");
    // }

    player2.overlay({
        overlays: [{
            start: 0,
            content: '<div style="background-color: black; width: 100%; height: 100%; z-index: 98;"><div class="container h-100"><div class="row h-100 align-items-center"><div class="col-12"><span class="text-white" style="font-size: 15px;">Now casting to your TV</span></div></div></div</div>',
            end: 'pause',
            align: 'top'
        }]
    });
    player2.currentTime(0);
    player2.volume(0.01);
    player2.play();

    $(".cast-icon").attr("src", "./assets/images/telkom/cast_on.png");
    $(".cast").attr("cast-status", "on");
});

cc.on("disconnect", () => {
    // $("#cast").removeClass("session");

    timeCurrent = cc.time; // variable pertama kali ada di footer

    $(".cast").attr("cast-status", "off");

    player2.overlay();

    if (disable_function == 1) {
        if (cc.available) {
            $(".cast-icon").attr("src", "./assets/images/telkom/cast.png");
        } else {
            $(".cast-icon").attr("src", "./assets/images/cast_disable.jpg");
        }

        if ($('#exampleModal2').hasClass('show')) {
            player2.volume(1);
        }
    } else {
        $(".cast-icon").attr("src", "./assets/images/cast_disable.jpg");
    }
});

cc.on("state", (state) => {
    $(".state").text(cc.device + ": " + state);
});

cc.on("paused", () => {
    if (cc.paused) {
        player2.pause();

        // $('.button-pause').addClass('hide');
        // $('.button-pause').hide();
        // $('.button-play').removeClass('hide');
        // $('.button-play').show();
    } else {
        player2.play();

        // $('.button-play').addClass('hide');
        // $('.button-play').hide();
        // $('.button-pause').removeClass('hide');
        // $('.button-pause').show();
    }
});

cc.on("muted", () => {
    if (cc.muted) {
        player2.muted(true);
    } else {
        player2.muted(false);
    }
});

cc.on("volumeLevel", () => {
    // player2.volume(cc.volumeLevel);
    player2.volume(0.01);
});

cc.on("timeupdate", () => {
    // $(".time").text(cc.timePretty); // 00:00:00
    // $(".duration").text(cc.durationPretty); // Total waktu video
    // $('input[type="range"]').attr("value", cc.progress); // angka bentuk decimal
    // $('input[type="range"]').rangeslider("update", true);

    if (data_subs === 0) {
        timeCurrent = Math.round(cc.time); // variable pertama kali ada di footer

        if (timeCurrent === 60) {
            cc.disconnect();

            if ($('#exampleModal2').is(':visible')) {
                player2.play();
            } else {
                player2.pause();
                player2.currentTime(0);
            }
        }
    }

    // $(".add-info").text(timeCurrent);
});

function cast(url, songtitle, artist, poster, unsubscibe) {
    if (cc.available) {
        cc.cast("" + url + "", {
            poster: "" + poster + "",
            title: "" + artist + "",
            description: "" + songtitle + "",
            subtitles: false,
            muted: false,
            paused: false,
        });
    }
}

function add_to_queue(url, songtitle, artist, poster) {
    if (cc.session) {
        cc.queueing("" + url + "", {
            poster: "" + poster + "",
            title: "" + artist + "",
            description: "" + songtitle + "",
            subtitles: false,
            muted: false,
            paused: false,
        });
    }
}

function viewing() {
    return cc.view_queue();
    // if (cc.session) {
    // }
}

player2.on("volumechange", function (event) {

    event.preventDefault();

    var player2_isVolumeMuted = this.muted();

    if (cc.session) {
        if (disable_function == 1) {
            if (player2_isVolumeMuted) {
                cc.mute();
            } else {
                cc.unmute();
                cc.volume(1);
            }

            // cc.volume(this.volume());
            // this.volume(0.01);
        }
    }

    if (disable_function == 1) {
        muted_status = player2_isVolumeMuted;
    }
});

$(".vjs-progress-control").on("mouseup", () => {
    if (cc.session) {
        // cc.pause();
        cc.seek(player2.currentTime(), false);
    }
});

player2.on("pause", function () {
    if ($('#exampleModal2').hasClass('show')) {
        if (cc.session) {
            cc.pause();
        }
    }
});

player2.on("play", function () {
    if (cc.session) {
        cc.play();
    }
});

function vocal_onoff() {
    // $('.vocal-icon').attr("src", "./assets/images/loading_player_button.gif");
    $("#vocal").popover('disable');

    var index = $(".vocal").attr("index-track");
    let pitchValueVocal = $("#pitchValue").attr("pitch-value");

    if (cc.session) {
        if (index == "1") {
            if (pitchValueVocal == "0") {
                pitchIndex = 1;
            } else if (pitchValueVocal == "1") {
                pitchIndex = 6;
            } else if (pitchValueVocal == "2") {
                pitchIndex = 7;
            } else if (pitchValueVocal == "3") {
                pitchIndex = 8;
            } else if (pitchValueVocal == "-1") {
                pitchIndex = 5;
            } else if (pitchValueVocal == "-2") {
                pitchIndex = 4;
            } else if (pitchValueVocal == "-3") {
                pitchIndex = 3;
            }
        } else {
            if (pitchValueVocal == "0") {
                pitchIndex = 2;
            } else if (pitchValueVocal == "1") {
                pitchIndex = 12;
            } else if (pitchValueVocal == "2") {
                pitchIndex = 13;
            } else if (pitchValueVocal == "3") {
                pitchIndex = 14;
            } else if (pitchValueVocal == "-1") {
                pitchIndex = 11;
            } else if (pitchValueVocal == "-2") {
                pitchIndex = 10;
            } else if (pitchValueVocal == "-3") {
                pitchIndex = 9;
            }
        }

        cc.subtitle(pitchIndex);
    }

    // Get the current player's AudioTrackList object.
    var audioTrackListVocal = player2.audioTracks();

    for (var i = 0; i < audioTrackListVocal.length; i++) {
        var track = audioTrackListVocal[i];

        if (index == "1") {
            if (pitchValueVocal == "0") {
                trackLabel = "eng";
            } else if (pitchValueVocal == "1") {
                trackLabel = "jpn";
            } else if (pitchValueVocal == "2") {
                trackLabel = "kor";
            } else if (pitchValueVocal == "3") {
                trackLabel = "lat";
            } else if (pitchValueVocal == "-1") {
                trackLabel = "ind";
            } else if (pitchValueVocal == "-2") {
                trackLabel = "heb";
            } else if (pitchValueVocal == "-3") {
                trackLabel = "ger";
            }

            if (track.label === trackLabel) {
                track.enabled = true;
                $(".vocal").attr("index-track", "2");
                $(".vocal-icon").attr("src", "./assets/images/telkom/vocal_on.png");
                return;
            }
        } else if (index == "2") {

            if (pitchValueVocal == "0") {
                trackLabel = "fin";
            } else if (pitchValueVocal == "1") {
                trackLabel = "rus";
            } else if (pitchValueVocal == "2") {
                trackLabel = "spa";
            } else if (pitchValueVocal == "3") {
                trackLabel = "tha";
            } else if (pitchValueVocal == "-1") {
                trackLabel = "por";
            } else if (pitchValueVocal == "-2") {
                trackLabel = "nor";
            } else if (pitchValueVocal == "-3") {
                trackLabel = "mon";
            }

            if (track.label === trackLabel) {
                track.enabled = true;
                $(".vocal").attr("index-track", "1");
                $(".vocal-icon").attr("src", "./assets/images/telkom/vocal_off.png");
                return;
            }
        }
    }
}

$(".pitchControl").click(function (e) {
    e.preventDefault();

    // $('.pitch-icon').attr("src", "./assets/images/loading_player_button.gif");

    let trackIndex = $(".vocal").attr("index-track");
    let pitchValue = $("#pitchValue").attr("pitch-value");
    let pitchMethod = $(this).attr("pitch-method");

    let pitchValueChange = 0;
    if (pitchMethod === "minus") {
        pitchValueChange = parseInt(pitchValue) - 1;
    } else {
        pitchValueChange = parseInt(pitchValue) + 1;
    }

    if (pitchValueChange == 4 || pitchValueChange == -4) {
        return false;
    }

    if (trackIndex == "2") {
        if (pitchValueChange == "0") {
            pitchIndex = 1;
            trackId = "eng";
        } else if (pitchValueChange == "1") {
            pitchIndex = 6;
            trackId = "jpn";
        } else if (pitchValueChange == "2") {
            pitchIndex = 7;
            trackId = "kor";
        } else if (pitchValueChange == "3") {
            pitchIndex = 8;
            trackId = "lat";
        } else if (pitchValueChange == "-1") {
            pitchIndex = 5;
            trackId = "ind";
        } else if (pitchValueChange == "-2") {
            pitchIndex = 4;
            trackId = "heb";
        } else if (pitchValueChange == "-3") {
            pitchIndex = 3;
            trackId = "ger";
        }
    } else {
        if (pitchValueChange == "0") {
            pitchIndex = 2;
            trackId = "fin";
        } else if (pitchValueChange == "1") {
            pitchIndex = 12;
            trackId = "rus";
        } else if (pitchValueChange == "2") {
            pitchIndex = 13;
            trackId = "spa";
        } else if (pitchValueChange == "3") {
            pitchIndex = 14;
            trackId = "tha";
        } else if (pitchValueChange == "-1") {
            pitchIndex = 11;
            trackId = "por";
        } else if (pitchValueChange == "-2") {
            pitchIndex = 10;
            trackId = "nor";
        } else if (pitchValueChange == "-3") {
            pitchIndex = 9;
            trackId = "mon";
        }
    }

    $("#pitchValue").text(pitchValueChange);
    $("#pitchValue").attr("pitch-value", pitchValueChange);

    if (cc.session) {
        cc.subtitle(pitchIndex);
    }

    // Get the current player's AudioTrackList object.
    var audioTrackList = player2.audioTracks();

    for (var i = 0; i < audioTrackList.length; i++) {
        var track = audioTrackList[i];

        if (track.label === trackId) {
            track.enabled = true;
            $('.pitch-icon').attr("src", "./assets/images/telkom/pitch_on.png");
            return;
        }
    }
});