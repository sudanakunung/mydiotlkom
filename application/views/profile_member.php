<style type="text/css">
    body{
        background: #fff;
    }

    .content-title {
        /*background-image: url("<?= base_url('assets/images/tab_bg.jpg'); ?>");*/
        /* Center and scale the image nicely */
        background: rgb(45,104,204);
        background: linear-gradient(90deg, rgba(45,104,204,1) 0%, rgba(24,16,73,1) 100%);
        background-position: top;
        background-repeat: no-repeat;
        padding-top: 120px
    }

    .subscription-box{
        border: 1px solid #d1d1d1; 
        border-radius: 10px; 
        -webkit-box-shadow: 0px 5px 3px 0px rgba(201,201,201,1);
        -moz-box-shadow: 0px 5px 3px 0px rgba(201,201,201,1);
        box-shadow: 0px 5px 3px 0px rgba(201,201,201,1);
    }

    nav.tab-custom{
        width: 100%;
        background: rgb(45,104,204);
        background: linear-gradient(90deg, rgba(45,104,204,1) 0%, rgba(24,16,73,1) 100%);
        background-position: top;
        background-repeat: no-repeat;
    }

    .tab-custom .nav-link{
        padding: .5rem .7rem;
        font-size: 13px;
    }

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: transparent;
        border-color: transparent;
        border-bottom: solid 3px white;
    }

    .tab-content{
        width: 100%;
    }

    .footer-mobile{
        display: none;
    }

    .msg-ballon i{
        font-size: 15px;
        margin-top: 3px;
    }

    .custom.btn.btn-outline-primary{
        font-size: small;
        padding: 5px;
        color: rgba(24,16,73,1);
        border: solid 2px rgba(24,16,73,1);
    }

    .custom.btn.btn-outline-light{
        border-color: #fff;
        color: #000;
    }
</style>

<div class="container" style="padding-top: 50px;">
    <div class="row justify-content-center py-4">
        <div class="col-3">
            <?php
            if(!empty($user['image_profile'])) {
                $src_profile_img = base_url('uploads/profile/').$user['image_profile'];
            } else {
                $src_profile_img = base_url('assets/images/profile_active.png');
            }
            ?>
            <img class="img-fluid" src="<?= $src_profile_img; ?>">
        </div>
        <div class="col-8 text-center">
            <div class="row">
                <div class="col-4 pl-0">
                    <span class="font-weight-bold">0</span>
                    <br />
                    <small>Post</small>
                </div>
                <div class="col-4 pl-0">
                    <span class="font-weight-bold"><?= $count_followers; ?></span>
                    <br />
                    <small>Followers</small>
                </div>
                <div class="col-4 pl-0">
                    <span class="font-weight-bold"><?= $count_following; ?></span>
                    <br />
                    <small>Following</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row">
                <div class="col-6">
                    <span class="font-weight-bold"><?= $user['name']; ?></span>
                    <br>
                    <small><?= $user['my_mood']; ?></small>
                </div>
                <div class="col-6 text-right">
                    <a href="<?= base_url('edit-profile'); ?>"><small><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</small></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row pt-3">

        <!-- <nav style="z-index: 1; position: absolute; top: 76px; width: 100%;">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="border-bottom: 0;">
                <a class="nav-item nav-link active text-white" id="nav-messages-tab" data-toggle="tab" href="#nav-messages" role="tab"
                   aria-controls="nav-home" aria-selected="true">MESSAGES</a>
                <a class="nav-item nav-link text-white" id="nav-friends-tab" data-toggle="tab" href="#nav-friends" role="tab"
                   aria-controls="nav-profile" aria-selected="false">FRIENDS</a>
            </div>
        </nav> -->

        <nav class="tab-custom">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="border-bottom: 0;">
                <a class="nav-item nav-link active text-white" id="nav-library-tab" data-toggle="tab" href="#nav-library" role="tab"
                   aria-controls="nav-home" aria-selected="true">LIBRARY</a>
                <a class="nav-item nav-link text-white" id="nav-followers-tab" data-toggle="tab" href="#nav-followers" role="tab" aria-controls="nav-profile" aria-selected="false">FOLLOWERS</a>
                <a class="nav-item nav-link text-white" id="nav-following-tab" data-toggle="tab" href="#nav-following" role="tab" aria-controls="nav-profile" aria-selected="false">FOLLOWING</a>
                <a class="nav-item nav-link text-white" id="nav-gallery-tab" data-toggle="tab" href="#nav-gallery" role="tab" aria-controls="nav-profile" aria-selected="false">GALLERY</a>
            </div>
        </nav>

        <div class="tab-content pt-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-library" role="tabpanel" aria-labelledby="nav-library-tab">
                <div class="col-12 text-center">
                    Data is still empty
                </div>
            </div>

            <div class="tab-pane fade" id="nav-followers" role="tabpanel" aria-labelledby="nav-followers-tab">
                <div class="col-12">
                    <?php
                    if($get_followers == null){
                        echo "<div class=\"text-center\"><p>You don't have followers yet</p></div>";
                    } else {
                        foreach ($get_followers as $key => $fs) { ?>
                            <div id="user-<?= $fs->ffID; ?>" class="col-12 py-2 px-0" style="border-bottom: #cccccc solid 2px;">
                                <div class="row">
                                    <div class="col-2 pr-0">
                                        <?php 
                                        if(!empty($fs->image_profile)){
                                            $src = base_url('uploads/profile/').$fs->image_profile;
                                        } else {
                                            $src = base_url('assets/images/profile_active.png');
                                        }
                                        ?>
                                        <img src="<?= $src; ?>" class="img-fluid rounded-circle" style="border: 2px #000 solid;">
                                    </div>
                                    <div class="col-6 align-self-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 17px;">
                                        <span style="font-size: 14px;"><b><?= $fs->name; ?></b></span>
                                    </div>
                                    <div class="col-4 align-self-center">
                                        <button onClick="unfollow(<?= $fs->ffID; ?>); return false;" class="unfollow-<?= $fs->ffID; ?> custom btn btn-outline-primary form-control">Unfollow</button>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-following" role="tabpanel" aria-labelledby="nav-following-tab">
                <div class="col-12">
                    <?php 
                    if($get_following == null){
                        echo "<div class=\"text-center\"><p>You haven't followed anyone yet</p></div>";
                    } else {
                        foreach ($get_following as $key => $fg) { ?>
                            <div id="user-<?= $fg->ffID; ?>" class="col-12 py-2 px-0" style="border-bottom: #cccccc solid 2px;">
                                <div class="row">
                                    <div class="col-2 pr-0">
                                        <?php 
                                        if(!empty($fg->image_profile)){
                                            $src = base_url('uploads/profile/').$fg->image_profile;
                                        } else {
                                            $src = base_url('assets/images/profile_active.png');
                                        }
                                        ?>
                                        <img src="<?= $src; ?>" class="img-fluid rounded-circle" style="border: 2px #000 solid;">
                                    </div>
                                    <div class="col-6 align-self-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 17px;">
                                        <span style="font-size: 14px;"><b><?= $fg->name; ?></b></span>
                                    </div>
                                    <div class="col-4 align-self-center">
                                        <button onClick="unfollow(<?= $fg->ffID; ?>); return false;" class="unfollow-<?= $fg->ffID; ?> custom btn btn-outline-primary form-control">Unfollow</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-gallery" role="tabpanel" aria-labelledby="nav-gallery-tab">
                <div class="col-12">
                    <button class="custom btn btn-outline-light">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <br />
                        Add Clip
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

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