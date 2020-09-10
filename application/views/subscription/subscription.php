<style type="text/css">
    body{
        background: #fff;
    }

    .content-title {
		background-color:rgb(208, 74, 58);
        /* Center and scale the image nicely */
        background-position: top;
        background-repeat: no-repeat;
        padding-top: 120px
    }

    .subscription-box{
        border: 1px solid #d1d1d1; 
        border-radius: 10px; 
        -webkit-box-shadow: 0px 5px 3px 0px rgba(201,201,201,1);
        -moz-box-shadow: 0px 5px 3px 0px rgba(201,201,201,1);
        box-shadow: 0px 5px 3px 0px rgba(201,201,201,1);
    }

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: transparent;
        border-color: transparent;
        border-bottom: solid 3px white;
    }

    .tab-content{
        width: 100%;
    }

    .footer-mobile{
        display: none;
    }

    .custom.form-control:focus {
	    color: #495057;
	    background-color: #fff;
	    border-color: #ced4da;
	    outline: 0;
	    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0);
	}
</style>

<div class="container content-title" >
    <div class="row">
        <!-- <div class="col-6 text-center text-white">
            Information
        </div>

        <div class="col-6 text-center text-white" style="border-bottom: solid 2px #fff;">
            <b>Subscription</b>
        </div> -->
    </div>
