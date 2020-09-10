<style type="text/css">
    .box-login{
        background-color:#fff;
    }

    input.form-control,
	input.form-control:focus{
        background-color: transparent;
        border: 1px solid #ddd;
    }
	
	input.register:focus{
		border: solid 1px #ddd;
		border-left: transparent;
		background: transparent;
	}

    .custom-control-label::before{
        background-color: transparent;
        border: 1px solid #ddd;
    }

    .datepicker td, .datepicker th{
        padding: 8px;
    }
	
	.footer-mobile{
        display: none;
    }.text-white{
        
    }
</style>

<div class="container h-100" style="background-color:#f5f5f5">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-11 col-md-5 col-lg-5">
            <div class="row justify-content-center">

                <div class="col-11 box-login">
                    <div class="row">
                        <div class="col-12 mb-4 mt-5 text-center">
                            <h3 style="color:#7d7b7b "><b>Registration</b></h3>
                        </div>
                        <div class="col-12">
                            <form id="register" action="<?= base_url('Register/store'); ?>" method="POST">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="name" style="background: transparent; color:#7d7b7b ; border: 1px solid #fff; border-right: transparent;">
                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input name="name" type="text" class="text-white form-control register" style="color:#7d7b7b " id="name" placeholder="Name" aria-describedby="name" style="border-left: transparent;" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="email" style="background: transparent; color:#7d7b7b ; border: 1px solid #fff; border-right: transparent;">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input name="email" type="text" class="text-white form-control register"style="color:#7d7b7b " id="email" placeholder="Email Address" aria-describedby="email" style="border-left: transparent;" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="birthday" style="background: transparent; color: #7d7b7b; border: 1px solid #fff; border-right: transparent;">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input name="birthday" type="text" class="text-white form-control register datepicker"  style="color:#7d7b7b "id="birthday" placeholder="Birthday" aria-describedby="birthday" style="border-left: transparent; padding: .375rem .75rem;" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6">
                                        <div class="custom-control custom-radio custom-control-inline" >
                                            <input type="radio" id="sex-m" name="sex" class="custom-control-input" value="M">
                                            <label class="custom-control-label" for="sex-m" style="color:#7d7b7b ">Male</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-control custom-radio custom-control-inline" >
                                            <input type="radio" id="sex-f" name="sex" class="custom-control-input" value="F">
                                            <label class="custom-control-label" for="sex-f"style="color:#7d7b7b ">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="single" name="relationship" class="custom-control-input" value="SINGLE">
                                            <label class="custom-control-label " for="single"style="color:#7d7b7b ">Single</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="married" name="relationship" class="custom-control-input" value="MARRIED">
                                            <label class="custom-control-label " for="married"style="color:#7d7b7b ">Married</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="address" style="background: transparent; color: #7d7b7b; border: 1px solid #ddd; border-right: transparent;">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input name="address" type="text" class="text-white form-control register" id="address" placeholder="Location" aria-describedby="address" style="border-left: transparent;" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <input name="password" type="password" class="text-white form-control" id="password" placeholder="Password" required>
                                </div>

                                <div class="form-group">
                                    <input name="confirm_password" type="password" class="text-white form-control" id="confirm_password" placeholder="Confirm Password" data-parsley-equalto="#password">
                                </div>

                                <button type="submit" class="btn form-control my-3 text-white" style="background-color:#d04a3a">REGISTER</button>
                            </form>
                        </div>
                    </div>                  
                </div>     

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script src="<?= base_url('assets'); ?>/js/bootstrap-datepicker.min.js"></script>   
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>

<script type="text/javascript">
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha256-pEdn/pJ2tyT37axbEIPkyUUfuG1yXR0+YV+h+jphem4=" crossorigin="anonymous"></script>
<script>
    $('#register').parsley();
</script> -->

<!-- <script type="text/javascript">
$("#register").submit(function(event) {
    event.preventDefault();

    var password =  $('#password').val();
    var confirm_password = $('#confirm_password').val();

    if(password !== confirm_password){
        alert('Passwords do not match');

        return false;
    }

    var form_data = $(this).serialize();

    $.ajax({
        url: '<?= base_url('Register/store'); ?>',
        type: 'POST',
        data: form_data,
        datatype: 'json',
        success: function (data){ 
            if(data.status == 200){
                alert(data.message);
                window.location.replace("<?= base_url('login/showloginemail'); ?>");
            } else {
                alert(data.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert(textStatus);
        }
    }); 
});
</script> -->