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
/*  Função na qual carrega outras paginas, a partir do parâmetro dado, caso
    esse parâmetro esteja vazio, ele retornará uma página com erro 404   */
$route['autenticate'] 		 				= 'pages/aut_login';
/*  Função na qual receberá os input de login e senha, após isso eles serão
    analisados pelas funções sys_model validation e após ser consultado no
    banco será carregada uma página diferente para cada tipo de permissão,
    como usuários, administradores, e bibliotecario. Caso não aja cadastro,
    então será mostrado a página de erro de login.  */
$route['sem_acesso'] 						= 'pages/error_page';
/*  Carregará uma página de erro  */
$route['consulta'] 							= 'pages/consulta';
/*  Ele solicita uma vericação de nível de usuário, e após ver se no banco ha
    o livro e a disponibilidade do mesmo, e  logo após carrega a página de
    acordo com o nível de usuário.  */
$route['reserva'] 							= 'pages/reserva';
/*  Ele solicita uma vericação de nível de usuário, e após consultar se no
    banco há algum livro disponível(não emprestado) ele "pega" esse livro e
    carrega a página de acordo com o nível de usuário.  */
$route['emprestimoLivro'] 					= 'pages/emprestimoLivro';
/*  Ele recebe como parâmetro a identificação do livro e o tipo de usuário,
    depois ele consulta o livro, e verifica o usuário que solicitou. */
$route['emprestimoLivro/(:num)/(:any)'] 			= 'pages/emprestimoLivro/$1/$2';
/*  Faz o mesmo que o 'emprestimoLivro' mas tendo como entrada o número
    do livro e qualquer tipo de usuário */
$route['emprestimoLivro/(:num)'] 			= 'pages/emprestimoLivro/$1';
/*  Faz o mesmo que o 'emprestimoLivro' mas tendo como entrada apenas o
    número do livro.  */
$route['redirecionaEmprestimo'] 					= 'pages/trataEmprestimoLivro';
/*  Ele recebe dois parâmetros, que são o username e o ibsn, depois ele
    fará uma consulta no banco e mostrará o título para aquele número e
    depois redireciona a página para a de empréstimos.  */
$route['reservaLivro'] 						= 'pages/reservaLivro';
/*  Ele recebe como parâmetro a identificação do livro e o tipo de usuário,
    depois ele consulta o livro no banco, e verifica o usuário que reservou.  */
$route['reservaLivro/(:num)'] 				= 'pages/reservaLivro/$1';
/*  Faz o mesmo que 'reservaLivro' mas tendo como entrada apenas o número
    do livro (ISBN).  */
$route['cadastro'] 							= 'pages/cadastro';
/*  Carrega o arquivo de HTML responsável pela página de cadastro do site.  */
$route['addUsuario'] 						= 'pages/addUsuario';
/*  Ele recebe e valida um formulário com as informações de cadastro, como,
    nome, login, senha... Se o usuário for um professor, ele poderá levar
    5 livros, e terá que confirmar sua siape para comprovar a docência. Se
    o usuário for do tipo aluno, ele poderá levar 3 livros , e terá que usar
    sua matrícula para comprovar a discência. Se o usuário for um funcionário
    poderá levar 4 livros, e confirmará com o número registro dos funcionrio  */
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
$route['caixa']     = 'pages/caixaPesquisa';
$route['rconsultaUsuario']  = 'pages/rconsultaUsuario';
$route['rconsultaReserva']  = 'pages/rconsultaReserva';
$route['rconsultaProfs'] = 'pages/rconsultaProfs';

$route['user/(:any)']  = 'user/$1';
$route['blib/(:any)']  = 'bibliotecario/$1';
$route['admin/(:any)'] = 'administrador/$1';

$route['professores'] 		= 'administrador/professores';
$route['consultaUsuario'] 	= 'administrador/consultaUsuario';
$route['consultaEmprestimo'] 	= 'administrador/consultaEmprestimo';
$route['livros/(:any)'] 	= 'pages/livros/$1';
$route['categoria/(:any)'] 	= 'pages/categoria/$1';
$route['editora/(:any)'] 	= 'pages/editora/$1';
$route['curso/(:any)'] 	= 'pages/curso/$1';
$route['consultaReserva'] 	= 'administrador/consultaReserva';
$route['alterarReserva'] 	= 'administrador/alterarReserva';
$route['cancelReserva'] 	= 'administrador/cancelReserva';
$route['solicitaRemocao'] 	= 'administrador/solicitaRemocao';
$route['cancelReserva/(:any)/(:any)'] 	= 'administrador/cancelReserva/$1/$2';
$route['confirmaSolicitacao/(:any)'] 	= 'administrador/confirmaSolicitacao/(:any)';
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
