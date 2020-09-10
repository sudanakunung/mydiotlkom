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

	aside {
		padding-top: 0 !important;
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

	.play-icon{
	    position: absolute; 
	    left: 42%;
	    top: 32%;
	    width: 25px;
	}
	.title-artist{
	    line-height: 1.1; height: 51px;
	}
	.title{
	    font-size: 13px; line-height: 1;
	}
	.artist{
	    font-size: 11px; line-height: 1;
	}
	.info-icon{
	    height: 17px;
	}

    .footer-mobile{
    	display: none;
    }

    #filter-icon{
    	background: transparent;
	    border-right: 0;
	    padding-right: 0;
    }

    #filter{
    	border-left: 0;
    }

    #keyword, #keyword:focus, #basic-addon2{
    	border: 2px solid rgba(44,103,203,1);
    	border-top: none;
	    border-left: none;
	    border-right: none;
	    border-radius: 0;
    }

    #basic-addon2{
    	background: transparent;
    }
    .overlay{
    	position: absolute;
		top: 110px;
		left: 0;
		width: 100%;
		z-index: 10;
		background-color: rgba(0,0,0,0.5);
    }
    .friend-name{
    	white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    	font-size: 14px;
    }
    .friend-follow{
    	font-size: 12px;
    }
    .friend-profile-box{
    	width: 100%;
        object-fit: cover;
    }
    @media only screen and (max-width: 768px) {
        .friend-profile-box{
            height: 320px;
        }
    }

    @media only screen and (max-width: 414px) {
        .friend-profile-box{
            height: 167px;
        }
    }

    @media only screen and (max-width: 411px) {
        .friend-profile-box{
            height: 165.5px;
        }
    }

    @media only screen and (max-width: 375px) {
        .friend-profile-box{
            height: 147.5px;
        }
    }

    @media only screen and (max-width: 360px) {
        .friend-profile-box{
            height: 140px;
        }
    }

    @media only screen and (max-width: 320px) {
        .friend-profile-box{
            height: 120px;
        }
    }
</style>

<div class="container pt-5 content-title">
    <div class="row pt-3">
        <div class="col-12">
        	<div class="input-group">
			  	<input type="text" name="keyword" aria-describedby="filter-icon" id="keyword" class="form-control" placeholder="Type the name or email" aria-describedby="basic-addon2" autocomplete="off" value="<?= $keyword; ?>">
			  	<div class="input-group-append">
			    	<span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
			  	</div>
			</div>
        </div>
    </div>

    <div class="row pt-4">
    	<div class="overlay" style="display: none;"></div>
        <div class="col-12">
        	<div class="content">
        		<?php
        		if(isset($users)){
        			echo '
        			<p>Search for user \''.$keyword.'\'</p>
					<div id="search-result" class="row">
        			';
        			foreach ($users['array'] as $key => $value) {
        				// $countFollowers = $this->db->get_where('follow_friends', ['following_user_id' => $value->id])->num_rows();

						// $countFollowing = $this->db->get_where('follow_friends', ['user_id' => $value->id])->num_rows();

						if(!empty($value['urlPP']) || $value['urlPP'] != null) {
							if($data = @getimagesize($user['urlPP'])){
								$src_profile_img = $user['urlPP'];
							}else{
								$src_profile_img = base_url('uploads/profile/default/default-profile.jpg');
							}
						} else {
							$src_profile = base_url('uploads/profile/default/default-profile.jpg');
						}
						
						echo '
						<div class="col-6 mb-3 friend" onClick="gotoProfile('.$value['userId'].'); return false">
							<div class="border p-1">
			    				<p class="mb-1">
			        				<img src="'.$src_profile.'" class="friend-profile-box mb-2">
			        			</p>
			    				<p class="mb-1 friend-name">
			    					'.addslashes($value['name']).'
			    				</p>
			    				<p class="mb-1 text-center friend-follow">
			    					'.$value['follower'].' Follower | '.$value['following'].' Following
			    				</p>    
							</div>				
						</div>
						';
        			}

        			echo '</div>';
        		} else { ?>
        			<p><img src="<?= base_url('assets/images/search-friend-icon.jpg'); ?>" /> Search for result is 0</p>
        		<?php
        		}
        		?>
        	</div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#keyword").keyup(function(){
  	getFriends($(this).val());
});

$("#keyword").focus(function(){
	if($('.content').height() > 400){
		$('.overlay').css("height", $('.content').height()+20+"px");
	} else {
		$('.overlay').css("height", "100%");
	}

	$('.overlay').show();
});

$("#keyword").focusout(function(){
  	$('.overlay').hide();
});

function getFriends(keyword) {
	$('.content').html('<div class="col-md-12"><center><img id="lazy-loader" src="<?= base_url('home/images/loader.gif');?>"/></center></div>');

	$.ajax({
	    url: "<?= base_url('SearchFriend/search_friend'); ?>",
	    type: "POST",
	    dataType: "json",
	    data: {"keyword": keyword}
	})
	.done(function(data) {
	    $('.content').html(data.html);

	    if($('.content').height() > 400){
			$('.overlay').css("height", $('.content').height()+20+"px");
		} else {
			$('.overlay').css("height", "100%");
		}

		$('.overlay').show();
	})
	.fail(function() {
	    alert('Terjadi Kesalahan dengan Koneksi Internet Anda');
	})
	.always(function() {
	});
}

function gotoProfile(userID)
{
	window.location = "<?= base_url('friend-profile/'); ?>"+ userID;
}
</script>

<script type="text/javascript">
    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
            load_more_data();
        }
    });

    function load_more_data() {
        
        // $("#"+loadfor+"-load-more").html('<div class="col-md-12"><center><img id="lazy-loader" src="<?php echo base_url('home/images/loader.gif');?>"/></center></div>');

        let last_numItems = $('.friend').length;

        let url = '<?= site_url('friend-by-search/load-more-friends'); ?>';

        $.ajax({
            url: url+'?keyword=<?= $this->input->get('keyword'); ?>&last_items='+last_numItems,
            cache: false,
            success: function(data){
                // $("#"+loadfor+"-load-more").html('');
                $("#search-result").append(data);
            }
        });
    }
</script>

<?php include 'footer.php'; ?>