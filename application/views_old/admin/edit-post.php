<!DOCTYPE html>
<html>
   <head>
       <title>Mydiosing - Admin</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include 'css.php'; ?>
      <!-- CKE+KCF -->
      <script type="text/javascript" src="<?php echo base_url('plugins/ckeditor/ckeditor.js');?>"></script>
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
                     <div class="col-md-9 col-sm-8 col-xs-12">
                        <!--main form-->
            <div class="card">
               <div class="card-header">
                  Posting
               </div>
               <div class="card-body">
                <?php $atr = array(
                  'class' => 'form form-horizontal'
                  ); 
                  echo form_open_multipart('AdminPost/update', $atr);
                  ?>
                  <input type="hidden" name="id" value="<?php echo $artikel['id'];?>">
                     <div class="section">
                        <div class="section-body">
                           <div class="form-group">
                              <label class="col-md-12 control-label" style="margin-bottom: 10px">Judul</label>
                              <div class="col-md-12">
                                 <input type="text" class="form-control" placeholder="Judul" name="judul" value="<?php echo $artikel['judul'];?>">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-12 control-label" style="margin-bottom: 10px">Konten</label>
                              <div class="col-md-12">
                                 <textarea id="editor" cols="400" name="artikel" class="form-control"><?php echo $artikel['artikel'];?></textarea>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-12 control-label" style="margin-bottom: 10px">Meta Deskripsi</label>
                              <div class="col-md-12">
                                 <input type="text" name="meta" class="form-control" placeholder="Meta Deskripsi" value="<?php echo $artikel['meta'];?>">
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
            </div>
<!--end main form-->
         </div>
         <div class="col-md-3 col-sm-4 col-xs-12">
            <div>
            <!--side form-->
            <div class="card">
               <div class="card-body">
                  <button type="submit" class="btn btn-red" style="margin-bottom: 0px;width: 100%">Edit Post</button>
               </div>
            </div><br>
            <div class="card">
              <div class="card-header">
                Bahasa
              </div>
              <div class="card-body">
                 <div class="row">
                     <label class="col-md-12 control-label" style="margin-bottom: 10px">Bahasa</label>
                     <div class="col-md-12">
                        <select class="select2" name="bahasa">
                          <option value="id" <?php echo ($artikel['bahasa'] == 'id') ? 'selected' : '';?>>Bahasa Indonesia</option>
                          <option value="en" <?php echo ($artikel['bahasa'] == 'en') ? 'selected' : '';?>>Bahasa Inggris</option>
                        </select>
                     </div>
                  </div>
              </div>
            </div> 
            <br/>
            <div class="card">
               <div class="card-header">
                  Thumbnail
               </div>
               <div class="card-body">
                  <input style="width:100%;" type="file" name="files" accept="image/*"  onchange="showMyImage(this)" />
                   <br/>
                  <img id="thumbnil" style="width:100%; margin-top:10px;"  src="<?php echo base_url('plugins/kcfinder/upload/images/'.$artikel['thumbnail']);?>"/>
               </div>
            </div>
            </form>
            <!--end side form-->
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
            <?php include 'footer.php'; ?>
         </div>
      </div>
      <?php include 'js.php'; ?>
      <script type="text/javascript">
                CKEDITOR.replace( 'editor',
                {
                    toolbar : 'MyToolbar',
                    width:"100%",
                    height:"80vh",
                    filebrowserBrowseUrl : '<?php echo base_url(); ?>plugins/kcfinder/browse.php?opener=ckeditor&type=files',
                    filebrowserImageBrowseUrl : '<?php echo base_url(); ?>plugins/kcfinder/browse.php?opener=ckeditor&type=images',
                    filebrowserFlashBrowseUrl : '<?php echo base_url(); ?>plugins/kcfinder/browse.php?opener=ckeditor&type=flash',
                    filebrowserUploadUrl : '<?php echo base_url(); ?>kcfinder/upload.php?opener=ckeditor&type=files',
                    filebrowserImageUploadUrl : '<?php echo base_url(); ?>plugins/kcfinder/upload.php?opener=ckeditor&type=images',
                    filebrowserFlashUploadUrl : '<?php echo base_url(); ?>plugins/kcfinder/upload.php?opener=ckeditor&type=flash',
                });
            </script>
            <script type="text/javascript">
               function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
            </script>
   </body>
</html>