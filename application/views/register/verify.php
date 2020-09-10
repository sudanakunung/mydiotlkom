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
            if($sukses){ ?>
            	<h5><?= $message; ?></h5>
            <?php
            } else { ?>
            	<h5><?= $message; ?></h5>
				<p><a href="#" class="btn btn-warning" onclick="resend_email('<?= $email; ?>','<?= $name; ?>'); return false;">Resend E-mail</a>
				</p>
	            <p><a href="<?= base_url('/'); ?>" class="btn btn-primary">Back to Home</a></p>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
	function resend_email(email, name)
	{
		$.ajax({
	        url: '<?= base_url('Register/resend_email'); ?>',
	        type: 'POST',
	        data: {
	        	"email" : email,
	        	"name" : name
	        },
	        datatype: 'json',
	        success: function (data){ 
	            if(data.status == 200){
	                alert(data.message);
	            } else {
	                alert(data.message);
	            }
	        },
	        error: function (jqXHR, textStatus, errorThrown){
	            alert("An error has occurred while processing data, please try again");
	        }
	    });
	}
</script>