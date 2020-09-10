<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Google extends Google_Client {
	function __construct() {
		parent::__construct(); 
		// $this->setAuthConfigFile('./client_secret.json');
		$this->setAuthConfigFile('./client_secret_292287579277-brerijk9poi2sn1hc4gdk7eng9pdmfct.apps.googleusercontent.com.json');
		// $this->setClientId('292287579277-brerijk9poi2sn1hc4gdk7eng9pdmfct.apps.googleusercontent.com');
		// $this->setClientSecret('-R7iYxqyHyFJPx86qYby4Szy');
		$this->setRedirectUri('https://app.mydiosing.com/Login/google');
		$this->setScopes(array(
			"https://www.googleapis.com/auth/plus.login",
			"https://www.googleapis.com/auth/userinfo.email",
			"https://www.googleapis.com/auth/userinfo.profile",
			"https://www.googleapis.com/auth/plus.me",
		)); 
	}
}