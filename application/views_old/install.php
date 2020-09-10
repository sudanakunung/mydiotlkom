<?php include 'header.php'; ?>

<style type="text/css">
      .bubble:after {
        content: '';
        display: block;
        margin: 0 auto;
        width: 0px;
        height: 0px;
        border-top: 1.1rem solid #f3f3f3;
        border-right: 1rem solid transparent;
        border-left: 1rem solid transparent;
    }
    
    .checked {
        color: orange;
    }
    
    a.logo-place {
        height: 80px;
    }
</style>
<div class="bg" style="background-image: url('<?php echo base_url('home/images/tab_bg.jpg'); ?>'); background-size: cover; padding-top: 7rem; padding-bottom: 0;">
   
   <!-- Display only on mobile -->
   <div class="clearfix d-sm-none">
      <!-- link install -->
      <section class="mb-3 pr-3 pl-3">
         <div style="background-color: #f3f3f3; padding: 1rem;border-radius: 16px">
             <div class="row">
                 <div class="col-4">
                     <img src="<?= base_url('assets/images/logo_md_box.png'); ?>" class="img-fluid">
                 </div>
                 <div class="col-8">
                     <span style="font-size: 26px">MYDIO Sing - Best Video Karaoke App</span>
                 </div>
             </div>
             <div class="row">
                 <div class="col-8 offset-4">
                     <span class="mr-1" style="font-size: 15px">4.3</span>
                     <span class="fa fa-star checked"></span>
                     <span class="fa fa-star checked"></span>
                     <span class="fa fa-star checked"></span>
                     <span class="fa fa-star checked"></span>
                     <span class="fa fa-star-half-o checked"></span>
                     <span class="ml-2" style="font-size: 15px">(10K+)</span>
                     <br>
                     <span class="text-primary">Mydiowork Technology</span>
                     <br>
                     <span class="text-secondary" style="font-size: 12px">Contains ads &#8226; In-app purchases</span>
                 </div>
             </div>
             <div class="row mt-3 mb-4">
                 <div class="col-3 text-center">
                     <span class="fa fa-download" style="font-size: 13px"></span>
                     <br>
                     <span class="text-secondary" style="font-size: 12px">27 MB</span>
                 </div>
                 <div class="col-3 text-center border-left border-right">
                     <span style="font-size: 13px">Version</span>
                     <br>
                     <span class="text-secondary" style="font-size: 12px">2.2.7</span>
                     <div style="background-color: grey; width: 1px; margin: 1rem 0"></div>
                 </div>
                 <div class="col-3 text-center border-right">
                     <span style="font-size: 13px">Updated on</span>
                     <br>
                     <span class="text-secondary" style="font-size: 12px">Apr 16, 2020</span>
                     <div style="background-color: grey; width: 1px; margin: 1rem 0"></div>
                 </div>
                 <div class="col-3 text-center">
                     <span style="font-size: 13px">1M+</span>
                     <br>
                     <span class="text-secondary" style="font-size: 12px">Downloads</span>
                 </div>
             </div>
             <div class="col-12">
                 <a href="<?= base_url('uploads') ?>/mydiosing-release.apk" class="btn btn-primary btn-sm btn-block" tabindex="-1" role="button"><b>Download</b></a>
             </div>
         </div>
      </section>
      <section class="text-center pr-3 pl-3">
         <div class="row">
             <div class="col-sm-12">
                 <p class="app-text text-white">Thank you for downloading the Mydiosing App</p>
             </div>
         </div>
         <div class="row">
             <div class="col-sm-12">
                 <p class="text-white">Not working after 10 seconds? <a data-auto-download href="<?= base_url('uploads') ?>/mydiosing-release.apk">Retry download</a></p>
             </div>
         </div>
      </section>
      <!-- steps to install -->
      <section class="pl-3 pr-3">
         <div class="row mb-3 text-center" style="background-color: grey;">
             <div class="col-sm-12">
                 <p class="app-text text-white" style="color: white;">Steps to Install</p>
             </div>
         </div>
         <section>
             <div class="row">
                 <div class="col-sm-12 mb-3">
                     <span class="badge badge-primary" style="border-radius: 100%; padding: 9px 12px; font-size: 12px">1</span>
                     <span class="text-white">Turn on Unknown Sources.</span>
                 </div>
             </div>
             <div class="row">
                 <div class="col-sm-12 mb-3">
                     <img src="<?php echo base_url('home/images/tutorial_1.png'); ?>" class="img-fluid" style="border-radius: 12px">
                 </div>
             </div>
         </section>
         <section>
             <div class="row">
                 <div class="col-sm-12 mb-3">
                     <span class="badge badge-primary" style="border-radius: 100%; padding: 9px 12px; font-size: 12px">2</span>
                     <span class="text-white">Install App.</span>
                 </div>
             </div>
             <div class="row">
                 <div class="col-sm-12 mb-3">
                     <img src="<?php echo base_url('home/images/tutorial_2.jpeg'); ?>" class="img-fluid" style="border-radius: 12px">
                 </div>
             </div>
         </section>
      </section>
   </div>

   <!-- Display except mobile -->
   <div class="clearfix d-none d-sm-block">
      <div class="row justify-content-center m-0">
         <div class="col-md-6 col-lg-4 bubble">
             <div style="background-color: #f3f3f3; padding: 1rem;border-radius: 16px">
                 <div class="row">
                     <div class="col-3">
                         <img src="<?= base_url('assets/images/logo_md_box.png'); ?>" class="img-fluid">
                     </div>
                     <div class="col-9">
                         <span style="font-size: 26px">MYDIO Sing - Best Video Karaoke App</span>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-9 offset-3">
                         <span class="mr-1" style="font-size: 15px">4.3</span>
                         <span class="fa fa-star checked"></span>
                         <span class="fa fa-star checked"></span>
                         <span class="fa fa-star checked"></span>
                         <span class="fa fa-star checked"></span>
                         <span class="fa fa-star-half-o checked"></span>
                         <span class="ml-2" style="font-size: 15px">(10K+)</span>
                         <br>
                         <span class="text-primary">Mydiowork Technology</span>
                         <br>
                         <span class="text-secondary" style="font-size: 12px">Contains ads &#8226; In-app purchases</span>
                     </div>
                 </div>
                 <div class="row mt-3 mb-4">
                     <div class="col-3 text-center">
                         <span class="fa fa-download" style="font-size: 13px"></span>
                         <br>
                         <span class="text-secondary" style="font-size: 12px">27 MB</span>
                     </div>
                     <div class="col-3 text-center border-left border-right">
                         <span style="font-size: 13px">Version</span>
                         <br>
                         <span class="text-secondary" style="font-size: 12px">2.2.7</span>
                         <div style="background-color: grey; width: 1px; margin: 1rem 0"></div>
                     </div>
                     <div class="col-3 text-center border-right">
                         <span style="font-size: 13px">Updated on</span>
                         <br>
                         <span class="text-secondary" style="font-size: 12px">Apr 16, 2020</span>
                         <div style="background-color: grey; width: 1px; margin: 1rem 0"></div>
                     </div>
                     <div class="col-3 text-center">
                         <span style="font-size: 13px">1M+</span>
                         <br>
                         <span class="text-secondary" style="font-size: 12px">Downloads</span>
                     </div>
                 </div>
                 <div class="col-12">
                     <a href="#" class="btn btn-primary btn-sm btn-block" tabindex="-1" role="button"><b>Download</b></a>
                 </div>
             </div>
         </div>
      </div>

      <div class="row justify-content-center m-0" style="background-color: #f3f3f3;">
         <div class="col-md-12 text-center">
            <h2 class="mb-4 mt-4">Please follow these steps:</h2>
         </div>
         <div class="col-md-10">
            <div class="row justify-content-center">
               <div class="col-md-4">
                   <div class="text-center">
                       <img src="<?php echo base_url('home/images/step-1.jpg'); ?>" class="img-fluid">
                   </div>
                   <p>Step 1</p>
                   <h2>Download MYDIO Sing App</h2>
                   <ol>
                       <li>Click on Download MYDIO Sing App button</li>
                       <li>Follow instructions</li>
                   </ol>
               </div>
               <div class="col-md-4">
                   <div class="text-center">
                       <img src="<?php echo base_url('home/images/step-2.jpg'); ?>" class="img-fluid">
                   </div>
                   <p>Step 2</p>
                   <h2>Enable Unknown Sources</h2>
                   <ol>
                       <li>In your phone Settings page, tap on "Security" or "Applications" (varies with device)</li>
                       <li>Enable "Unknown Sources" permission</li>
                       <li>Confirm with "OK"</li>
                   </ol>
               </div>
               <div class="col-md-4">
                   <div class="text-center">
                       <img src="<?php echo base_url('home/images/step-3.jpg'); ?>" class="img-fluid">
                   </div>
                   <p>Step 3</p>
                   <h2>Install and Launch MYDIO Sing App</h2>
                   <ol>
                       <li>Tap "Install"on the Android Installer screen</li>
                       <li>Launch the MYDIO Sing app ! Enjoy Sing & Fun.</li>
                   </ol>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- footer -->
</div>

<?php include 'footer.php'; ?>


