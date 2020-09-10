<section class="bg" style="padding-top: 0.4rem;padding-bottom: 4rem;">
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
<aside style="padding-top: 3rem" class="js-offcanvas" data-offcanvas-options='{ "modifiers": "left,overlay" }' id="off-canvas">
    <ul class="list-unstyled">
    <li>
    </li>
</ul>
</aside>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="<?php echo base_url('home/');?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('home/');?>js/backgroundVideo.js"></script>
<script src="<?php echo base_url('home/');?>js/modernizr.js"></script>    
<script src="https://unpkg.com/js-offcanvas/dist/_js/js-offcanvas.pkgd.min.js"></script> 

</div><script src="https://translate.yandex.net/website-widget/v1/widget.js?widgetId=ytWidget&pageLang=cs&widgetTheme=dark&autoMode=true" type="text/javascript"></script>

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
<script src="https://vjs.zencdn.net/6.10.1/video.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.js"></script>

<script>
    var console = { log: function() {} };
    function mydioapp() {
        $('#exampleModal4').modal('show');
    }

    function search(val)
    {
        if (val.length>0) {
            $("[id='search-result']").css('display', 'block');
            $("[id='auto-complete']").html('<li><a class="sugest" href="<?php echo site_url($url.'/search');?>?query='+val+'&type=onlytitle">search '+val+' on song title</a></li><li><a class="sugest" href="<?php echo site_url($url.'/search');?>?query='+val+'&type=onlyartist">search '+val+' on artist</a></li>')
        }else{
            console.log('work');
            $("[id='search-result']").css('display', 'none');
        }
    }
</script>

<script type="text/javascript">
    $(function() {
        var window_width = $(window).width();
        // var os = navigator.platform;

        if(window_width < 1080){
            $('a[data-auto-download]').each(function() {
                var $this = $(this);
                setTimeout(function() {
                    window.location = $this.attr('href');
                }, 2000);
            });
        }
    });
</script>