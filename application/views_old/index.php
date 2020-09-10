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

.bottomMenu {
    display: none;
    position: fixed;
    bottom: 68px;
    /*height: 60px;*/
    z-index: 1;
}

.overlay{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    background-color: rgba(0,0,0,0.5);
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
                        <!-- <div id="video">
                            <?php if ($mobile == true): ?>
                                <video playsinline loop muted <?php echo ($datasaver == true) ? 'controls':'autoplay'; ?>>
                                    <source type="video/mp4" src="<?php echo base_url('home/images/mobile.mp4');?>"></source>
                                </video>
                                <?php else: ?>
                                <video playsinline loop muted autoplay>
                                    <source type="video/mp4" src="<?php echo base_url('home/images/intro.mp4');?>"></source>
                                </video>
                            <?php endif ?>
                        </div> -->
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
    <!-- <section class="bg">
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
    </section> -->

    <!-- top caraclip -->
    <!-- <section class="bg">
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
    </section> -->

    <!-- top rekomended -->
    <!-- <section class="bg">
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
    </section> -->

    <!-- top trending -->
    <!-- <section class="bg">
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
    </section> -->
</div>

<!-- For Mobile -->
<div class="overlay" style="display: none;"></div>
<div class="d-block d-sm-none" style="padding-bottom: 74px; padding-top: 56px;">
    <div id="banner-slider" class="owl-carousel owl-theme" style="z-index: -1;">
        <?php
        foreach ($data['banner_slider']['array']  as $bs) { ?>
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
               aria-controls="nav-home" aria-selected="true" search="song">FEATURED</a>
            <a class="nav-item nav-link text-white" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab"
               aria-controls="nav-profile" aria-selected="false" search="song">ALL</a>
            <a class="nav-item nav-link text-white" id="nav-trending-tab" data-toggle="tab" href="#nav-trending" role="tab"
               aria-controls="nav-contact" aria-selected="false" search="song">
                TRENDING
            </a>
            <a class="nav-item nav-link text-white" id="nav-feeds-tab" data-toggle="tab" href="#nav-feeds" role="tab"
               aria-controls="nav-contact" aria-selected="false" search="friend">
                TOP FEEDS
            </a>
        </div>
    </nav>
    <!--tabs-->
	<div class="col-md-12 loading" style="display: block;">
		<center><img id="lazy-loader" src="<?php echo base_url('home/images/loader.gif');?>"/></center>
	</div>
    
	<div class="first tab-content bg-white" id="nav-tabContent" style="display: none;">
        <div class="tab-pane fade show active" id="nav-featured" role="tabpanel" aria-labelledby="nav-featured-tab">
            <div class="container">
				<?php
				foreach ($featured['array'] as $key => $value){

					if($key > 0){
						$border = 'style="border-top: solid 1px #d8d8d8;"';
					} else {
						$border = '';
					}

					$this->db->where('video_id', $value['songId']);
					$countLikeDatabase = $this->db->get('video_like')->num_rows();

					if($countLikeDatabase > 0){
						$likeNumber = ($value['like']+$countLikeDatabase);
					} else {
						$likeNumber = $value['like'];
					}

                    // Check Apakah user pernah like video
                    if ($this->session->has_userdata('memberLogin')) {
                        $this->db->where('user_id', $this->session->userdata('userId'));            
                    } else {
                        $this->db->where('ip_address', $this->input->ip_address());
                    }
                    $this->db->where('video_id', $value['songId']);
                    $checkUser = $this->db->get('video_like')->num_rows();
                    if($checkUser > 0){
                        $exist_liked = 1;
                    } else {
                        $exist_liked = 0;
                    }

					echo '
					<div class="row py-2" onClick="mydiolimit(\''.$value['urlHls'].'\', \''.$value['title'].'\', \''.$value['artist'].'\', \''.$value['poster'].'\', \''.$value['song'].'\', \''.$value['songId'].'\')" '.$border.' video-liked="'.$exist_liked.'">
						<div class="col-4">
							<img class="poster-video" src="'.$value['poster'].'" />
							<img id="play-icon-'.$value['songId'].'" class="play-icon" src="'.base_url('assets/images/play_video.png').'">
						</div>
						<div class="col-8 pl-0">
							<div class="row">
								<div class="col-12 title-artist">
									<span class="title"><b>'.$value['title'].'</b></span>
									<br/>
									<span class="artist">'.$value['artist'].'</span>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-4 pr-0">
									<span class="align-middle" style="font-size: 12px;">
										<img class="info-icon" src="'.base_url('assets/images/view.png').'">&nbsp;&nbsp;'.$value['view'].'
									</span>                                
								</div>
								<div class="col-4 pr-0">
									<span class="align-middle" style="font-size: 12px;">
										<img class="info-icon" src="'.base_url('assets/images/love.png').'">&nbsp;&nbsp;<span id="like-'.$value['songId'].'">'.$likeNumber.'</span>
									</span>
								</div>
								<div class="col-4 pr-0">
									<span class="align-middle" style="font-size: 12px;">
										<img class="info-icon" src="'.base_url('assets/images/record.png').'">&nbsp;&nbsp;'.$value['rec'].'
									</span>
								</div>
							</div>
						</div>
					</div>
					';
				}
				?>

				<!--<div class="col-md-12 col-xs-12 lazy" data-loader="ajax" data-src="<?= site_url('lazy/recommended'); ?>">
				</div>-->
			</div>
        </div>
        <div class="tab-pane fade" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
            <div class="container">
				<?php
				foreach ($newsong['array'] as $key => $value){

					if($key > 0){
						$border = 'style="border-top: solid 1px #d8d8d8;"';
					} else {
						$border = '';
					}

					$this->db->where('video_id', $value['songId']);
					$countLikeDatabase = $this->db->get('video_like')->num_rows();

					if($countLikeDatabase > 0){
						$likeNumber = ($value['like']+$countLikeDatabase);
					} else {
						$likeNumber = $value['like'];
					}

					echo '
					<div class="row py-2" onClick="mydiolimit(\''.$value['urlHls'].'\', \''.$value['title'].'\', \''.$value['artist'].'\', \''.$value['poster'].'\', \''.$value['song'].'\', \''.$value['songId'].'\')" '.$border.'>
						<div class="col-4">
							<img class="poster-video" src="'.$value['poster'].'" />
							<img class="play-icon" src="'.base_url('assets/images/play_video.png').'">
						</div>
						<div class="col-8 pl-0">
							<div class="row">
								<div class="col-12 title-artist">
									<span class="title"><b>'.$value['title'].'</b></span>
									<br/>
									<span class="artist">'.$value['artist'].'</span>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-4 pr-0">
									<span class="align-middle" style="font-size: 12px;">
										<img class="info-icon" src="'.base_url('assets/images/view.png').'">&nbsp;&nbsp;'.$value['view'].'
									</span>                                
								</div>
								<div class="col-4 pr-0">
									<span class="align-middle" style="font-size: 12px;">
										<img class="info-icon" src="'.base_url('assets/images/love.png').'">&nbsp;&nbsp;<span id="like-'.$value['songId'].'">'.$likeNumber.'</span>
									</span>
								</div>
								<div class="col-4 pr-0">
									<span class="align-middle" style="font-size: 12px;">
										<img class="info-icon" src="'.base_url('assets/images/record.png').'">&nbsp;&nbsp;'.$value['rec'].'
									</span>
								</div>
							</div>
						</div>
					</div>
					';
				}
				?>

				<!--<div class="col-md-12 col-xs-12 lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/all'); ?>">
				</div>-->
			</div>
        </div>
        <div class="tab-pane fade" id="nav-trending" role="tabpanel" aria-labelledby="nav-trending-tab">
            <div class="container">
				<?php
				foreach ($mostrecent['array'] as $key => $value){

					if($key > 0){
						$border = 'style="border-top: solid 1px #d8d8d8;"';
					} else {
						$border = '';
					}

					$this->db->where('video_id', $value['songId']);
					$countLikeDatabase = $this->db->get('video_like')->num_rows();

					if($countLikeDatabase > 0){
						$likeNumber = ($value['like']+$countLikeDatabase);
					} else {
						$likeNumber = $value['like'];
					}

					echo '
					<div class="row py-2" onClick="mydiolimit(\''.$value['urlHls'].'\', \''.$value['title'].'\', \''.$value['artist'].'\', \''.$value['poster'].'\', \''.$value['song'].'\', \''.$value['songId'].'\')" '.$border.'>
						<div class="col-4">
							<img class="poster-video" src="'.$value['poster'].'" />
							<img class="play-icon" src="'.base_url('assets/images/play_video.png').'">
						</div>
						<div class="col-8 pl-0">
							<div class="row">
								<div class="col-12 title-artist">
									<span class="title"><b>'.$value['title'].'</b></span>
									<br/>
									<span class="artist">'.$value['artist'].'</span>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-4 pr-0">
									<span class="align-middle" style="font-size: 12px;">
										<img class="info-icon" src="'.base_url('assets/images/view.png').'">&nbsp;&nbsp;'.$value['view'].'
									</span>                                
								</div>
								<div class="col-4 pr-0">
									<span class="align-middle" style="font-size: 12px;">
										<img class="info-icon" src="'.base_url('assets/images/love.png').'">&nbsp;&nbsp;<span id="like-'.$value['songId'].'">'.$likeNumber.'</span>
									</span>
								</div>
								<div class="col-4 pr-0">
									<span class="align-middle" style="font-size: 12px;">
										<img class="info-icon" src="'.base_url('assets/images/record.png').'">&nbsp;&nbsp;'.$value['rec'].'
									</span>
								</div>
							</div>
						</div>
					</div>
					';
				}
				?>

				<!--<div class="col-md-12 col-xs-12 lazy" data-loader="ajax" data-src="<?php echo site_url('lazy/trending'); ?>">
				</div>-->
			</div>
        </div>
        <div class="tab-pane fade" id="nav-feeds" role="tabpanel" aria-labelledby="nav-feeds-tab">
            <nav>
                <div class="nav second-nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link text-secondary active" id="nav-karafie-tab" data-toggle="tab" href="#nav-karafie" role="tab"
                       aria-controls="nav-home" aria-selected="true" search="friend">TOP KARAFIE</a>
                    <a class="nav-item nav-link text-secondary" id="nav-karaclip-tab" data-toggle="tab" href="#nav-karaclip" role="tab"
                       aria-controls="nav-profile" aria-selected="false" search="friend">TOP KARACLIP</a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-karafie" role="tabpanel" aria-labelledby="nav-karafie-tab">
                    <div class="container">
                        <div class="row mt-1">
							<?php
                            $break_after = 3;
							$break_after_second = 9;
							$counter = 0;
							$html = '';
							foreach ($karafie['array'] as $key => $value) {
								
								if ($counter % $break_after == 0) {
									if ($counter == 0) {
										$class_item = "gallery";
										$html.='<div class="gallery">';
									} else {
										if ($counter % $break_after_second == 0) {
											$class_item = "gallery3";
											$html.='<div class="gallery3">';
										} else {
											$class_item = "gallery2";
											$html.='<div class="gallery2">';
										}
									}
								}

								$number = ($counter % $break_after) + 1;
									
								$html .='
								<figure class="'.$class_item.'__item--'.$number.'" onClick="mydiosingplay(\''.$value['urlM3U8'].'\', \''.$value['title'].'\')">
									<img src="'.$value['urlPoster'].'" class="gallery__img">
								</figure>
								<p class="'.$class_item.'__icon--'.$number.'">
									<i class="fa fa-video-camera text-white" aria-hidden="true"></i>
								</p>
								';

								if ($counter % $break_after == ($break_after-1)) {
									$html.='</div>';
								}

								++$counter;
							}

							if ((($counter-1) % $break_after) != ($break_after-1)) {
								$html.='</div>';
							}

							echo $html;							
							?>
							<!--<div 
                                class="col-12 p-0 lazy" 
                                data-loader="ajax" 
                                data-src="<?php echo site_url('lazy/karafie');?>
                            "></div>-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-karaclip" role="tabpanel" aria-labelledby="nav-karaclip-tab">
                    <div class="container">
                        <div class="row mt-1">
                            <?php 
							$break_after = 3;
							$break_after_second = 9;
							$counter = 0;
							$html = '';
							foreach ($karaclip['array'] as $key => $value) {
								if ($counter % $break_after == 0) {
									if ($counter == 0) {
										$class_item = "gallery";
										$html.='<div class="gallery">';
									} else {
										if ($counter % $break_after_second == 0) {
											$class_item = "gallery3";
											$html.='<div class="gallery3">';
										} else {
											$class_item = "gallery2";
											$html.='<div class="gallery2">';
										}
									}
								}

								$number = ($counter % $break_after) + 1;
									
								$html .='
								<figure class="'.$class_item.'__item--'.$number.'" onClick="mydioclip(\''.$value['urlM3U8'].'\', \''.$value['title'].'\', \''.$value['recordingId'].'\')">
									<img src="'.$value['urlPoster'].'" class="gallery__img">
								</figure>
								<p class="'.$class_item.'__icon--'.$number.'">
									<i class="fa fa-video-camera text-white" aria-hidden="true"></i>
								</p>
								';

								if ($counter % $break_after == ($break_after-1)) {
									$html.='</div>';
								}

								++$counter;
							}

							if ((($counter-1) % $break_after) != ($break_after-1)) {
								$html.='</div>';
							}

							echo $html;
							?>
							<!--<div 
                                class="col-12 p-0 lazy" 
                                data-loader="ajax" 
                                data-src="<?php echo site_url('lazy/karaclip');?>
                            "></div>-->
                        </div>
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
	$(window).bind("load", function() {
		$(".loading").hide();
		$("#nav-tabContent").show();
	});

    function notifchat(){
        $.ajax({
            url: "<?= base_url('Messenger/notifmessages'); ?>",
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
        // notifchat();
    });
</script>

<script type="text/javascript">
    $(".search").focus(function(e){
        e.preventDefault();
        
        $('.overlay').show();
        $('.search-suggest').hide();
    });
    
    $('.search').keyup(function(event){
		
		let searchFor = $('.search').attr('yang-dicari');
		let keyword = $(this).val();
			
        if(event.keyCode == 13){
            $('.search-suggest').hide();

			if(searchFor == "song"){
				window.location = "<?= base_url('song-by-search?keyword=') ?>" + keyword;
			} else {
				window.location = "<?= base_url('friend-by-search?keyword=') ?>" + keyword;
			}
        } else {
            let yang_dicari = $(this).attr("yang-dicari");
            getDatas(keyword, yang_dicari);
        }
    });
    
    $('.search-icon').click(function(event){
        $('.search-suggest').hide();
        let keyword = $('.search').val();
        let searchFor = $('.search').attr('yang-dicari');
        
        if(searchFor == "song"){
            var urlClickFromIcon = "<?= base_url('song-by-search?keyword=') ?>" + keyword;
        } else {
            var urlClickFromIcon = "<?= base_url('friend-profile/') ?>" + keyword;
        }

        window.location = urlClickFromIcon;
    });

    $(".search").blur(function(e){
        $(".artist-suggest").one('click', function (event) {
            event.preventDefault();
            
            let keyword = $(this).attr('key-word');
            let searchFor = $('.search').attr('yang-dicari');

            $(this).append('&nbsp;&nbsp;<img src="<?= base_url('assets/images/loading_suggest.gif'); ?>" height="20">');
        
            if(searchFor === "song"){
                var urlEnterKeyboard = "<?= base_url('song-by-search?keyword=') ?>" + keyword;
            } else {
                var urlEnterKeyboard = "<?= base_url('friend-profile/') ?>" + keyword;
            }
            window.location = urlEnterKeyboard;
        });

        $(".overlay").click(function() {
            $('.overlay').hide();
            $('.search-suggest').hide();
			$('.search').val("");
        });
    });

    function getDatas(keyword, yang_dicari) {
        if(yang_dicari == "song"){
            var url_search = "<?= base_url('SearchSong/search_song_suggest'); ?>";
        } else {
            var url_search = "<?= base_url('SearchFriend/search_friend_suggest'); ?>";
        }
        
        $('.search-suggest').html('<div class="col-md-12"><center><img id="lazy-loader" src="<?= base_url('home/images/loader.gif');?>"/></center></div>');
        
        $('.overlay').show();
        
        $('.search-suggest').show();
        
        $.ajax({
            url: url_search,
            type: 'POST',
            dataType: 'json',
            data: {'keyword': keyword}
        })
        .done(function(data) {
            $('.search-suggest').html(data.html);
        })
        .fail(function() {
            alert('Terjadi Kesalahan dengan Koneksi Internet Anda');
        });
    }

    $(".nav-item").click(function(e){
        let searchFor = $(this).attr('search');

        if(searchFor == "song"){
            $(".search").attr("placeholder", "Search Artist or Song's Title...");
            $(".search").attr("yang-dicari", "song");
        } else {
            $(".search").attr("placeholder", "Search MYDIO Friends...");
            $(".search").attr("yang-dicari", "friend");
        }
    });
</script>