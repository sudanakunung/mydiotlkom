<?php include 'header.php' ?>
<style>
    .video-js {
      margin: 0 auto;
      width: 100%;
    }
    @media only screen and (max-width: 600px) {
        body {
            background-color: lightblue;
        }
    }
    .loader-ku{display:none;}
</style>
	<section class="bg" style="padding-top: 6rem;">
    <div class="container-fluid section-new">
        <div class="row top-carafie">
            <div class="col-md-12 col-xs-12">
                <div class="row" style="padding: 10px 20px;"> 
                    <div class="col-md-6 col-6 no-padding">
                        <h1 class="top-carafie-text" style="line-height: 2"><?php echo ucfirst($type);?></h1>
                    </div>
                    <div class="col-md-6 col-6 no-padding">
                        <a href="<?php echo site_url($type.'');?>" class="btn btn-circle btn-lg pull-right carafie-button x"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($data['array'] as $key => $value): ?>
                        <div class="col-md-3 col-6 border-carafie <?php echo ($key == 4) ? 'hide':'';?>" onClick="
                            mydiolimit('<?php echo $value['song'];?>', '<?php echo $value['title'];?>')">
                            <div class="row">
                                <div class="col-md-12 no-padding">
                                    <div class="dummy"></div>
                                    <div class="in" style="background-image: url('<?php echo $value['poster'];?>')">
                                    </div>
                                </div>
                                <div class="row margin-title">
                                    <div class="col-md-12">
                                        <p class="title"><?php echo $value['title']; ?></p>
                                        <span class="like"><?php echo $value['artist']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <input type="hidden" id="nomor" value="10">
                <div class="row" id="asd">
                	
                </div>
                <div class="row ">
                    <div class="col-md-12">
                        <center><img id="myloading" class="loader-ku" src="<?php echo base_url('home/images/loader.gif');?>"/></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 id="songtitlelimit"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span>&times</span>
            </button>
        </div>
          <div class="modal-body" >
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <video id=example-video-2 class="video-js vjs-default-skin" controls>
            </video>
          </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-overlay/1.1.4/videojs-overlay.min.js"></script>
<script>
    $(document).ready(function(){
        function alignModal(){
            var modalDialog = $(this).find(".modal-dialog");
            
            // Applying the top margin on modal dialog to align it vertically center
            modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
        }
        // Align modal when it is displayed
        $(".modal").on("shown.bs.modal", alignModal);
        
        // Align modal when user resize the window
        $(window).on("resize", function(){
            $(".modal:visible").each(alignModal);
        });   
    });
    
    var player2 = videojs('example-video-2');
    function mydiolimit(url, songtitle, artist) {
        delete player2.overlay();
        $('#exampleModal2').modal('show');
        $('#songtitlelimit').html(songtitle);
        $('#songartist').html(artist);
        var url = url;
        player2.src(url);
        player2.play();
        return false;
    }
    player2.on('timeupdate',  function(event) {
        event.preventDefault();
        if (this.currentTime() >= 60) {
            //$('#exampleModal2').modal('hide');
            player2.pause();
            overlay_content = '<div><center><h2 class="text-video">For Full Video Please Download Our App</h2></center><a href="https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp&hl=in&showAllReviews=true&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1"><img alt="Temukan di Google Play" src="<?php echo base_url('home/images/google-play-badge.png');?>" class="img-fluid app-download" /></a><a href="https://play.google.com/store/apps/details?id=com.mydiotech.mydiosingapp&hl=in&showAllReviews=true&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" style="margin-left:10px;"><img alt="Temukan di Google Play" src="<?php echo base_url('home/images/app-store.png');?>" class="img-fluid app-download" /></a><div>';
                player2.overlay({
                  overlays: [{
                    start: 'pause',
                    content: overlay_content,
                    end: 'play',
                    align: 'top'
                  }]
                });
            this.currentTime(0);
            return;
        }
        //console.log(this.currentTime());
    });
    $('#exampleModal2').on('hide.bs.modal', function () { 
         player2.pause();
    });
    $('.modal-dialog').draggable({
        handle: ".modal-header"
    });
    
	var win = $(window);
    var request = false;
	win.scroll(function() {
        if (request == false) {
            if (Math.floor($(window).scrollTop()) + $(window).height() == ($(document).height()) || Math.floor($(window).scrollTop())+$(window).height() + 1 == $(document).height() && !request) {
                request=true;
                $('#myloading').removeClass('loader-ku');
                var nomor = $('#nomor').val();
                //$.scrollLock( true );
                $.ajax({
                    url: '<?php echo site_url('Home/trending');?>',
                    type: 'POST',
                    dataType: 'html',
                    data: {no: nomor, type:'<?php echo $typeparam;?>'},
                })
                .done(function(data) {
                    nomor = parseInt(nomor)+10;
                    $('#nomor').val(nomor);
                    console.log(nomor);
                    $('#asd').append(data);
                    $('#myloading').addClass('loader-ku');
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    //$.scrollLock( false );
                    request = false;
                    console.log("complete");
                });
            }
        }
	});
</script>
</body>
</html>
