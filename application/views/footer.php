<?php
if(!isset($hide_navbar)){ ?>
    <!-- For desktop -->
    <section class="bg d-none d-sm-none d-md-block" style="padding-top: 0.4rem;padding-bottom: 4rem;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-xs-12 text-center">
                    <div class="footer-menu">
                        <a href="<?php echo site_url($url.'/about');?>"><?php echo $this->lang->line('About');?></a>                    
                    </div>
                    <div class="footer-menu">
                        <a href="<?php echo site_url($url.'/tos');?>"><?php echo $this->lang->line('Terms Of Service');?></a>                    
                    </div>
                    <div class="footer-menu">
                        <a href="<?php echo site_url($url.'/news');?>"><?php echo $this->lang->line('News');?></a>
                    </div>
                    <div class="footer-menu">
                        <a href="<?php echo site_url($url.'/contact');?>"><?php echo $this->lang->line('Contact Us');?></a>
                    </div>
                    <div class="footer-menu">
                        <a href="<?php echo site_url($url.'/privacy');?>"><?php echo $this->lang->line('Privacy');?></a>     
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 2.5rem">
                <div class="col-md-6 col-xs-12 offset-md-3 text-center">
                    <a href="https://www.facebook.com/mydiosingofficial/"><button type="button" class="btn btn-footer btn-circle btn-lg"><i class="fa fa-facebook"></i></button></a>
                    <a href="https://www.instagram.com/mydiosing/?hl=id"><button type="button" class="btn btn-footer btn-circle btn-lg"><i class="fa fa-instagram"></i></button></a>
                    <a href="https://twitter.com/mydio_sing"><button type="button" class="btn btn-footer btn-circle btn-lg"><i class="fa fa-twitter"></i></button></a>
                    <a href="<?php echo site_url($url.'/youtube');?>"><button type="button" class="btn btn-footer btn-circle btn-lg"><i class="fa fa-youtube"></i></button></a>
                </div>
            </div>
            <div class="row" style="margin-top: 1rem">
                <div class="col-md-12 col-xs-12 text-center">
                    <span class="footnote">&copy 2018 Mydiowork Technology. All Right Reserved.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- For Mobile -->
    <div class="d-block d-sm-none">
        <div class="footer-mobile">
            <div class="row">
                <?php
                $hal = $this->uri->segment(1);
                ?>
                <div class="col-3 py-2 text-center">
                    <a class="text-dark" href="<?= base_url('/'); ?>">
                        <p style="margin-bottom: 5px;">
                            <img src="<?= ($hal == null) ? base_url('assets/images/home_active.png') : base_url('assets/images/home.png'); ?>" style="height: 24px;">
                        </p>
                        <span style="font-size: 14px">
                            Home
                        </span>
                    </a>
                </div>
                <div class="col-3 py-2 text-center">
                    <a class="text-dark" href="<?= base_url('friends'); ?>">
                        <p style="margin-bottom: 5px;">
                            <img src="<?= ($hal == 'friends') ? base_url('assets/images/friends_active.png') : base_url('assets/images/friends.png'); ?>" style="height: 24px;">
                        </p>
                        <span style="font-size: 14px">
                            Friends
                        </span>
                    </a>
                </div>
                <div class="col-3 py-2 text-center">
                    <a class="text-dark" href="<?= base_url('notification'); ?>">
                        <p style="margin-bottom: 5px;">
                            <img src="<?= ($hal == 'notification') ? base_url('assets/images/notifikasi_active.png') : base_url('assets/images/notifikasi.png'); ?>" style="height: 24px;">
                        </p>
                        <span style="font-size: 14px">
                            Notification
                        </span>
                    </a>
                </div>
                <div class="col-3 py-2 text-center">
                    <a class="text-dark" href="<?= base_url('profile'); ?>">
                        <p style="margin-bottom: 5px;">
                            <?php 
                            $userData = $this->db->get_where('users', ['id' => $this->session->userdata('userId')])->row_array();

                            if(!empty($userData['image_profile'])){
                                $src = base_url('uploads/profile/').$user['image_profile'];
                            } else {
                                if($hal == 'profile'){
                                    $src = base_url('assets/images/profile_active.png');
                                } else {
                                    $src = base_url('assets/images/profile.png');
                                }
                            }
                            ?>
                            <img src="<?= $src; ?>" class="rounded-circle" style="height: 24px;">
                        </p>
                        <span style="font-size: 14px">                        
                            Profile
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <aside style="padding-top: 3rem" class="js-offcanvas" data-offcanvas-options='{ "modifiers": "left,overlay" }' id="off-canvas">
        <ul class="list-unstyled">
            <li></li>
        </ul>
    </aside>

<?php
}
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 id="songtitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span>&times</span>
            </button>
        </div>
          <div class="modal-body">
            <video id="example-video" class="video-js vjs-default-skin" controls>
            </video>
          </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="info">
                    <h5 id="songtitlelimit"></h5>
                    <p id="songartist"></p>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span>&times</span>
                </button>
            </div>
            <div class="modal-body">
                <video id="example-video-2" class="video-js vjs-default-skin" controls playsinline>
                </video>
                
                <div class="row justify-content-center mt-3">
                    <div class="col">
                        <?php 
                        if (isset($data)){
                            if($data['like_exist'] == 1){
                                $love_status = 1;
                                $src_image = base_url('assets/images/love_blue.jpg');
                            } else {
                                $love_status = 0;
                                $src_image = base_url('assets/images/love_white.jpg');
                            }
                        } else {
                            $love_status = 0;
                            $src_image = base_url('assets/images/love_white.jpg');
                        }                
                        ?>

                        <a href="#" class="love" love-status="<?= $love_status; ?>" song-id="">
                            <img src="<?= $src_image; ?>" class="img-fluid rounded love-icon">
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="vocal" index-track="2">
                            <img src="<?= base_url('assets/images/vocal.jpg'); ?>" class="img-fluid rounded vocal-icon">
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="pitch">
                            <img src="<?= base_url('assets/images/pitch.jpg'); ?>" class="img-fluid rounded">
                        </a>
                    </div>
					<div class="col">
                        <a href="#" class="cast" cast-status="off">
                            <img src="<?= base_url('assets/images/cast_disable.jpg'); ?>" class="img-fluid rounded cast-icon">
                        </a>
                    </div>
                    <div class="col">
                        <a href="<?= base_url('uploads') ?>/mydiosing-release.apk">
                            <img src="<?= base_url('assets/images/karafun.jpg'); ?>" class="img-fluid rounded">
                        </a>
                    </div>                    
                </div>

                <div id="pitchBox" triger-when-clicks="show" class="row justify-content-center mt-4" style="display: none;">
                    <div class="col-5 text-center">
                        <div class="row align-items-center bg-white">
                            <div class="col-4 text-left p-0">
                                <button class="pitchControl btn btn-secondary form-control" pitch-method="minus">
                                    <span>-</span>
                                </button>
                            </div>
                            <div class="col-4 text-center">
                                <span id="pitchValue" pitch-value="0">0</span>
                            </div>
                            <div class="col-4 text-right p-0">
                                <button class="pitchControl btn btn-secondary form-control" pitch-method="plus">
                                    <span>+</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 id="songtitleclip"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span>&times</span>
            </button>
        </div>
          <div class="modal-body">
            <video id="example-video-3" class="video-js vjs-default-skin vjs-16-9" controls>
            </video>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 id="songtitleclip"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span>&times</span>
            </button>
        </div>
          <div class="modal-body modal-app" style="background-image: url('<?php echo base_url('home/images/logo-base.png');?>')">
            <div style="text-align: center"><h2 class="text-video-2">Untuk melihat semua, silahkan download aplikasi kami</h2><a href="https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp&hl=in&showAllReviews=true&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1"><img alt="Temukan di Google Play" src="<?php echo base_url('home/images/google-play-badge.png');?>" class="img-fluid app-download" /></a><a href="https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp&hl=in&showAllReviews=true&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" style="margin-left:10px;"><img alt="Temukan di Google Play" src="<?php echo base_url('home/images/app-store.png');?>" class="img-fluid app-download" /></a></div>
          </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(".love").click(function(){
    
    let status = $(this).attr('love-status');

    if(status == "0"){
        <?php 
        if ($this->session->has_userdata('memberLogin')) {
            $userId = $this->session->userdata('userId');
        } else {
            $userId = $this->input->ip_address();
        }
        ?>

        let userId = '<?= $userId; ?>';
        let videoId = $(this).attr('song-id');

        $.ajax({
            url: '<?php echo site_url('Home/likevideo'); ?>',
            type: 'POST',
            data: {
                'userId': userId,
                'videoId': videoId,
                'loginStatus': status
            },
        })
        .done(function(data) {
            
            if(data.status == 200){
                $('.love').attr('love-status', '1');
                $('.love-icon').attr('src', './assets/images/love_blue.png');
            }

            alert(data.message);
        })
        .fail(function(data) {
            alert(data.message);
        })
    } else {
        alert('This video have you ever liked');
    }
});

