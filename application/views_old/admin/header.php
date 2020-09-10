<nav class="navbar navbar-default" id="navbar">
   <div class="container-fluid">
      <div class="navbar-collapse collapse in">
         <ul class="nav navbar-nav navbar-mobile">
            <li>
               <button type="button" class="sidebar-toggle">
               <i class="fa fa-bars"></i>
               </button>
            </li>
            <li class="logo">
               <a class="navbar-brand" href="#"><span class="highlight">Admin</span> Panel</a>
            </li>
            <li>
               <button type="button" class="navbar-toggle">
               <img class="profile-img" src="<?php echo base_url('assets/images/'.$admin['icon']);?>">
               </button>
            </li>
         </ul>
         <ul class="nav navbar-nav navbar-left">
            <li class="navbar-title">Dashboard</li>
            <li class="navbar-search hidden-sm">
               <input id="search" type="text" placeholder="Search..">
               <button class="btn-search"><i class="fa fa-search"></i></button>
            </li>
         </ul>
         <ul class="nav navbar-nav navbar-right">
            <li class="dropdown profile">
               <a href="<?php echo site_url('admin-profile');?>" class="dropdown-toggle" >
                  <img class="profile-img" src="<?php echo base_url('assets/images/'.$admin['icon']);?>">
                  <div class="title">Profile</div>
               </a>
               <div class="dropdown-menu">
                  <div class="profile-info">
                     <h4 class="username"><?php echo $admin['username'];?></h4>
                  </div>
                  <ul class="action">
                     <li>
                        <a href="<?php echo site_url('admin-profile');?>">
                        Profile
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo site_url('admin-logout');?>">
                        Logout
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
            <li class="dropdown profile dnone">
               <a class="dnone" href="<?php echo site_url('admin-logout');?>">
                        Logout
                        </a>
            </li>
         </ul>
      </div>
   </div>
</nav>
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