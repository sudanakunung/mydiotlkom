<?php include 'header.php'; ?>

<div class="container pt-5 content-title">
    <div class="row">
        <div class="col-12">
            <h1 class="success">Your Subscription Payment has been Successful!</h1>
            <?php if(!empty($paymentData)){ ?>  
                <h4>Payment Information</h4>
                <p><b>Reference Number:</b> <?php echo $paymentData['id']; ?></p>
                <p><b>Transaction ID:</b> <?php echo $paymentData['txn_id']; ?></p>
                <p><b>Paid Amount:</b> <?php echo $paymentData['payment_gross'].' '.$paymentData['currency_code']; ?></p>
                <p><b>Payment Status:</b> <?php echo $paymentData['payment_status']; ?></p>
                
                <h4>Subscription Information</h4>
                <p><b>ID:</b> <?php echo $paymentData['subscr_id']; ?></p>
                <p><b>Name:</b> <?php echo $itemName; ?></p>
                <p><b>Validity:</b> <?php echo $paymentData['valid_from'].' to '.$paymentData['valid_to']; ?></p>
            <?php }else{ ?>    
                <h1 class="error">Your payment was unsuccessful, please try again.</h1>
            <?php } ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>