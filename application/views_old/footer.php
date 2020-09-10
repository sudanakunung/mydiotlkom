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
                        <a href="<?php echo site_url($url.'/contact');?>"><?php echo $this->lang->line('Contact');?></a>
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
                    <?php
                    /* if (!$this->session->has_userdata('memberLogin')) {
                        $redirect_friends = base_url('login?next_url=friends');
                    } else {
                        $redirect_friends = base_url('friends');
                    } */
					
					$redirect_friends = base_url('friends');
                    ?>
                     <a class="text-dark" href="<?= $redirect_friends; ?>">
                        <p style="margin-bottom: 5px;">
                            <img src="<?= ($hal == 'friends') ? base_url('assets/images/friends_active.png') : base_url('assets/images/friends.png'); ?>" style="height: 24px;">
                        </p>
                        <span style="font-size: 14px">
                            Friends
                        </span>
                    </a>
                </div>
                <div class="col-3 py-2 text-center">
                    <?php
                    if (!$this->session->has_userdata('memberLogin')) {
                        $redirect_notification = base_url('login?next_url=notification');
                    } else {
                        $redirect_notification = base_url('notification');
                    }
                    ?>
                    <a class="text-dark" href="<?= $redirect_notification; ?>">
                        <p style="margin-bottom: 5px;">
                            <img src="<?= ($hal == 'notification') ? base_url('assets/images/notifikasi_active.png') : base_url('assets/images/notifikasi.png'); ?>" style="height: 24px;">
                        </p>
                        <span style="font-size: 14px">
                            Notification
                        </span>
                    </a>
                </div>
                <div class="col-3 py-2 text-center">
                    <?php
                    /* if (!$this->session->has_userdata('memberLogin')) {
                        $redirect_profile = base_url('login?next_url=profile');
                    } else {
                        $redirect_profile = base_url('profile');
                    } */
					
					$redirect_profile = base_url('profile');
                    ?>
                    <a class="text-dark" href="<?= $redirect_profile; ?>">
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
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" video-id="">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="overlay-video-2" style="width: 100%; height: 100%; background: rgba(0,0,0,0.8); position: absolute; display: none; z-index: 99;">
            </div>

            <div class="modal-header">
                <div class="info">
                    <h5 id="songtitlelimit"></h5>
                    <p id="songartist"></p>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span>&times</span>
                </button>
            </div>
            <div class="modal-body example-video-2">
                <video id="example-video-2" class="video-js vjs-default-skin" controls playsinline>
                </video>
                
                <div class="row justify-content-center mt-3">
                    <div class="col love-box">
                        <a href="#" class="love" love-status="" song-id="" onclick="love_click(); return false;">
                            <img src="<?= base_url('assets/images/love_white.jpg'); ?>" class="img-fluid rounded love-icon">
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="vocal" index-track="2" onclick="vocal_onoff(); return false;">
                            <img src="<?= base_url('assets/images/vocal.jpg'); ?>" class="img-fluid rounded vocal-icon">
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="pitch" onclick="show_pitch_control(); return false;">
                            <img src="<?= base_url('assets/images/pitch.jpg'); ?>" class="img-fluid rounded pitch-icon">
                        </a>
                    </div>
					<div class="col">
                        <a href="#" class="cast" cast-status="off" onclick="cast_run(); return false;">
                            <img src="<?= base_url('assets/images/cast_disable.jpg'); ?>" class="img-fluid rounded cast-icon">
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="karafun" data-toggle="modal" data-target="#exampleModal5">
                            <img src="<?= base_url('assets/images/karafun.jpg'); ?>" class="img-fluid rounded karafun-icon">
                        </a>
                    </div>                    
                </div>

                <div id="pitchBox" triger-when-clicks="show" class="row justify-content-center mt-4" style="display: none;">
                    <div class="col-5 text-center">
                        <div class="row align-items-center bg-white rounded">
                            <div class="col-4 text-left p-0">
                                <button class="pitchControl btn btn-primary form-control" pitch-method="minus">
                                    <span>-</span>
                                </button>
                            </div>
                            <div class="col-4 text-center">
                                <span id="pitchValue" pitch-value="0">0</span>
                            </div>
                            <div class="col-4 text-right p-0">
                                <button class="pitchControl btn btn-primary form-control" pitch-method="plus">
                                    <span>+</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 add-info">
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

<!-- Modal -->
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

