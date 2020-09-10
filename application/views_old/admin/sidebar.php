<aside class="app-sidebar z-100" id="sidebar">
   <div class="sidebar-header">
      <a class="sidebar-brand" href="<?php echo site_url('/admin');?>"><span class="highlight">Admin</span> Panel</a>
      <button type="button" class="sidebar-toggle">
      <i class="fa fa-times"></i>
      </button>
   </div>
   <div class="sidebar-menu">
      <ul class="sidebar-nav">
         <li class="active">
            <a href="<?php echo site_url('admin');?>">
               <div class="icon">
                  <i class="fa fa-tasks" aria-hidden="true"></i>
               </div>
               <div class="title">Dashboard</div>
            </a>
         </li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <div class="icon">
                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>
               </div>
               <div class="title">Artikel</div>
            </a>
            <div class="dropdown-menu">
               <ul>
                  <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i>Artikel</li>
                  <li><a href="<?php echo site_url('/add-post');?>">Tambah Artikel</a></li>
                  <li><a href="<?php echo site_url('/data-post');?>">Daftar Artikel</a></li>
               </ul>
            </div>
         </li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <div class="icon">
                  <i class="fa fa-youtube" aria-hidden="true"></i>
               </div>
               <div class="title">Video</div>
            </a>
            <div class="dropdown-menu">
               <ul>
                  <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i>Video</li>
                  <li><a href="<?php echo site_url('/add-video');?>">Tambah Video</a></li>
                  <li><a href="<?php echo site_url('/data-video');?>">Daftar video</a></li>
               </ul>
            </div>
         </li>
      </ul>
   </div>
   <div class="sidebar-footer">
      <ul class="menu">
         <li>
            <a href="/" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cogs" aria-hidden="true"></i>
            </a>
         </li>
         <li><a href="#"><span class="flag-icon flag-icon-th flag-icon-squared"></span></a></li>
      </ul>
   </div>
</aside>