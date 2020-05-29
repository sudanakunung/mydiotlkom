<!DOCTYPE html>

<html>

<head>

    <title>Admin Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php echo link_tag('assets/css/vendor.css'); ?>

    <?php echo link_tag('assets/css/flat-admin.css'); ?>

</head>

<body>

    <div class="app app-default">

        <div class="app-container app-login">

            <div class="flex-center">

                <div class="app-header"></div>

                <div class="app-body">

                    <div class="app-block">

                        <div class="app-form">

                            <div class="form-header">

                                <div class="app-brand"><span class="highlight">Admin</span> Mydiosing</div>

                            </div>

                            <?php if ($this->session->flashdata('login') != null): ?>

                                <div class="alert alert-warning alert-dismissible" role="alert">

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

                                <strong>Warning!</strong> <?php echo $this->session->flashdata('login'); ?>

                            </div>

                            <?php endif ?>

                            <!-- form-login -->

                            <?php echo form_open('Auth/verify'); ?>

                                <div class="input-group">

                                    <span class="input-group-addon" id="basic-addon1">

                                      <i class="fa fa-user" aria-hidden="true"></i>

                                    </span>

                                    <input type="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1" name="email" required />

                                </div>

                                <div class="input-group">

                                    <span class="input-group-addon" id="basic-addon2">

                                      <i class="fa fa-key" aria-hidden="true"></i>

                                    </span>

                                    <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" name="password" required />

                                </div>

                                <div class="text-center">

                                    <input type="submit" name="submit" class="btn btn-success btn-submit" value="Login"/>

                                </div>

                            <?php echo form_close(); ?>

                        </div>

                    </div>

                </div>

                <div class="app-footer">

                </div>

            </div>

        </div>

    </div>



    <script type="text/javascript" src="<?php echo base_url('assets/js/vendor.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js');?>"></script>

</body>

</html>