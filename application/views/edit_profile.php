<style type="text/css">
    body{
        background: #fff;
    }

    /* .footer-mobile{
        display: none;
    } */

    .datepicker td, .datepicker th{
        padding: 6px;
    }

    .border-blue, .border-blue:focus{
        border: solid 1px rgba(44,103,203,1)!important;
    }

    .border-blue{
        padding: .75rem;
    }

    .custom.form-control:focus{
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .photo-profile{
        width: 100%;
        object-fit: cover;
    }
    @media only screen and (max-width: 768px) {
        .photo-profile{
            height: 150px;
            width: 150px;
        }
    }

    @media only screen and (max-width: 414px) {
        .photo-profile{
            height: 73.5px;
            width: 73.5px;
        }
    }

    @media only screen and (max-width: 411px) {
        .photo-profile{
            height: 72.75px;
            width: 72.75px;
        }
    }

    @media only screen and (max-width: 375px) {
        .photo-profile{
            height: 90px;
            width: 90px;
        }
    }

    @media only screen and (max-width: 360px) {
        .photo-profile{
            height: 80px;
            width: 80px;
        }
    }

    @media only screen and (max-width: 320px) {
        .photo-profile{
            height: 60px;
            width: 60px;
        }
    }
</style>

<div class="container" style="padding-top: 50px;">
    <div class="row justify-content-center py-4">
        <div class="col-4 position-relative">
            <?php
            if(!empty($user['urlPP'])) {
                if($data = @getimagesize($user['urlPP'])){
                    $src_profile_img = $user['urlPP'];
                }else{
                    $src_profile_img = base_url('assets/images/profile.png');
                }
            } else {
                $src_profile_img = base_url('assets/images/profile.png');
            }
            // $src_profile_img = $user['urlPP'];
            ?>
            <img class="photo-profile rounded-circle" src="<?= $src_profile_img; ?>">

            <span class="position-absolute text-primary edit-icon">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </span>

            <form id="upload_image_profile" class="d-none" enctype="multipart/form-data">
                <input type="file" id="filename" name="filename" accept="image/*">
            </form>

            <!-- <form action="<?= base_url('ProfileMember/update_pp'); ?>" method="POST" enctype="multipart/form-data">
                <input type="file" name="filename" accept="image/*">
                <button type="submit">save</button>
            </form> -->
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <form id="update-profile">
                <div class="form-group">
                    <small for="name">User Name</small>
                    <input type="text" name="name" class="form-control border-blue" id="name" value="<?= $user['name']; ?>" required="true">
                </div>
                <div class="form-group">
                    <small for="mood">My Mood</small>
                    <input type="text" name="mood" class="form-control border-blue" id="mood" value="<?= $user['mood']; ?>" required="true">
                </div>
                <div class="form-group">
                    <small for="birthday">Date of Birth</small>
                    <input type="text" name="birthday" class="form-control border-blue datepicker" id="birthday" value="<?= $user['birthday']; ?>">
                </div>
                <div class="form-row my-4">
                    <div class="col-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="gender-m" name="gender" class="custom-control-input" <?= ($user['gender'] == 'M' ? 'checked' : ''); ?> value="M">
                            <label class="custom-control-label" for="gender-m">Male</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="gender-f" name="gender" class="custom-control-input" <?= ($user['gender'] == 'L' ? 'checked' : ''); ?> value="L">
                            <label class="custom-control-label" for="gender-f">Female</label>
                        </div>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="relationship-s" name="relationship" class="custom-control-input" <?= ($user['relationship'] == 'SINGLE' ? 'checked' : ''); ?> value="SINGLE">
                            <label class="custom-control-label" for="relationship-s">Single</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="relationship-m" name="relationship" class="custom-control-input" <?= ($user['relationship'] == 'MARRIED' ? 'checked' : ''); ?> value="MARRIED">
                            <label class="custom-control-label" for="relationship-m">Married</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary custom form-control btn-submit">SAVE</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".edit-icon").click(function(e){
        $("#filename").trigger("click");
    });

    $("#filename").change(function(e){
        $("#upload_image_profile").submit();
    });

    $("#upload_image_profile").submit(function(e){
        e.preventDefault();

        $(".edit-icon").html('<i class="fa fa-spinner fa-spin loading" aria-hidden="true"></i>');

        var form_data = new FormData(this);

        $.ajax({
            url: '<?= base_url('ProfileMember/update_pp'); ?>',
            dataType: 'json',
            type: 'POST',
            data: form_data,
            async: true,
            success: function(data) {
                
                if(data.status == 200){

                    setTimeout(function(){ location.reload(); }, 500);
                    
                    // $(".edit-icon").html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>');

                    // $(".photo-profile").attr(data.src);

                    // $("#filename").val("");
                } else {
                    alert(data.message);
                    
                    $(".edit-icon").html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>');

                    $("#filename").val("");
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });    
</script>

<script src="<?= base_url('assets'); ?>/js/bootstrap-datepicker.min.js"></script>   
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>
<script type="text/javascript">
    $("#update-profile").submit(function(e){

        e.preventDefault();

        $(".btn-submit").html('<i class="fa fa-spinner fa-spin loading" aria-hidden="true"></i> LOADING...');

        var form_data = $(this).serialize();

        $.ajax({
            url: "<?= base_url('ProfileMember/update'); ?>",
            type: 'POST',
            datatype: 'json',
            data: form_data,
            success: function(data){
                if(data.status == 200){
                    location.reload(true);
                } else {
                    alert(data.message);
                    $(".btn-submit").html('SAVE');
                }                
            }
        });
    });
</script>