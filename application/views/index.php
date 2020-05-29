<?php include 'header.php';?>

<style type="text/css">
body {
    top: 0 !important;
    background-image: none;
    background-color: #fff;
}
.nav-header{
    z-index: 1; 
    position: absolute; 
    top: 225.5px; 
    width: 100%; 
    background: rgba(0,0,0,0.4);
}
.first.tab-content{
    margin-top: -12px;
}
.button-play.hide,
.button-pause.hide {
    display: none !important;
}
#banner-slider .item img{
    display: block;
    width: 100%;
    height: auto;
}
.nav-fill .nav-item{
    font-size: 14px;
}
.nav-tabs{
    border-bottom: none;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
    background-color: transparent;
    border: none;
    border-bottom: solid 2px;
    margin-bottom: 2px;
}
.second-nav.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
    font-weight: bold;
}
.play-icon{
    position: absolute; 
    left: 42%;
    top: 32%;
    width: 25px;
}
.title-artist{
    line-height: 1.1; 
    height: 48px;
}
.title{
    font-size: 15px;
    line-height: 1;
}
.artist{
    font-size: 13px;
    line-height: 1;
}
.info-icon{
    height: 17px;
}

.bottomMenu {
    display: none;
    position: fixed;
    bottom: 68px;
    /*height: 60px;*/
    z-index: 1;
}

@media only screen and (max-width: 768px) {
    /* For mobile phones: */
    body {
        background-image: none;
        background-color: #fff;
    }
}

@media only screen and (max-width: 411px) {
    .nav-header{
        top: 247.5px;
    }

    .search-box{
        width: 64%;
    }
}

@media only screen and (max-width: 414px) {
    .nav-header{
        top: 245.5px; 
    }

    .search-box{
        width: 260px;
    }
}

@media only screen and (max-width: 375px) {
    .nav-header{
        top: 226.5px;
    }

    .search-box{
        width: 230px;
    }

    .first.tab-content{
        margin-top: -10px;
    }
}

@media only screen and (max-width: 360px) {
    .nav-link{
        padding: .5rem .6rem;
    }

    .nav-header{
        top: 218px;
    }

    .search-box{
        width: 60%;
    }

    .first.tab-content{
        margin-top: -10px;
    }
}

@media only screen and (max-width: 320px) {
    .nav-link{
        padding: .5rem .6rem;
    }
    
    .nav-header{
        top: 195px;
    }

    .search-box{
        width: 55%;
    }

    .first.tab-content{
        margin-top: -9px;
    }
}
</style>

