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
        	<div id="content"></div>
        	<div id="content-load-more"></div>
        </div>
    </div>
</div>

<script>
    var limit = 40;
    var start = 0;
    var action = "inactive";
    var keyword = $('#filter').val();

    function load_data(keyword, limit, start) {
        $("#content-load-more").html('<div class="col-md-12 p-3"><center>Please Wait...</center></div>');

        $.ajax({
           	url: '<?= base_url('SongCategory/filter_song'); ?>?keyword='+keyword+'&limit='+limit+'&start='+start+'',
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
        load_data(keyword, 10, 0);
    }

    $(window).scroll(function () {

    	if ($(window).scrollTop() + $(window).height() > $("#content").height()-(40/100*$("#content").height()) && action == "inactive") {
            action = "active";
            
            if(start > 0){
                start = start + limit;
            } else {
                start = 10;
            }
            
            load_data(keyword, limit, start);
        }
    });
</script>

<script type="text/javascript">
	$("#filter").change(function(){
		keyword = $(this).val();
		getSongs(keyword);
	});

	function getSongs(keyword) {
		$('#content').html('<div class="col-md-12"><center><img id="lazy-loader" src="<?= base_url('home/images/loader.gif');?>"/></center></div>');
		
		$.ajax({
		    url: '<?= base_url('SongCategory/filter_song'); ?>?keyword='+keyword+'&limit=10&start=0',
           	method: "GET",
           	cache: false
		})
		.done(function(data) {
		    limit = 40;
	    	start = 0;
	   		action = "inactive";
		    $('#content').html(data);
		})
		.fail(function() {
		    alert('An Error Has Occurred With Your Internet Connection');
		})
		.always(function() {
		});
	}
</script>