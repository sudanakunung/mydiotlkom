var cc = new Castjs();

cc.on('available', () => {
  // $('#cast').removeClass('disabled')
  $('.cast-icon').attr('src', './assets/images/cast.jpg')
})

cc.on('session', () => {
  $('#cast').removeClass('disabled')
  $('#cast').addClass('session')
  $('.cast-icon').attr('src', './assets/images/cast_on.jpg')
  $('.cast').attr('cast-status', 'on')
  if (cc.paused) {
    $('#play').removeClass('fa-pause').addClass('fa-play')
  } else {
    $('#play').removeClass('fa-play').addClass('fa-pause')
  }
})

cc.on('disconnect', () => {
  $('#cast').removeClass('session')
  $('.cast-icon').attr('src', './assets/images/cast.jpg')
  $('.cast').attr('cast-status', 'off')
})

cc.on('state', (state) => {
  $('.state').text(cc.device + ': ' + state)
})

cc.on('paused', () => {
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
})

cc.on('muted', () => {
  if (cc.muted) {
    player2.muted(true);
  } else {
    player2.muted(false);
  }
})

cc.on('volumeLevel', () => {
  player2.volume(cc.volumeLevel);
})

cc.on('timeupdate', () => {
  $('.time').text(cc.timePretty);
  $('.duration').text(cc.durationPretty);
  $('input[type="range"]').attr('value', cc.progress);
  $('input[type="range"]').rangeslider('update', true);
})

function cast(url, songtitle, artist, poster, unsubscibe){
  if (cc.available) {
    cc.cast(''+url+'', {
      poster: ''+poster+'',
      title: ''+artist+'',
      description: ''+songtitle+'',
      muted:  false,
      paused: false
    })
  }
}

$('.vocal').on('click', (e) => {
  
  e.preventDefault();
  
  var index = $('.vocal').attr('index-track');
  
  if (cc.session) {
    cc.subtitle(index);

    if(index == "1"){
      $('.vocal').attr('index-track', '2');
      $('.vocal-icon').attr('src', './assets/images/vocal.jpg');
    } else if(index == "2")  {
      $('.vocal').attr('index-track', '1');
      $('.vocal-icon').attr('src', './assets/images/no_vocal.jpg');
    }
  } 
})

$('.vjs-mute-control').on('click', () => {
  
  var player2_isVolumeMuted = player2.muted();

  if (cc.session) {
    if(player2_isVolumeMuted){
      cc.mute();
    } else {
      cc.unmute();
    }
  }
})

$('.vjs-progress-control').on('mouseup', () => {
  if (cc.session) {
    // cc.pause();
    cc.seek(player2.currentTime(), false);
  }
});

$('.vjs-volume-control').on('mouseup', () => {
  if (cc.session) {
    cc.volume(player2.volume());
  }
});

player2.on("pause", function () {
  cc.pause();
});

player2.on("play", function () {
  cc.play();
});

$(".pitchControl").click(function(){
    let trackIndex = $('.vocal').attr('index-track');
    let pitchValue = $('#pitchValue').attr('pitch-value');
    let pitchMethod = $(this).attr('pitch-method');

    let pitchValueChange = 0;
    if(pitchMethod === "minus"){
        pitchValueChange = parseInt(pitchValue)-1;
    } else {
        pitchValueChange = parseInt(pitchValue)+1;
    }

    if(pitchValueChange == 4 || pitchValueChange == -4){
        return false;
    }

    if(trackIndex == "2"){
        if(pitchValueChange == 0){
            pitchIndex = 1;
        }
        else if(pitchValueChange == "1"){
            pitchIndex = 6;
        }
        else if(pitchValueChange == "2"){
            pitchIndex = 7;
        }
        else if(pitchValueChange == "3"){
            pitchIndex = 8;
        }
        else if(pitchValueChange == "-1"){
            pitchIndex = 5;
        }
        else if(pitchValueChange == "-2"){
            pitchIndex = 4;
        }
        else if(pitchValueChange == "-3"){
            pitchIndex = 3;
        }
    } else {
        if(pitchValueChange == 0){
            pitchIndex = 2;
        }
        else if(pitchValueChange == "1"){
            pitchIndex = 12;
        }
        else if(pitchValueChange == "2"){
            pitchIndex = 13;
        }
        else if(pitchValueChange == "3"){
            pitchIndex = 14;
        }
        else if(pitchValueChange == "-1"){
            pitchIndex = 11;
        }
        else if(pitchValueChange == "-2"){
            pitchIndex = 10;
        }
        else if(pitchValueChange == "-3"){
            pitchIndex = 9;
        }
    }

    $('#pitchValue').text(pitchValueChange);
    $('#pitchValue').attr('pitch-value', pitchValueChange);

    if (cc.session) {
        cc.subtitle(pitchIndex);
    }
});
