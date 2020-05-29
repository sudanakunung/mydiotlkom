<style type="text/css">
    body{
        background: #fff;
    }

    .footer-mobile{
    	display: none;
    }
</style>

<div class="container pt-5 content-title">
    <div class="row py-3">
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
    <div class="row py-3" data-toggle="modal" data-target="#contact_modal">
        <div class="col-2 pr-0">
        	<span class="material-icons align-middle">phone</span>
        </div>
        <div class="col-8 pl-0">
        	<span class="align-middle">Cotact Us</span>
        </div>
        <div class="col-2align-self-center">
        	<span class="material-icons align-middle">navigate_next</span>
        </div>
    </div>
    <?php 
    if ($this->session->has_userdata('memberLogin')) { ?>
        <div class="row py-3">
            <div class="col-2 pr-0">
                <span class="material-icons align-middle">power_settings_new</span>
            </div>
            <div class="col-8 pl-0">
                <a class="text-dark" href="<?= base_url('logout'); ?>"><span class="align-middle">Log out</span></a>
            </div>
            <div class="col-2align-self-center">
                <span class="material-icons align-middle">navigate_next</span>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<div id="contact_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times; </button>
            </div>
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>
