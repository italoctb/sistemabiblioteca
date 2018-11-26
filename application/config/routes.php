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
//Rota para view.
$route['autenticate'] 		 				= 'pages/aut_login';
//Rota para autenticação de login.
$route['sem_acesso'] 						= 'pages/error_page';
//Rota para uma página de erro.
$route['realizarEmprestimo'] 							= 'pages/consulta';
//Rota para carregamento de páginas de acordo com o nível de usuário.
$route['reserva'] 							= 'pages/reserva';
//Rota para fazer uma consulta de reserva.
$route['emprestimoLivro'] 					= 'pages/emprestimoLivro';
//Rota para realizar um empréstimo.
$route['emprestimoLivro/(:num)/(:any)'] 			= 'pages/emprestimoLivro/$1/$2';
//Faz o mesmo que o 'emprestimoLivro', mas tem como entrada ISBN do livro e usuário.
$route['emprestimoLivro/(:num)'] 			= 'pages/emprestimoLivro/$1';
//Faz o mesmo que o 'emprestimoLivro', mas tem como entrada apenas o ISBN do livro.
$route['redirecionaEmprestimo'] 					= 'pages/trataEmprestimoLivro';
//Rota de consulta pelo ISBN e redireciona para a página de empréstimos.
$route['reservaLivro'] 						= 'pages/reservaLivro';
//Rota para verificar se o livro está reservado.
$route['reservaLivro/(:num)'] 				= 'pages/reservaLivro/$1';
//Faz o mesmo que 'reservaLivro', mas tem como entrada apenas o ISBN do livro.
$route['cadastro'] 							= 'pages/cadastro';
//Rota para a página de cadastro.
$route['addUsuario'] 						= 'pages/addUsuario';
//Rota para adição de novo usuario.
$route['envEmprestimo'] 					= 'pages/envEmprestimo';
//Rota para de solicitação de um emprestimo, ao banco.
$route['envReserva'] 						= 'pages/envReserva';
//Rota para o envio de reserva para o banco.
$route['meusEmprestimos'] 					= 'pages/meusEmprestimos';
//Rota para mostrar os emprestimos do usuário.
$route['minhasReservas'] 					= 'pages/minhasReservas';
//Rota para mostrar as reservas do usuário.
$route['alterarEmprestimos'] 	 			= 'pages/alterarEmprestimos';

$route['editarEmprestimo'] 					= 'pages/editarEmprestimo';
//Rota para modificar os emprestimos.
$route['editarEmprestimo/(:any)/(:any)']	= 'pages/editarEmprestimo/$1/$2';
//Rota para modificar os emprestimos com parâmetros de ISBN ou título e username ou nome.
$route['updateEmprestimo'] 					= 'pages/updateEmprestimo';
//Rota de requerimento de emprestimo.
$route['baixaEmprestimo'] 					= 'pages/baixaEmprestimo';
//Rota para visualização dos emprestimos.
$route['baixaEmprestimo/(:any)'] 			= 'pages/baixaEmprestimo/$1';
//Rota para visualização dos emprestidos com parâmetro username.
$route['devEmprestimo'] 					= 'pages/devEmprestimo';
//Rota para o administrador ou bibliotecario fazer o empréstimo de livros.
$route['devEmprestimo/(:any)/(:any)'] 		= 'pages/devEmprestimo/$1/$2';
//Rota semelhante a 'devEmprestimo', mas tendo como parametro o livro e usuário.
$route['logout'] 							= 'pages/logout';
//Rota para encerrar seção.
$route['consulta']     = 'pages/caixaPesquisa';
//Rota para a caixa de pesquisa.
$route['rconsultaReserva']  = 'pages/rconsultaReserva';
//Rota para visualização das reservas.


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
$route['blib/(:any)/(:any)'] = 'bibliotecario/$1/$2';
$route['admin/(:any)'] = 'administrador/$1';
$route['admin/(:any)/(:any)'] = 'administrador/$1/$2';
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
$route['admin/tratarConsultaEmp'] = 'administrador/tratarConsultaEmp';
$route['blib/tratarConsultaEmp'] = 'administrador/tratarConsultaEmp';
$route['consultaReserva'] 	= 'administrador/consultaReserva';
$route['consultaReserva/(:any)'] 	= 'administrador/consultaReserva/$1';
$route['tratarconsultaReserva'] 	= 'administrador/tratarconsultaReserva';
//-------------------------------------------------------------

$route['livros/(:any)'] 	= 'pages/livros/$1';
$route['categoria/(:any)'] 	= 'pages/categoria/$1';
$route['editora/(:any)'] 	= 'pages/editora/$1';
$route['curso/(:any)'] 	= 'pages/curso/$1';

$route['alterarReserva'] 	= 'pages/alterarReserva';
$route['cancelReserva'] 	= 'pages/cancelReserva';
$route['solicitaRemocao/(:any)'] 	= 'pages/solicitaRemocao/$1';
$route['solicitaRemocao'] 	= 'pages/solicitaRemocao';
$route['cancelReserva/(:any)/(:any)'] 	= 'pages/cancelReserva/$1/$2';
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
$route['removerCadastro']		= '/administrador/removerCadastro';
$route['trataRemover']			= '/administrador/trataRemover';
$route['editarUsuario']			= '/administrador/editarUsuario';
$route['editarUsuario/(:any)']	= '/administrador/editarUsuario/$1';
$route['deletarUsuario']		= '/administrador/deletarUsuario';
$route['deletarUsuario/(:any)']	= '/administrador/deletarUsuario/$1';
$route['updateUsuario']			= '/administrador/updateUsuario';
$route['cancelCadastro']			= '/pages/cancelCadastro';
$route['cancelCadastro/(:any)']			= '/pages/cancelCadastro/$1';
$route['TrataCancelCadastro']			= '/pages/TrataCancelCadastro';
$route['semAcesso'] = 'pages/semAcesso';
$route['404_override'] = 'pages/erro404';
