<style>
	.footer-mobile{
		display: none;
	}
</style>

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-11 col-md-5 col-lg-5 text-center text-white message"></div>
    </div>
</div>

<script type="text/javascript">
	function updatePurchase(){

		$('.message').html('<div class="row"><div class="col-md-12 text-center"><center><img src="<?php echo base_url('assets/images/loading_poster.gif');?>" style="height: 48px;"/>&nbsp;&nbsp;&nbsp;Loading...</center></div></div>');

		var subscription_id = '<?= $subscription_id; ?>';

        $.ajax({
  			url: '<?= base_url('Subscription/update_purchase'); ?>',
	        type: 'POST',
	        data: {'subscription_id': subscription_id},
	        datatype: 'json',
	        success: function (data){		            
	            $('.message').html('<i class="fa fa-check text-success" aria-hidden="true" style="font-size: 60px;"></i><br /><br /><h5>'+data.message+'</h5><p><a href="<?= base_url('/'); ?>" class="btn btn-primary mt-4">Back to Home</a></p><p><a href="<?= base_url('logout'); ?>" class="btn btn-danger">Logout</a></p>');
	        }
  		});
    }

    $(document).ready(function(){
        updatePurchase();
    });
</script>