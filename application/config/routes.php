<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';

$route['install-app'] = 'Home/installApp';

//Profile Member
$route['profile'] = 'ProfileMember/index';
$route['edit-profile'] = 'ProfileMember/edit_profile';

//Member Messenger
$route['messenger'] = 'Messenger/index';
$route['messenger/chat/(:any)'] = 'Messenger/chat/$1';
$route['messenger/friends'] = 'Messenger/friends';

//Admin dashboard
$route['admin-login'] = 'Auth';
$route['admin-logout'] = 'Auth/logoutAdmin';
$route['admin'] = 'Dashboard';
$route['en'] = 'Home';

//Member Register
$route['register'] = 'Register/index';
$route['register/store'] = 'Register/store';

//Member Register
$route['setting'] = 'Setting/index';

//Category Songs
$route['song-by-category'] = 'SongCategory/index';
$route['filter-song/(:any)'] = 'SongCategory/filter_song/$1';

//Search Songs
$route['song-by-search'] = 'SearchSong/index';

//Member Login
$route['login'] = 'Login/index';
$route['login/showloginemail'] = 'Login/showLoginEmail';
$route['login/email'] = 'Login/email';
$route['login/facebook'] = 'Login/facebook';
$route['login/google'] = 'Login/google';
$route['logout'] = 'Login/logout';

//Subscription
$route['subscription'] = 'Subscription/index';
$route['subscription/success'] = 'Subscription/success';
$route['subscription/cancel'] = 'Subscription/cancel';
$route['subscription/paypal-ipn'] = 'Subscription/paypal_ipn';

// artikel route
$route['add-post'] = 'AdminPost/index';
$route['edit-post/(:num)'] = 'AdminPost/edit';
$route['data-post'] = 'AdminPost/data';

//video
$route['add-video'] = 'Video';
$route['data-video'] = 'Video/viewVideo';
$route['edit-video/(:num)'] = 'Video/edit';

//admin
$route['admin-profile'] = 'Profile';

//home route
$route['news'] = 'Home/news';
$route['en/news'] = 'Home/news';
$route['Home/getNews/id'] = 'Home/getNews';
$route['Home/getNews/en'] = 'Home/getNews';
$route['news/(:num)/(:any)'] = 'Home/detailNews';
$route['all/karafie'] = 'Home/all';
$route['en/all/karafie'] = 'Home/all';
$route['submit-contact'] = 'Home/sendEmail';

$route['all/karaclip'] = 'Home/all';
$route['en/all/karaclip'] = 'Home/all';
$route['all/trending'] = 'Home/video';
$route['en/all/trending'] = 'Home/video';
$route['all/recommended'] = 'Home/video';
$route['en/all/recommended'] = 'Home/video';

$route['lazy/recommended'] = 'Home/lazy';
$route['lazy/trending'] = 'Home/lazy';
$route['lazy/all'] = 'Home/lazy';
$route['lazy/karaclip'] = 'Home/lazyClip';
$route['lazy/karafie'] = 'Home/lazyRecord';
$route['lazy/songs'] = 'Home/lazySongs';
$route['lazy/users'] = 'Home/lazyUsers';
$route['lazy/recordings'] = 'Home/lazyRecordings';

//statis page
$route['about'] = 'Home/about';
$route['en/about'] = 'Home/about';
$route['tos'] = 'Home/tos';
$route['en/tos'] = 'Home/tos';
$route['privacy'] = 'Home/privacy';
$route['en/privacy'] = 'Home/privacy';
$route['contact'] = 'Home/contact';
$route['en/contact'] = 'Home/contact';

//youtube
$route['youtube'] = 'Home/youtube';
$route['en/youtube'] = 'Home/youtube';

//record clip
$route['record-clip'] = 'Home/recordClip';
//search
$route['search'] = 'Home/search';
$route['en/search'] = 'Home/search';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

