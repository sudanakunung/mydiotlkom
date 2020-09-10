class Castjs {
    constructor() {
        this.receiver = '92EA264C';
        this.joinpolicy = null;
        this.player = null;
        this.session = null;
        this.currentSession = null;
        this.mediaSession = null;
        this.available = false;

        this.source = null;
        this.title = null;
        this.poster = null;
        this.description = null;

        // var interval = setInterval(() =>{

        // })

        if (window.chrome.cast && window.chrome.cast.isAvailable) {
            this.available = true;
        }
    }

    cast(source, metadata = {}) {
        if (!source) {
            console.log("No Media source specified.");
        }

        metadata.source = source;

        for (var key in metadata) {
            if (metadata.hasOwnProperty(key)) {
                this[key] = metadata[key];
            }
        }

        var sessionRequest = new chrome.cast.SessionRequest(this.reciever);
        chrome.cast.requestSession(
            function successCallback(session) {
                this.currentSession = session;
                this.session = true;

                var mediaInfo = new chrome.cast.media.MediaInfo(this.source);
                mediaInfo.metadata = new chrome.cast.media.GenericMediaMetadata();

                mediaInfo.metadata.images = [new chrome.cast.Image(this.poster)];
                mediaInfo.metadata.title = this.title;
                mediaInfo.metadata.subtitle = this.description;

                if (this.mediaSession != null) {
                    this.addToPlaylist(mediaInfo, mediaInfo.metadata);
                    return;
                }

                var request = new chrome.cast.media.LoadRequest(mediaInfo);

                this.currentSession.loadMedia(
                    request,
                    function successCallback(mediaSession) {
                        this.mediaSession = mediaSession;
                        player2.volume(0);
                        player2.controlBar.hide();

                        var vocalStatusForCasting = $(".vocal").attr("index-track");
                        var pitchValueVocalForCasting = $("#pitchValue").attr("pitch-value");
                        // var pitchIndexForCasting = 0;
                        if (vocalStatusForCasting == "1") {
                            if (pitchValueVocalForCasting == "0") {
                                pitchIndexForCasting = 2;
                            } else if (pitchValueVocalForCasting == "1") {
                                pitchIndexForCasting = 12;
                            } else if (pitchValueVocalForCasting == "2") {
                                pitchIndexForCasting = 13;
                            } else if (pitchValueVocalForCasting == "3") {
                                pitchIndexForCasting = 14;
                            } else if (pitchValueVocalForCasting == "-1") {
                                pitchIndexForCasting = 11;
                            } else if (pitchValueVocalForCasting == "-2") {
                                pitchIndexForCasting = 10;
                            } else if (pitchValueVocalForCasting == "-3") {
                                pitchIndexForCasting = 9;
                            }
                        } else {
                            if (pitchValueVocalForCasting == "0") {
                                pitchIndexForCasting = 1;
                            } else if (pitchValueVocalForCasting == "1") {
                                pitchIndexForCasting = 6;
                            } else if (pitchValueVocalForCasting == "2") {
                                pitchIndexForCasting = 7;
                            } else if (pitchValueVocalForCasting == "3") {
                                pitchIndexForCasting = 8;
                            } else if (pitchValueVocalForCasting == "-1") {
                                pitchIndexForCasting = 5;
                            } else if (pitchValueVocalForCasting == "-2") {
                                pitchIndexForCasting = 4;
                            } else if (pitchValueVocalForCasting == "-3") {
                                pitchIndexForCasting = 3;
                            }
                        }
                    },
                    function errorCallback(err) {
                        console.log(err);
                    }
                )
            },
            function errorCallback(err) {
                console.log(err);
            },
            sessionRequest
        )
    }

    addToPlaylist(source, metadata = {}) {
        if (!source) {
            return this.trigger('error', 'No media source specified.');
        }

        metadata.source = source;

        for (var key in metadata) {
            if (metadata.hasOwnProperty(key)) {
                this[key] = metadata[key];
            }
        }

        var mediaInfo = new chrome.cast.media.MediaInfo(this.source);
        mediaInfo.metadata = new chrome.cast.media.GenericMediaMetadata();

        mediaInfo.metadata.images = [new chrome.cast.Image(this.poster)];
        mediaInfo.metadata.title = this.title;
        mediaInfo.metadata.subtitle = this.description;

        let item = new chrome.cast.media.QueueItem(mediaInfo);
        this.mediaSession.queueAppendItem(
            item,
            function onSuccess() {
                alert('Queue Added' + item.media.metadata.title);
            },
            function onError(err) {
                console.log(err);
            }
        )
    }
}