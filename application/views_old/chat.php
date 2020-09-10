<style type="text/css">
    body{
        background-image: url("<?= base_url('assets/images/chat_bg.jpg'); ?>");
        /* Center and scale the image nicely */
        background-position: top;
        background-repeat: repeat;
    }

    aside{
        display: none;
    }

    .footer-mobile{
        display: none;
    }

    .chat {
        width: 100%;
        height: 91.5%;
        /*padding: 15px 30px;*/
        padding: 15px 15px 62px 15px;
        margin: 0 auto;
        overflow-y: scroll;
        transform: rotate(180deg);
        direction: rtl;
    }

    .chat__wrapper {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column-reverse;
        flex-direction: column-reverse;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        justify-content: flex-end;
    }

    .chat__date{
        transform: rotate(180deg);
        text-align: center;
        margin: 20px 0;
    }

    .chat__date span{
        padding: 10px;
        background: #b5e4ff;
        color: #476b81;
        border-radius: 10px;
    }

    .chat__message {
        font-size: 18px;
        padding: 10px 20px;
        border-radius: 5px;
        color: #000;
        background-color: #e6e7ec;
        max-width: 600px;
        width: -webkit-fit-content;
        width: -moz-fit-content;
        width: fit-content;
        position: relative;
        margin: 5px;
        word-break: break-all;
        transform: rotate(180deg);
        direction: ltr;
    }

    .chat__message:after {
        content: "";
        width: 20px;
        height: 12px;
        display: block;
        background-image: url("https://stageviewcincyshakes.firebaseapp.com/icon-gray-message.e6296433d6a72d473ed4.png");
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        position: absolute;
        bottom: -2px;
        left: -5px;
    }

    .chat__message-own {
        color: #fff;
        margin-left: auto;
        background-color: #00a9de;
    }

    .chat__message-own:after {
        width: 19px;
        height: 13px;
        left: inherit;
        right: -5px;
        background-image: url("https://stageviewcincyshakes.firebaseapp.com/icon-blue-message.2be55af0d98ee2864e29.png");
    }

    .chat__form {
        width: 100%;
        background-color: transparent;
        padding-left: 10px;
        padding-right: 10px;
    }

    .chat__form form {
        max-width: 800px;
        margin: 0 auto;
        height: 50px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .chat__form input {
        height: 40px;
        font-size: 16px;
        min-width: 100%;
        padding-left: 15px;
        padding-right: 35px;
        background-color: #fff;
        /*border-radius: 15px;
        border: none;*/
        border-radius: 20px;
        border: 2px solid #ccc;
    }

    .chat__form button {
        width: 18%;
        height: 40px;
        font-size: 16px;
        border: none;
        text-align: center;
        text-transform: uppercase;
        cursor: pointer;
        background: rgba(0,0,0,0.4);
        border-radius: 10px;
        margin-left: 2%;
    }

    .chat__form button:hover {
        font-weight: bold;
    }

    .chat__inputkeyword{
        width: 80%;
    }

    .chat__inputkeyword span.material-icons{
        position: absolute;
        right: 24%;
        bottom: 3.1%;
    }

    .attachment.modal-body{
        padding: 1rem!important;
    }

    .upload.chat__message{
        width: 50%;
        padding: 5px;
    }

    .chat__loading{
        width: 100%;
        text-align: center;
        font-size: medium;
    }
</style>

<div class="chat">
    <div class="chat__wrapper">
        <?php 
        foreach ($chat_history as $vala) { ?>
            
            <div class="chat__date">
                <span><?= $vala['date']; ?></span>
            </div>

            <?php 
            foreach ($vala['chats'] as $valb) {

                if($valb['sender_id'] == $this->session->userdata('userId')){
                    $class = "chat__message chat__message-own";
                } else {
                    $class = "chat__message";
                }

                if($valb['attachment'] <> null){
                    $class_upload = 'upload ';
                } else {
                    $class_upload = '';
                }

                ?>
                <div id="message-<?= $valb['id'] ?>" class="<?= $class_upload.$class; ?>">
                    <div>
                        <?php

                        if($valb['chat_messages_text'] <> null){
                            echo $valb['chat_messages_text'];
                        } else {
                            echo '<img src="'.base_url().'uploads/chat/'.$valb['attachment'].'" class="img-fluid">';
                        }
                        ?>
                    </div>
                </div>   
            <?php
            }
        }
        ?>

        <div class="chat__loading" style="display: none;">
            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

<div class="chat__form">
    <form id="chat__form">
        <div class="chat__inputkeyword">
            <span id="attach-file" class="material-icons">attach_file</span>
            <input id="text-message" type="text" placeholder="Type a message...">
        </div>
        
        <button id="btn-submit-chat" type="submit">
            <span class="material-icons text-light align-middle">send</span>
        </button>
    </form>
</div>

<!-- <div id="result"></div> -->

<!-- Modal -->
<div class="modal fade" id="modalAttachment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="attachment modal-body bg-white">
                <div class="row justify-content-center">
                    <div class="col-4 text-center">
                        <img id="attach-image" src="<?= base_url('assets/images/add_image.png'); ?>" class="img-fluid">
                        <form id="upload-image" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="receiver_id" value="<?= $receiver_id; ?>">
                            <input type="file" name="imgupload" id="imgupload" style="display:none" accept="image/*"/>
                        </form>                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function cek_new_chat(){

        $.ajax({
            url: "<?= base_url('Messenger/ceknewchat'); ?>",
            type: 'POST',
            data: {
                'receiver_id': '<?= $receiver_id; ?>'
            },
            cache: false,
            success: function(data){

                if(data.length > 0){
                    
                    $('.chat__loading').show();

                    $.each( data, function( key, value ) {
                        $.ajax({
                            url: "<?= base_url('Messenger/updatereadnewchat'); ?>",
                            type: 'POST',
                            data: {
                                'chat_messages_id': value.id
                            },
                            cache: false,
                            success: function(data){
                                
                                $('.chat__loading').hide();

                                if(value.chat_messages_text === null){
                                    var chat_message = '<div id="message-'+value.id+'" class="upload chat__message"><div><img src="<?= base_url(); ?>uploads/chat/'+value.attachment+'" class="img-fluid"></div></div>';
                                } else {
                                    var chat_message = '<div id="message-'+value.id+'" class="chat__message"><div>' + value.chat_messages_text + '</div></div>';
                                }

                                $('.chat__wrapper').append(chat_message);
                            }
                        });
                    });
                } else {
                    $('.chat__loading').hide();
                }                
            }
        });

        var waktu = setTimeout("cek_new_chat()", 3000);
    }

    $(document).ready(function(){
        cek_new_chat();
    });

    $(function () {

        $('#chat__form').on('submit', function(e) {
            e.preventDefault();
            var chat_message = $('#text-message').val();

            $('#btn-submit-chat').html('<i class="fa fa-spinner fa-spin loading" aria-hidden="true"></i>');
            
            $.ajax({
                url: "<?= base_url('Messenger/storechat'); ?>",
                type: 'POST',
                data: {
                    'receiver_id': '<?= $receiver_id; ?>',
                    'chat_message': chat_message
                },
                datatype: 'json',
                success: function (data){ 
                    
                    if(data.status == 200){
                        $('.chat__wrapper').append('<div id="message-'+data.id+'" class="chat__message chat__message-own"><div>' + chat_message + '</div></div>')

                        $('#btn-submit-chat').html('<span class="material-icons text-light align-middle">send</span>');

                    } else {
                        $('#btn-submit-chat').html('<span class="material-icons text-light align-middle">send</span>');

                        alert(data.message);
                        return false;
                    }

                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert(textStatus);
                    return false;
                }
            });
        });

        // $("input[type='image']").click(function() {
        //     $("input[id='my_file']").click();
        // });

        $('#attach-image').on('click', function(e) {
            e.preventDefault();
            $('#imgupload').trigger('click'); 
        });

        $('#imgupload').on('change', function(e) {
            e.preventDefault();
            $('#upload-image').submit();
        });

        $("form#upload-image").submit(function(e){
            e.preventDefault();

            $('#modalAttachment').modal('hide');
            
            $('#btn-submit-chat').html('<i class="fa fa-spinner fa-spin loading" aria-hidden="true"></i>');

            var formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('Messenger/uploadimage'); ?>",
                dataType: 'json',
                type: 'POST',
                data: formData,
                async: true,
                success: function(data) {
                    $('#btn-submit-chat').html('<span class="material-icons text-light align-middle">send</span>');

                    if(data.status == 403){
                        alert(data.message);
                        return false;
                    }

                    $('.chat__wrapper').append('<div id="message-'+data.id+'" class="upload chat__message"><div>' + data.message + '</div></div>');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        // $('#chat__form').on('submit', function(e) {
        //     e.preventDefault();
        //     var message = $('#text-message').val();
        //     $('#text-message').val('');
        //     var date = new Date().toJSON().slice(0,10).replace(/-/g,'/');
        //     $('.chat__wrapper').append('<div class="chat__message chat__message-own"><div class="date">' + date + '</div><div>' + message + '</div></div>')
        // });

        $('#attach-file').on('click', function(e) {
            e.preventDefault();
            $('#modalAttachment').modal('show');
        });
    });
</script>