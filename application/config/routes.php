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

$route['default_controller'] = "Home";

$route['admin'] = "login";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";
$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['profile'] = "user/profile";
$route['profile/(:any)'] = "user/profile/$1";
$route['profileUpdate'] = "user/profileUpdate";
$route['profileUpdate/(:any)'] = "user/profileUpdate/$1";

$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['changePassword/(:any)'] = "user/changePassword/$1";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['login-history'] = "user/loginHistoy";
$route['login-history/(:num)'] = "user/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "user/loginHistoy/$1/$2";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";


$route['deletepricedrop'] = "pricedrop/deletepricedrop";
$route['deletespecialoffer'] = "specialoffer/deletespecialoffer";
$route['deleteonlyforyou'] = "onlyforyou/deleteonlyforyou";
$route['deleteredeemgift'] = "redeemgift/deleteredeemgift";
$route['deletenotification'] = "notification/deletenotification";

$route['deletepurchasehistory'] = "purchasehistory/deletepurchasehistory";
$route['deletesalessummery'] = "salessummery/deletesalessummery";


/*admin pagination*/

$route['pricedrop/(:num)'] = "pricedrop/index/$1";
$route['specialoffer/(:num)'] = "specialoffer/index/$1";
$route['onlyforyou/(:num)'] = "onlyforyou/index/$1";
$route['redeemgift/(:num)'] = "redeemgift/index/$1";
$route['notification/(:num)'] = "notification/index/$1";
$route['purchasehistory/(:num)'] = "purchasehistory/index/$1";
$route['salessummery/(:num)'] = "salessummery/index/$1";
$route['feedback/(:num)'] = "feedback/index/$1";


/* frontend  pagination  */


$route['userNotifications/(:num)'] = "Frontend/userNotifications/index/$1";
$route['userSalessummary/(:num)'] = "Frontend/userSalessummary/index/$1";
$route['userPayoutsummary/(:num)'] = "Frontend/userPayoutsummary/index/$1";
$route['userSpecialoffers/(:num)'] = "Frontend/userSpecialoffers/index/$1";
$route['userPricedrop/(:num)'] = "Frontend/userPricedrop/index/$1";
$route['userRedeemgift/(:num)'] = "Frontend/userRedeemgift/index/$1";
$route['userOnlyforyou/(:num)'] = "Frontend/userOnlyforyou/index/$1";



/* End of file routes.php */
/* Location: ./application/config/routes.php */

/******** FRONTEND ROUTES ********/


$route['userRegistration'] = "Frontend/UserRegistration";
$route['userLogin'] = "Frontend/UserLogin";
$route['userOnlyforyou'] = "Frontend/UserOnlyforyou";
$route['userMyaccount'] = "Frontend/UserMyaccount";
$route['userNotifications'] = "Frontend/UserNotifications";
$route['userPayoutsummary'] = "Frontend/UserPayoutsummary";
$route['userPricedrop'] = "Frontend/UserPricedrop";
$route['userProfile'] = "Frontend/UserProfile";
$route['userRedeemgift'] = "Frontend/UserRedeemgift";
$route['userSalessummary'] = "Frontend/UserSalessummary";
$route['userSpecialoffers'] = "Frontend/UserSpecialoffers";
$route['userFeedback'] = "Frontend/UserFeedback";
$route['sendfeedback'] = "Frontend/UserFeedback/sendfeedback";

$route['registeruser'] = "Frontend/UserRegistration/register";
$route['successregister'] = "Frontend/UserRegistration/successregister";
$route['loginuser'] =  "Frontend/UserLogin/loginMe";
$route['logoutuser'] = "Frontend/UserLogin/logout";
$route['searchsales'] = "Frontend/UserSalessummary/search";


$route['userFeedback'] = "Frontend/UserFeedback";
$route['updateaccount'] = "Frontend/UserMyaccount/updateprofile";
$route['termsconditions'] = "Frontend/UserTermcondition";
$route['changemypassword'] = "Frontend/Changepassword";
$route['updatepassword'] = "Frontend/Changepassword/changePassword";


