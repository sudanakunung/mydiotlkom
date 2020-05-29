<!DOCTYPE html>
<html>
<head>
  <title>Mydiosing - Admin</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include 'css.php'; ?>

</head>
<body>
  <div class="app app-default">

<?php include 'sidebar.php'; ?>

<div class="app-container">

  <?php include 'header.php'; ?>
<!-- <div class="row">
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                  <a class="card card-banner card-orange-light">
                     <div class="card-body">
                        <i class="icon fa fa-line-chart fa-4x"></i>
                        <div class="content">
                           <div class="title">Page Views</div>
                           <div class="value"><?php echo $pageviews['total'];?><span class="sign"></span></div>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                  <a class="card card-banner card-blue-light" href="<?php echo site_url('data-suara') ?>">
                     <div class="card-body">
                        <i class="icon fa fa-outdent fa-4x"></i>
                        <div class="content">
                           <div class="title">Suara Suporter</div>
                           <div class="value"><span class="sign"></span><?php echo $suara;?></div>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                  <a class="card card-banner card-yellow-light" href="<?php echo site_url('data-post') ?>">
                     <div class="card-body">
                        <i class="icon fa fa-list fa-4x"></i>
                        <div class="content">
                           <div class="title">List Artikel</div>
                           <div class="value"><span class="sign"></span><?php echo $artikel;?></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div> -->
  <footer class="app-footer"> 
  <div class="row">
    <div class="col-xs-12">
      <div class="footer-copyright">
        Copyright © 2016 Company Co,Ltd.
      </div>
    </div>
  </div>
</footer>
</div>
<?php include 'js.php';?>
  </div>
</body>
</html>