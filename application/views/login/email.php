<style type="text/css">
    .box-login{
        background: rgba(4, 29, 23, 0.5);
    }

    input.form-control{
        background-color: transparent;
        border: 1px solid #fff;
    }

    .custom-control-label::before{
        background-color: transparent;
        border: 1px solid white;
    }

    .datepicker td, .datepicker th{
        padding: 8px;
    }

    .footer-mobile{
        display: none;
    }
</style>

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-11 col-md-5 col-lg-5">
        	<div class="row justify-content-center">

    			<div class="col-11 box-login">
    				<div class="row">
    					<div class="col-12 mb-4 mt-5 text-center">
    						<h3 class="text-white"><b>Log In</b></h3>
    					</div>
    					<div class="col-12">
    						<form id="login-email">

                                <input type="hidden" name="next_url" value="<?= $this->input->get('next_url'); ?>">

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="email" style="background: transparent; color: white; border: 1px solid #fff; border-right: transparent;">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input name="email" type="text" class="form-control" id="validationDefaultUsername" placeholder="Email Address" aria-describedby="email" style="border-left: transparent;" required>
                                    </div>
                                </div>
								<div class="form-group">
									<input name="password" type="password" class="form-control" id="password" placeholder="Password">
								</div>

                                <div class="form-group row">
                                    <div class="col-6">
                                        <a href="<?= base_url('login'); ?>" class="btn btn-outline-light form-control">CLOSE</a>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" id="submit" class="btn btn-primary form-control btn-submit">CONTINUE</button>
                                    </div>
                                </div>

                                <div class="row my-5">
                                    <div class="col-12 text-white">
                                        Dont have an Account? <a href="<?= base_url('register'); ?>" class="text-white"><b>Register</b></a>
                                    </div>
                                </div>
		    				</form>
    					</div>
    				</div>   				
    			</div>     

        	</div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>


<script type="text/javascript">
// $(".btn-submit").click(function(event) {
//     $(this).html('<i class="fa fa-spinner fa-pulse fa-fw"></i> LOADING...');
// });

$("#login-email").submit(function(event) {

    event.preventDefault();

    $("#submit").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> LOADING...');

    var form_data = $(this).serialize();

    $.ajax({
        url: '<?= base_url('Login/email'); ?>',
        type: 'POST',
        data: form_data,
        datatype: 'json',
        success: function (data){ 
            
            if(data.status == 200){
                window.location.replace("<?= base_url('/'.$this->input->get('next_url').''); ?>");
            } else {
                alert(data.message);
                $("#submit").html("CONTINUE");
                return false;
            }
        },
        error: function (jqXHR, textStatus, errorThrown){
            $("#submit").html("CONTINUE");
            alert(jqXHR);
            return false;
        }
    }); 
});
</script>
