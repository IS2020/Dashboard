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
$route['default_controller'] = 'Index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//GET

$route['Admin/'] = 'Admin/eventos_index';
$route['Admin/crear/'] = 'Admin/antenas_crear';

// POST

$route['Admin/ajax_crear_antena'] = 'Admin/ajax_crear_antena';


// OTRO
//$route['Superadmin/escuelas'] = 'Superadmin/escuelas_index';
//$route['Superadmin/escuelas/crear'] = 'Superadmin/escuelas_crear';
//$route['Superadmin/eventos'] = 'Superadmin/eventos_index';
//$route['Admin/eventos/crear'] = 'Admin/eventos_crear';
//$route['Admin/eventos/editar/(:any)'] = 'Admin/eventos_editar/$1';
//$route['Evento/ajax_inscribir'] = "Evento/ajax_inscribir";
//$route['Evento/(:any)'] = "Evento/index/$1";