$(".pitch").click(function(){
    let whenClicksPitch = $("#pitchBox").attr("triger-when-clicks");

    if(whenClicksPitch == "hide"){
        $("#pitchBox").hide();
        $("#pitchBox").attr("triger-when-clicks", "show");
    } else {
        $("#pitchBox").show();
        $("#pitchBox").attr("triger-when-clicks", "hide");
    }
});
</script>

<script src="<?php echo base_url('home/');?>js/backgroundVideo.js"></script>
<script src="<?php echo base_url('home/');?>js/modernizr.js"></script>    
<script src="https://unpkg.com/js-offcanvas/dist/_js/js-offcanvas.pkgd.min.js"></script>

<?php
if(!isset($hide_navbar)){ ?>
    <!-- <script src="https://translate.yandex.net/website-widget/v1/widget.js?widgetId=ytWidget&pageLang=id&widgetTheme=dark&autoMode=false" type="text/javascript"></script> -->
<?php
}
?>

<script>
    $(document).ready(function() {
        $(".navbar-nav").clone().prependTo("#off-canvas");
        $(function() {
            $(document).trigger("enhance");
        });
    });

    // $('#mobile-search').on('focus', function(e) {
    //     e.stopPropagation();
    //     e.preventDefault();
    // });

    window.HELP_IMPROVE_VIDEOJS = false;