<!-- For desktop -->
<div class="d-none d-md-block">
    <section>
        <div class="container-fluid" style="background:#9699a0;">
            <div class="row">
                <div class="col-md-12 no-padding">
                    <div id="mydiovideo">
                        <div id="video">
                            <?php if ($mobile == true): ?>
                                <video playsinline loop muted <?php echo ($datasaver == true) ? 'controls':'autoplay'; ?>>
                                    <source type="video/mp4" src="<?php echo base_url('home/images/mobile.mp4');?>"></source>
                                </video>
                                <?php else: ?>
                                <video playsinline loop muted autoplay>
                                    <source type="video/mp4" src="<?php echo base_url('home/images/intro.mp4');?>"></source>
                                </video>
                            <?php endif ?>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>

    <!-- download app -->
    <section class="bg">
        <div class="container-fluid section-new">
            <div class="row top-carafie" style="background-image: -webkit-linear-gradient(-30deg, #00004d 0%, #5333ed 49%, #2cd4d9 100%);color: white">
                <div class="col-md-6 col-xs-12">
                    <center><h2 class="tagline">SINGing is believing!</h2>
                    <p class="app-text-2"><?php echo $this->lang->line('Follow your favorite artist and Sing with original music video');?></p>
                </div>
                <div class="col-md-6 col-xs-12">
                    <center>
                    <p class="app-text"><?php echo $this->lang->line('Our app is available. Download now !');?></p>
                    <a href='https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp&hl=in&showAllReviews=true&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Temukan di Google Play' src='<?php echo base_url('home/images/google-play-badge.png');?>' class="img-fluid app-download" /></a>
                    <a href='https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp&hl=in&showAllReviews=true&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Temukan di Google Play' src='<?php echo base_url('home/images/app-store.png');?>' class="img-fluid app-download" /></a>
                    <a href="<?php echo base_url('install'); ?>" class="btn btn-primary btn-lg active app-text" role="button" aria-pressed="true">Download</a>
                </div>
            </div>
        </div>
    </section>

    <!-- berita -->
    <section class="bg">
        <div class="container-fluid section-new">
            <div class="row top-carafie">
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-6 no-padding">
                            <h1 class="top-carafie-text"><?php echo $this->lang->line('Recent News');?></h1>
                        </div>
                        <div class="col-md-6 col-6 no-padding">
                            <a href="<?php echo site_url($url.'/news');?>" class="btn btn-outline-dark pull-right carafie-button"><?php echo $this->lang->line('See All');?></a>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        
                        <div class="col-md-6 no-padding">
                            <a href="<?php echo site_url($url.'/news');?>">
                           <div class="bg-news" style="background-image: url('<?php echo base_url('plugins/kcfinder/upload/images/'.$berita['thumbnail']);?>');">
                            </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?php echo site_url($berita['link']);?>" class="link"><h2 class="judul-preview"><?php echo $berita['judul'] ?></h2></a>
                            <p class="preview-bilboard"><?php echo substr(strip_tags($berita['artikel']), 0, 600).'....<a href="'.site_url($url.'/news').'" class="link">baca selengkapnya</a>'; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- top carafie -->
    <section class="bg">
        <div class="container-fluid section-new">
            <div class="row top-carafie">
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-6 no-padding">
                            <h1 class="top-carafie-text">Top Karafie</h1>
                        </div>
                        <div class="col-md-6 col-6 no-padding">
                            <button onClick="mydioapp()" class="btn btn-outline-dark pull-right carafie-button"><?php echo $this->lang->line('See All');?></button>
                        </div>
                    </div>
                    <div class="row lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/karafie');?>">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- top caraclip -->
    <section class="bg">
        <div class="container-fluid section-new">
            <div class="row top-carafie">
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-6 no-padding">
                            <h1 class="top-carafie-text">Top Karaclip</h1>
                        </div>
                        <div class="col-md-6 col-6 no-padding">
                            <button onClick="mydioapp()" class="btn btn-outline-dark pull-right carafie-button"><?php echo $this->lang->line('See All');?></button>
                        </div>
                    </div>
                    <div class="row lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/karaclip');?>">
                </div>
                </div>
            </div>
        </div>
    </section>

    <!-- top rekomended -->
    <section class="bg">
        <div class="container-fluid section-new">
            <div class="row top-carafie">
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-6 no-padding">
                            <h1 class="top-carafie-text"><?php echo $this->lang->line('Recommended');?></h1>
                        </div>
                        <div class="col-md-6 col-6 no-padding">
                            <button onClick="mydioapp()" class="btn btn-outline-dark pull-right carafie-button"><?php echo $this->lang->line('See All');?></button>
                        </div>
                    </div>
                    <div class="row lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/recommended');?>">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- top trending -->
    <section class="bg">
        <div class="container-fluid section-new">
            <div class="row top-carafie">
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-6 no-padding">
                            <h1 class="top-carafie-text">Trending</h1>
                        </div>
                        <div class="col-md-6 col-6 no-padding">
                            <button onClick="mydioapp()" class="btn btn-outline-dark pull-right carafie-button"><?php echo $this->lang->line('See All');?></button>
                        </div>
                    </div>
                    <div class="row lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/trending');?>">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- For Mobile -->
