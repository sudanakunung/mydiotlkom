<?php include 'header.php'; ?>
<style>
    .loader-ku{display:none;}
    .card{border:none!important;}
</style>
	<section style="padding-top: 6rem;padding-bottom: 1rem;background:#9699a0;font-family: 'Open Sans', sans-serif;" >
    <div class="container">
        <div class="row">
            <?php $key=0; foreach ($featured as $key => $value):?>
                    <div class="col-md-6 col-xs-12">
                    <div class="card card-news card-height">
                        <div class="card-body no-padding">
                            <img src="<?php echo base_url('plugins/kcfinder/upload/images/'.$value['thumbnail']);?>" class="img-fluid" alt="">
                        </div>
                        <div class="judul">
                            <div class="featured-title">
                                <a href="<?php echo site_url($value['link']);?>"><?php echo $value['judul'];?></a>
                                <div class="news-date">
                                        <?php echo date_format(date_create($value['created_at']), 'j M Y'); ?> || <?php echo $value['author'];?>
                                    </div>
                            </div>
                            <div class="author">
                                <span><i class="fa fa-user"></i> <?php echo $value['author'];?></span>
                            </div>
                        </div>
                        <div class="featured-overlay">

                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <section>
        <div class="container container-post">
            <div class="row">
                <div class="col-md-12">
                    <div class="card listing">
                        <?php foreach ($list as $key => $value):?>
                            <div class="single">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="post-img">
                                        <a href="<?php echo site_url($value['link']);?>">
                                            <img src="<?php echo base_url('plugins/kcfinder/upload/images/'.$value['thumbnail']);?>" class="img-fluid" alt="" style="border-radius:4px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="post-body">
                                        <h2 class="post-title-list"><a href="<?php echo site_url($value['link']);?>"><?php echo $value['judul'];?></a></h2>
                                    </div>
                                    <div class="post-preview">
                                        <?php
                                        $trimstring = '';
                                         if (strlen($value['artikel']) > 300) {
                                          $trimstring = substr($value['artikel'], 0, 300).'....';
                                        }else{
                                          $trimstring = $value['artikel'];
                                        }
                                        echo $trimstring;
                                        ?>
                                    </div>
                                    <hr>
                                    <div class="news-date">
                                        <?php echo date_format(date_create($value['created_at']), 'j M Y'); ?> || <?php echo $value['author'];?>
                                    </div>
                                </div>
                            </div>
                            </div>
                        <?php endforeach ?>
                        <input type="hidden" value="10" id="nomor">
                        <div id="asd"></div>
                        <div class="row ">
                            <div class="col-md-12">
                                <?php if ($key == 3): ?>
                                    <center><button onClick="loadMore()" id="btn-loader" class="btn btn-outline-dark carafie-button">Load more...</button></center>
                                <?php endif ?>
                                
                                <center><img id="myloading" class="loader-ku" src="<?php echo base_url('home/images/loader.gif');?>"/></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<?php include 'footer.php'; ?>
<script src="https://translate.yandex.net/website-widget/v1/widget.js?widgetId=ytWidget&pageLang=id&widgetTheme=dark&autoMode=false" type="text/javascript"></script>
<script>
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
    var win = $(window);
    var request = false;

    function loadMore() {
        $('#btn-loader').css('display', 'none');
        $('#myloading').removeClass('loader-ku');
            var nomor = $('#nomor').val();
            $.ajax({
                url: '<?php echo site_url('Home/getNews/'.$lang);?>',
                type: 'POST',
                dataType: 'json',
                data: {no: nomor},
            })
            .done(function(data) {
                nomor = parseInt(nomor)+4;
                $('#nomor').val(nomor);
                //console.log(nomor);
                $('#asd').append(data.data);
                $('#myloading').addClass('loader-ku');
                if (data.key == 3) {
                    $('#btn-loader').css('display', 'block');
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        }
</script>
</body>
</html>