</script>

<script src="<?= base_url('assets'); ?>/js/owl.carousel.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#banner-slider").owlCarousel({
 
        navigation : false, // Show next and prev buttons
        pagination :false,
        autoPlay : true,
        slideSpeed : 300,
        paginationSpeed : 400,

        items : 1, 
        itemsDesktop : false,
        itemsDesktopSmall : false,
        itemsTablet: false,
        itemsMobile : false
    });
});
</script>

<script src="<?php echo base_url('assets'); ?>/js/jquery.justified.min.js"></script>

<script src="https://vjs.zencdn.net/6.10.1/video.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.js"></script>

<script>
    var console = {log: function() {}};
    
    function mydioapp() {
        $('#exampleModal4').modal('show');
    }

    function search(val)
    {
        if (val.length>0) {
            $("[id='search-result']").css('display', 'block');
            $("[id='auto-complete']").html('<li><a class="sugest" href="<?php echo site_url($url.'/search');?>?query='+val+'&type=onlytitle">search '+val+' on song title</a></li><li><a class="sugest" href="<?php echo site_url($url.'/search');?>?query='+val+'&type=onlyartist">search '+val+' on artist</a></li>')
        } else {
            console.log('work');
            $("[id='search-result']").css('display', 'none');
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-overlay/1.1.4/videojs-overlay.min.js"></script>

<script>
    $(document).ready(function(){
        function alignModal(){
            var modalDialog = $(this).find(".modal-dialog");

            // Applying the top margin on modal dialog to align it vertically center
            modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
        }
        // Align modal when it is displayed
        $(".modal").on("shown.bs.modal", alignModal);

        // Align modal when user resize the window
        $(window).on("resize", function(){
            $(".modal:visible").each(alignModal);
        });   
    });

    var player = videojs('example-video');
    function mydiosingplay(url, songtitle) {
        $('#exampleModal').modal('show');
        $('#songtitle').html(songtitle);
        var url = url;
        player.src(url);
        player.play();
        return false;
    }

    $('#exampleModal').on('hide.bs.modal', function () { 
        player.pause();
    });

    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }

    var player2 = videojs('example-video-2');
    var url_player2 = '';
    var songtitle_player2 = '';
    var artist_player2 = '';
    var poster_player2 = '';

    function skiptotime(counter)
    {
        player2.currentTime(counter);
        player2.play();
    }

    function reset_player(time)
    {
        player2.currentTime(time);
        player2.play();
    }

    function mydiolimit(url, songtitle, artist, poster, song, songId) {
        delete player2.overlay();

        song_player2 = song;
        songtitle_player2 = songtitle;
        artist_player2 = artist;
        poster_player2 = poster;

        $('.love').attr('song-id', songId);
        $('#exampleModal2').modal('show');
        $('#songtitlelimit').html(songtitle_player2);
        $('#songartist').html(artist_player2);
        
        player2.src(url);
        player2.play();

        if (cc.session) {
            cc.disconnect();

            $(".cast").trigger('click');
        }

        return false;
    }
    
    $(".cast").click(function(e){
        e.preventDefault();

        let status = $(this).attr('cast-status');

        if(status == "on") {
                cc.disconnect();
        } else {
            cast(''+song_player2+'', ''+songtitle_player2+'', ''+artist_player2+'', ''+poster_player2+'');
        }
    });

    <?php 
    $datasubscribtion = $this->db->get_where('user_subscriptions', ['user_id' => $this->session->userdata('userId')])->row_array();

    if(!$data_subscribtion){ ?>
        player2.on('timeupdate',  function(event) {
            event.preventDefault();
            
            if (this.currentTime() >= 60) {

                if (cc.session) {
                    cc.disconnect();
                }
                //$('#exampleModal2').modal('hide');
                player2.pause();
                overlay_content = '<div><center><h2 class="text-video">For Full Video Please Download Our App</h2></center><a href="https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp&hl=in&showAllReviews=true&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1"><img alt="Temukan di Google Play" src="<?php echo base_url('home/images/google-play-badge.png');?>" class="img-fluid app-download" /></a><a href="https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp&hl=in&showAllReviews=true&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" style="margin-left:10px;"><img alt="Temukan di Google Play" src="<?php echo base_url('home/images/app-store.png');?>" class="img-fluid app-download" /></a><div>';
                    player2.overlay({
                        overlays: [{
                            start: 'pause',
                            content: overlay_content,
                            end: 'play',
                            align: 'top'
                        }]
                    });

                this.currentTime(0);

                return;
            }
        });
    <?php
    }
    ?>

    var poster = [];
    var player3 = videojs('example-video-3');
    function mydioclip(url, songtitle, recordId) {
        poster = ['<?php echo base_url('home/images/poster2.jpeg');?>', '<?php echo base_url('home/images/poster3.jpeg');?>'];
        //alert(url);
        $.ajax({
            url: '<?php echo site_url('record-clip');?>',
            type: 'POST',
            dataType: 'json',
            data: {recordId: recordId},
        })
        .done(function(data) {
            if (data['count'] > 0) 
            {
                poster = [];
                $.each(data['array'], function(index, el) {
                    poster.push(el['urlClip']);
                });
            }
        })
        .fail(function() {
            alert('Terjadi Kesalahan dengan Koneksi Internet Anda');
        })
        .always(function() {
            
        });
        $('#exampleModal3').modal('show');
        $('#songtitleclip').html(songtitle);
        var url = url;
        player3.src(url);
        player3.poster(poster[i]);
        player3.play();
        return false;
    }

    var i = 0;
    var x = 0;
    player3.on('timeupdate', function (event) {
        event.preventDefault();
        //console.log(Math.floor(this.currentTime()));
        var lok = Math.floor(this.currentTime());
        if (lok%3 == 0) {
            if (x != lok) {
                x = lok;
                player3.poster(poster[i]);
                i++;
                if (i == poster.length) {
                    i=0;
                }
            }
        }
    })

    $('#exampleModal').on('hide.bs.modal', function () { 
         player.pause();
    });

    $('#exampleModal3').on('hide.bs.modal', function () { 
         player3.pause();
    });

    $('#exampleModal2').on('hide.bs.modal', function () { 
        player2.pause();
        // if (cc.session) {
        //     cc.disconnect();
        // }
    });
    
    $('.modal-dialog').draggable({
        handle: ".modal-header"
    });
</script>

<script src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1"></script>
<script src="<?=base_url('assets'); ?>/js/cast.js"></script>
<script src="<?=base_url('assets'); ?>/js/main.js" crossorigin="anonymous"></script>

<script src="<?= base_url(); ?>upup.min.js"></script>
<script>
UpUp.start({
  // 'content-url': 'offline.html', // Halaman offline belum dibuatkan.
  'assets': ['<?= base_url(); ?>assets/images/logo_md_box.png'],
  'service-worker-url': '<?= base_url(); ?>upup.sw.min.js'
});
</script>
</body>
</html>
