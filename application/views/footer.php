<?php
if(!isset($hide_navbar)){ ?>
    <section class="bg d-none d-sm-none d-md-block" style='
        height: 100%;
        background-image: url("<?= base_url('assets/images/bg.png'); ?>");
        background-position: top;
        background-repeat: no-repeat;
        background-size: cover;
        margin-top: auto; 
        margin-bottom: auto;
    '>
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-1">
            <p>&nbsp;</p>
            </div>
            <div class="col-sm-6 content-justify-center text-center" style="height: 90vh; display: flex; justify-content: center; align-items: center;">
                <div style="width: 70%">
                    <img src="<?= base_url('assets/images/logo_mydio.png'); ?>" width="45%">
                    <p>&nbsp;</p>
                    <p class="poppins text-white">MYDIO Sing web app cannot open with desktop version. Please switch to mobile phone device to use<br> <b class="poppins">app.mydiosing.com</b> </p>
                </div>
            </div>
            <div class="col-sm-5">&nbsp;</div>
        </div>
    </div>
    </section>
    <!-- For desktop -->
    <!-- <section class="bg d-none d-sm-none d-md-block" style="padding-top: 0.4rem;padding-bottom: 4rem;">
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
    </section> -->

    <!-- For Mobile -->
    <div class="d-block d-sm-none">
        <div class="footer-mobile">
            <div class="row">
                <?php
                $hal = $this->uri->segment(1);
                ?>
                <a class="col-3 py-2 text-center text-dark"  href="<?= base_url('/'); ?>" style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding-top: .2rem!important;">
                  
                            <img src="<?= ($hal == null) ? base_url('assets/images/telkom/ic_homeline-active.svg') : base_url('assets/images/telkom/ic_home.svg'); ?>" style="width:30px;">
                        <span style="font-size: 10px">
                            Home
                        </span>
                </a>
                <div class="col-3 py-2 text-center" id="friends"style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding-top: .2rem!important;">
                    <?php
                    /* if (!$this->session->has_userdata('memberLogin')) {
                        $redirect_friends = base_url('login?next_url=friends');
                    } else {
                        $redirect_friends = base_url('friends');
                    } */
                    
                    // $redirect_friends = base_url('friends');
                    ?>
                     <!-- <a class="text-dark" href="<?= $redirect_friends; ?>"> -->
                            <img src="<?= ($hal == 'friends') ? base_url('assets/images/telkom/ic_friend-active.svg') : base_url('assets/images/telkom/ic_friend.svg'); ?>" style="width:30px;">
                        <span style="font-size: 10px">
                            Friends
                        </span>
                    <!-- </a> -->
                </div>
                <div class="col-3 py-2 text-center" id="notification"style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding-top: .2rem!important;">
                    <?php
                    if (!$this->session->has_userdata('memberLogin')) {
                        $redirect_notification = base_url('login?next_url=notification');
                    } else {
                        $redirect_notification = base_url('notification');
                    }
                    ?>
                    <!-- <a class="text-dark" href="<?= $redirect_notification; ?>"> -->
                <img src="<?= ($hal == 'notification') ? base_url('assets/images/telkom/ic_bell-active.svg') : base_url('assets/images/telkom/ic_bell.svg'); ?>" style="width:30px;">
                        <span style="font-size: 10px">
                            Notification
                        </span>
                    <!-- </a> -->
                </div>
                <div class="col-3 py-2 text-center" id="profile"style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding-top: .2rem!important;">
                    <?php
                    /* if (!$this->session->has_userdata('memberLogin')) {
                        $redirect_profile = base_url('login?next_url=profile');
                    } else {
                        $redirect_profile = base_url('profile');
                    } */
                    
                    // $redirect_profile = base_url('profile');
                    ?>
                    <!-- <a class="text-dark" href="<?= $redirect_profile; ?>"> -->
                            <?php $userData = $this->db->get_where('users', ['id' => $this->session->userdata('userId')])->row_array();

                            if(!empty($userData['image_profile'])){
                                $src = base_url('uploads/profile/').$user['image_profile'];
                            } else {
                                if($hal == 'profile'){
                                    $src = base_url('assets/images/telkom/ic_profile-active.svg');
                                } else {
                                    $src = base_url('assets/images/telkom/ic_profile.svg');
                                }
                            }
                            ?>
                            <img src="<?= $src; ?>" class="rounded-circle" style="width:30px;">
                       
                        <span style="font-size: 10px">                        
                            Profile
                        </span>
                    <!-- </a> -->
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
        <div class="modal-header" style="background-color:white">
            <h5 id="songtitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span>&times</span>
            </button>
        </div>
          <div class="modal-body" style="background-color:white">
            <video id="example-video" class="video-js vjs-default-skin" controls playsinline>
            </video>
          </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" video-id="">
  <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="overlay-video-2" style="width: 100%; height: 100%; position: absolute; display: none; z-index: 99;">
            </div>

            <div class="modal-header" style="background-color:white">
                <div class="info">
                    <h5 id="songtitlelimit"></h5>
                    <p id="songartist"></p>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span>&times</span>
                </button>
            </div>
            <div class="modal-body example-video-2" style="background-color:white">
                <video id="example-video-2" class="video-js vjs-default-skin" controls playsinline>
                </video>
                
                <div class="row justify-content-center mt-3">
                    <div class="col love-box">
                        <a href="#" class="love" login-status="" love-status="" song-id="" onclick="love_click(); return false;" style="margin:auto">
                            <img src="<?= base_url('assets/images/telkom/love.png'); ?>" class="img-fluid rounded love-icon">
                           
                        </a>
                    </div>
                    <div class="col" id="vocal" data-placement="top" data-content="Turn on and off your vocal">
                        <a href="#" class="vocal" index-track="2" onclick="vocal_onoff(); return false;">
                            <img src="<?= base_url('assets/images/telkom/vocal_on.png'); ?>" class="img-fluid rounded vocal-icon">
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="pitch" onclick="show_pitch_control(); return false;">
                            <img src="<?= base_url('assets/images/telkom/pitch_on.png'); ?>" class="img-fluid rounded pitch-icon">
                        </a>
                    </div>
                    <div class="col" id="cast" data-placement="top" data-content="Cast media to your TV">
                        <a href="#" class="cast" cast-status="off" onclick="cast_run(); return false;">
                            <img src="<?= base_url('assets/images/telkom/cast.png'); ?>"class="img-fluid rounded cast-icon">
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="karafun" data-toggle="modal" data-target="#exampleModal5">
                            <img src="<?= base_url('assets/images/telkom/recording_off.png'); ?>" class="img-fluid rounded karafun-icon">
                        </a>
                    </div>                    
                </div>

                <div id="pitchBox" triger-when-clicks="show" class="row justify-content-center mt-4" style="display: none;">
                    <div class="col-5 text-center">
                        <div class="row align-items-center bg-white rounded">
                            <div class="col-4 text-left p-0">
                                <button class="pitchControl btn btn-primary form-control" pitch-method="minus" style="border: none; background-color: rgb(208, 74, 58);">
                                    <span style="color: white;">-</span>
                                </button>
                            </div>
                            <div class="col-4 text-center">
                                <span id="pitchValue" pitch-value="0">0</span>
                            </div>
                            <div class="col-4 text-right p-0">
                                <button class="pitchControl btn btn-primary form-control" pitch-method="plus" style="border: none; background-color: rgb(208, 74, 58);">
                                    <span style="color: white;">+</span>
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
        <div class="modal-content" style="background-color:white">
        <div class="modal-header">
            <h5 id="songtitleclip"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span>&times</span>
            </button>
        </div>
          <div class="modal-body"style="background-color:white">
            <audio id="example-video-3" class="video-js vjs-default-skin vjs-16-9" data-setup="{}" preload="auto" controls playsinline style="border-radius: .3rem;">
            </audio>
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
                // if (!$this->session->has_userdata('memberLogin')) {
                //     $redirect_subscription_popup = base_url('login?next_url=subscription');
                // } else {
                //     $redirect_subscription_popup = base_url('subscription');
                // }

                $redirect_subscription_popup = base_url('subscription')
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
        <div class="modal-content" style="border-radius: 5px; border-style: solid; border-width: thin; border-color: #212564; padding: 0; height: 250px;">
   
            <!-- Modal body -->
            <div class="modal-body" style="padding: 0;">
                <div class="overlay-preview" style="border-radius: 5px; width: 100%; height: 100%; background: rgba(0,0,0,0.8); position: absolute;">
                    <div class="row px-2" style="margin-top: 100px; height: fit-content;">
                        
                        <div class="col-5 preview-row" style="margin-left: 10px;">
                            <div class="rounded text-white" style="background: #212564; padding: 10px;">
                                <span class="align-middle" style="font-size: 14px;">
                                    <img src="<?= base_url('assets/images/preview_icon_modal.png'); ?>" style="height: 25px;">
                                    &nbsp;
                                    PREVIEW   
                                </span>                         
                            </div>
                        </div>

                        <div class="col-7 add-row" style="margin-left: 150px; position: absolute;">
                            <!-- <a data-toggle="modal" data-target="#exampleModal8" class="text-dark" href="Javascript.void(0)"> -->
                                <div class="rounded text-white" style="background: #212564; padding: 10px;">
                                    <span class="align-middle" style="font-size: 14px;">
                                        <img src="<?= base_url('assets/images/add_to_queing_icon_modal.png'); ?>" style="height: 25px;">
                                        &nbsp;
                                        ADD TO PLAY   
                                    </span>                         
                                </div>
                            <!-- </a> -->
                        </div>

                    </div>
                </div>
                <img src="" class="poster-song-preview" style="border-radius: 5px;width: 100%; height: 100%; object-fit: cover; object-position: 50% 0;">
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

<div class="modal" id="exampleModal10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"style="background-image:url('../assets/images/telkom/bg_effect.svg');background-repeat:no-repeat;background-color:#ffff">
    <div class="modal-dialog"style="background-color:transparent">
        <div class="modal-content" style="border-radius: 5px; background-color:transparent">
            <div class="modal-body" style="background-color:transparent">
                <div class="h-25">&nbsp;</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: white; margin-right: 10px;">&times</span>
                </button>
                <div class="h-100">&nbsp;</div>
                <div class="container h-100">
                    <div class="row h-100 justify-content-center align-items-center">
                        <div class="col-11 col-md-5 col-lg-5">
                            <div class="row justify-content-center">
                                <div class="col-11 col-md-8 col-lg-8">
                                    <img src="<?= base_url('assets/images/telkom/indihome_logo.png'); ?>" width="100%">
                                </div>

                                <div class="col-md-8 mt-5">
                                    <a href="Javascript.void(0)" id="emaillogin" class="btn btn-danger form-control" style="background-color:#cc4c3a" >LOG IN</a>
                                </div>

                                <div class="col-md-8 mt-4 text-center text-black">
                                    <span class="separator">Or login with</span>
                                </div>

                                <div class="col-md-8 mt-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <div id="status"></div>
                                            <a href="" id="siginFacebook" onClick="fbLogin(); return false;" class="btn btn-primary form-control">
                                                <i class="fa fa-facebook" aria-hidden="true"></i>
                                            </a>

                                            <!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                                            </fb:login-button> -->
                                        </div>
                                        <div class="col-6">
                                            <!-- <a href="" id="signinGoogle" class="btn btn-danger form-control">
                                                <i class="fa fa-google" aria-hidden="true"></i>
                                            </a> -->

                                            <a href="<?= $linkOuthGoogle; ?>" class="btn btn-danger form-control">
                                                <i class="fa fa-google" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 mt-4 text-center text-black">
                                    <span style="font-size: 12px;">Dont have account? <b><a class="text-black" href="<?= base_url('register'); ?>">Register</a></b></span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="h-100">&nbsp;</div>
            </div>
        </div>
    </div>
    <div style="position:absolute;bottom:0;color:#8f8f8f:text-align:center;width:100%;text-align:center">
                    <i style="margin-bottom: 0.1rem;color:#8f8f8f;font-size:12px">Powered by</i>
                    <p style="margin-bottom: 0.1rem;color:#8f8f8f">MYDIOWORK Technology</p>
    </div>
</div>

<div class="modal" id="exampleModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px; border-style: solid; border-width: thin; border-color: #212564;">
            <div class="modal-body" style="background:#ffff">
                <div class="h-25">&nbsp;</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: black; margin-right: 10px;">&times</span>
                    </button>
                <div class="h-100">&nbsp;</div>
                <div class="container h-100">
                    <div class="row h-100 justify-content-center align-items-center">
                        <div class="col-11 col-md-5 col-lg-5">
                            <div class="row justify-content-center">

                                <div class="col-11 box-login">
                                    <div class="row">
                                        <div class="col-12 mb-4 mt-5 text-center">
                                            <h3 class="text-black"><b>Log In</b></h3>
                                        </div>
                                        <div class="col-12">
                                            <form id="login-email">

                                                <input type="hidden" name="next_url" value="<?= $this->input->get('next_url'); ?>">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="email" style="background: transparent; color: black; border: 1px solid #ddd; border-right: transparent;">
                                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input name="email" type="text" class="form-control" id="validationDefaultUsername" placeholder="Email Address" aria-describedby="email" style="border-left: transparent;" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-6">
                                                        <a href="Javascript.void(0)" class="btn btn-outline-dark form-control login">CLOSE</a>
                                                    </div>

                                                    <div class="col-6">
                                                        <button type="submit" id="submit" class=" form-control btn-submit text-white" style="background-color:#d04a3a">CONTINUE</button>
                                                    </div>
                                                </div>

                                                <div class="row my-5">
                                                    <div class="col-12 text-black">
                                                        Dont have an Account? <a href="<?= base_url('register'); ?>" class="text-black"><b>Register</b></a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>   				
                                </div>     

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="exampleModal15" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="background-color: white;">
   
            <div class="modal-body text-center mt-3" style="background-color: white;">
                <span style="color: #212563;">You can cast your karaoke video to any tv screen from one device only.</span>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="exampleModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<div class="modal" id="exampleModal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
   
            <!-- Modal body -->
            <div class="modal-body text-center" style="background-color: white;">
                <div class="queue-content mt-3" style="color: #212563;"></div>
            </div>

        </div>
    </div>
</div>

<?php 
if(isset($showScrollTop)){ ?>
<img src="<?= base_url('assets/images/telkom/ic_up.png'); ?>" class="icon-scroll-top" onclick="scrollToTop();" style="display: none;">

<script> 
    function scrollToTop() { 
        $('html,body').animate({ scrollTop: 0 }, 'slow');
    } 

    $(document).scroll(function() {
        var y = $(this).scrollTop();
        if (y > 20) {
            $('.icon-scroll-top').fadeIn();
        } else {
            $('.icon-scroll-top').fadeOut();
        }
    });
</script>
<?php
}
?>

<script type="text/javascript">
    function love_click(){
        
        let login_status = $('.love').attr('login-status');

        if(login_status == 'sudah'){
            // $('.love-icon').attr("src", "<?= base_url('assets/images/loading_player_button.gif'); ?>");

            $('.love-icon').attr("src", "<?= base_url('assets/images/telkom/love.png'); ?>");

            let userId = '<?= $this->session->userdata('userId'); ?>';
            let videoId = $(".love").attr('song-id');
            let status = $(".love").attr('love-status');

            $.ajax({
                url: "<?php echo site_url('Home/likevideo'); ?>",
                type: 'POST',
                data: {
                    'userId': userId,
                    'videoId': videoId,
                    'status': status
                },
            })
            .done(function(data) {
                
                // let currentLikeNumber = parseInt($("#like-"+videoId+"").text());
                
                // let databaseLikeNumber = data.likeFromDatabase;
                
                if(data.status == 200){
                    if(status == "0"){
                        let databaseLikeNumber = data.likeFromDatabase;
                        let newLikeNumber =  (1 + databaseLikeNumber);
                        // let newLikeNumber =  (1 + databaseLikeNumber);
                        $('.love').attr("love-status", "1");
                        $('.love-icon').attr("src", "<?= base_url('assets/images/telkom/love_on.png'); ?>");
                        
                    }else{
                        let databaseLikeNumber = data.likeFromDatabase;
                        let newLikeNumber =  (1 - databaseLikeNumber);
                        // let newLikeNumber =  (1 - databaseLikeNumber);
                        $('.love').attr("love-status", "0");
                        $('.love-icon').attr("src", "<?= base_url('assets/images/telkom/love.png'); ?>");
                        
                        updateLikeNumber(videoId, newLikeNumber);
                    }
                }
                

                // alert(data.message);
            })
            .fail(function(data) {
                alert(data.message);
            })
            if(status == "0"){
            }
        } else {
            alert('Please login first');
            $("#exampleModal10").modal('show');
        }
    }

    function unlikeVideo(){

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

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-playLists/0.2.0/videojs-playlists.js"></script> -->

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

    var player = videojs('example-video', {
        html5: {
            hls: {
                overrideNative: !videojs.browser.IS_SAFARI,
            },
        },
    });

    // player.stopButton();
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

    // player2.stopButton();
    var player2 = videojs('example-video-2');
    
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

        $("#play-icon-"+songId).attr("src", "<?= base_url('assets/images/pause_video.svg'); ?>");
        // clearTimeout();

        if (cc.session) {
            
            $(".poster-song-preview").attr("src", poster);
            $(".preview-row").attr("onclick", "mydiolimit_disable('"+url+"','"+songtitle+"','"+artist+"','"+poster+"','"+song+"','"+songId+"')");
            $(".add-row").attr("onclick", "add_queue('"+song+"','"+songtitle+"','"+artist+"','"+poster+"')");
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

            $("#pitchBox").hide();
            $("#pitchBox").attr("triger-when-clicks", "show");

            $('.love').attr('song-id', songId);
            $('#exampleModal2').attr('video-id', songId);
            $('#exampleModal2').modal('show');

            $('#songtitlelimit').html(songtitle_player2);
            $('#songartist').html(artist_player2);

            $(".vjs-live-control").hide();

            delete player2.overlay();
            player2.src(url);
            player2.play();
            
            window.setTimeout(function () {
                $("#vocal").popover('show');
            }, 1500);

            window.setTimeout(function () {
                $("#vocal").popover('hide');
                $("#vocal").popover('disable');
            }, 7500);

            window.setTimeout(function () {
                $("#cast").popover('show');
            }, 8000);

            window.setTimeout(function () {
                $("#cast").popover('hide');
                $("#cast").popover('disable');
            }, 14000);

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
        //disable_function = 2;

        $(".love").removeAttr("onclick");
        $(".love-icon").attr("src", "./assets/images/telkom/love.png");
        $(".vocal").removeAttr("onclick");
        $(".vocal-icon").attr("src", "./assets/images/telkom/vocal_off.png");
        $(".pitch").removeAttr("onclick");
        $(".pitch-icon").attr("src", "./assets/images/telkom/pitch_off.png");
        if(cc.session){
            $(".cast").attr("onclick", "cast_stop(); return false;");
            $(".cast-icon").attr("src", "./assets/images/telkom/cast_on.png");
        }else{
            $(".cast").removeAttr("onclick");
            $(".cast-icon").attr("src", "./assets/images/telkom/cast.png");
        }
        $(".karafun").removeAttr("data-toggle data-target");
        $(".karafun-icon").attr("src", "./assets/images/telkom/recording_off.png");

        $('#exampleModal2').attr('video-id', songId);
        $('#exampleModal2').modal('show');
        $("#pitchBox").hide();
        $("#pitchBox").attr("triger-when-clicks", "show");
        $("#pitchValue").attr("pitch-value","0");
        $("#exampleModal7").modal('hide');

        $('#songtitlelimit').html(songtitle_player2);
        $('#songartist').html(artist_player2);
        
        $(".vjs-mute-control").hide();
        
        player2.overlay();
        player2.src(url);
        player2.play();
        player2.controlBar.show();        
        return false;
    }

    function add_queue(url, songtitle, artist, poster) {
        if(cc.session){
            song = url;
            title = songtitle;
            singer = artist;
            image = poster;

            add_to_queue(song, title, singer, image);
        }
        $("#exampleModal7").modal('hide');
    }
    
    function cast_run() {
        let status = $(".cast").attr('cast-status');

        if(status == "on" || cc.session) {
            player2.controlBar.show();
            cc.disconnect();
        } else {
            $("#cast").popover('disable');
            cast(''+song_player2+'', ''+songtitle_player2+'', ''+artist_player2+'', ''+poster_player2+'');
        }

        return false;
    }

    function show_list(){
        // cc.initialize();
        // alert(cc.session);
        $("#exampleModal12").modal('show');
        $(".queue-content").html("<span>Queue list is empty.</span>");
        
        play_url = "<?= base_url('assets/images/play_video.svg'); ?>";
        items = viewing();
        
        if(items){
            $(".queue-content").html("");
            
            Object.keys(items).forEach(function(key) {
                // alert(items[key].itemId);
                images = "";
                Object.keys(items[key].media.metadata.images).forEach(function(secondKey){
                    images = ''+items[key].media.metadata.images[secondKey].url+'';
                })
                // alert(JSON.stringify(items[key]));
                // alert(items[key].itemId);
                $(".queue-content").append(`
                <div class="row py-2" style="border-top: solid 1px #d8d8d8;">
                    <div class="col-4">
                        <div style="width: 100%; height: 76px; background-image: url(`+images+`); background-position: top; background-size: cover; background-repeat: no-repeat; border-radius: 5px;">
                            <img class="play-icon" src="`+play_url+`">
                        </div>
                    </div>
                    <div class="col-8 pl-0">
                        <div class="row">
                            <div class="col-12 title-artist">
                                <span class="title"><b>`+items[key].media.metadata.subtitle+`</b></span>
                                <br/>
                                <span class="artist">`+items[key].media.metadata.title+`</span>
                            </div>
                        </div>
                    </div>
                </div>
                `);
            });
        }

        // alert(JSON.stringify(items));
        // $(".queue-content").html(JSON.stringify(items));
        // console.log(items);
        // if(cc.session){
        //     // viewing();
        //     // alert(items[0].itemId);
                
        //     // var item = "";
        //     // for(i=0;i<items.length;i++){
        //     //    item += items[i].media.metadata.title+", "; 
        //     // }

        //     // alert(item);
        // }
    }

    function cast_stop() {
        if(cc.session) {
            player2.muted(true);
            $(".vjs-mute-control").show();
            reset_player();
            cc.disconnect();
            // player2.volume(0);
            
        }
        $(".love").attr("login-status");
        $(".love").attr("love-status");
        $(".love").attr("song-id");
        $(".love").attr("onclick", "love_click(); return false;");
        $(".love-icon").attr("src", "./assets/images/telkom/love.png");

        $(".vocal").attr("onclick", "vocal_onoff(); return false;");
        $(".vocal-icon").attr("src", "./assets/images/telkom/vocal_on.png");

        $(".pitch").attr("onclick", "show_pitch_control(); return false;");
        $(".pitch-icon").attr("src", "./assets/images/telkom/pitch_off.png");

        $(".cast").attr("onclick", "cast_run(); return false;");
        $(".cast-icon").attr("src", "./assets/images/telkom/cast.png");

        $(".karafun").attr("data-toggle");
        $(".karafun").attr("data-target");
        $(".karafun-icon").attr("src", "./assets/images/telkom/recording_off.png");
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

            if(data.status_login == 'sudah'){
                $('.love').attr('login-status', 'sudah');
                if(data.exist){
                    $('.love').attr('love-status', '1');
                    $('.love-icon').attr('src', './assets/images/telkom/love_on.png');
                } else {
                    $('.love').attr('love-status', '0');
                    $('.love-icon').attr('src', './assets/images/telkom/love.png');
                }
            } else {
                $('.love').attr('login-status', 'belum');
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
    // $datasubscribtion = $this->db->get_where('user_subscriptions', ['user_id' => $this->session->userdata('userId')])->row_array();
    
    // if($datasubscribtion){
    //     if($datasubscribtion['valid_to'] > date('Y-m-d H:i:s')){
    //         $data_subs = 1;
    //     } else {
    //         $data_subs = 0;
    //     }
    // } else {
    //     $data_subs = 0;
    // }

    if (!$this->session->has_userdata('memberLogin')) {
        $subscribtion_status = 'FREE';
    } else {
        $reqTime = date('YmdHis');
        $apiCheckSubscribe = $this->client->request('GET', ''.$this->url_api.'/Subscription', [
            'query' => [
                'action' => 'info',
                'sessionId' => $this->session->userdata('sessionId'),
                'reqTime' => $reqTime,
                'sig' => genSignature($reqTime, $this->session->userdata('salt'))
            ]
        ]);
        $subsStatus = json_decode($apiCheckSubscribe->getBody()->getContents(), TRUE);
        $subscribtion_status = $subsStatus[0]['subscription'];
    }

    $subscribtionstatus = $subscribtion_status;

    if($subscribtionstatus == 'FREE'){
        $data_subs = 0;
    } else {
        $data_subs = 1;
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

    var player3 = videojs('example-video-3', {
        html5: {
            hls: {
                overrideNative: !videojs.browser.IS_SAFARI,
            },
        },
    });

    // player3.stopButton();

    var player3 = videojs('example-video-3');
    function mydioclip(url, songtitle, recordId, urlPoster) {

        poster = [urlPoster, '<?php echo base_url('home/images/advert1.jpg');?>', '<?php echo base_url('home/images/advert2.jpg');?>', '<?php echo base_url('home/images/advert3.jpg');?>', '<?php echo base_url('home/images/advert4.jpg');?>', '<?php echo base_url('home/images/advert5.jpg');?>', '<?php echo base_url('home/images/advert6.jpg');?>', '<?php echo base_url('home/images/advert7.jpg');?>'];
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
        $(".vjs-live-control").hide();
        var url = url;
        player3.src(url);
        player3.poster(poster[i]);
        player3.play();
        return false;
    }
    
    $('#exampleModal3').on('hide.bs.modal', function () { 
        player3.pause();
    });

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

    // $('#exampleModal').on('hide.bs.modal', function () { 
    //     player.pause();
    // });

    // $('#exampleModal3').on('hide.bs.modal', function () { 
    //     player3.pause();
    // });

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
        $(".vocal-icon").attr("src", "<?= base_url('assets/images/telkom/vocal_on.png'); ?>");

        $(".pitch").attr("onclick", "show_pitch_control(); return false;");
        $(".pitch-icon").attr("src", "<?= base_url('assets/images/telkom/pitch_on.png'); ?>");
        
        $(".cast").attr("onclick", "cast_run(); return false;");
        if(cc.available) {
            $(".cast-icon").attr("src", "<?= base_url('assets/images/telkom/cast.png'); ?>");
        } else {
            $(".cast-icon").attr("src", "<?= base_url('assets/images/cast_disable.jpg'); ?>");
        }

        $(".karafun").attr({
            "data-toggle": "modal",
            "data-target": "#exampleModal5"
        });
        $(".karafun-icon").attr("src", "<?= base_url('assets/images/telkom/recording_on.png'); ?>");
        
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

<script>
$('#profile').click(function(event){
    event.preventDefault();
    var login = "<?= $this->session->has_userdata('memberLogin'); ?>";
    if(login != ""){
        window.location.href = "<?= base_url('profile'); ?>";
    }else{
        $("#exampleModal10").modal('show');
    }
})
</script>

<script>
$('.login').click(function(event){
    event.preventDefault();
    
    $("#exampleModal11").modal('hide');
    $("#exampleModal10").modal('show');
})
</script>

<script>
$('#notification').click(function(event){
    event.preventDefault();
    var login = "<?= $this->session->has_userdata('memberLogin'); ?>";
    if(login != ""){
        window.location.href = "<?= base_url('notification'); ?>";
    }else{
        $("#exampleModal10").modal('show');
    }
})
</script>

<script>
$('#friends').click(function(event){
    event.preventDefault();
    var login = "<?= $this->session->has_userdata('memberLogin'); ?>";
    if(login != ""){
        window.location.href = "<?= base_url('friends'); ?>";
    }else{
        $("#exampleModal10").modal('show');
    }
})
</script>

<script>
$('#emaillogin').click(function(event){
    event.preventDefault();
    $("#exampleModal10").modal('hide');
    $("#exampleModal11").modal('show');
})
</script>

<script type="text/javascript">
// $(".btn-submit").click(function(event) {
//     $(this).html('<i class="fa fa-spinner fa-pulse fa-fw"></i> LOADING...');
// });

$("#login-email").submit(function(event) {

    event.preventDefault();

    $("#submit").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> LOADING...');

    var form_data = $(this).serialize();

    $.ajax({
        url: '<?= base_url('Login/email'); ?>',
        type: 'POST',
        data: form_data,
        datatype: 'json',
        success: function (data){ 
            
            if(data.status == 200){
                window.location.replace("<?= base_url(); ?>");
            } else {
                alert(data.message);
                $("#submit").html("CONTINUE");
                return false;
            }
        },
        error: function (jqXHR, textStatus, errorThrown){
            $("#submit").html("CONTINUE");
            alert(jqXHR);
            return false;
        }
    }); 
});
</script>

<script>
$('#signinGoogle').click(function(event) {
    event.preventDefault();
	
	$("#signinGoogle").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> LOADING...');
	
    gapi.auth2.authorize({
        
        client_id: '378935023510-92a13olugo9drqb7jes7o52ads4joat8.apps.googleusercontent.com',
        scope: 'email profile openid',
        response_type: 'id_token access_token permission'

    }, function(response) {

        if (response.error) {
            if(response.error == 'popup_closed_by_user'){
                alert('Popup Closed by User');
            }

            return;
        }

        var token_type = response.token_type;
        var accessToken = response.access_token;
        var idToken = response.id_token;

        $.ajax({
            url: "<?= base_url('Login/google'); ?>",
            type: 'POST',
            data: {
                'token_type': token_type,
                'accessToken': accessToken, 
                'idToken': idToken
            },
            datatype: 'json',
            success: function (data){ 
                if(data.status == 200){
                    window.location.replace("<?= base_url('/'.$this->input->get('next_url').''); ?>");
                } else {
                    alert(data.message);
					$("#signinGoogle").html('<i class="fa fa-google" aria-hidden="true"></i>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert(textStatus);
				$("#signinGoogle").html('<i class="fa fa-google" aria-hidden="true"></i>');
            }
        });            
    });

    // auth2 = gapi.auth2.init({
    //     client_id: '378935023510-92a13olugo9drqb7jes7o52ads4joat8.apps.googleusercontent.com',
    //     scope: 'email profile openid',
    //     response_type: 'id_token access_token permission'
    // });

    // // Sign the user in, and then retrieve their ID.
    // auth2.signIn().then(function() {
    //     var profile = auth2.currentUser.get().getBasicProfile();
    //     console.log('ID: ' + profile.getId());
    //     console.log('Full Name: ' + profile.getName());
    //     console.log('Given Name: ' + profile.getGivenName());
    //     console.log('Family Name: ' + profile.getFamilyName());
    //     console.log('Image URL: ' + profile.getImageUrl());
    //     console.log('Email: ' + profile.getEmail());
    // });
});
</script>

<script type="text/javascript">
window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
		appId: '279391043077517', // FB App ID
		// appId: '328408954224270', // FB App ID MYDIOSING
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true, // parse social plugins on this page
        version: 'v6.0' // use graph api version 2.8
    });

    // Check whether the user already logged in
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            FB.logout(function(response) {});
        }
    });
};
    
// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook login with JavaScript SDK
function fbLogin() {
	
	$("#siginFacebook").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> LOADING...');
	
    FB.login(function(response) {
        if (response.authResponse) {

            var accessToken = response.authResponse.accessToken;

            FB.api('/me/', 'GET', {"fields":"email,birthday,first_name,last_name"}, function(response) {
                $.ajax({
					url: "<?= base_url('Login/facebook'); ?>",
					type: 'POST',
					data: {
						'email': response.email,
						'birthday': response.birthday,
						'first_name': response.first_name,
						'last_name': response.last_name,
						'accessToken': accessToken
					},
					datatype: 'json',
					success: function (data){ 
						if(data.status == 200){
							window.location.replace("<?= base_url('/'.$this->input->get('next_url').''); ?>");
						} else {
							alert(data.message);
							$("#siginFacebook").html('<i class="fa fa-facebook" aria-hidden="true"></i>');
						}
					},
					error: function (jqXHR, textStatus, errorThrown){
						alert(textStatus);
						$("#siginFacebook").html('<i class="fa fa-facebook" aria-hidden="true"></i>');
					}
				}); 
            });        

        } else {
            alert('User cancelled login or did not fully authorize.');
			$("#siginFacebook").html('<i class="fa fa-facebook" aria-hidden="true"></i>');
        }
    });
}
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

<script>
function setCookie(cname,cvalue,exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires=" + d.toGMTString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie() {
  var user=getCookie("username");
  if (user != "") {
      $("#vocal").popover('disable');
      $("#cast").popover('disable');
  } else {
     user = "Mydiosing Lite";
     if (user != "" && user != null) {
       setCookie("username", user, 30);
     }
  }
}

window.onload = checkCookie();
</script>

<script src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1"></script>
<script src="<?=base_url('assets'); ?>/js/cast.js"></script>
<script src="<?=base_url('assets'); ?>/js/main.js" crossorigin="anonymous"></script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyBvucMo2z2buOBM-JFec7ydGVOz_bdMaq8",
    authDomain: "mydio-sing-536c2.firebaseapp.com",
    databaseURL: "https://mydio-sing-536c2.firebaseio.com",
    projectId: "mydio-sing-536c2",
    storageBucket: "mydio-sing-536c2.appspot.com",
    messagingSenderId: "292287579277",
    appId: "1:292287579277:web:bddfc74849239b0c1b4ec4"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

  const messaging = firebase.messaging();
</script>

<script>
    messaging.onMessage(function (payload) {
        // $("#exampleModal12").modal('show');
        // $(".queue-content").html("");
        // $(".queue-content").html(JSON.stringify(payload));
        const notificationOption={
            body:payload.message,
            icon: "<?= base_url('assets/images/logo-md.png'); ?>"
        };
        
        var notification=new Notification(payload.title,notificationOption);
        notification.onclick=function (ev) {
            ev.preventDefault();
            window.open("<?= base_url(); ?>",'_blank');
            notification.close();
        }
    });
</script>

<script>
    messaging.requestPermission().then(function(){
        // Get Instance ID token. Initially this makes a network call, once retrieved
        // subsequent calls to getToken will return from cache.
        messaging.getToken().then((currentToken) => {
          if (currentToken) {
            // $("#exampleModal12").modal('show');
            // $(".queue-content").html("");
            // $(".queue-content").html("<span>"+currentToken+"</span>");
            // alert("Your token : "+currentToken);
            sendTokenToServer(currentToken);
            updateUIForPushEnabled(currentToken);
          } else {
            // Show permission request.
            console.log('No Instance ID token available. Request permission to generate one.');
            // Show permission UI.
            updateUIForPushPermissionRequired();
            setTokenSentToServer(false);
          }
        }).catch((err) => {
          console.log('An error occurred while retrieving token. ', err);
          showToken('Error retrieving Instance ID token. ', err);
          setTokenSentToServer(false);
        });
    });
</script>

</body>
</html>