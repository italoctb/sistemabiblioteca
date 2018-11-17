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

$route['default_controller'] 			= 'pages/view';
$route['autenticate'] 		 			= 'pages/aut_login';
$route['sem_acesso'] 					= 'pages/error_page';
$route['consulta'] 						= 'pages/consulta';
$route['emprestimoLivro'] 					= 'pages/emprestimoLivro';
$route['emprestimoLivro/(:num)'] 			= 'pages/emprestimoLivro/$1';
$route['cadastro'] 						= 'pages/cadastro';
$route['addUsuario'] 					= 'pages/addUsuario';
$route['envEmprestimo'] 					= 'pages/envEmprestimo';
$route['meusEmprestimos'] 				= 'pages/meusEmprestimos';
$route['alterarEmprestimos'] 	 		= 'pages/alterarEmprestimos';
$route['editarEmprestimo'] 				= 'pages/editarEmprestimo';
$route['editarEmprestimo/(:any)/(:any)']	= 'pages/editarEmprestimo/$1/$2';
$route['updateEmprestimo'] 				= 'pages/updateEmprestimo';
$route['baixaEmprestimo'] 					= 'pages/baixaEmprestimo';
$route['baixaEmprestimo/(:any)'] 			= 'pages/baixaEmprestimo/$1';
$route['devEmprestimo'] 					= 'pages/devEmprestimo';
$route['devEmprestimo/(:any)/(:any)'] 		= 'pages/devEmprestimo/$1/$2';
$route['logout'] 						= 'pages/logout';

$route['user/(:any)']  = 'user/$1';
$route['blib/(:any)']  = 'bibliotecario/$1';
$route['admin/(:any)'] = 'administrador/$1';

$route['professores'] 		= 'administrador/professores';
$route['consultaUsuario'] 	= 'administrador/consultaUsuario';
$route['consultaEmprestimo'] 	= 'administrador/consultaEmprestimo';

$route['user/home']		= '/user/home';

$route['blib/home']		= '/bibliotecario/home';

$route['admin/home']			= '/administrador/home';
$route['registro_usuario']		= '/administrador/registro_usuario';
$route['addCadastro']			= '/administrador/addCadastro';
$route['editarUsuario']			= '/administrador/editarUsuario';
$route['editarUsuario/(:any)']	= '/administrador/editarUsuario/$1';
$route['deletarUsuario']		= '/administrador/deletarUsuario';
$route['deletarUsuario/(:any)']	= '/administrador/deletarUsuario/$1';
$route['updateUsuario']			= '/administrador/updateUsuario';

$route['semAcesso'] = 'pages/semAcesso';
$route['404_override'] = 'pages/erro404';
