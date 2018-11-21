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

$route['default_controller'] 				= 'pages/view';
$route['autenticate'] 		 				= 'pages/aut_login';
$route['sem_acesso'] 						= 'pages/error_page';
$route['emprestimo'] 							= 'pages/consulta';
$route['reserva'] 							= 'pages/reserva';
$route['emprestimoLivro'] 					= 'pages/emprestimoLivro';
$route['emprestimoLivro/(:num)/(:any)'] 			= 'pages/emprestimoLivro/$1/$2';
$route['emprestimoLivro/(:num)'] 			= 'pages/emprestimoLivro/$1';
$route['redirecionaEmprestimo'] 					= 'pages/trataEmprestimoLivro';
$route['reservaLivro'] 						= 'pages/reservaLivro';
$route['reservaLivro/(:num)'] 				= 'pages/reservaLivro/$1';
$route['cadastro'] 							= 'pages/cadastro';
$route['addUsuario'] 						= 'pages/addUsuario';
$route['envEmprestimo'] 					= 'pages/envEmprestimo';
$route['envReserva'] 						= 'pages/envReserva';
$route['meusEmprestimos'] 					= 'pages/meusEmprestimos';
$route['minhasReservas'] 					= 'pages/minhasReservas';
$route['alterarEmprestimos'] 	 			= 'pages/alterarEmprestimos';
$route['editarEmprestimo'] 					= 'pages/editarEmprestimo';
$route['editarEmprestimo/(:any)/(:any)']	= 'pages/editarEmprestimo/$1/$2';
$route['updateEmprestimo'] 					= 'pages/updateEmprestimo';
$route['baixaEmprestimo'] 					= 'pages/baixaEmprestimo';
$route['baixaEmprestimo/(:any)'] 			= 'pages/baixaEmprestimo/$1';
$route['devEmprestimo'] 					= 'pages/devEmprestimo';
$route['devEmprestimo/(:any)/(:any)'] 		= 'pages/devEmprestimo/$1/$2';
$route['logout'] 							= 'pages/logout';
$route['consulta']     = 'pages/caixaPesquisa';
$route['rconsultaReserva']  = 'pages/rconsultaReserva';

//Perfil
$route['meuPerfil'] = 'pages/meuPerfil';
$route['editarPerfil'] = 'pages/editarPerfil';
//$route['editarPerfil/(:any)'] = 'pages/editarPerfil/$1';
$route['editarPerfil/(:any)/(:any)'] = 'pages/editarPerfil/$1/$2';
$route['tratarEditarPerfilAl'] = 'pages/tratarEditarPerfilAl';
$route['tratarEditarPerfilFunc'] = 'pages/tratarEditarPerfilFunc';
$route['tratarEditarPerfilProf'] = 'pages/tratarEditarPerfilProf';
//----------------------------------------------------
$route['user/(:any)']  = 'user/$1';
$route['blib/(:any)']  = 'bibliotecario/$1';
$route['admin/(:any)'] = 'administrador/$1';

$route['professores'] 		= 'administrador/professores';
//Consultas de campo de pesquisa
$route['consultaHome'] = 'pages/consultaHome';
$route['consultaHome/(:any)'] = 'pages/consultaHome/$1';
$route['tratarConsultaHome'] = 'pages/tratarConsultaHome';
$route['consultaUsuario'] 	= 'pages/consultaUsuario';
$route['consultaUsuario/(:any)'] 	= 'pages/consultaUsuario/$1';
$route['tratarConsultaUsuario'] = 'pages/tratarConsultaUsuario';
$route['consultaProf'] 		= 'pages/consultaProf';
$route['consultaProf/(:any)'] 	= 'pages/consultaProf/$1';
$route['tratarConsultaProf'] = 'pages/tratarConsultaProf';
$route['consultaEmprestimo'] 	= 'administrador/consultaEmprestimo';
$route['consultaEmprestimo/(:any)'] 	= 'administrador/consultaEmprestimo/$1';
$route['tratarConsultaEmp'] = 'administrador/tratarConsultaEmp';
$route['consultaReserva'] 	= 'administrador/consultaReserva';
$route['consultaReserva/(:any)'] 	= 'administrador/consultaReserva/$1';
$route['tratarconsultaReserva'] 	= 'administrador/tratarconsultaReserva';
//-------------------------------------------------------------

$route['livros/(:any)'] 	= 'pages/livros/$1';
$route['categoria/(:any)'] 	= 'pages/categoria/$1';
$route['editora/(:any)'] 	= 'pages/editora/$1';
$route['curso/(:any)'] 	= 'pages/curso/$1';

$route['alterarReserva'] 	= 'administrador/alterarReserva';
$route['cancelReserva'] 	= 'administrador/cancelReserva';
$route['solicitaRemocao'] 	= 'administrador/solicitaRemocao';
$route['cancelReserva/(:any)/(:any)'] 	= 'administrador/cancelReserva/$1/$2';
$route['trataSolicitacao'] 	= '/administrador/trataSolicitacao';
$route['confirmaSolicitacao'] 	= '/administrador/confirmaSolicitacao/';
$route['ordenaISBN'] 	= 'pages/ordena/ISBN';
$route['ordenaNomeObra'] 	= 'pages/ordena/nomeObra';
$route['ordenaNomeAutor'] 	= 'pages/ordena/nomeAutor';
$route['ordenaAno'] 	= 'pages/ordena/ano';
$route['ordenaEdit']		= 'pages/ordena/edit';
$route['ordenaCategoria']	= 'pages/ordena/categoria';
$route['ordenaDisp']		= 'pages/ordena/disp';


$route['blib/home']		= '/bibliotecario/home';

$route['admin/home']			= '/administrador/home';
$route['registro_usuario']		= '/administrador/registro_usuario';
$route['addCadastro']			= '/administrador/addCadastro';
$route['removerCadastro']			= '/administrador/removerCadastro';
$route['trataRemover']			= '/administrador/trataRemover';
$route['editarUsuario']			= '/administrador/editarUsuario';
$route['editarUsuario/(:any)']	= '/administrador/editarUsuario/$1';
$route['deletarUsuario']		= '/administrador/deletarUsuario';
$route['deletarUsuario/(:any)']	= '/administrador/deletarUsuario/$1';
$route['updateUsuario']			= '/administrador/updateUsuario';

$route['semAcesso'] = 'pages/semAcesso';
$route['404_override'] = 'pages/erro404';
