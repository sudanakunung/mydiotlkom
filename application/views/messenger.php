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
</style>

<div class="container content-title">
    <div class="row">
        <!-- <div class="col-6 text-center text-white">
            Information
        </div>

        <div class="col-6 text-center text-white" style="border-bottom: solid 2px #fff;">
            <b>Subscription</b>
        </div> -->
    </div>
</div>

<div class="container">
    <div class="row">
        <nav style="z-index: 1; position: absolute; top: 76px; width: 100%;">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="border-bottom: 0;">
                <a class="nav-item nav-link active text-white" id="nav-messages-tab" data-toggle="tab" href="#nav-messages" role="tab"
                   aria-controls="nav-home" aria-selected="true">MESSAGES</a>
                <a class="nav-item nav-link text-white" id="nav-friends-tab" data-toggle="tab" href="#nav-friends" role="tab"
                   aria-controls="nav-profile" aria-selected="false">FRIENDS</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-messages" role="tabpanel" aria-labelledby="nav-messages-tab">
                
                <?php
                if(empty($chats)){ ?>
                    <div id="chats" class="col-12">
                        <div class="col-12 py-3 px-0" style="border-bottom: #cccccc solid 2px; text-align: center;">
                            <span>No conversation yet.</span>
                        </div>
                    </div>
                <?php
                } else { ?>
                    <div id="chats" class="col-12 has-chats">
                        <?php
                        foreach ($chats as $key => $value) { ?>
                            <div class="col-12 py-2 px-0" style="border-bottom: #cccccc solid 2px;"onclick="location.href = '<?= base_url('messenger/chat/'.$value->receiver_id.''); ?>';">
                                <div class="row">
                                    <div class="col-2 pr-0">
                                        <?php 
                                        if(!empty($value->image_profile)){
                                            $src = base_url('uploads/profile/').$value->image_profile;
                                        } else {
                                            $src = base_url('assets/images/profile_active.png');
                                        }
                                        ?>
                                        <img src="<?= $src; ?>" class="img-fluid rounded-circle" style="border: 2px #000 solid;">
                                    </div>
                                    <div class="col-10 align-self-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 17px;">
                                        
                                        <span id="unread-user-<?= $value->id; ?>" <?= ($value->count_unread_message == 0 ? 'style="display: none";' : ''); ?> class="badge badge-danger">
                                            <?= $value->count_unread_message; ?> 
                                        </span>

                                        <span style="font-size: 14px;"><b><?= $value->name; ?></b></span>
                                        <br>
                                        <span id="msg-user-<?= $value->id; ?>" class="msg-ballon" style="font-size: 12px;">
                                            <?php 
                                            if($value->chat_messages_text <> null){
                                                $message = $value->chat_messages_text;
                                            } else {
                                                $message = '<i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;&nbsp;Image';
                                            }
                                            
                                            echo $message;
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="tab-pane fade" id="nav-friends" role="tabpanel" aria-labelledby="nav-friends-tab">
                <div class="col-12">
                    <?php 
                    foreach ($friends as $key => $valf) { ?>
                        <div class="col-12 py-2 px-0" style="border-bottom: #cccccc solid 2px;"onclick="location.href = '<?= base_url('messenger/chat/'.$valf->following_user_id.''); ?>';">
                            <div class="row">
                                <div class="col-2 pr-0">
                                    <?php 
                                    if(!empty($valf->image_profile)){
                                        $src = base_url('uploads/profile/').$valf->image_profile;
                                    } else {
                                        $src = base_url('assets/images/profile_active.png');
                                    }
                                    ?>
                                    <img src="<?= $src; ?>" class="img-fluid rounded-circle" style="border: 2px #000 solid;">
                                </div>
                                <div class="col-10 align-self-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 17px;">
                                    <span style="font-size: 14px;"><b><?= $valf->name; ?></b></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>          
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function notifchat(){
        
        $.ajax({
            url: "<?= base_url('messenger/notifchats'); ?>",
            cache: false,
            success: function(data){

                if(data.length > 0){
                    $('#chats').addClass('has-chats');

                    $.each( data, function( key, value ) {

                        if(value.jumlah > 0){
                            var label_jumlah = '<span id="unread-user-'+value.sender_id+'" class="badge badge-danger">'+value.jumlah+'</span>&nbsp;';
                        } else {
                            var label_jumlah = '';
                        }
                        
                        $('#chats').html('<div class="col-12 py-2 px-0" style="border-bottom: #cccccc solid 2px;"onclick="location.href=\'<?=base_url('messenger/chat/'); ?>'+value.sender_id+'\';"><div class="row"> <div class="col-2 pr-0"> <img src="'+value.src_image_profile+'" class="img-fluid rounded-circle" style="border: 2px #000 solid;"></div><div class="col-10 align-self-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 17px;">'+label_jumlah+'<span style="font-size: 14px;"><b>'+value.name+'</b></span><br><span id="msg-user-'+value.sender_id+'" class="msg-ballon" style="font-size: 12px;">'+value.chat_messages_text+'</span></div></div>');
                    });
                }

                if($('.has-chats').length > 0){
                    $.each( data, function( key, value ) {
                        if(value.jumlah > 0){
                            $("#unread-user-"+value.sender_id).show();
                            $("#unread-user-"+value.sender_id).html(value.jumlah);
                            $("#msg-user-"+value.sender_id).html(value.chat_messages_text);
                        }
                    });
                }
            }
        });

        var waktu = setTimeout("notifchat()",3000);
    }

    $(document).ready(function(){
        // notifchat();
    });
</script>