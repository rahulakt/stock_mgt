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
$route['default_controller'] = 'login_controller/admin_load';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// 404 error
//$route['page_not_found'] = 'login_controller/page_not_found';

// Start Login
$route['login'] = 'login_controller';
$route['admin_login'] = 'login_controller/admin_login';
//$route['admin_user'] = 'login_controller/admin_load';
$route['logout'] = 'login_controller/logout';
// End Login

// Change Password
$route['change_pass'] = 'login_controller/change_password';

// Dashboard
$route['dashboard'] = 'site_controller/dashboard';

// Start Purchase Pruduct
$route['purchase'] = 'site_controller/purchase';
$route['save_purchase_invoice'] = 'site_controller/save_purchase_invoice';
// End Purchase Pruduct

// Start Sale Pruduct
$route['sale'] = 'site_controller/sale';
// End Sale Pruduct

// Start Purchase Report
$route['purchase_report'] = 'site_controller/purchase_report';
// End Purchase Report

// Start Sale Report
$route['sale_report'] = 'site_controller/sale_report';
// End Sale Report