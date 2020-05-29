<style type="text/css">
	.separator {
		font-size: 12px;
	    display: flex;
	    align-items: center;
	    text-align: center;
	}
	.separator::before, .separator::after {
	    content: '';
	    flex: 1;
	    border-bottom: 1px solid #fff;
	}
	.separator::before {
	    margin-right: .75em;
	}
	.separator::after {
	    margin-left: .75em;
	}
    .footer-mobile{
        display: none;
    }
</style>

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-11 col-md-5 col-lg-5">
        	<div class="row justify-content-center">
        		<div class="col-11 col-md-8 col-lg-8">
        			<img src="<?= base_url('assets/images/logo-md.png'); ?>" width="100%">
        		</div>

        		<div class="col-md-8 mt-5">
        			<a href="<?= base_url('login/showloginemail') ?>" class="btn btn-primary form-control">LOG IN</a>
        		</div>

        		<div class="col-md-8 mt-4 text-center text-white">
        			<span class="separator">Or login with</span>
        		</div>

        		<div class="col-md-8 mt-4">
        			<div class="row">
        				<div class="col-6">
        					<div id="status"></div>
        					<a href="" onClick="fbLogin(); return false;" class="btn btn-primary form-control">
        						<i class="fa fa-facebook" aria-hidden="true"></i>
        					</a>

        					<!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
							</fb:login-button> -->
        				</div>
        				<div class="col-6">
        					<a href="" id="signinGoogle" class="btn btn-danger form-control">
        						<i class="fa fa-google" aria-hidden="true"></i>
        					</a>
        				</div>
        			</div>
        		</div>

        		<div class="col-md-8 mt-4 text-center text-white">
        			<span style="font-size: 12px;">Dont have account? <b><a class="text-white" href="<?= base_url('register'); ?>">Register</a></b></span>
        		</div>
        	</div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script>
$('#signinGoogle').click(function(event) {
    event.preventDefault();
    gapi.auth2.authorize({
        
        client_id: '330389880017-bvil48vmvj9ev4murcfp308ak6ijpm98.apps.googleusercontent.com',
        scope: 'email profile openid',
        response_type: 'id_token access_token permission'

    }, function(response) {

        if (response.error) {
            if(response.error == 'popup_closed_by_user'){
                alert('Popup Closed by User');
            }

            return;
        }

        var token_type = response.token_type;
        var accessToken = response.access_token;
        var idToken = response.id_token;

        $.ajax({
            url: '<?= base_url('login/google'); ?>',
            type: 'POST',
            data: {
                '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
                'token_type': token_type,
                'accessToken': accessToken, 
                'idToken': idToken
            },
            datatype: 'json',
            success: function (data){ 
                if(data.status == 200){
                    window.location.replace("<?= base_url('/'); ?>");
                } else {
                    alert(data.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert(textStatus);
            }
        });            
    });

    // auth2 = gapi.auth2.init({
    //     client_id: '330389880017-bvil48vmvj9ev4murcfp308ak6ijpm98.apps.googleusercontent.com',
    //     scope: 'email profile openid',
    //     response_type: 'id_token access_token permission'
    // });

    // // Sign the user in, and then retrieve their ID.
    // auth2.signIn().then(function() {
    //     var profile = auth2.currentUser.get().getBasicProfile();
    //     console.log('ID: ' + profile.getId());
    //     console.log('Full Name: ' + profile.getName());
    //     console.log('Given Name: ' + profile.getGivenName());
    //     console.log('Family Name: ' + profile.getFamilyName());
    //     console.log('Image URL: ' + profile.getImageUrl());
    //     console.log('Email: ' + profile.getEmail());
    // });
});
</script>

<script type="text/javascript">
window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
        appId: '279391043077517', // FB App ID
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true, // parse social plugins on this page
        version: 'v6.0' // use graph api version 2.8
    });

    // Check whether the user already logged in
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            FB.logout(function(response) {});
        }
    });
};
    
// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook login with JavaScript SDK
function fbLogin() {   
    FB.login(function(response) {
        if (response.authResponse) {

            var accessToken = response.authResponse.accessToken;

            FB.api('/me/', 'GET', {"fields":"email,birthday,first_name,last_name"}, function(response) {
                    $.ajax({
                        url: '<?= base_url('login/facebook'); ?>',
                        type: 'POST',
                        data: {
                            '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
                            'email': response.email,
                            'birthday': response.birthday,
                            'first_name': response.first_name,
                            'last_name': response.last_name,
                            'accessToken': accessToken
                        },
                        datatype: 'json',
                        success: function (data){ 
                            if(data.status == 200){
                                window.location.replace("<?= base_url('/'); ?>");
                            } else {
                                alert(data.message);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert(textStatus);
                        }
                    }); 
                }
            );        

        } else {
            alert('User cancelled login or did not fully authorize.');
        }

    });


}
</script>