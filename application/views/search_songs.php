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
			  	<input type="text" name="keyword" aria-describedby="filter-icon" id="keyword" class="form-control" placeholder="Type the artist or song name" aria-describedby="basic-addon2" autocomplete="off" value="<?= $keyword; ?>">
			  	<div class="input-group-append">
			    	<span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
			  	</div>
			</div>
        </div>
    </div>

    <div class="row pt-4">
    	<div class="overlay" style="display: none;"></div>
        <div class="col-12">
        	<p>Search result for you :</p>
        	
        	<div id="content"></div>
        	<div id="content-load-more"></div>
        </div>
    </div>
</div>

<script>
    var limit = 40;
    var start = 0;
    var action = "inactive";
    var keyword = "<?= $keyword; ?>";

    function load_data(limit, start) {
        $("#content-load-more").html('<div class="col-md-12 p-3"><center>Please Wait...</center></div>');

        $.ajax({
           	url: '<?= base_url('SearchSong/search_song'); ?>?keyword='+keyword+'&limit='+limit+'&start='+start+'',
           	method: "GET",
           	cache: false,
            success: function (data) {
                $("#content").append(data);
                if (data == "") {
                    action = "active";
                } else {
                    action = "inactive";
                }

                $("#content-load-more").html("");
            },
        });
    }

    if (action == "inactive") {
        action = "active";
        load_data(10, 0);
    }

    $(window).scroll(function () {
    	if ($(window).scrollTop() + $(window).height() > $("#content").height()-(30/100*$("#content").height()) && action == "inactive") {
            action = "active";
            
            if(start > 0){
                start = start + limit;
            } else {
                start = 10;
            }
            
            load_data(limit, start);
        }
    });
</script>

<script type="text/javascript">
$("#keyword").keyup(function(){
  	getSongs($(this).val());
});

$("#keyword").focus(function(){
	if($('#content').height() > 45){
		$('.overlay').css("height", $('#content').height()+20+"px");
	} else {
		$('.overlay').css("height", "100%");
	}

	$('.overlay').show();
});

$("#keyword").focusout(function(){
  	$('.overlay').hide();
});

function getSongs(keyword) {
	$('#content').html('<div class="col-md-12"><center><img id="lazy-loader" src="<?= base_url('home/images/loader.gif');?>"/></center></div>');

	$.ajax({
	    url: '<?= base_url('SearchSong/search_song'); ?>?keyword='+keyword+'&limit=10&start=0',
       	method: "GET",
       	cache: false,
	})
	.done(function(data) {
		limit = 40;
    	start = 0;
   		action = "inactive";

	    $('#content').html(data);

	    if($('#content').height() > 45){
			$('.overlay').css("height", $('#content').height()+20+"px");
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