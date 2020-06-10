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
</style>

<div class="container pt-5 content-title">
    <div class="row">
        <div class="col-12">
        	<div class="content">
        		<div class="row">
        			<div class="col-12">

        				<?php
        				if($userNotif <> null){
	        				foreach ($userNotif as $un) { 

	        					if($un->additional_id <> null || !empty($un->additional_id)){
	        						$this->db->where('id', $un->additional_id);
									$user = $this->db->get('users')->row();
	        					} else {
	        						$user = null;
	        					}
	        					?>

	        					<div class="row align-items-center border-bottom py-2">
		        					<div class="col-2 pr-0">
		        						<?php
		        						if($un->type == "system"){
		        							$src_icon = base_url('assets/images/notif_gear.jpg');
		        						} else {
											if($user->image_profile <> null || !empty($user->image_profile)){
												$src_icon = base_url('uploads/profile/default/'.$user->image_profile.'');
											} else {
												$src_icon = base_url('uploads/profile/default/default-profile.jpg');
											}
										}
		        						?>
		        						<img src="<?= $src_icon; ?>" style="border: solid 2px #1f42ba;" class="img-fluid rounded-circle">
		        					</div>
		        					<div class="col-10">
		        						<?php 
		        						if($un->type == "system"){ ?>
	    									
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
			        								<?= $un->content; ?>
			        							</span>
			        						</p>
	    								
	    								<?php
	    								} else { ?>
	    									
	    									<p class="mb-0 font-weight-bold" style="color: #717171;">
			        							<?= $user->name; ?>
			        						</p>
			        						<p class="mb-0" style="font-size: 13px">
			        							<span style="color: #191248; padding-right: 10px;">
			        								<i class="fa fa-check" aria-hidden="true"></i>
			        							</span>
			        							<span style="color: #707070;">
			        								<?= $user->name; ?>
			        							</span>
			        							<span class="px-1" style="color: #d8d8d8;">
			        								<i class="fa fa-circle" aria-hidden="true"></i>
			        							</span>
			        							<span style="color: #707070;">
			        								<?= strtolower($un->content); ?>
			        							</span>
			        						</p>
	    								<?php
	    								}
		        						?>

		        						<p class="mb-0" style="font-size: 13px; color: #707070;">
		        							<?php
		        							$datestring = '%d %M';
											$time = $un->created_at;
											echo mdate($datestring, $time);
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