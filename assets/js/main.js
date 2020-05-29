var cc = new Castjs();

cc.on('available', () => {
  $('#cast').removeClass('disabled')
})

cc.on('session', () => {
  $('#cast').removeClass('disabled')
  $('#cast').addClass('session')
  if (cc.paused) {
    $('#play').removeClass('fa-pause').addClass('fa-play')
  } else {
    $('#play').removeClass('fa-play').addClass('fa-pause')
  }
})

cc.on('disconnect', () => {
  $('#cast').removeClass('session')
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

// $('#cast').on('click', () => {
//   if (cc.available) {
//     cc.cast('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4', {
//       poster:      'https://fenny.github.io/Castjs/demo/poster.jpg',
//       title:       'Sintel',
//       description: 'Third Open Movie by Blender Foundation',
//       subtitles: [{
//           active: true,
//           label:  'English',
//           source: 'https://fenny.github.io/Castjs/demo/english.vtt'
//       }, {
//           label:  'Spanish',
//           source:    'https://fenny.github.io/Castjs/demo/spanish.vtt'
//       }],
//       muted:  false,
//       paused: false
//     })
//   }
// })

function cast(url, songtitle, artist, poster, unsubscibe){
  if (cc.available) {

    // var url = 'https://www5.mydiosing.com:1935/mydiosing/smil:song-122431539766085876.smil/playlist.m3u8';

    // cc.cast(''+url+'', {
    //   poster:      'https://www4.mydiosing.com:8843/poster/poster-12243.jpg',
    //   title:       'Sintel',
    //   description: 'Third Open Movie by Blender Foundation',
    //   subtitles: [{
    //       active: true,
    //       label:  'English',
    //       source: 'https://fenny.github.io/Castjs/demo/english.vtt'
    //   }, {
    //       label:  'Spanish',
    //       source:    'https://fenny.github.io/Castjs/demo/spanish.vtt'
    //   }],
    //   muted:  false,
    //   paused: false
    // })

    cc.cast(''+url+'', {
      poster:      ''+poster+'',
      title:       ''+artist+'',
      description: ''+songtitle+'',
      subtitles: false,
      muted:  false,
      paused: false
    }, unsubscibe)
  }
}

// $('.jq-dropdown-menu').on('click', 'a', function(e) {
//   e.preventDefault();
//   var index = $(this).attr('href')
//   if (cc.session) {
//     cc.subtitle(index)
//   }
//   $('.jq-dropdown-menu a').removeClass('active')
//   $(this).addClass('active')
// })

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

// $('#mute').on('click', () => {
//   if (cc.session) {
//     if ($('#mute').hasClass('fa-volume-up')) {
//       cc.mute();
//       $('#mute').removeClass('fa-volume-up').addClass('fa-volume-mute')
//     } else {
//       cc.unmute();
//       $('#mute').removeClass('fa-volume-mute').addClass('fa-volume-up')
//     }
//   }
// })


$('.button-cast').on('click', () => {
  alert('aa');
})

$('.vjs-play-control').on('click', () => {
  
  if (cc.session) {
    if (player2.paused()) {
      cc.pause();
    } else {
      cc.seek(player2.currentTime(), true);
      cc.play();
    }
  }

})

// $('#play').on('click', () => {
//   if (cc.session) {
//     if ($('#play').hasClass('fa-play')) {
//       cc.play();
//       $('#play').removeClass('fa-play').addClass('fa-pause')
//     } else {
//       cc.pause();
//       $('#play').removeClass('fa-pause').addClass('fa-play')
//     }
//   }
// })

// $('.button-pause').on('click', () => {
//   if (cc.session) {
//     cc.pause();
//     $('.button-pause').addClass('hide');
//     $('.button-play').show();
//     $('.button-play').removeClass('hide');
//   }
// })

// $('.button-play').on('click', () => {
//   if (cc.session) {
//     cc.play();
//     $('.button-play').addClass('hide');
//     $('.button-pause').show();
//     $('.button-pause').removeClass('hide');
//   }
// })

// $('#stop').on('click', () => {
//   if (cc.session) {
//     cc.disconnect();
//     $('#cast').removeClass('session');
//   }
// })

// $('#back').on('click', () => {
//   if (cc.session) {
//     var goback = cc.progress - 1;
//     if (goback <= 0) {
//       goback = 0;
//     }
//     cc.seek(goback)
//   }
// })

// var slider = $('input[type="range"]').rangeslider({
//   polyfill: false,
//   onSlideEnd: function(pos, val) {
//     if (cc.session) {
//       cc.seek(val, true);
//     }
//   }
// });

$('.vjs-progress-control').on('mouseup', () => {
  if (cc.session) {
    // cc.pause();
    cc.seek(player2.currentTime(), false);
  }
})

$('.vjs-volume-control').on('mouseup', () => {
  if (cc.session) {
    cc.volume(player2.volume());
  }
})
