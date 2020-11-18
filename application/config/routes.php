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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['nuevo_cliente'] = 'C_Cliente/GuardarCliente';
$route['auto_cliente/(:any)'] = 'C_Auto/loadForm/$1';
$route['save_auto_cliente'] = 'C_Auto/GuadarAuto';
$route['evidencia_auto/(:any)/(:any)'] = 'C_Auto/loadEvidencia/$1/$2';
$route['evidencia_auto_foto/(:any)/(:any)'] = 'C_Auto/loadEvidenciaFoto/$1/$2';
$route['siguiente_area/(:any)'] = 'C_Auto/loadChangeArea/$1';
$route['salida_auto'] = 'C_Auto/loadSalidaAuto';
$route['UpdateSalida'] ='C_Auto/UpdateSalida';
$route['detalles_auto'] ='C_Auto/loadDetalles';
$route['informacion_general/(:any)'] ='C_Auto/informacionGeneral/$1';
$route['firmar_documento/(:any)/(:any)']='C_Auto/loadFirma/$1/$2';
                            


