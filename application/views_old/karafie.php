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
                        <h1 class="top-carafie-text"><?php echo ucfirst($type);?></h1>
                    </div>
                    <div class="col-md-6 col-6 no-padding">
                        <a href="<?php echo site_url($url);?>" class="btn btn-circle btn-lg pull-right carafie-button x"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="row">
                   	<?php foreach ($data['array'] as $key => $value): ?>
                        <div class="col-md-3 col-6 border-carafie" onClick="mydiosingplay('<?php echo $value['urlRecording'];?>', '<?php echo $value['title'];?>')">
                            <div class="row">
                                <div class="col-md-12 no-padding">
                                    <div class="dummy"></div>
                                    <div class="in" style="background-image: url('<?php echo $value['urlPoster'];?>')">
                                    </div>
                                </div>
                                <div class="row margin-title">
                                    <div class="col-md-12">
                                        <p class="title"><?php echo $value['title']; ?></p>
                                        <span class="like"><i class="fa fa-headphones"></i> <?php echo $value['countListen'];?></span> <span class="like"><i class="fa fa-heart"></i> <?php echo $value['countLike'];?></span>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 id="songtitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span>&times</span>
            </button>
        </div>
          <div class="modal-body" >
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <video id=example-video class="video-js vjs-default-skin" controls>
            </video>
          </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
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

    var player = videojs('example-video');
    function mydiosingplay(url, songtitle) {
        $('#exampleModal').modal('show');
        $('#songtitle').html(songtitle);
        var url = url;
        player.src(url);
        player.play();
        return false;
    }
    $('#exampleModal').on('hide.bs.modal', function () { 
         player.pause();
    });
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
    $('.modal-dialog').draggable({
        handle: ".modal-header"
    });
	var win = $(window);
    var request = false;
	win.scroll(function() {
        if (request == false) {
            if (Math.floor($(window).scrollTop()) + $(window).height() == ($(document).height()) || Math.floor($(window).scrollTop())+$(window).height() + 1 == $(document).height() && !request) {
                $('#myloading').removeClass('loader-ku');
                // $.scrollLock( true );
                var nomor = $('#nomor').val();
                request=true;
                $.ajax({
                    url: '<?php echo site_url('Home/karafie');?>',
                    type: 'POST',
                    dataType: 'html',
                    data: {no: nomor, type:'<?php echo $type;?>'},
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
                    request = false;
                    //$.scrollLock( false );
                    console.log("complete");
                });
            }
        }
	});
</script>
</body>
</html>