<div class="d-block d-sm-none" style="padding-bottom: 74px; padding-top: 56px;">
    <div id="banner-slider" class="owl-carousel owl-theme" style="z-index: -1;">
        <?php 
        foreach ($banner_slider['array']  as $bs) { ?>
            <div class="item p-0">
                <img src="<?= $bs['urlImage']; ?>" alt="<?= $bs['title']; ?>">
            </div>
        <?php
        }
        ?>
    </div>

    <nav class="nav-header">
        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active text-white" id="nav-featured-tab" data-toggle="tab" href="#nav-featured" role="tab"
               aria-controls="nav-home" aria-selected="true">FEATURED</a>
            <a class="nav-item nav-link text-white" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab"
               aria-controls="nav-profile" aria-selected="false">ALL</a>
            <a class="nav-item nav-link text-white" id="nav-trending-tab" data-toggle="tab" href="#nav-trending" role="tab"
               aria-controls="nav-contact" aria-selected="false">TRENDING</a>
            <a class="nav-item nav-link text-white" id="nav-feeds-tab" data-toggle="tab" href="#nav-feeds" role="tab"
               aria-controls="nav-contact" aria-selected="false">TOP FEEDS</a>
        </div>
    </nav>
    <!--tabs-->
    <div class="first tab-content bg-white" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-featured" role="tabpanel" aria-labelledby="nav-featured-tab">
            <div class="col-md-12 col-xs-12 lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/recommended');?>">
            </div>
        </div>
        <div class="tab-pane fade" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
            <div class="col-md-12 col-xs-12 lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/all');?>">
            </div>
        </div>
        <div class="tab-pane fade" id="nav-trending" role="tabpanel" aria-labelledby="nav-trending-tab">
            <div class="col-md-12 col-xs-12 lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/trending');?>">
            </div>
        </div>
        <div class="tab-pane fade" id="nav-feeds" role="tabpanel" aria-labelledby="nav-feeds-tab">
            <nav>
                <div class="nav second-nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link text-secondary active" id="nav-karafie-tab" data-toggle="tab" href="#nav-karafie" role="tab"
                       aria-controls="nav-home" aria-selected="true">TOP KARAFIE</a>
                    <a class="nav-item nav-link text-secondary" id="nav-karaclip-tab" data-toggle="tab" href="#nav-karaclip" role="tab"
                       aria-controls="nav-profile" aria-selected="false">TOP KARACLIP</a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-karafie" role="tabpanel" aria-labelledby="nav-karafie-tab">
                    <div class="row mt-1 p-0 lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/karafie');?>">
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-karaclip" role="tabpanel" aria-labelledby="nav-karaclip-tab">
                    <div class="row mt-1 p-0 lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/karaclip');?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="bottomMenu bg-white row text-center">
    <div class="col-12">
        <div class="col-12">
            <img src="<?= base_url('assets/images/logo_md_box.png'); ?>" class="my-2 img-fluid" width="50">
            <p>MYDIO Sing</p>
            <p>Tambahkan MYDIO Sing ke layar awal Anda untuk mendapatkan pengalaman baru yang lebih cepat dan lebih ringan.</p>
            <p>
                <a class="btn btn-info form-control" href="itms-services://?action=download-manifest&url=<?= base_url('uploads/app-debug.apk'); ?>">Ya!</a>
            </p>
        </div>
    </div>
</div> -->

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $("video").lazy();
    });
    $(function() {
        $('.lazy').Lazy({
            effect: 'fadeIn',
            beforeLoad: function(element) {
                element.html('<div class="col-md-12"><center><img id="lazy-loader" src="<?php echo base_url('home/images/loader.gif');?>"/></center></div>');
            },
        });
    });
</script>

<!-- <script type="text/javascript">
    $(document).scroll(function() {
        var y = $(this).scrollTop();
        if (y > 300) {
            $('.bottomMenu').slideDown();
        } else {
            $('.bottomMenu').slideUp();
        }
    });
</script> -->

<!-- <script type="text/javascript">
    function installApp()
    {
        var fallbackToStore = function() {
            window.location.replace('content:');
        };
        var openApp = function() {
            window.location.replace('your_uri_scheme://');
        };
        var triggerAppOpen = function() {
            openApp();
            setTimeout(fallbackToStore, 250);
        };
    }
</script> -->

<script type="text/javascript">
    function notifchat(){
        $.ajax({
            url: "<?= base_url('messenger/notifmessages'); ?>",
            cache: false,
            success: function(data){
                if(data.jumlah > 0){
                    $("#notifchat").show();
                    $("#notifchat").html(data.jumlah);
                }
            }
        });
        var waktu = setTimeout("notifchat()",10000);
    }

    $(document).ready(function(){
        notifchat();
    });
</script>

<?php include 'footer.php' ?>