</div>
<div class="container">
    <div class="row">
        <nav style="z-index: 1; position: absolute; top: 76px; width: 100%;">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="border-bottom: 0;">
                <a class="nav-item nav-link active text-white" id="nav-subscription-tab" data-toggle="tab" href="#nav-subscription" role="tab"
                   aria-controls="nav-profile" aria-selected="false">SUBSCRIPTION</a>
                <a class="nav-item nav-link text-white" id="nav-information-tab" data-toggle="tab" href="#nav-information" role="tab"
                   aria-controls="nav-home" aria-selected="true">INFORMATION</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-subscription" role="tabpanel" aria-labelledby="nav-subscription-tab">
                <?php 
                if($subsStatus[0]['subscription'] <> "FREE"){ ?>
					<div class="col-12 text-center " >
						<img src="<?= base_url('assets/images/telkom/illustrasi_music.svg'); ?>" width="50%" class="mb-1">
						<p><span>You are currently on subscription until</span><br /><span><?= date_format(date_create($subsStatus[0]['endDate']), "d M Y"); ?></span></p>
						<p><a href="<?= base_url(); ?>" class="btn btn-primary" style="background-color:rgb(208, 74, 58)">Back to Home</a></p>
					</div>
				<?php
				} else { ?>
					<div class="col-12 text-center " >
						<img src="<?= base_url('assets/images/telkom/illustrasi_music.svg'); ?>" width="50%">
						<p style="font-size: 12px;">Select your subscription</p>
					</div>

					<div class="col-md-12">
						<?php 
						foreach ($listSubs as $key => $val) { ?>
							<div id="paket-<?= $val['subscriptionId']; ?>" class="col-md-12 p-3 mb-3 subscription-box" onclick="subscribe('<?= $val['subscriptionId']; ?>','<?= $val['quotaReoccurringDays']; ?>','<?= $val['subscription']; ?>','<?= $val['price']; ?>'); return false;">
								<div class="row">
									<div class="col-2 pr-0">
										<img src="<?= $val['icon']; ?>" class="img-fluid">
									</div>
									<div class="col-5 pr-0 align-self-center">
										<p class="mb-0">
											<span style="font-size: 15px;">
												<b><?= $val['subscription']; ?></b>
											</span>
											<br />
											<span style="font-size: 11px">Expires in <?= ucfirst(strtolower($val['subscription'])); ?>.</span>
										</p>
									</div>
									<div class="col-4 pl-0 text-right align-self-center">
										<p class="mb-0">
											<span style="font-size: 15px;"><b>USD <?= $val['price']; ?></b></span>
											<br />
											<span style="font-size: 11px">For <?= ucfirst(strtolower($val['subscription'])); ?>.</span>
										</p>
									</div>
									<div class="col-1 text-center align-self-center p-0">
										<i class="fa fa-chevron-right" aria-hidden="true" style="font-size: 18px;"></i>
									</div>
								</div>
							</div>
						<?php
						}
						?>

						<!-- <div id="paket-1m" class="col-md-12 p-3 subscription-box" onclick="subscribe('1m'); return false;">
							<div class="row">
								<div class="col-2 pr-0">
									<img src="<?= base_url('assets/images/subscription_monthly.jpg'); ?>" class="img-fluid">
								</div>
								<div class="col-5 pr-0 align-self-center">
									<p class="mb-0">
										<span style="font-size: 15px;"><b>Monthly</b></span>
										<br />
										<span style="font-size: 11px">Expires in 1 Month.</span>
									</p>
								</div>
								<div class="col-4 pl-0 text-right align-self-center">
									<p class="mb-0">
										<span style="font-size: 15px;"><b>USD 1</b></span>
										<br />
										<span style="font-size: 11px">For 1 Month.</span>
									</p>
								</div>
								<div class="col-1 text-center align-self-center p-0">
									<i class="fa fa-chevron-right" aria-hidden="true" style="font-size: 18px;"></i>
								</div>
							</div>
						</div>

						<div id="paket-3m" class="col-md-12 p-3 mt-3 subscription-box" onclick="subscribe('3m'); return false;">
							<div class="row">
								<div class="col-2 pr-0">
									<img src="<?= base_url('assets/images/subscription_3_month.jpg'); ?>" class="img-fluid">
								</div>
								<div class="col-5 pr-0 align-self-center">
									<p class="mb-0">
										<span style="font-size: 15px;"><b>3 Months</b></span>
										<br />
										<span style="font-size: 11px">Expires in 3 Months.</span>
									</p>
									
								</div>
								<div class="col-4 pl-0 text-right align-self-center">
									<p class="mb-0">
										<span style="font-size: 15px;"><b>USD 2</b></span>
										<br />
										<span style="font-size: 11px">For 3 Months.</span>
									</p>
								</div>
								<div class="col-1 text-center align-self-center p-0">
									<i class="fa fa-chevron-right" aria-hidden="true" style="font-size: 18px;"></i>
								</div>
							</div>
						</div>

						<div id="paket-1y" class="col-md-12 p-3 mt-3 subscription-box" onclick="subscribe('1y'); return false;">
							<div class="row">
								<div class="col-2 pr-0">
									<img src="<?= base_url('assets/images/subscription_yearly.jpg'); ?>" class="img-fluid">
								</div>
								<div class="col-5 pr-0 align-self-center">
									<p class="mb-0">
										<span style="font-size: 15px;"><b>1 Year</b></span>
										<br />
										<span style="font-size: 11px">Expires in 1 year.</span>
									</p>
									
								</div>
								<div class="col-4 pl-0 text-right align-self-center">
									<p class="mb-0">
										<span style="font-size: 15px;"><b>USD 7</b></span>
										<br />
										<span style="font-size: 11px">For 1 Year.</span>
									</p>
								</div>
								<div class="col-1 text-center align-self-center p-0">
									<i class="fa fa-chevron-right" aria-hidden="true" style="font-size: 18px;"></i>
								</div>
							</div>
						</div> -->
					</div>

					<!-- <div class="col-12 mt-5">
						<p>
							<span><b>Manage Subscription</b></span>
							<br />
							<span style="font-size: 11px;">Manage your subscription on PayPal</span>
						</p>
						<a href="#" class="btn btn-primary form-control">PayPal Subscription</a>
					</div> -->
				<?php
				}
				?>
            </div>

            <div class="tab-pane fade" id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab">
                <?php 
                if($subsStatus[0]['subscription'] <> "FREE"){ ?>

					<div class="col-12 mt-3">
                        <div class="col-12 p-3 subscription-box">
                            <div class="row">
                                <div class="col-3">
                                    <?php 
                                    if(!empty($user['urlPP'])){
                                        $src = $user['urlPP'];
                                    } else {
                                        $src = base_url('uploads/profile/default/default-profile.jpg');
                                    }
                                    ?>
                                    <img src="<?= $src; ?>" class="img-fluid rounded-circle">
                                </div>
                                <div class="col-9 align-self-center">
                                    <p class="mb-0">
                                        <span style="font-size: 15px;"><b>
                                        	<?= $user['name']; ?></b>
                                        </span>
                                        <br />
                                        <span style="font-size: 11px">Your current subcription</span>
										<br />
										<span style="font-size: 11px">
											Name : <?= ucwords(strtolower($subsStatus[0]['subscription'])); ?> Membership Subscription
										</span>
										<br />
										<span style="font-size: 11px">Valid until : <?= date_format(date_create($subsStatus[0]['endDate']), "d M Y"); ?></span>										
                                    </p>
                                    <p class="mt-2 mb-0">
										<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reasonModal">
											Cancel Subscription
										</button>
									</p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                } else { ?>

                    <div class="col-12 mt-3">
                        <div class="col-12 p-3 subscription-box">
                            <div class="row">
                                <div class="col-3">
									<?php 
                                    if(!empty($user['urlPP'])){
                                        $src = $user['urlPP'];
                                    } else {
                                        $src = base_url('uploads/profile/default/default-profile.jpg');
                                    }
                                    ?>
                                    <img src="<?= $src; ?>" class="img-fluid rounded-circle">
                                </div>
                                <div class="col-9 align-self-center">
                                    <p class="mb-0">
                                        <span style="font-size: 15px;"><b><?= $user['name']; ?></b></span>
                                        <br />
                                        <span style="font-size: 11px">Your current subcription</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-5 text-center">
                        <img src="<?= base_url('assets/images/banner_subscription.jpg'); ?>" width="90%">
                        <p style="font-size: 12px;">You have no active subscription</p>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Reason Modal -->
<div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reason to Unsubscribe</h5>
            </div>
            <div class="modal-body bg-white">
                
                <form id="cancel-subscription-paypal">
				    <input type="hidden" name="subscription_id" value="<?= $detailPaypalData['id']; ?>">
				    <div class="form-group">
				        <label for="reason">Reason</label>
				        <textarea class="custom form-control" name="reason"></textarea>
				    </div>
				</form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger cancel-subscription">
                	Cancel Subscription
                </button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	function subscribe(subscriptionId, lama_paket, nama_paket, harga_paket){
		
		var nama_paket_ucfirst = nama_paket.toLowerCase().replace(/\b[a-z]/g, function(letter) {
		    return letter.toUpperCase();
		});

		$('#paket-'+subscriptionId).html('<div class="row"><div class="col-md-12"><center><img src="<?php echo base_url('assets/images/loading_poster.gif');?>" style="height: 48px;"/>&nbsp;&nbsp;&nbsp;Loading...</center></div></div>');

		$.ajax({
	        url: '<?= base_url('Subscription/creat_subscription'); ?>',
	        type: 'POST',
	        data: { 'lama_paket': lama_paket, 'nama_paket': nama_paket },
	        datatype: 'json',
	        success: function (data){ 
	            
	            if(data.status == 200){
	                window.location.replace(data.redirect);
	            } else {
	                alert(data.message);
	                
	                if(lama_paket == "30"){
	                	icon = '<?= base_url('assets/images/subscription_monthly.jpg'); ?>';
	                } else if(lama_paket == "90"){
	                	icon = '<?= base_url('assets/images/subscription_3_month.jpg'); ?>';
	                } else {
	                	icon = '<?= base_url('assets/images/subscription_yearly.jpg'); ?>';
	                }

	                $('#paket-'+subscriptionId).html('<div class="row"><div class="col-2 pr-0"><img src="'+icon+'" class="img-fluid"></div><div class="col-5 pr-0 align-self-center"><p class="mb-0"><span style="font-size:15px"><b>'+nama_paket+'</b></span><br><span style="font-size:11px">Expires in '+nama_paket_ucfirst+'.</span></p></div><div class="col-4 pl-0 text-right align-self-center"><p class="mb-0"><span style="font-size:15px"><b>USD '+harga_paket+'</b></span><br><span style="font-size:11px">For '+nama_paket_ucfirst+'.</span></p></div><div class="col-1 text-center align-self-center p-0"><i class="fa fa-chevron-right" aria-hidden="true" style="font-size:18px"></i></div></div>');

	                return false;
	            }
	        },
	        error: function (jqXHR, textStatus, errorThrown){
	         	
	            alert('Something went wrong please try again');
	            
	            if(lama_paket == "30"){
                	icon = '<?= base_url('assets/images/subscription_monthly.jpg'); ?>';
                } else if(lama_paket == "90"){
                	icon = '<?= base_url('assets/images/subscription_3_month.jpg'); ?>';
                } else {
                	icon = '<?= base_url('assets/images/subscription_yearly.jpg'); ?>';
                }

                $('#paket-'+subscriptionId).html('<div class="row"><div class="col-2 pr-0"><img src="'+icon+'" class="img-fluid"></div><div class="col-5 pr-0 align-self-center"><p class="mb-0"><span style="font-size:15px"><b>'+nama_paket+'</b></span><br><span style="font-size:11px">Expires in '+nama_paket_ucfirst+'.</span></p></div><div class="col-4 pl-0 text-right align-self-center"><p class="mb-0"><span style="font-size:15px"><b>USD '+harga_paket+'</b></span><br><span style="font-size:11px">For '+nama_paket_ucfirst+'.</span></p></div><div class="col-1 text-center align-self-center p-0"><i class="fa fa-chevron-right" aria-hidden="true" style="font-size:18px"></i></div></div>');

	            return false;
	        }
	    }); 
	}

	$(".cancel-subscription").on("click", function(e){
	  	e.preventDefault();
	  	$('#cancel-subscription-paypal').submit();
	});

	$("form#cancel-subscription-paypal").on("submit", function(e){
		e.preventDefault();

		$('.cancel-subscription').html('<i class="fa fa-spinner fa-pulse fa-fw"></i> LOADING...');

		var formData = $(this).serialize();

	  	if (confirm('Are you sure you want to unsubscribe?')) {
	  		$.ajax({
	  			url: '<?= base_url('Subscription/cancel_subscription_paypal'); ?>',
		        type: 'POST',
		        data: formData,
		        datatype: 'json',
		        success: function (data){		            
		            if(data.status == 200) {
		                location.reload();
		            } else {
		                alert(data.message);
		                $('.cancel-subscription').html('Cancel Subscription');
		            }
		        },
		        error: function (jqXHR, textStatus, errorThrown){
		            alert('Something went wrong please try again');
		            $('.cancel-subscription').html('Cancel Subscription');
		        }
	  		});
	  	}
	});
</script>

<script type="text/javascript">
	function checkSubscribeStatus(){
        $.ajax({
            url: "<?= base_url('Subscription/check_subscribe_status'); ?>",
            cache: false
        });
        var waktu = setTimeout("checkSubscribeStatus()",60000);
    }

    $(document).ready(function(){
        // checkSubscribeStatus();
    });
</script>