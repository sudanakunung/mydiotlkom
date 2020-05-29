<!DOCTYPE html>
<html>
   <head>
       <title>Mydiosing - Admin</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include 'css.php'; ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap-datetimepicker.min.css">
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
                  echo form_open_multipart('AdminPost/add', $atr);
                  ?>
                     <div class="section">
                        <div class="section-body">
                           <div class="form-group">
                              <label class="col-md-12 control-label" style="margin-bottom: 10px">Judul</label>
                              <div class="col-md-12">
                                 <input type="text" class="form-control" placeholder="Judul" name="judul">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-12 control-label" style="margin-bottom: 10px">Konten</label>
                              <div class="col-md-12">
                                 <textarea id="editor" cols="400" name="artikel" class="form-control"></textarea>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-12 control-label" style="margin-bottom: 10px">Meta Deskripsi</label>
                              <div class="col-md-12">
                                 <input type="text" name="meta" class="form-control" placeholder="Meta Deskripsi">
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
                  <button type="submit" class="btn btn-red" style="margin-bottom: 0px;width: 100%">Posting</button>
               </div>
            </div>
            <br>
            <div class="card">
              <div class="card-header">
                Tanggal
              </div>
              <div class="card-body">
                 <div class="row">
                     <label class="col-md-12 control-label" style="margin-bottom: 10px">Tanggal</label>
                      <div id="datepicker" class="input-group date form_datetime" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                        <input class="form-control" size="16" type="text" value="" readonly>
                        <input type="hidden" id="dtp_input1" size="16" type="text" name="tanggal" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                      </div>
              </div>
            </div>
            </div>
            <br/>
            <div class="card">
              <div class="card-header">
                Bahasa
              </div>
              <div class="card-body">
                 <div class="row">
                     <label class="col-md-12 control-label" style="margin-bottom: 10px">Bahasa</label>
                     <div class="col-md-12">
                        <select class="select2" name="bahasa">
                          <option value="id">Bahasa Indonesia</option>
                          <option value="en">Bahasa Inggris</option>
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
                  <img id="thumbnil" style="width:100%; margin-top:10px;"  src=""/>
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
      <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.id.js"></script>
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
                $('#datepicker, #datepicker1').datetimepicker({
                  //language:  'fr',
                  weekStart: 1,
                  todayBtn:  1,
                  autoclose: 1,
                  todayHighlight: 1,
                  startView: 2,
                  forceParse: 0,
                  showMeridian: 1
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