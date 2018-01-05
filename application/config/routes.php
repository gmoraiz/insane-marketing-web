<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']   = 'web';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;


$route['login']['GET']   = 'web/login';
$route['login']['POST']  = 'admin/login';
$route['logout']['POST'] = 'admin/logout';

$route['by_phone/(:any)']['GET'] = 'user/by_phone/$1';

$route['administrator']['GET'] = 'web/admin';
$route['administrator']['POST'] = 'admin/insert_login';
$route['administrator/(:num)']['DELETE'] = 'admin/delete_login/$1';
$route['administrator/(:num)']['GET'] = 'web/admin_edit/$1';
$route['administrator/(:num)']['POST'] = 'admin/update_login/$1';

$route['reward']['GET'] = 'web/reward';
$route['reward']['POST'] = 'reward/insert';
$route['reward/(:num)']['DELETE'] = 'reward/delete/$1';
$route['reward/(:num)']['GET'] = 'web/reward_edit/$1';
$route['reward/(:num)']['POST'] = 'reward/update/$1';

$route['message']['GET'] = 'web/message';
$route['message']['POST'] = 'message/insert';
$route['message/(:num)']['DELETE'] = 'message/delete/$1';
$route['message/(:num)']['GET'] = 'web/message_edit/$1';
$route['message/(:num)']['POST'] = 'message/update/$1';

$route['register']['GET']           = 'web/register';
$route['register']['POST']          = 'admin/register';
$route['register/(:any)']['GET']    = 'admin/confirm_step_three/$1';
$route['register-login']['POST']    = 'admin/register_login';
$route['register-complete']['POST'] = 'admin/register_complete';
$route['score']['POST']             = 'admin/score';

