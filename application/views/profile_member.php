<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" />

<style type="text/css">
    body{
        background: #fff;
    }

    .js-offcanvas{
        display: none;
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
        background: #c05033;
    }

    .tab-custom .nav-link{
        display: block;
         padding: 0.3rem;
        font-size: 10px;
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

    /* .footer-mobile{
        display: none;
    } */

    .msg-ballon i{
        font-size: 15px;
        margin-top: 3px;
    }

    .custom.btn.btn-outline-primary,
    .custom.btn.btn-outline-primary:active,
    .custom.btn.btn-outline-primary:focus{
        font-size: small;
        padding: 5px;
        color: rgb(208, 74, 58);
        border: solid 2px rgb(208, 74, 58);
    }

    .custom.btn.btn-outline-light{
        border-color: #fff;
        color: #000;
    }

    .custom.btn.btn-primary,
    .custom.btn.btn-primary:active,
    .custom.btn.btn-primary:focus{
        background-color: rgb(208, 74, 58);
        border: solid 2px rgb(208, 74, 58);
        font-size: small;
        padding: 5px;
    }

    .custom.btn.btn-primary:focus{
        color: #fff;
    }

    .friend-profile{
        border: 2px #000 solid;
        width: 100%;
    }
    .user-profile{
        width: 100%;
        object-fit: cover;
    }
    .col-library{
        position: relative;
    }
    .col-library .icon{
        position: absolute;
        top: 5px;
        right: 15px;
    }
    .col-library img{
        width: 100%;
        object-fit: cover;
    }
    .clip{
        width: 100%;
        object-fit: cover;
    }

    @media only screen and (max-width: 768px) {
        .friend-profile{
            height: 105px;
            object-fit: cover;
        }
        .user-profile{
            height: 150px;
        }
        .col-library img{
            height: 238px;
        }
        .clip{
            height: 210px;
        }
    }

    @media only screen and (max-width: 414px) {
        .friend-profile{
            height: 54px;
            object-fit: cover;
        }
        .user-profile{
            height: 73.5px;
        }
        .col-library img{
            height: 135.98px;
        }
        .clip{
            height: 107.98px;
        }
    }

    @media only screen and (max-width: 411px) {
        .friend-profile{
            height: 53.5px;
            object-fit: cover;
        }
        .user-profile{
            height: 72.75px;
        }
        .col-library img{
            height: 134.98px;
        }
    }

    @media only screen and (max-width: 375px) {
        .friend-profile{
            height: 47.5px;
            object-fit: cover;
        }
        .user-profile{
            height: 63.75px;
        }
        .col-library img{
            height: 123px;
        }
        .clip{
            height: 95px;
        }
    }

    @media only screen and (max-width: 360px) {
        .friend-profile{
            height: 45px;
            object-fit: cover;
        }
        .user-profile{
            height: 60px;
        }
        .col-library img{
            height: 116px;
        }
        .clip{
            height: 90px;
        }
    }

    @media only screen and (max-width: 320px) {
        .friend-profile{
            height: 38.33px;
            object-fit: cover;
        }
        .user-profile{
            height: 50px;
        }
        .col-library img{
            height: 104.66px;
        }
        .clip{
            height: 76.66px;
        }
    }
    .btn-outline-light:not(:disabled):not(.disabled):active, .btn-outline-light:hover{
        color: #212529;
        background-color: white;
        border-color: white;
    }
    .col-clip{
        position: relative;
    }
    .icon-trash{
        position: absolute;
        right: 25px;
        bottom: 15px;
    }
</style>

<div class="container" style="padding-top: 50px;">
    <div class="row justify-content-center py-4">
        <div class="col-3">
            <?php
            if(!empty($user['urlPP']) || $user['urlPP'] != null) {
                if($data = @getimagesize($user['urlPP'])){
                    $src_profile_img = $user['urlPP'];
                }else{
                    $src_profile_img = base_url('assets/images/profile.png');
                }
            } else {
                $src_profile_img = base_url('assets/images/profile.png');
            }
            ?>
            <img class="user-profile rounded-circle" src="<?= $src_profile_img; ?>">
        </div>
        <div class="col-8 text-center">
            <div class="row">
                <div class="col-4 pl-0">
                    <span class="font-weight-bold"><?= $user['clip']; ?></span>
                    <br />
                    <small>Post</small>
                </div>
                <div class="col-4 pl-0">
                    <span class="font-weight-bold"><?= $user['follower']; ?></span>
                    <br />
                    <small>Followers</small>
                </div>
                <div class="col-4 pl-0">
                    <span class="font-weight-bold"><?= $user['following']; ?></span>
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
                    <small><?= $user['mood']; ?></small>
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

        <nav class="tab-custom" style="background-color:">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="border-bottom: 0;">
                <a class="nav-item nav-link active text-white" id="nav-library-tab" data-toggle="tab" href="#nav-library" role="tab"
                   aria-controls="nav-home" aria-selected="true">LIBRARY</a>
                <a class="nav-item nav-link text-white" id="nav-followers-tab" data-toggle="tab" href="#nav-followers" role="tab" aria-controls="nav-profile" aria-selected="false">FOLLOWERS</a>
                <a class="nav-item nav-link text-white" id="nav-following-tab" data-toggle="tab" href="#nav-following" role="tab" aria-controls="nav-profile" aria-selected="false">FOLLOWING</a>
                <a class="nav-item nav-link text-white" id="nav-gallery-tab" data-toggle="tab" href="#nav-gallery" role="tab" aria-controls="nav-profile" aria-selected="false">GALLERY</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent" style="padding-top: .1rem;">
            <div class="tab-pane fade show active" id="nav-library" role="tabpanel" aria-labelledby="nav-library-tab">
                
                <div class="container">
                    <div class="row">
                        <?php 
                        if($recording['total'] == 0 ){
                            echo "
                            <div class=\"col-12 text-center mt-3\">
                                <p>Data is still empty</p>
                            </div>";
                        } else {
                            $break_after = 3;
                            $counter = 0;
                            
                            foreach ($recording['array'] as $re) {

                                if($re['urlRecordingAudio'] != null){
                                    $uri = $re['urlRecordingAudio'];
                                }else{
                                    $uri = $re['urlM3U8'];
                                }

                                // if ($counter % $break_after == 0) {
                                //     $html.='<div class="gallery2">';
                                // }

                                // $number = ($counter % $break_after) + 1;

                                // $html .='
                                // <figure class="gallery2__item--'.$number.'" onClick="mydioclip(\''.$re['urlM3U8'].'\', \''.$re['title'].'\', \''.$re['recordingId'].'\')">
                                //     <img src="'.$re['urlPoster'].'" class="gallery__img">
                                // </figure>
                                // <p class="gallery2__icon--'.$number.'">
                                //     <i class="fa fa-video-camera text-white" aria-hidden="true"></i>
                                // </p>
                                // ';

                                // if ($counter % $break_after == ($break_after-1)) {
                                //     $html.='</div>';
                                // }

                                // ++$counter;

                                echo '
                                <div class="col-4 col-library" onClick="mydioclip(\''.$uri.'\', \''.str_replace(array("\r\n","'"), array(" ","`"), $re['title']).'\', \''.$re['recordingId'].'\')" style="padding: 0 1px 1px 1px;">
                                    <img src="'.$re['urlPoster'].'">
                                    <p class="icon">
                                        <i class="fa fa-video-camera text-white" aria-hidden="true"></i>
                                    </p>
                                </div>
                                ';
                            }

                            echo $html;
                        }
                        ?>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="nav-followers" role="tabpanel" aria-labelledby="nav-followers-tab">
                <div class="col-12">
                    <?php
                    if($followers['total'] == 0 ){
                        echo "
                        <div class=\"col-12 text-center mt-3\">
                            <p>You don't have followers yet</p>
                        </div>";
                    } else {
                        foreach ($followers['array'] as $fs) { ?>
                            <div id="user-<?= $fs['otherId']; ?>" class="col-12 py-2 px-0" style="border-bottom: #cccccc solid 2px;">
                                <div class="row">
                                    <div class="col-2 pr-0 aaa">
                                        <?php 
                                        if(isset($fs['otherUrlPic'])){
                                            if($data = @getimagesize($fs['otherUrlPic'])){
                                                $src = $fs['otherUrlPic'];
                                            }else{
                                                $src = base_url("assets/images/profile.png");
                                            }
                                        } else {
                                            $src = base_url("assets/images/profile.png");
                                        }
                                        ?>
                                        <img src="<?= $src; ?>" class="rounded-circle friend-profile">
                                    </div>
                                    <div class="col-6 align-self-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 17px;">
                                        <span style="font-size: 14px;"><b><?= $fs['otherName']; ?></b></span>
                                    </div>
                                    <div class="col-4 align-self-center follow-follower text-center" otherId="<?= $fs['otherId']; ?>">
                                        <!-- <button onClick="unfollow(<?= $fs->ffID; ?>); return false;" class="unfollow-<?= $fs->ffID; ?> custom btn btn-outline-primary form-control">Unfollow</button> -->
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
                    if($following['total'] == 0){
                        echo "
                        <div class=\"col-12 text-center mt-3\">
                            <p>You haven't followed anyone yet</p>
                        </div>";
                    } else {
                        foreach ($following['array'] as $key => $fg) { ?>
                            <div id="user-<?= $fg->ffID; ?>" class="col-12 py-2 px-0" style="border-bottom: #cccccc solid 2px;">
                                <div class="row">
                                    <div class="col-2 pr-0">
                                        <?php 
                                        if(isset($fg['otherUrlPic'])){
                                            if($data = @getimagesize($fg['otherUrlPic'])){
                                                $src = $fg['otherUrlPic'];
                                            }else{
                                                $src = base_url('assets/images/profile.png');
                                            }
                                        } else {
                                            $src = base_url('assets/images/profile.png');
                                        }
                                        ?>
                                        <img src="<?= $src; ?>" class="friend-profile rounded-circle">
                                    </div>
                                    <div class="col-6 align-self-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 17px;">
                                        <span style="font-size: 14px;"><b><?= $fg['otherName']; ?></b></span>
                                    </div>
                                    <div class="col-4 align-self-center follow-follower text-center" otherId="<?= $fg['otherId']; ?>">
                                        <!-- <button onClick="unfollow(<?= $fg->ffID; ?>); return false;" class="unfollow-<?= $fg->ffID; ?> custom btn btn-outline-primary form-control">Unfollow</button> -->
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
                <div class="container">
                    <div id="content" class="row pt-2">
                        <div class="col-4 pb-2">
                            <button id="add-icon" class="custom btn btn-outline-light">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <br />
                                Add Clip
                            </button>

                            <form id="upload_clip" class="d-none" enctype="multipart/form-data">
                                <input type="file" id="filename" name="filename" accept="image/*">
                            </form>
                        </div>
                        
                        <?php
                        foreach ($clips['array'] as $val) { ?>
                            <div id="clip_<?= $val['clipId']; ?>" class="col-4 pb-2 col-clip">
                                <?php if($data = @getimagesize($val['urlClip'])){ ?>
                                    <img src="<?= $val['urlClip']; ?>" href="<?= $val['urlClip']; ?>" class="clip img-thumbnail rounded">
                                <?php }else{ ?>
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=" class="clip img-thumbnail rounded">
                                <?php } ?>
                                <!-- <img src="<?= base_url('assets/images/trash.png'); ?>" class="icon-trash" onclick="deleteClip('<?= $val['clipId']; ?>','<?= $val['urlClip']; ?>'); return false;"> -->
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.clip').magnificPopup({type:'image'});
    });

    function deleteClip(clipId, urlClip)
    {
        if (confirm('Are you sure you want to delete?')) {
            $.ajax({
                url: '<?= base_url('ProfileMember/delete_clip'); ?>',
                dataType: 'json',
                type: 'POST',
                data: {
                    "clipId": clipId,
                    "urlClip": urlClip
                },
                success: function(data) {                    
                    if(data.status == 200){
                        $("#clip_"+clipId).remove();
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
    }
</script>

<script type="text/javascript">
    $("#add-icon").click(function(e){
        $("#filename").trigger("click");
    });

    $("#filename").change(function(e){
        $("#upload_clip").submit();
    });

    $("#upload_clip").submit(function(e){
        e.preventDefault();

        $("#add-icon").html('<i class="fa fa-spinner fa-spin loading" aria-hidden="true"></i><br />Add Clip');

        var form_data = new FormData(this);

        $.ajax({
            url: '<?= base_url('ProfileMember/store_clip'); ?>',
            dataType: 'json',
            type: 'POST',
            data: form_data,
            async: true,
            success: function(data) {
                
                if(data.status == 200){
                    $("#content").append(data.html);
                } else {
                    alert(data.message);

                    $("#filename").val("");
                }

                $("#add-icon").html('<i class="fa fa-plus" aria-hidden="true"></i><br />Add Clip');
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });    
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".follow-follower").each(function(){
            $(this).html('<i class="fa fa-spinner fa-spin loading" aria-hidden="true"></i>');

            var otherId = $(this).attr("otherId");

            $.ajax({
                url: "<?= base_url('ProfileMember/check_isfollowing'); ?>",
                type: 'POST',
                datatype: 'json',
                data: {
                    otherId : otherId,
                },
                success: function(data){
                    $('div[otherId="'+otherId+'"]').html(data.html);
                }
            });
        });
    });

    function follow(friend_id){
        $('#follow-'+friend_id).html('<i class="fa fa-spinner fa-spin loading" aria-hidden="true"></i>');

        $.ajax({
            url: "<?= base_url('Friends/follow'); ?>",
            type: 'POST',
            datatype: 'json',
            data: {
                "friend_id" : friend_id
            },
            cache: false,
            success: function(data){
                
                if(data.status == 200){
                    $('#follow-'+friend_id).attr("status-follow", data.status_follow);
                    $('#follow-'+friend_id).attr("onclick", "unfollow("+friend_id+")");

                    $('#follow-'+friend_id).removeClass("btn-primary").addClass("btn-outline-primary");
                    $('#follow-'+friend_id).text("Unfollow");
                }

                alert(data.message);
            }
        });
    }

    function unfollow(friend_id){
        $('#follow-'+friend_id).html('<i class="fa fa-spinner fa-spin loading" aria-hidden="true"></i>');

        $.ajax({
            url: "<?= base_url('Friends/unfollow'); ?>",
            type: 'POST',
            datatype: 'json',
            data: {
                "friend_id" : friend_id
            },
            cache: false,
            success: function(data){
                
                if(data.status == 200){
                    $('#follow-'+friend_id).attr("status-follow", data.status_follow);
                    $('#follow-'+friend_id).attr("onclick", "follow("+friend_id+")");

                    $('#follow-'+friend_id).removeClass("btn-outline-primary").addClass("btn-primary");
                    $('#follow-'+friend_id).text("Follow");
                }

                alert(data.message);

            }
        });
    }
</script>