<!-- Modal -->
<div class="modal" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <!-- Modal Header -->
            <div class="modal-header">
                <!--
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                -->
            </div>
   
            <!-- Modal body -->
            <div class="modal-body" style="background-color: white;">
                To use these features you must use the MYDIO Sing app on the Play Store. Download this app now?
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp"><input type="submit" name="submit-yes" class="btn btn-primary" value="Yes" target="_blank"></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <!-- Modal Header -->
            <div class="modal-header">
                <!--
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                -->
            </div>
   
            <!-- Modal body -->
            <div class="modal-body" style="background-color: white;">
                Do you want to subscribe now?
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
                <?php
                if (!$this->session->has_userdata('memberLogin')) {
                    $redirect_subscription_popup = base_url('login?next_url=subscription');
                } else {
                    $redirect_subscription_popup = base_url('subscription');
                }
                ?>
                <a href="<?= $redirect_subscription_popup; ?>" class="btn btn-primary">
                    Yes
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    No
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 0; height: 250px">
   
            <!-- Modal body -->
            <div class="modal-body" style="padding: 0;">
                <div class="overlay-preview" style="width: 100%; height: 100%; background: rgba(0,0,0,0.8); position: absolute;">
                    <div class="row px-3" style="margin-top: 100px; height: fit-content;">
                        
                        <div class="col-5 preview-row">
                            <div class="rounded text-white" style="background: #212564; padding: 10px;">
                                <span class="align-middle" style="font-size: 14px;">
                                    <img src="<?= base_url('assets/images/preview_icon_modal.png'); ?>" style="height: 25px;">
                                    &nbsp;
                                    PREVIEW   
                                </span>                         
                            </div>
                        </div>

                        <div class="col-7">
                            <a data-toggle="modal" data-target="#exampleModal8" class="text-dark" href="Javascript.void(0)">
                                <div class="rounded text-white" style="background: #212564; padding: 10px;">
                                    <span class="align-middle" style="font-size: 14px;">
                                        <img src="<?= base_url('assets/images/add_to_queing_icon_modal.png'); ?>" style="height: 25px;">
                                        &nbsp;
                                        ADD TO PLAY   
                                    </span>                         
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
                <img src="" class="poster-song-preview" style="width: 100%; height: 100%; object-fit: cover; object-position: 50% 0;">
            </div>

        </div>
    </div>
</div>

