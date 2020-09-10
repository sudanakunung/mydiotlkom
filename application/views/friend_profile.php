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

    .custom.btn.btn-outline-primary,
    .custom.btn.btn-outline-primary:active,
    .custom.btn.btn-outline-primary:focus{
        font-size: small;
        padding: 5px;
        color: rgba(24,16,73,1);
        border: solid 2px rgba(24,16,73,1);
    }

    .custom.btn.btn-outline-light{
        border-color: #fff;
        color: #000;
    }

    .custom.btn.btn-primary,
    .custom.btn.btn-primary:active,
    .custom.btn.btn-primary:focus{
        background-color: rgba(24,16,73,1);
        border: solid 2px rgba(24,16,73,1);
        font-size: small;
        padding: 5px;
    }
    .friend-profile{
        border: 2px #000 solid;
        width: 100%;
    }
    .user-profile{
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
    }

    @media only screen and (max-width: 414px) {
        .friend-profile{
            height: 54px;
            object-fit: cover;
        }
        .user-profile{
            height: 73.5px;
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
    }

    @media only screen and (max-width: 375px) {
        .friend-profile{
            height: 47.5px;
            object-fit: cover;
        }
        .user-profile{
            height: 63.75px;
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
    }

    @media only screen and (max-width: 320px) {
        .friend-profile{
            height: 38.33px;
            object-fit: cover;
        }
        .user-profile{
            height: 50px;
        }
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
                    <span class="font-weight-bold"><?= $user['recording']; ?></span>
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
        <div class="col-12">
            <p class="mt-3 mb-0">
                <span class="font-weight-bold"><?= $user['name']; ?></span>
            </p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col">
            <?php
            if($isfollowing['isFollowing'] == 0){ ?>
                <button id="follow-<?= $user['userId']; ?>" class="custom btn btn-primary form-control follow-friend" status-follow="0" friend-id="<?= $user['userId']; ?>">
                    Follow
                </button>
            <?php
            } else { ?>
                <button id="follow-<?= $user['userId']; ?>" class="custom btn btn-outline-primary form-control follow-friend" status-follow="1" friend-id="<?= $user['userId']; ?>">
                    Unfollow
                </button>
            <?php
            }
            ?>
        </div>
        <div class="col">
            <!-- <a href="<?= base_url('messenger/chat/'.$user['id'].''); ?>" class="custom btn btn-outline-primary form-control">Message</a> -->

            <a data-toggle="modal" data-target="#exampleModal5" href="Javascript.void(0)" class="custom btn btn-outline-primary form-control">Message</a>
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
            </div>
        </nav>

        <div class="tab-content pt-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-library" role="tabpanel" aria-labelledby="nav-library-tab">
                <div class="container p-0">
                    <?php 
                    if($recording['total'] == 0 ){
                        echo "<div class=\"text-center\"><p>Data is still empty</p></div>";
                    } else {
                        $break_after = 3;
                        $counter = 0;
                        foreach ($recording['array'] as $re) {

                            if ($counter % $break_after == 0) {
                                $html.='<div class="gallery2">';
                            }

                            $number = ($counter % $break_after) + 1;

                            $html .='
                            <figure class="gallery2__item--'.$number.'" onClick="mydioclip(\''.$re['urlM3U8'].'\', \''.$re['title'].'\', \''.$re['recordingId'].'\')">
                                <img src="'.$re['urlPoster'].'" class="gallery__img">
                            </figure>
                            <p class="gallery2__icon--'.$number.'">
                                <i class="fa fa-video-camera text-white" aria-hidden="true"></i>
                            </p>
                            ';

                            if ($counter % $break_after == ($break_after-1)) {
                                $html.='</div>';
                            }

                            ++$counter;
                        }

                        echo $html;
                    }
                    ?>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-followers" role="tabpanel" aria-labelledby="nav-followers-tab">
                <div class="col-12">
                    <?php
                    if ($this->session->has_userdata('memberLogin')) {
                        if($followers['total'] == 0){
                            echo"
                            <div class=\"text-center\">
                                <p>Don't have followers yet</p>
                            </div>";
                        } else {
                            foreach ($followers['array'] as $key => $fs) { ?>
                                <div id="user-<?= $fs['otherId']; ?>" class="col-12 py-2 px-0" style="border-bottom: #cccccc solid 2px;">
                                    <div class="row">
                                        <div class="col-2 pr-0 aaa">
                                            <?php 
                                            if(isset($fs['otherUrlPic'])){
                                                $src = $fs['otherUrlPic'];
                                            } else {
                                                $src = base_url('assets/images/profile_active.png');
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
                    } else {
                        echo'
                        <div class="text-center">
                            <p>You are required to <a href="'.base_url('login').'">login</a> to be able to see the list of followers</p>
                        </div>';
                    }
                    ?>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-following" role="tabpanel" aria-labelledby="nav-following-tab">
                <div class="col-12">
                    <?php 
                    if ($this->session->has_userdata('memberLogin')) {
                        if($following['total'] == 0){
                            echo "<div class=\"text-center\"><p>Hasn't followed anyone yet</p></div>";
                        } else {
                            foreach ($following['array'] as $key => $fg) { ?>
                                <div id="user-<?= $fg->ffID; ?>" class="col-12 py-2 px-0" style="border-bottom: #cccccc solid 2px;">
                                    <div class="row">
                                        <div class="col-2 pr-0">
                                            <?php 
                                            if(isset($fg['otherUrlPic'])){
                                                $src = $fg['otherUrlPic'];
                                            } else {
                                                $src = base_url('assets/images/profile_active.png');
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
                    } else {
                        echo'
                        <div class="text-center">
                            <p>You are required to <a href="'.base_url('login').'">login</a> to be able to see the list of following</p>
                        </div>';
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
    $(".follow-friend").click(function(e){

        e.preventDefault();

        <?php 
        if (!$this->session->has_userdata('memberLogin')) { ?>
            
            alert('Please login first');
            window.location.replace("<?= base_url('/login'); ?>");

        <?php 
        } else { ?>

            let status_follow = $(this).attr('status-follow');
            let friend_id = $(this).attr('friend-id');

            if(status_follow == "1"){
                var url_follow = "<?= base_url('Friends/unfollow'); ?>";
            } else {
                var url_follow = "<?= base_url('Friends/follow'); ?>";
            }

            $.ajax({
                url: url_follow,
                type: 'POST',
                datatype: 'json',
                data: {
                    "friend_id" : friend_id
                },
                cache: false,
                success: function(data){

                    if(data.status == 200){
                        $('#follow-'+friend_id).attr("status-follow", data.status_follow);

                        if(data.status_follow > 0){
                            $('#follow-'+friend_id).removeClass("btn-primary").addClass("btn-outline-primary");
                            $('#follow-'+friend_id).text("Unfollow");
                        } else {
                            $('#follow-'+friend_id).removeClass("btn-outline-primary").addClass("btn-primary");
                            $('#follow-'+friend_id).text("Follow");
                        }
                    }

                    alert(data.message);
                }
            });

        <?php
        }
        ?>
    });

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