<style>
	.footer-mobile{
		display: none;
	}
</style>

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-11 col-md-5 col-lg-5 text-center text-white">
            <i class="fa fa-check text-success" aria-hidden="true" style="font-size: 60px;"></i>
            <br /><br />
            <?php 
			if(!empty($paymentData)){ 
				if($paymentData['status'] == "exist"){ ?>
					<h5><?= $paymentData['message']; ?></h5>
				<?php
				} else { ?>
					<h5>Your Subscription Payment has been Successful!</h5>
					
					<!--<h4>Subscription Information</h4>
					<span><b>Payment Status:</b> <?php echo $paymentData['payment_status']; ?></span>
					<br />
					<span><b>Name:</b> <?php echo $itemName; ?></span>
					<br />
					<span><b>Paid Amount:</b> <?php echo $paymentData['payment_gross'].' '.$paymentData['currency_code']; ?></span>
					<br />
					<span><b>Validity:</b> <?php echo $paymentData['valid_from'].' to '.$paymentData['valid_to']; ?></span>-->
				<?php
				} 
			} else{ ?>    
                <h5><?= $paymentData['message']; ?></h5>
            <?php 
			} 
			?>
			
            <p><a href="<?= base_url('/'); ?>" class="btn btn-primary mt-4">Back to Home</a></p>
			<p><a href="<?= base_url('logout'); ?>" class="btn btn-danger">Logout</a></p>
        </div>
    </div>
</div>