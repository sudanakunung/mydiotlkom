<style type="text/css">
    body {
    	top: 0 !important;
	    background-image: none;
	    background-color: #fff;
	}

	@media only screen and (max-width: 768px) {
	    /* For mobile phones: */
	    body {
	        background-image: none;
	        background-color: #fff;
	    }
	}

	/*aside {
		padding-top: 0 !important;
	}*/	

	.friend-profile{
        border: solid 2px #1f42ba;
        width: 100%;
    }

    .poster-recording{
    	width: 100%;
    	height: 229px;
    	object-fit: cover;
    	object-position: 50% 0;
    }

    @media only screen and (max-width: 768px) {
        .friend-profile{
            height: 105px;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 414px) {
        .friend-profile{
            height: 54px;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 411px) {
        .friend-profile{
            height: 53.5px;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 375px) {
        .friend-profile{
            height: 47.5px;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 360px) {
        .friend-profile{
            height: 45px;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 320px) {
        .friend-profile{
            height: 38.33px;
            object-fit: cover;
        }
    }

    .col-comment{
    	position: relative;
    }

    .input-comment{
    	width: 100%; 
    	border-radius: 7px;
    	padding: 5px 10px;
    	border: solid 1px #5e678e;
    }

    .send-icon{
    	position: absolute; position: absolute;
	    right: 25px;
	    top: 8px;
	    font-size: 20px;
	    color:#080808;
    }

    .col-created-at{
    	font-size: 8px; 
    	font-weight: bold;
    }

    .info-views{
    	font-size: 12px; 
    	font-weight: bold; 
    	color: #080808;
    }

    .info-title{
    	font-size: 15px; 
    	font-weight: bold; 
    	color: #080808;
    }

    .input-comment::-webkit-input-placeholder {
	  	font-size: 13px;
	}
	.input-comment::-moz-placeholder {
	  	font-size: 13px;
	}
	.input-comment:-ms-input-placeholder {
	  	font-size: 13px;
	}
	.input-comment:-moz-placeholder {
	  	font-size: 13px;
	}

	.play-icon{
		left: 43%;
	    top: 35%;
	    width: 55px;
	}
</style>

<div class="container pt-5 content-title">
    <div class="row">
        <div class="col-12">
        	<div class="content">
        		<div class="row">
        			<div class="col-12 pt-2">
        				<?php 
        				if($friendFeeds['total'] <> 0){
        					foreach ($friendFeeds['array'] as $ff) { ?>
        						<div class="row align-items-center border-bottom py-2">
				        			<div class="col-12">
				        				<div class="row align-items-center pb-2">
				        					<div class="col-2 pr-0">
				        						<?php
				        						if(!empty($ff['urlPP']) || $ff['urlPP'] != null) {
													if($data = @getimagesize($ff['urlPP'])){
														$src_profile_img = $ff['urlPP'];
													}else{
														$src_profile_img = base_url('assets/images/profile.png');
													}
												} else {
													$src_profile_img = base_url('assets/images/profile.png');
												}
				        						?>

				        						<img src="<?= $src_profile_img; ?>" class="rounded-circle friend-profile">
				        					</div>
				        					<div class="col-10 font-weight-bold" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
				        						<?= $ff['name']; ?>
				        					</div>
				        				</div>
				        				<div class="row" onClick="mydioclip('<?= $ff['urlRecordingAudio']; ?>', '<?= str_replace(array("\r\n","'"), array(" ","`"), $ff['title']); ?>', '<?= $ff['recordingId']; ?>')">
				        					<div class="col-12 position-relative">
				        						<img class="play-icon" src="<?= base_url('assets/images/play_video.png'); ?>">
				        						<img src="<?= $ff['urlPoster']; ?>" class="img-fluid rounded poster-recording">
				        					</div>		        					
				        				</div>
				        				<div class="row pt-3 pb-2">
				        					<div class="col-5">
				        						<div class="row align-items-center">
				        							<div class="col">
				        								<?php 
				        								$reqTime = date('YmdHis');

				        								$params = [
															'type' => 'status',
															'id' => $ff['recordingId'],
															'sessionId' => $this->session->userdata('sessionId'),
															'reqTime' => $reqTime,
															'sig' => genSignature($reqTime, $this->session->userdata('salt'))
														];

				        								$api_likestatus = $this->curl->simple_get(''.$this->url_api.'/Like?' . http_build_query($params));

														$likeStatus = json_decode($api_likestatus, true);

														if($likeStatus['islike'] == 1){ ?>
															<img src="<?= base_url('assets/images/telkom/ic_love.svg'); ?>" class="img-fluid love-feed" feed-id="<?= $ff['recordingId'] ?>" method="unlike">
														<?php
														} else { ?>
															<img src="<?= base_url('assets/images/telkom/ic_heart.svg'); ?>" class="img-fluid love-feed" feed-id="<?= $ff['recordingId'] ?>" method="like">
														<?php
														}
				        								?>	
				        							</div>
				        							<div class="col">
				        								<a data-toggle="modal" data-target="#exampleModal5" href="Javascript.void(0)">
					        								<img src="<?= base_url('assets/images/telkom/ic_share.svg'); ?>" class="img-fluid">
					        							</a>
				        							</div>
				        							<div class="col">
				        								<a data-toggle="modal" data-target="#exampleModal5" href="Javascript.void(0)">
					        								<img src="<?= base_url('assets/images/telkom/ic_chat.svg'); ?>" class="img-fluid">
					        							</a>
				        							</div>
				        						</div>
				        					</div>
				        					<div class="col-7 text-right">
				        						<a data-toggle="modal" data-target="#exampleModal5" href="Javascript.void(0)">
					        						<img src="<?= base_url('assets/images/telkom/ic_record.svg'); ?>" width="25">
					        					</a>
				        					</div>
				        				</div>

				        				<div class="row">
				        					<div class="col-12">
				        						<hr>
				        						<span class="info-views">
				        							<?= $ff['countListen']; ?> views
				        						</span>
				        						<br>
				        						<span class="info-title">
					        						<?= $ff['title']; ?>
					        					</span>
					        				</div>
					        				<div class="col-12 mt-1 mb-2 col-comment">
				        						<input type="text" class="input-comment" placeholder="Comment..." readonly="true">
				        						<span class="material-icons align-middle send-icon">send</span>
				        					</div>
				        					<div class="col-12 text-secondary col-created-at">
				        						<span>
					        						<?= date("M d", strtotime($ff['dtUpload'])); ?>
					        					</span>
				        					</div>
				        				</div>
				        			</div>
				        		</div>
        					<?php
        					}
        				} else { ?>
        					<div class="row align-items-center py-5">
	    						<div class="col-12 text-center">
	    							There are no friend feeds yet
	    						</div>
	    					</div>
        				<?php
        				}
        				?>

        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(".input-comment").click(function(){
	$('#exampleModal5').modal('show');
});

$(".love-feed").click(function(){
	let method_love_feed = $(this).attr('method');
	let recordingID = $(this).attr('feed-id');

	if(method_love_feed == "like"){
        var url_like = "<?= base_url('Friends/store_feed_like'); ?>";
    } else {
        var url_like = "<?= base_url('Friends/delete_feed_like'); ?>";
    }

    $.ajax({
        url: url_like,
        type: 'POST',
        dataType: 'json',
        data: {
        	'recordingID': recordingID
        }
    })
    .done(function(data) {
    	alert(data.message);

    	if(method_love_feed == "like"){
    		$('img.love-feed[feed-id="'+recordingID+'"]').attr('src', '<?= base_url('assets/images/love_friend_feed_red.jpg') ?>');

    		$('img.love-feed[feed-id="'+recordingID+'"]').attr('method', 'unlike');
    	} else {
    		$('img.love-feed[feed-id="'+recordingID+'"]').attr('src', '<?= base_url('assets/images/love_friend_feed.jpg') ?>');

    		$('img.love-feed[feed-id="'+recordingID+'"]').attr('method', 'like');
    	}
    })
    .fail(function() {
        alert('An Error Has Occurred With Your Internet Connection');
    });

});
</script>