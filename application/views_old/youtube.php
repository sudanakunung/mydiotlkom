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
                        <a href="<?php echo site_url($url.'');?>" class="btn btn-circle btn-lg pull-right carafie-button x"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($youtubes as $key => $value): ?>
                        <div class="col-md-3 col-6 border-carafie" onClick="youtube('<?php echo $value['link'] ?>')">
                            <div class="row">
                                <div class="col-md-12 no-padding">
                                    <div class="dummy"></div>
                                    <div class="in" style="background-image: url('<?php echo base_url('uploads/'.$value['thumb']);?>')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
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
            <iframe id="cartoonVideo" width="100%" height="300" src="" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
    function youtube(argument) {
        $('#exampleModal2').modal('show');
        $("#cartoonVideo").attr('src', ''+argument+'?autoplay=1');
    }

    $("#exampleModal2").on('hide.bs.modal', function(){
        $("#cartoonVideo").attr('src', '');
    });
</script>