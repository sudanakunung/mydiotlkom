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
</style>

<div class="container pt-5 content-title">
    <div class="row pt-3">
        <div class="col-12">
        	<div class="input-group">
			  	<input type="text" name="keyword" aria-describedby="filter-icon" id="keyword" class="form-control" placeholder="Type the artist or song name" aria-describedby="basic-addon2">
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
        		foreach ($respones['array'] as $key => $value){

        			if($key > 0){
						$border = 'style="border-top: solid 1px #d8d8d8;"';
					} else {
						$border = '';
					}

        			echo "
        			<div class=\"row py-2\" onClick=\"mydiolimit('".$value['urlHls']."', '".addslashes($value['title'])."', '".addslashes($value['artist'])."', '".$value['poster']."')\" $border>
	        			<div class=\"col-12\">
	        				<span>".$value['title']."</span>
	        				<br/>
	        				<small>".$value['artist']."</small>
	        			</div>	
	        		</div>
        			";
        		}
        		?>
        	</div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#keyword").keyup(function(){
  	getSongs($(this).val());
});

$("#keyword").focus(function(){
	if($('.content').height() > 45){
		$('.overlay').css("height", $('.content').height()+20+"px");
	} else {
		$('.overlay').css("height", "100%");
	}

	$('.overlay').show();
});

$("#keyword").focusout(function(){
  	$('.overlay').hide();
});

function getSongs(keyword) {
	$('.content').html('<div class="col-md-12"><center><img id="lazy-loader" src="<?= base_url('home/images/loader.gif');?>"/></center></div>');

	$.ajax({
	    url: '<?= base_url('searchsong/search_song'); ?>',
	    type: 'POST',
	    dataType: 'json',
	    data: {'keyword': keyword}
	})
	.done(function(data) {
	    $('.content').html(data.html);

	    if($('.content').height() > 45){
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
</script>

<?php include 'footer.php'; ?>