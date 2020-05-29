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
</style>

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-11 col-md-5 col-lg-5">
            <div class="row justify-content-center">

                <div class="col-11 box-login">
                    <div class="row">
                        <div class="col-12 mb-4 mt-5 text-center">
                            <h3 class="text-white"><b>Register</b></h3>
                        </div>
                        <div class="col-12">
                            <form id="register">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="name" style="background: transparent; color: white; border: 1px solid #fff; border-right: transparent;">
                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input name="name" type="text" class="text-white form-control" id="name" placeholder="Name" aria-describedby="name" style="border-left: transparent;" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="email" style="background: transparent; color: white; border: 1px solid #fff; border-right: transparent;">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input name="email" type="text" class="text-white form-control" id="email" placeholder="Email Address" aria-describedby="email" style="border-left: transparent;" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="birthday" style="background: transparent; color: white; border: 1px solid #fff; border-right: transparent;">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input name="birthday" type="text" class="text-white form-control datepicker" id="birthday" placeholder="Birthday" aria-describedby="birthday" style="border-left: transparent; padding: .375rem .75rem;" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sex-m" name="sex" class="custom-control-input" value="male">
                                            <label class="custom-control-label text-white" for="sex-m">Male</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sex-f" name="sex" class="custom-control-input" value="female">
                                            <label class="custom-control-label text-white" for="sex-f">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="single" name="status" class="custom-control-input" value="single">
                                            <label class="custom-control-label text-white" for="single">Single</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="married" name="status" class="custom-control-input" value="married">
                                            <label class="custom-control-label text-white" for="married">Married</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="address" style="background: transparent; color: white; border: 1px solid #fff; border-right: transparent;">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input name="address" type="text" class="text-white form-control" id="validationDefaultUsername" placeholder="Location" aria-describedby="address" style="border-left: transparent;" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <input name="password" type="password" class="text-white form-control" id="password" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <input name="confirm_password" type="password" class="text-white form-control" id="confirm_password" placeholder="Confirm Password">
                                </div>

                                <button type="submit" class="btn btn-primary form-control my-3">Submit</button>
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
        url: '<?= base_url('register/store'); ?>',
        type: 'POST',
        data: form_data + "&<?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>",
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
</script>