<!DOCTYPE html>
<html>
   <head>
       <title>Mydiosing - Admin</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include 'css.php';?>
   </head>
   <body>
      <div class="app app-default">
        <?php include 'sidebar.php'; ?>
         <div class="app-container">
            <?php include 'header.php'; ?>
            <div class="btn-floating" id="help-actions">
               <div class="btn-bg"></div>
               <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions">
               <i class="icon fa fa-plus"></i>
               <span class="help-text">Shortcut</span>
               </button>
               <div class="toggle-content">
                  <ul class="actions">
                     <li><a href="#">Website</a></li>
                     <li><a href="#">Documentation</a></li>
                     <li><a href="#">Issues</a></li>
                     <li><a href="#">About</a></li>
                  </ul>
               </div>
            </div>
            <div class="row">
             <div class="col-lg-12">
               <div class="card">
                 <div class="card-body app-heading">
                   <img class="profile-img" src="<?php echo base_url('assets/images/'.$admin['icon']);?>">
                   <div class="app-title">
                     <div class="title"><span class="highlight"><?php echo $admin['username'] ?></span></div>
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-md-12 col-sm-12 col-xs-12">
               <!--main form-->
               <style type="text/css">
                  #tit{
                     font-size: 14px;
                     font-weight: 600;
                     margin-bottom: 5px;
                  }
                  #tits{
                     font-size: 12px;
                  }
               </style>
               <?php if ($this->session->flashdata('profile') != null): ?>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php echo $this->session->flashdata('profile');?>
                           </div>
                          <?php endif ?>
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                       <div class="col-md-3 col-sm-12">
                         <div class="section">
                           <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Informasi Akun</div>
                           <div class="section-body">
                              <p id="tit">Nama :</p>
                              <p id="tits"><?php echo $admin['username'] ?></p>
                              <p id="tit">Email :</p>
                              <p id="tits"><?php echo $admin['email'] ?></p>
                           </div>
                         </div>
                       </div>
                       <div class="col-md-9 col-sm-12">
                        <div class="col-md-8">
                          <?php 
                            $atr = array(
                              'class' => 'form form-horizontal'
                            );

                            echo form_open_multipart('profile/update', $atr);
                           ?> 
                           <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                                    <div class="section">
                                       <div class="section-body">
                                          <div class="form-group">
                                             <label class="col-md-12 control-label" style="margin-bottom: 10px">Nama</label>
                                             <div class="col-md-12">
                                                <input type="text" class="form-control" name="username" placeholder="Nama" value="<?php echo $admin['username'];?>">
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label class="col-md-12 control-label" style="margin-bottom: 10px">Email</label>
                                             <div class="col-md-12">
                                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $admin['email'] ?>">
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label class="col-md-12 control-label" style="margin-bottom: 10px">Password</label>
                                             <div class="col-md-12">
                                                <input type="Password" class="form-control" name="password" placeholder="Password">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                        </div>
                        <div class="col-md-4">
                           <div class="card-body">
                              <input style="width: 100%" type="file" accept="image/*"  onchange="showMyImage(this)" name="files"/>
                              <br/>
                              <img id="thumbnil" style="width:100%; margin-top:10px;"  src="<?php echo base_url('assets/images/'.$admin['icon']);?>"/>
                           </div>
                           <button type="submit" class="btn btn-red" style="margin-bottom: 0px;width: 100%">Update</button>
                           
                          <?php echo form_close();?>
                        </div>
                       </div>
                     </div>
                  </div>
               </div>
               <!--end main form-->
             </div>
           </div>
           
            <?php include 'footer.php'; ?>
         </div>
      </div>
      <?php include "js.php";?>
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