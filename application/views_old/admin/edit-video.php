<!DOCTYPE html>
<html>
   <head>
       <title>Bali Football</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include 'css.php';?>
      <style type="text/css">
         .cke_chrome{
         border: 1px solid #cacaca !important;
         }
         .cke_bottom{
         background:#f0474e !important;
         }
      </style>
   </head>
   <body>
      <div class="app app-default">
         <?php include 'sidebar.php'; ?>
         <div class="app-container">
            <?php include 'header.php'; ?>
            <div class="row">
               <div class="col-xs-12">
                  <div class="contianer">
                     <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <!--main form-->
                           <div class="card">
                              <div class="card-header">
                                 Yutube Videos
                              </div>
                              <div class="card-body">
                                <?php 
                                  $atr = array(
                                    'class' => 'form form-horizontal'
                                  );
                                  echo form_open('Video/update', $atr);;
                                 ?>
                                 <input type="hidden" name='id' value="<?php echo $video['id'];?>">
                                    <div class="section">
                                       <div class="section-body">
                                          <div class="form-group">
                                             <label class="col-md-12 control-label" style="margin-bottom: 10px">Alamat</label>
                                             <div class="col-md-12">
                                                <input type="text" class="form-control" value="<?php echo $video['link']?>" placeholder="Alamat video" name="link" >
                                             </div>
                                          </div>
                                          <button type="submit" class="btn btn-red">Update</button>
                                       </div>
                                    </div>
                                 <?php echo form_close(); ?>
                              </div>
                           </div>
                           <!--end main form-->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php include 'footer.php'; ?>
         </div>
      </div>
      <?php include 'js.php';?>
   </body>
</html>