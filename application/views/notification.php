<style type="text/css">
    body {
    	top: 0 !important;
	    background-image: none;
	    background-color: #fff;
	}

	@media only screen and (max-width: 768px) {
	    /* For mobile phones: */
	    body {
	        background-image: none;
	        background-color: #fff;
	    }
	}

	/*aside {
		padding-top: 0 !important;
	}	*/

	.icon-notif{
        border: solid 2px #1f42ba;
        width: 100%;
    }

    @media only screen and (max-width: 768px) {
        .icon-notif{
            height: 105px;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 414px) {
        .icon-notif{
            height: 54px;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 411px) {
        .icon-notif{
            height: 53.5px;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 375px) {
        .icon-notif{
            height: 47.5px;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 360px) {
        .icon-notif{
            height: 45px;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 320px) {
        .icon-notif{
            height: 38.33px;
            object-fit: cover;
        }
    }
</style>

<div class="container content-title" style="padding-top: 60px;">
    <div class="row">
        <div class="col-12">
        	<div class="content">
        		<div class="row">
        			<div class="col-12">

        				<?php
        				if($userNotif['total'] <> 0){
	        				foreach ($userNotif['array'] as $un) { 

								// if($un->additional_id <> null || !empty($un->additional_id)){
								// 	$this->db->where('id', $un->additional_id);
								// 	$user = $this->db->get('users')->row();
								// } else {
								// 	$user = null;
								// }
	        					?>

	        					<div class="row align-items-center border-bottom py-2">
		        					<div class="col-2 pr-0">
		        						<?php
		        						if($un['type'] == "R"){
		        							$src_icon = base_url('assets/images/notif_gear.jpg');
		        						} else {
											// if($user->image_profile <> null || !empty($user->image_profile)){
											// 	$src_icon = base_url('uploads/profile/default/'.$user->image_profile.'');
											// } else {
											// 	$src_icon = base_url('uploads/profile/default/default-profile.jpg');
											// }
											if(!empty($un['fromPP']) || $un['fromPP'] != null) {
												if($data = @getimagesize($un['fromPP'])){
													$src_icon = $un['fromPP'];
												}else{
													$src_icon = base_url('assets/images/profile.png');
												}
											}else{
												$src_icon = base_url('assets/images/profile.png');
											}
										}
		        						?>
		        						<img src="<?= $src_icon; ?>" class="img-fluid rounded-circle icon-notif">
		        					</div>
		        					<div class="col-10">
		        						<?php 
		        						if($un['type'] == "R"){ ?>
	    									
	    									<p class="mb-0 font-weight-bold" style="color: #717171;">
			        							System Notification
			        						</p>
			        						<p class="mb-0" style="font-size: 13px">
			        							<span style="color: #191248; padding-right: 10px;">
			        								<i class="fa fa-check" aria-hidden="true"></i>
			        							</span>
			        							<span style="color: #d8d8d8; padding-right: 5px;">
			        								<i class="fa fa-circle" aria-hidden="true"></i>
			        							</span>
			        							<span style="color: #707070;">
			        								<?= $un['message']; ?>
			        							</span>
			        						</p>
	    								
	    								<?php
	    								} else { ?>
	    									
	    									<p class="mb-0 font-weight-bold" style="color: #717171;">
			        							<?= $un['fromName']; ?>
			        						</p>
			        						<p class="mb-0" style="font-size: 13px">
			        							<span style="color: #191248; padding-right: 10px;">
			        								<i class="fa fa-check" aria-hidden="true"></i>
			        							</span>
			        							<span style="color: #707070;">
			        								<?= $un['fromName']; ?>
			        							</span>
			        							<span class="px-1" style="color: #d8d8d8;">
			        								<i class="fa fa-circle" aria-hidden="true"></i>
			        							</span>
			        							<span style="color: #707070;">
			        								<?= $un['message']; ?>
			        							</span>
			        						</p>
	    								<?php
	    								}
		        						?>

		        						<p class="mb-0" style="font-size: 13px; color: #707070;">
		        							<?php
											echo date("d M", strtotime($un['dtCreated']));
		        							?>
		        						</p>
		        					</div>
		        				</div>
	        				<?php
	        				}
        				} else { ?>
        					<div class="row align-items-center py-5">
        						<div class="col-12 text-center">
        							There are no notifications for you yet
        						</div>
        					</div>
        				<?php
        				}        				
        				?>

        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>