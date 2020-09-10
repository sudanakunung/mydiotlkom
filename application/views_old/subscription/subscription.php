<style type="text/css">
    body{
        background: #fff;
    }

    .content-title {
        background-image: url("<?= base_url('assets/images/tab_bg.jpg'); ?>");
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
</style>

<div class="container content-title">
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
                if(!empty($data_subs)){ ?>
					<div class="col-12 text-center">
						<img src="<?= base_url('assets/images/banner_subscription.jpg'); ?>" width="90%" class="mb-1">
						<p><span>You are currently on subscription until</span><br /><span><?= date_format(date_create($data_subs['valid_to']), "d M Y"); ?></span></p>
						<p><a href="<?= base_url(); ?>" class="btn btn-primary">Back to Home</a></p>
					</div>
				<?php
				} else { ?>
					<div class="col-12 text-center">
						<img src="<?= base_url('assets/images/banner_subscription.jpg'); ?>" width="90%">
						<p style="font-size: 12px;">Select your subscription</p>
					</div>

					<div class="col-md-12">
						<form name="onemonth" action="<?= $data['PAYPAL_URL']; ?>" method="post">
							<!-- Identify your business so that you can collect the payments -->
							<input type="hidden" name="business" value="<?= $data['PAYPAL_ID']; ?>">
							<!-- Specify a subscriptions button. -->
							<input type="hidden" name="cmd" value="_xclick-subscriptions">
							<!-- Specify details about the subscription that buyers will purchase -->
							<input type="hidden" name="item_name" value="<?= '1 Month Membership Subscription'; ?>">
							<input type="hidden" name="item_number" value="<?= '1M'; ?>">
							<input type="hidden" name="currency_code" value="<?= $data['PAYPAL_CURRENCY']; ?>">

							<input type="hidden" name="a3" value="<?= $harga_subscribe['1m']; ?>">
							<input type="hidden" name="p3" value="1">
							<input type="hidden" name="t3" value="M">
							<!-- Custom variable user ID -->
							<input type="hidden" name="custom" value="<?= $this->session->userdata('userId'); ?>">
							<!-- Specify urls -->
							<input type="hidden" name="cancel_return" value="<?= $data['PAYPAL_CANCEL_URL']; ?>">
							<input type="hidden" name="return" value="<?= $data['PAYPAL_RETURN_URL']; ?>">
							<input type="hidden" name="notify_url" value="<?= $data['PAYPAL_NOTIFY_URL']; ?>">
						</form>
						<div class="col-md-12 p-3 subscription-box" onclick="document.forms.onemonth.submit()">
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

						<form name="threemonth" action="<?= $data['PAYPAL_URL']; ?>" method="post">
							<!-- Identify your business so that you can collect the payments -->
							<input type="hidden" name="business" value="<?= $data['PAYPAL_ID']; ?>">
							<!-- Specify a subscriptions button. -->
							<input type="hidden" name="cmd" value="_xclick-subscriptions">
							<!-- Specify details about the subscription that buyers will purchase -->
							<input type="hidden" name="item_name" value="<?= '3 Month Membership Subscription'; ?>">
							<input type="hidden" name="item_number" value="<?= '3M'; ?>">
							<input type="hidden" name="currency_code" value="<?= $data['PAYPAL_CURRENCY']; ?>">
							<input type="hidden" name="a3" value="<?= $harga_subscribe['3m']; ?>">
							<input type="hidden" name="p3" value="3">
							<input type="hidden" name="t3" value="M">
							<!-- Custom variable user ID -->
							<input type="hidden" name="custom" value="<?= $this->session->userdata('userId'); ?>">
							<!-- Specify urls -->
							<input type="hidden" name="cancel_return" value="<?= $data['PAYPAL_CANCEL_URL']; ?>">
							<input type="hidden" name="return" value="<?= $data['PAYPAL_RETURN_URL']; ?>">
							<input type="hidden" name="notify_url" value="<?= $data['PAYPAL_NOTIFY_URL']; ?>">
						</form>
						<div class="col-md-12 p-3 mt-3 subscription-box" onclick="document.forms.threemonth.submit()">
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

						<form name="oneyear" action="<?= $data['PAYPAL_URL']; ?>" method="post">
							<!-- Identify your business so that you can collect the payments -->
							<input type="hidden" name="business" value="<?= $data['PAYPAL_ID']; ?>">
							<!-- Specify a subscriptions button. -->
							<input type="hidden" name="cmd" value="_xclick-subscriptions">
							<!-- Specify details about the subscription that buyers will purchase -->
							<input type="hidden" name="item_name" value="<?= '1 Year Membership Subscription'; ?>">
							<input type="hidden" name="item_number" value="<?= '1Y'; ?>">
							<input type="hidden" name="currency_code" value="<?= $data['PAYPAL_CURRENCY']; ?>">
							<input type="hidden" name="a3" value="<?= $harga_subscribe['1y']; ?>">
							<input type="hidden" name="p3" value="3">
							<input type="hidden" name="t3" value="M">
							<!-- Custom variable user ID -->
							<input type="hidden" name="custom" value="<?= $this->session->userdata('userId'); ?>">
							<!-- Specify urls -->
							<input type="hidden" name="cancel_return" value="<?= $data['PAYPAL_CANCEL_URL']; ?>">
							<input type="hidden" name="return" value="<?= $data['PAYPAL_RETURN_URL']; ?>">
							<input type="hidden" name="notify_url" value="<?= $data['PAYPAL_NOTIFY_URL']; ?>">
						</form>
						<div class="col-md-12 p-3 mt-3 subscription-box" onclick="document.forms.oneyear.submit()">
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
						</div>
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
                if(!empty($data_subs)){ ?>
					<div class="col-12 mt-3">
                        <div class="col-12 p-3 subscription-box">
                            <div class="row">
                                <div class="col-3">
                                    <?php 
                                    if(!empty($user['image_profile'])){
                                        $src = base_url('uploads/profile/').$user['image_profile'];
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
										<br />
										<span style="font-size: 11px">
											<?php 
											if($data_subs['item_number'] == '1M'){
												$itemName = '1 Month Membership Subscription';
											} 
											else if($data_subs['item_number'] == '3M'){
												$itemName = '3 Month Membership Subscription';
											} else {
												$itemName = '1 Year Membership Subscription';
											}
											?>
											Name : <?= $itemName; ?>
										</span>
										<br />
										<span style="font-size: 11px">Valid until : <?= date_format(date_create($data_subs['valid_to']), "d M Y"); ?></span>
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
                                    if(!empty($user['image_profile'])){
                                        $src = base_url('uploads/profile/').$user['image_profile'];
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