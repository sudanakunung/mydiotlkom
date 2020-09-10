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
		white-space: nowrap;
		width: 100%;
		overflow: hidden;
		text-overflow: ellipsis;
		margin-top: 8px;
		line-height: 1.1; 
		height: 40px;
	}
	.title{
		font-size: 17px;
		line-height: 1;
	}
	.artist{
		font-size: 15px;
		line-height: 1;
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

    #filter:focus, #filter:focus-within{
		border: 1px solid #ced4da;
		border-left: 0;
    }    
</style>

<div class="container pt-5 content-title">
    <div class="row pt-3">
        <div class="col-12">
        	<div class="input-group">
			  	<div class="input-group-prepend">
			    	<span class="input-group-text" id="filter-icon">
			    		<i class="fa fa-filter" aria-hidden="true"></i>
			    	</span>
			  	</div>
			  	<select aria-describedby="filter-icon" id="filter" class="form-control">
			  		<?php 
			  		foreach ($data['list_language']['array'] as $key => $value) {
			  			echo '<option value="'.$value[0].'">Category : '.$value[1].'</option>';
			  		}
			  		?>
			  	</select>
			</div>
        </div>
    </div>

    <div class="row pt-4">
        <div class="col-12">
        	<div class="content"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	var keyword = $('#filter').val();

	getSongs(keyword);
});

$("#filter").change(function(){
  	getSongs($(this).val());
});

function getSongs(keyword) {
	$('.content').html('<div class="col-md-12"><center><img id="lazy-loader" src="<?= base_url('home/images/loader.gif');?>"/></center></div>');

	/* $.ajax({
	    url: "<?= site_url('filter-song'); ?>/"+keyword,
	    type: 'GET',
	    dataType: 'json',
	})
	.done(function(data) {
	    $('.content').html(data.html);
	})
	.fail(function() {
	    alert('Terjadi Kesalahan dengan Koneksi Internet Anda');
	})
	.always(function() {
	}); */
	
	$.ajax({
	    url: "<?= base_url('SongCategory/filter_song'); ?>",
	    type: "POST",
	    dataType: "json",
	    data: {"keyword": keyword}
	})
	.done(function(data) {
	    $('.content').html(data.html);
	})
	.fail(function() {
	    alert('An Error Has Occurred With Your Internet Connection');
	})
	.always(function() {
	});
}
</script>