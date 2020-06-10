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

        				<div class="row align-items-center border-bottom py-2">
		        			<div class="col-12">
		        				<div class="row align-items-center pb-2">
		        					<div class="col-2 pr-0">
		        						<?php 
		        						$src_icon = base_url('uploads/profile/default/default-profile.jpg');
		        						?>
		        						<img src="<?= $src_icon; ?>" style="border: solid 2px #1f42ba;" class="img-fluid rounded-circle">
		        					</div>
		        					<div class="col-10 font-weight-bold" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
		        						Nama Nama Nama Nama Nama Nama Nama Nama Nama
		        					</div>
		        				</div>
		        				<div class="row">
		        					<div class="col-12">
		        						<small class="mb-0">Mood right now</small>
		        						<br />
		        						My status ada disini
		        					</div>		        					
		        				</div>
		        				<div class="row pt-3 pb-2">
		        					<div class="col-5">
		        						<div class="row align-items-center">
		        							<div class="col">
		        								<img src="<?= base_url('assets/images/love_friend_feed.jpg'); ?>" class="img-fluid love-feed" feed-id="1" method="like">
		        							</div>
		        							<div class="col">
		        								<img src="<?= base_url('assets/images/share_friend_feed.jpg'); ?>" class="img-fluid">
		        							</div>
		        							<div class="col">
		        								<img src="<?= base_url('assets/images/chat_firend_feed.jpg'); ?>" class="img-fluid">
		        							</div>
		        						</div>
		        					</div>
		        					<div class="col-7 text-right">
		        						<img src="<?= base_url('assets/images/record.jpg'); ?>" width="25">
		        					</div>
		        				</div>
		        			</div>
		        		</div>

		        		<!-- <div class="row align-items-center py-5">
    						<div class="col-12 text-center">
    							There are no friend feeds yet
    						</div>
    					</div> -->

        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(".love-feed").click(function(){
	let method = $(this).attr('method');
	let feedID = $(this).attr('feed-id');

	if(method == "like"){
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

    	if(method == "like"){
    		$(this).attr('src', '<?= base_url('assets/images/love_friend_feed_red.jpg') ?>');
    	} else {
    		$(this).attr('src', '<?= base_url('assets/images/love_friend_feed.jpg') ?>');
    	}
    })
    .fail(function() {
        alert('Terjadi Kesalahan dengan Koneksi Internet Anda');
    });

});
</script>