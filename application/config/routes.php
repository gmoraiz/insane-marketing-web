<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'web';
$route['login']['GET'] = 'web/get_login';
$route['register']['GET'] = 'web/get_register';
$route['register']['POST'] = 'admin/register';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
