<style type="text/css">
    body{
        background: #fff;
    }

    .footer-mobile{
        display: none;
    }

    .datepicker td, .datepicker th{
        padding: 6px;
    }

    .border-blue, .border-blue:focus{
        border: solid 1px rgba(44,103,203,1)!important;
    }

    .border-blue{
        padding: .75rem;
    }
</style>

<div class="container" style="padding-top: 50px;">
    <div class="row justify-content-center py-4">
        <div class="col-4">
            <?php
            if(!empty($user['image_profile'])) {
                $src_profile_img = base_url('uploads/profile/').$user['image_profile'];
            } else {
                $src_profile_img = base_url('assets/images/profile_active.png');
            }
            ?>
            <img class="img-fluid" src="<?= $src_profile_img; ?>">
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <form id="update-profile" method="POST" action="<?= base_url('profilemember/update'); ?>">
                <div class="form-group">
                    <small for="name">User Name</small>
                    <input type="text" name="name" class="form-control border-blue" id="name" value="<?= $user['name']; ?>" required="true">
                </div>
                <div class="form-group">
                    <small for="my_mood">My Mood</small>
                    <input type="text" name="my_mood" class="form-control border-blue" id="my_mood" value="<?= $user['my_mood']; ?>" required="true">
                </div>
                <div class="form-group">
                    <small for="birthday">Date of Birth</small>
                    <input type="text" name="birthday" class="form-control border-blue datepicker" id="birthday" value="<?= $user['birthday']; ?>" required="true">
                </div>
                <div class="form-row my-4">
                    <div class="col-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="sex-m" name="sex" class="custom-control-input" <?= ($user['sex'] == 'male' ? 'checked' : ''); ?> value="male">
                            <label class="custom-control-label" for="sex-m">Male</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="sex-f" name="sex" class="custom-control-input" <?= ($user['sex'] == 'female' ? 'checked' : ''); ?> value="female">
                            <label class="custom-control-label" for="sex-f">Female</label>
                        </div>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="status-s" name="status" class="custom-control-input" <?= ($user['status'] == 'single' ? 'checked' : ''); ?> value="single">
                            <label class="custom-control-label" for="status-s">Single</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="status-m" name="status" class="custom-control-input" <?= ($user['status'] == 'married' ? 'checked' : ''); ?> value="married">
                            <label class="custom-control-label" for="status-m">Married</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary form-control">SAVE</button>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets'); ?>/js/bootstrap-datepicker.min.js"></script>   
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>
<script type="text/javascript">
    function unfollow(id){
        $('.unfollow-'+id).html('<i class="fa fa-spinner fa-spin loading" aria-hidden="true"></i>');

        $.ajax({
            url: "<?= base_url('profilemember/unfollow'); ?>",
            type: 'POST',
            datatype: 'json',
            data: {id : id},
            cache: false,
            success: function(data){
                $('#user-'+id).remove();
            }
        });
    }
</script>