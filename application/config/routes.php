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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'admin/Dashboard';
$route['dashboard/getalltotalbyyear'] = 'admin/Dashboard/getalltotalbyyear';
// $route['admin/login'] = 'admin/login';

// Detail
$route['guide'] = 'frontend/Guide/index';
$route['detail/(:num)'] = 'frontend/Detail/index/$1';
$route['home/(:num)'] = 'Home/index/$1';
$route['verify/(:any)/(:any)'] = 'Verify/index/$1/$2';
$route['password/resetpassword/(:any)'] = 'Verify/resetpassword/$1';
$route['sendmailforgot'] = 'Verify/sendmailforgot';
$route['sendmailforgot/forgetpwd/(:any)/(:any)'] = 'Verify/forgetpwd/$1/$2';

// $route['home/login'] = 'Home/login';
$route['login'] = 'Login';
$route['order/getorderbymonth'] = 'admin/Order/getorderbymonth';
$route['user/searchuser'] = 'admin/User/searchuser';
$route['user/checkemail'] = 'admin/User/checkemail';
$route['product/searchproduct'] = 'admin/Product/searchproduct';
$route['order/searchorder'] = 'admin/Order/searchorder';
$route['admin/profile'] = 'admin/Profile/index';
$route['admin/sorbyOrder'] = 'admin/Order/sorbyOrder' ;
$route['admin/pagination'] = 'admin/Pagination/index';
$route['product/addtocart'] = 'frontend/Product/addtocart';
$route['cart'] = 'frontend/Cart/index';
$route['cart/update'] = 'frontend/Cart/update';
$route['cart/addgiavi'] = 'frontend/Cart/addgiavi';
$route['checkout'] = 'frontend/Cart/checkout';
$route['thankyou'] = 'frontend/Thankyou/index';
$route['profile'] = 'frontend/Profile/index';
$route['profile/updateimg'] = 'frontend/Profile/updateimg';
$route['profile/search'] = 'frontend/Profile/index';
$route['profile/sortby'] = 'frontend/Profile/sortby';
$route['bill'] = 'frontend/Bill/index';
$route['bill/delete'] = 'frontend/Bill/delete';
$route['bill/addgiavi'] = 'frontend/Bill/addgiavi';
$route['contact'] = 'Home/contact';
$route['export/excel'] = 'admin/Export/exportExcel';
