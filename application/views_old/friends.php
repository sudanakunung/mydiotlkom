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
</style>

<div class="container pt-5 content-title">
    <div class="row">
        <div class="col-12">
        	<div class="content">
        		<div class="row">
        			<div class="col-12 pt-2">
        				<?php 
        				if($friendFeeds <> null){
        					foreach ($friendFeeds as $ff) { ?>
        						<div class="row align-items-center border-bottom py-2">
				        			<div class="col-12">
				        				<div class="row align-items-center pb-2">
				        					<div class="col-2 pr-0">
				        						<?php
				        						if($ff->image_profile <> null || !empty($ff->image_profile)){
				        							$image_profile = base_url('uploads/profile/'.$ff->image_profile.'');
				        						} else {
				        							$image_profile = base_url('uploads/profile/default/default-profile.jpg');
				        						}
				        						?>
				        						<img src="<?= $image_profile; ?>" style="border: solid 2px #1f42ba;" class="img-fluid rounded-circle">
				        					</div>
				        					<div class="col-10 font-weight-bold" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
				        						<?= $ff->name; ?>
				        					</div>
				        				</div>
				        				<div class="row">
				        					<div class="col-12">
				        						<small class="mb-0">
				        							<?= ucwords($ff->log_activity); ?>
				        						</small>
				        						<br />
				        						<?= $ff->description; ?>
				        					</div>		        					
				        				</div>
				        				<div class="row pt-3 pb-2">
				        					<div class="col-5">
				        						<div class="row align-items-center">
				        							<div class="col">
				        								<?php
				        								$this->db->where('id', $ff->id);
														$this->db->where('user_id', $this->session->userdata('userId'));
														$findUser = $this->db->get('feed_likes')->num_rows();

				        								if($findUser > 0){ ?>
				        									<img src="<?= base_url('assets/images/love_friend_feed_red.jpg'); ?>" class="img-fluid love-feed" feed-id="<?= $ff->id; ?>" method="unlike">
				        								<?php
				        								} else { ?>
				        									<img src="<?= base_url('assets/images/love_friend_feed.jpg'); ?>" class="img-fluid love-feed" feed-id="<?= $ff->id; ?>" method="like">
				        								<?php
				        								}
				        								?>				        								
				        							</div>
				        							<div class="col">
				        								<!-- <img src="<?= base_url('assets/images/share_friend_feed.jpg'); ?>" class="img-fluid"> -->
				        							</div>
				        							<div class="col">
				        								<!-- <img src="<?= base_url('assets/images/chat_firend_feed.jpg'); ?>" class="img-fluid"> -->
				        							</div>
				        						</div>
				        					</div>
				        					<div class="col-7 text-right">
				        						<!-- <a href="<?= base_url('uploads') ?>/mydiosing-release.apk">
					        						<img src="<?= base_url('assets/images/record.jpg'); ?>" width="25">
					        					</a> -->
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
$(".love-feed").click(function(){
	let method_love_feed = $(this).attr('method');
	let feedID = $(this).attr('feed-id');

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
        	'feedID': feedID
        }
    })
    .done(function(data) {
    	alert(data.message);

    	if(method_love_feed == "like"){
    		$('img.love-feed[feed-id="'+feedID+'"]').attr('src', '<?= base_url('assets/images/love_friend_feed_red.jpg') ?>');

    		$('img.love-feed[feed-id="'+feedID+'"]').attr('method', 'unlike');
    	} else {
    		$('img.love-feed[feed-id="'+feedID+'"]').attr('src', '<?= base_url('assets/images/love_friend_feed.jpg') ?>');

    		$('img.love-feed[feed-id="'+feedID+'"]').attr('method', 'like');
    	}
    })
    .fail(function() {
        alert('Terjadi Kesalahan dengan Koneksi Internet Anda');
    });

});
</script>