<div class="modal" id="exampleModal8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <!-- Modal Header -->
            <div class="modal-header">
                <!--
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                -->
            </div>
   
            <!-- Modal body -->
            <div class="modal-body" style="background-color: white;">
                <span>To use these features you must use the MYDIO Sing app on the Play Store.</span>
                <br />
                <span>Download this app now?</span>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp" class="btn btn-primary" target="_blank">
                    Yes
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    No
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function love_click(){
        // $('.love-icon').attr("src", "<?= base_url('assets/images/loading_player_button.gif'); ?>");

        $('.love-icon').attr("src", "<?= base_url('assets/images/love_blue.jpg'); ?>");

        <?php 
        if ($this->session->has_userdata('memberLogin')) {
            $userId = $this->session->userdata('userId');
        } else {
            $userId = $this->input->ip_address();
        }
        ?>

        let userId = '<?= $userId; ?>';
        let videoId = $(".love").attr('song-id');
        let status = $(".love").attr('love-status');

        if(status == "0"){
            $.ajax({
                url: "<?php echo site_url('Home/likevideo'); ?>",
                type: 'POST',
                data: {
                    'userId': userId,
                    'videoId': videoId
                },
            })
            .done(function(data) {
                
                let currentLikeNumber = parseInt($("#like-"+videoId+"").text());
                let databaseLikeNumber = data.likeFromDatabase;
                let newLikeNumber =  (currentLikeNumber + databaseLikeNumber);

                if(data.status == 200){
                    $('.love').attr("love-status", "1");
                    $('.love-icon').attr("src", "<?= base_url('assets/images/love_blue.jpg'); ?>");
                }

                updateLikeNumber(videoId, newLikeNumber);

                // alert(data.message);
            })
            .fail(function(data) {
                alert(data.message);
            })
        } else {
            $('.love-icon').attr("src", "<?= base_url('assets/images/love_blue.jpg'); ?>");
            alert('You have liked this video before');
        }
    }

    function updateLikeNumber(getVideoID, number){
        $("span#like-"+getVideoID+"").html(number);
    }

    function show_pitch_control() {
        let whenClicksPitch = $("#pitchBox").attr("triger-when-clicks");

        if(whenClicksPitch == "hide"){
            $("#pitchBox").hide();
            $("#pitchBox").attr("triger-when-clicks", "show");
        } else {
            $("#pitchBox").show();
            $("#pitchBox").attr("triger-when-clicks", "hide");
        }
    }
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
<script src="<?php echo base_url('assets'); ?>/js/videojs-stop-button.js"></script>
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

    var player2 = videojs('example-video-2', {
        html5: {
            hls: {
                overrideNative: !videojs.browser.IS_SAFARI,
            },
        },
    });

    player2.stopButton();
    
    var url_player2 = '';
    var songtitle_player2 = '';
    var artist_player2 = '';
    var poster_player2 = '';
    var disable_function = '';
    var muted_status = '';
    var songId_player2 = '';
    var timeCurrent = 0;

    function skiptotime(counter)
    {
        player2.currentTime(counter);
        player2.play();
    }

    function reset_player(playing)
    {
        player2.currentTime(0);
        player2.play();        
    }

    function mydiolimit(url, songtitle, artist, poster, song, songId) {
        
        // $("#play-icon-"+songId).attr("src", "<?= base_url('assets/images/loading_suggest.gif'); ?>");

        $("#play-icon-"+songId).attr("src", "<?= base_url('assets/images/pause_video.png'); ?>");
        
        if (cc.session) {
            
            $(".poster-song-preview").attr("src", poster);
            $(".preview-row").attr("onclick", "mydiolimit_disable('"+url+"','"+songtitle+"','"+artist+"','"+poster+"','"+song+"','"+songId+"')");
            $("#exampleModal7").modal('show');
        
        } else {
        
            song_player2 = song;
            songtitle_player2 = songtitle;
            artist_player2 = artist;
            poster_player2 = poster;
            songId_player2 = songId;
            disable_function = 1;
            
            muted_status = player2.muted();
            if(muted_status){
                player2.muted(true);
            } else {
                player2.volume(1);
            }

            checkLikeVideo(songId);

            // var video_liked = $(".row-video-"+songId).attr("video-liked");

            // if(video_liked == '1'){
            //     $('.love').attr('love-status', '1');
            //     $('.love-icon').attr('src', './assets/images/love_blue.jpg');
            // } else {
            //     $('.love').attr('love-status', '0');
            //     $('.love-icon').attr('src', './assets/images/love_white.jpg');
            // }

            $('.love').attr('song-id', songId);
            $('#exampleModal2').attr('video-id', songId);
            $('#exampleModal2').modal('show');

            $('#songtitlelimit').html(songtitle_player2);
            $('#songartist').html(artist_player2);

            delete player2.overlay();
            player2.src(url);
            player2.play();

            // if (cc.session) {
            //     cc.disconnect();
            //     $(".cast").trigger('click');
            // }
        }

        return false;
    }

    function mydiolimit_disable(url, songtitle, artist, poster, song, songId) {
        song_player2 = song;
        songtitle_player2 = songtitle;
        artist_player2 = artist;
        poster_player2 = poster;
        songId_player2 = songId;
        disable_function = 2;

        $(".love").removeAttr("onclick");
        $(".love-icon").attr("src", "./assets/images/love_blue_disable.jpg");
        $(".vocal").removeAttr("onclick");
        $(".vocal-icon").attr("src", "./assets/images/vocal_disable.jpg");
        $(".pitch").removeAttr("onclick");
        $(".pitch-icon").attr("src", "./assets/images/pitch_disable.jpg");
        $(".cast").removeAttr("onclick");
        $(".cast-icon").attr("src", "./assets/images/cast_disable.jpg");
        $(".karafun").removeAttr("data-toggle data-target");
        $(".karafun-icon").attr("src", "./assets/images/karafun_disable.jpg");

        $('#exampleModal2').attr('video-id', songId);
        $('#exampleModal2').modal('show');

        $("#exampleModal7").modal('hide');

        $('#songtitlelimit').html(songtitle_player2);
        $('#songartist').html(artist_player2);
        
        $(".vjs-mute-control").hide();

        player2.overlay();
        player2.src(url);
        player2.play();
        player2.muted(true);

        return false;
    }
    
    function cast_run() {
        let status = $(".cast").attr('cast-status');

        if(status == "on") {
                cc.disconnect();
        } else {
            cast(''+song_player2+'', ''+songtitle_player2+'', ''+artist_player2+'', ''+poster_player2+'');
        }

        return false;
    }

    function checkLikeVideo(videoID){

        // $('.love-icon').attr('src', './assets/images/loading_player_button.gif');
        
        $.ajax({
            url: "<?= base_url('Home/checkLikeVideo'); ?>",
            type: 'POST',            
            data: { "videoID" : videoID },
            async: false
        })
        .done(function(data) {
            if(data.exist){
                $('.love').attr('love-status', '1');
                $('.love-icon').attr('src', './assets/images/love_blue.jpg');
            } else {
                $('.love').attr('love-status', '0');
                $('.love-icon').attr('src', './assets/images/love_white.jpg');
            }

            // if(data.exist){
            //     $(".row-video-"+videoID).attr("video-liked", "1");
            // } else {
            //     $(".row-video-"+videoID).attr("video-liked", "0");
            // }
        })
        .fail(function() {
            alert('An Error Has Occurred With Your Internet Connection');
        })
    }
	
	<?php 
	$datasubscribtion = $this->db->get_where('user_subscriptions', ['user_id' => $this->session->userdata('userId')])->row_array();
	
	if($datasubscribtion){
		if($datasubscribtion['valid_to'] > date('Y-m-d H:i:s')){
			$data_subs = 1;
		} else {
			$data_subs = 0;
		}
	} else {
		$data_subs = 0;
	}
	?>
	
	var data_subs;
	$(document).ready(function(){
		data_subs = <?= $data_subs; ?>;
	});

    player2.on('timeupdate',  function(event) {
        event.preventDefault();
		
		<?php 
        if($data_subs == 0){ ?>

            var currentTimeUpdate = Math.floor(this.currentTime());

            if (currentTimeUpdate >= 60) {

                if(disable_function == 1){
                    if (cc.session) {
                        cc.disconnect();
                    }
                }

                // $('#exampleModal2').modal('hide');
                $('.overlay-video-2').show();
                $('#exampleModal6').modal('show');

                this.currentTime(0);
                this.pause();

                // overlay_content = '<div><center><h2 class="text-video">For Full Video Please Download Our App</h2></center><a href="https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp&hl=in&showAllReviews=true&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1"><img alt="Temukan di Google Play" src="<?php echo base_url('home/images/google-play-badge.png');?>" class="img-fluid app-download" /></a><a href="https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp&hl=in&showAllReviews=true&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" style="margin-left:10px;"><img alt="Temukan di Google Play" src="<?php echo base_url('home/images/app-store.png');?>" class="img-fluid app-download" /></a><div>';

                // player2.overlay({
                //     overlays: [{
                //         start: 'pause',
                //         content: overlay_content,
                //         end: 'play',
                //         align: 'top'
                //     }]
                // });

                // return;
            }

        <?php
        }
        ?>
    });
    
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
        // console.log(Math.floor(this.currentTime()));
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

    // $('#exampleModal2').on('show.bs.modal', function () {
    //     $("#play-icon-"+songId_player2).attr("src", "<?= base_url('assets/images/loading_poster.gif'); ?>");
    // });

    $('#exampleModal2').on('hide.bs.modal', function () { 
        
        // checkLikeVideo(songId_player2);

        $("#play-icon-"+songId_player2).attr("src", "<?= base_url('assets/images/play_video.png'); ?>");

        player2.pause();

        $(".overlay-video-2").hide();

        if(disable_function == 2){  
            $(".vjs-mute-control").show();
        } 

        $(".love").attr("onclick", "love_click(); return false;");
        
        $(".vocal").attr({
            "index-track": "2",
            "onclick": "vocal_onoff(); return false;"
        });
        $(".vocal-icon").attr("src", "<?= base_url('assets/images/vocal.jpg'); ?>");

        $(".pitch").attr("onclick", "show_pitch_control(); return false;");
        $(".pitch-icon").attr("src", "<?= base_url('assets/images/pitch.jpg'); ?>");
        
        $(".cast").attr("onclick", "cast_run(); return false;");
        if(cc.available) {
            $(".cast-icon").attr("src", "<?= base_url('assets/images/cast.jpg'); ?>");
        } else {
            $(".cast-icon").attr("src", "<?= base_url('assets/images/cast_disable.jpg'); ?>");
        }

        $(".karafun").attr({
            "data-toggle": "modal",
            "data-target": "#exampleModal5"
        });
        $(".karafun-icon").attr("src", "<?= base_url('assets/images/karafun.jpg'); ?>");
        
        // if (cc.session) {
        //     cc.disconnect();
        // }
    });

    $('#exampleModal6').on('hide.bs.modal', function () { 
        $('#exampleModal2').modal('hide');
    });
    
    $('.modal-dialog').draggable({
        handle: ".modal-header"
    });
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/UpUp/1.1.0/upup.min.js"></script>
<script>
/* var filesToCache = [
  '<?= base_url(); ?>',
  '<?= base_url(); ?>login',
  '<?= base_url(); ?>login/showloginemail',
  '<?= base_url(); ?>register',
  '<?= base_url(); ?>friends',
  '<?= base_url(); ?>notification',
  '<?= base_url(); ?>profile',
  '<?= base_url(); ?>song-by-category',
  '<?= base_url(); ?>subscription',
  '<?= base_url(); ?>subscription/success',
  '<?= base_url(); ?>subscription/cancel',
  '<?= base_url(); ?>setting',
  '<?= base_url(); ?>lazy/karaclip',
  '<?= base_url(); ?>lazy/karafie',
  '<?= base_url(); ?>lazy/trending',
  '<?= base_url(); ?>lazy/all',
  '<?= base_url(); ?>assets/images/add_image.png',
  '<?= base_url(); ?>assets/images/banner_subscription.jpg',
  '<?= base_url(); ?>assets/images/cast.jpg',
  '<?= base_url(); ?>assets/images/cast_on.jpg',
  '<?= base_url(); ?>assets/images/chat.png',
  '<?= base_url(); ?>assets/images/chat_firend_feed.jpg',
  '<?= base_url(); ?>assets/images/friends_active.png',
  '<?= base_url(); ?>assets/images/home.png',
  '<?= base_url(); ?>assets/images/icon_mic.jpg',
  '<?= base_url(); ?>assets/images/karafun.jpg',
  '<?= base_url(); ?>assets/images/kategori.png',
  '<?= base_url(); ?>assets/images/logo_md_box.png',
  '<?= base_url(); ?>assets/images/logo-md.png',
  '<?= base_url(); ?>assets/images/love.png',
  '<?= base_url(); ?>assets/images/love_blue.jpg',
  '<?= base_url(); ?>assets/images/love_blue_disable.jpg',
  '<?= base_url(); ?>assets/images/love_friend_feed.jpg',
  '<?= base_url(); ?>assets/images/love_friend_feed_red.jpg',
  '<?= base_url(); ?>assets/images/love_white.jpg',
  '<?= base_url(); ?>assets/images/menu.png',
  '<?= base_url(); ?>assets/images/mobile_bg.jpg',
  '<?= base_url(); ?>assets/images/no_vocal.jpg',
  '<?= base_url(); ?>assets/images/notif_gear.jpg',
  '<?= base_url(); ?>assets/images/notifikasi.png',
  '<?= base_url(); ?>assets/images/notifikasi_active.png',
  '<?= base_url(); ?>assets/images/pitch.jpg',
  '<?= base_url(); ?>assets/images/pitch_disable.jpg',
  '<?= base_url(); ?>assets/images/play_video.png',
  '<?= base_url(); ?>assets/images/preview_icon_modal.png',
  '<?= base_url(); ?>assets/images/profile.png',
  '<?= base_url(); ?>assets/images/profile_active.png',
  '<?= base_url(); ?>assets/images/record.jpg',
  '<?= base_url(); ?>assets/images/record.png',
  '<?= base_url(); ?>assets/images/search-friend-icon.jpg',
  '<?= base_url(); ?>assets/images/share_friend_feed.jpg',
  '<?= base_url(); ?>assets/images/subscription_3_month.jpg',
  '<?= base_url(); ?>assets/images/subscription_monthly.jpg',
  '<?= base_url(); ?>assets/images/subscription_yearly.jpg',
  '<?= base_url(); ?>assets/images/tab_bg.jpg',
  '<?= base_url(); ?>assets/images/view.png',
  '<?= base_url(); ?>assets/images/vocal.jpg',
  '<?= base_url(); ?>assets/images/vocal_disable.jpg',
  '<?= base_url(); ?>assets/images/webpage-logo.png',
  '<?= base_url(); ?>assets/pwa_icons/icon-1000x1000.png'
]; */

var filesToCache = [
  '<?= base_url(); ?>assets/pwa_icons/icon-1000x1000.png'
];

UpUp.start({
  // 'content-url': 'offline.html', // Halaman offline belum dibuatkan.
  // 'assets': filesToCache,
  'service-worker-url': './upup.sw.min.js'
});
</script>

<script src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1"></script>
<script src="<?=base_url('assets'); ?>/js/cast.js"></script>
<script src="<?=base_url('assets'); ?>/js/main.js" crossorigin="anonymous"></script>

</body>
</html>