<style type="text/css">
    body{
        background: #fff;
    }

    .form-default.form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .footer-mobile{
    	display: none;
    }
</style>

<div class="container pt-5 content-title">
    <?php 
    if ($this->session->has_userdata('memberLogin')) { ?>
        <div class="row py-3" data-toggle="modal" data-target="#change_pass_modal">
            <div class="col-2 pr-0">
                <span class="material-icons align-middle">lock</span>
            </div>
            <div class="col-8 pl-0">
                <span class="align-middle">Password</span>
            </div>
            <div class="col-2align-self-center">
                <span class="material-icons align-middle">navigate_next</span>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="row py-3" onclick="location.href = 'mailto:help.desk@mydiowork.com';">
        <div class="col-2 pr-0">
        	<span class="material-icons align-middle">phone</span>
        </div>
        <div class="col-8 pl-0">
        	<span class="align-middle">Contact Us</span>
        </div>
        <div class="col-2align-self-center">
        	<span class="material-icons align-middle">navigate_next</span>
        </div>
    </div>
    <?php 
    if ($this->session->has_userdata('memberLogin')) { ?>
        <div class="row py-3" onclick="location.href = '<?= base_url('logout'); ?>';">
            <div class="col-2 pr-0">
                <span class="material-icons align-middle">power_settings_new</span>
            </div>
            <div class="col-8 pl-0 text-dark">
                <span class="align-middle">Log out</span>
            </div>
            <div class="col-2align-self-center">
                <span class="material-icons align-middle">navigate_next</span>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<div class="modal" id="contact_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">

            <!-- Modal body -->
            <div class="modal-body" style="background-color: white;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <p class="my-4 font-weight-bold">Send feedback using</p>
                        </div>
                        <div class="col-3 text-center">
                            <a href="mailto:help.desk@mydiowork.com" class="text-dark">
                                <img src="<?= base_url('assets/images/gmail_icon.jpg'); ?>" class="img-fluid">
                                <p class="my-2">E-mail</p>
                            </a>                            
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer" style="border-top: 0;">
                <button type="button" class="btn btn-light form-control" data-dismiss="modal" style="border-radius: 1.5rem;">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="change_pass_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">

            <div class="overlay" style="width: 100%; height: 100%; background: rgba(0,0,0,0.7); position: absolute; z-index: 1; display: none;"></div>
            <!-- Modal body -->
            <div class="modal-body" style="background-color: white;">
                <div class="container pt-4">
                    <div class="row">
                        <div class="col-12">
                            <p class="font-weight-bold mb-0" style="font-size: 20px;">Change Password</p>
                            <hr/>
                        </div>
                        <div class="col-12 mt-3">
                            <form id="change-password" action="<?= base_url('ProfileMember/change_password'); ?>" method="POST">
                                <div class="form-group">
                                    <label class="mb-0" for="current_password">Current Password</label>
                                    <input type="password" class="form-default form-control" id="current_password" name="current_password" required="true"/>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="new_password">New Password</label>
                                    <input type="password" class="form-default form-control" id="new_password" name="new_password" required="true" />
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-default form-control" id="confirm_password" name="confirm_password" required="true"/>
                                </div>

                                <div class="pull-right">
                                    <button type="button" class="btn btn-outline-primary border-0" data-dismiss="modal">
                                        CANCEL
                                    </button>
                                    <button type="submit" id="submit" class="btn btn-outline-primary border-0">
                                        OK
                                    </button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>

<div class="modal" id="alert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-header bg-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span>&times</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="my-4 font-weight-bold message-alert"></p>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#change-password").submit(function(event) {
        event.preventDefault();

        $("#submit").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> LOADING...');
        
        var form_data = $(this).serialize();
        var form_action = $(this).attr("action");
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();

        if(new_password != confirm_password){
            $('.overlay').show();
            $('.message-alert').text('Confirm password does not match');
            $('#alert_modal').modal('show');
            $("#submit").html("OKE");
        } else {
            $.ajax({
                url: form_action,
                type: 'POST',
                data: form_data,
                datatype: 'json',
                success: function (data){                
                    if(data.status == 200){                        
                        $('.message-alert').text(data.message);
                        $('#alert_modal').modal('show');
                        $('#change_pass_modal').modal('hide');
                        $("#submit").html("OKE");
                    } else {
                        $('.overlay').show();
                        $('.message-alert').text(data.message);
                        $('#alert_modal').modal('show');                
                        $("#submit").html("OKE");
                        return false;
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    $("#submit").html("OKE");
                    alert(jqXHR);
                    return false;
                }
            });
        }
    });

    $('#change_pass_modal').on('hide.bs.modal', function (e) {
        $('#current_password').val('');
        $('#new_password').val('');
        $('#confirm_password').val('');
    });

    $('#alert_modal').on('hide.bs.modal', function (e) {
        $('.overlay').hide();
    });
</script>
