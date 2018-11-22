<?php
class Pages extends CI_Controller {
          function __construct(){
              parent::__construct();
              $user = $this->session->userdata('usuario');
              $nivel = $this->session->userdata('nivel_usuario');
              $tuser = $this->session->userdata('select tipoUsuario from USUARIO;');
              $usern = $this->session->userdata('username');
              $this->load->model('user_model');
              $this->load->model('func_model');
              $this->load->model('prof_model');
              $this->load->model('alu_model');
              $this->load->model('sys_model');
              $this->load->helper('url');
              $this->load->helper('form');
              $this->load->library('session');
              $this->load->library(array('form_validation', 'email'));
          }


        public function view($page = 'welcome')
        {
          if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
          {
            show_404();
          }
          $this->load->view($page);
        }
        /*  Função na qual carrega outras paginas, a partir do parâmetro dado,
            caso esse parâmetro esteja vazio, ele retornará uma página com erro 404   */

        public function aut_login(){
          $user = $this->input->post('username');
          $pass = $this->input->post('pass');
          $result = $this->sys_model->validation($user, $pass);
          if($result){
            $this->session->set_userdata('numReq', $num);
            $sel = $this->sys_model->consulta_especifico_Usuario($user)->nivel_usuario;
            switch ($sel) {
              case "usuario":
                $this->session->set_userdata('usuario', $user);
                $this->session->set_userdata('nivel_usuario', $sel);
                redirect(base_url('user/home'));
                break;
              case "bibliotecario":
                $this->session->set_userdata('usuario', $user);
                $this->session->set_userdata('nivel_usuario', $sel);
                redirect(base_url('blib/home'));
                break;
              case "administrador":
                $this->session->set_userdata('usuario', $user);
                $this->session->set_userdata('nivel_usuario', $sel);
                redirect(base_url('admin/home'));
                break;
              default:
                echo $sel;
                break;
            }

            /*$data = array(
                'title' => $this->my_model->consultaTitulos()
            );
            $this->load->view('templates/header.php');
            $this->load->view('autenticate', $data);
            $this->load->view('templates/footer.php');*/
          }else{
            $data['title'] = "Erro de login";
            $this->load->view('errologin', $data);
          }
        }
        /*  Função na qual receberá os input de login e senha, após isso eles serão
            analisados pelas funções sys_model validation e após ser consultado no
            banco será carregada uma página diferente para cada tipo de permissão,
            como usuários, administradores, e bibliotecario. Caso não aja cadastro,
            então será mostrado a página de erro de login.  */

        public function cadastro(){
            $this->load->view('pages/cadastro');
        }
        /*  Carrega o arquivo de HTML responsável pela página de cadastro do site.  */

        public function addUsuario(){
			$this->load->helper('form');
			$this->form_validation->set_rules('nome', 'Nome', 'trim|required|required');
			$this->form_validation->set_rules('username', 'Nome de Usuário', 'trim|required');
			$this->form_validation->set_rules('password', 'Senha', 'trim|required');
			$this->form_validation->set_rules('tipoUsuario', 'Tipo de usuário', 'trim|required');
			$this->form_validation->set_rules('matricula', 'Matrícula', 'trim|required');
			$this->form_validation->set_rules('user_end', 'Endereço', 'trim|required');
			$this->form_validation->set_rules('nivel_usuario', 'Nível de usuário', 'trim|required');


			if ($this->form_validation->run() == FALSE) {
				redirect(base_url('addCadastro'));
				$this->session->set_flashdata('error_msg', 'Preencha todos os campos.');
			}

			else{
				if ($this->input->post('tipoUsuario') == 'tipoProf'){
					$LOGIN = array(
						'nome' => $this->input->post('nome'),
						'username' => $this->input->post('username'),
						'password' => sha1($this->input->post('password')),
						'tipoUsuario' => $this->input->post('tipoUsuario'),
						'mat_siape' => $this->input->post('matricula'),
						'nivel_usuario' => $this->input->post('nivel_usuario'),
						'qntd_livros_max' => ('5'),
						'qntd_livros' => ('0'),
						'user_end' => $this->input->post('user_end'),
					);
					$PROF = array(
						'mat_siape' => $this->input->post('matricula'),
						'regime_trabalho' => $this->input->post('regime_trabalho'),
						'cod_curso' => $this->input->post('cod_curso'),
						'data_de_contratacao' => $this->input->post('data_de_contratacao'),
						'telefone_celular' => $this->input->post('telefone_celular'),
						'tipoProf' => ('3'),
					);
					$prof_check = $this->prof_model->prof_check($this->input->post('matricula'));
					if (!$prof_check) {
						$this->user_model->reg_prof($PROF);
						$this->user_model->reg_usuario($LOGIN);
						$this->session->set_flashdata('success_msg', 'Professor registrado com sucesso!');
						redirect(base_url(''));
					}
					else {
						$this->session->set_flashdata('error_msg', 'Erro no registro, verifique se os dados estão corretos');
						redirect(base_url(''));
					}
				}

				elseif ($this->input->post('tipoUsuario') == 'tipoAl'){
					$LOGIN = array(
						'nome' => $this->input->post('nome'),
						'username' => $this->input->post('username'),
						'password' => sha1($this->input->post('password')),
						'tipoUsuario' => $this->input->post('tipoUsuario'),
						'mat_aluno' => $this->input->post('matricula'),
						'nivel_usuario' => $this->input->post('nivel_usuario'),
						'qntd_livros_max' => ('3'),
						'qntd_livros' => ('0'),
						'user_end' => $this->input->post('user_end'),
					);
					$ALU = array(
						'mat_aluno' => $this->input->post('matricula'),
						'cod_curso' => $this->input->post('cod_curso_alu'),
						'data_de_ingresso' => $this->input->post('data_de_ingresso'),
						'data_de_conclusao_prev' => $this->input->post('data_de_conclusao_prev'),
						'tipoAl' => ('1'),
					);

					$alu_check = $this->alu_model->alu_check($LOGIN['mat_aluno']);
					if (!$alu_check) {
						$this->user_model->reg_alu($ALU);
						$dataAluCheck = $this->alu_model->dataAluCheck($LOGIN['mat_aluno']);

						if ($dataAluCheck) {
							$var = $this->input->post('i');
							for ($j = 0; $j <= $var; $j++){
								$FONE_ALU = array(
									'mat_aluno' => $this->input->post('matricula'),
									'fone_aluno' => $this->input->post("fone_aluno[$j]"),
								);
								$this->user_model->reg_fone_alu($FONE_ALU);
							}
							$this->user_model->reg_usuario($LOGIN);
							$this->session->set_flashdata('success_msg', 'Aluno registrado com sucesso!');
							redirect(base_url(''));
						}
						else {
							$this->session->set_flashdata('error_msg', 'Desculpe, o aluno não pode ser cadastrado.');
							redirect(base_url(''));
						}
					}
					else{
						$this->session->set_flashdata('error_msg', 'Erro no registro, verifique se sua Matrícula está correta');
						redirect(base_url(''));
					}
				}

				elseif ($this->input->post('tipoUsuario') == 'tipoFunc'){
					$LOGIN = array(
						'nome' => $this->input->post('nome'),
						'username' => $this->input->post('username'),
						'password' => sha1($this->input->post('password')),
						'tipoUsuario' => $this->input->post('tipoUsuario'),
						'mat_func' => $this->input->post('matricula'),
						'nivel_usuario' => $this->input->post('nivel_usuario'),
						'qntd_livros_max' => ('4'),
						'qntd_livros' => ('0'),
						'user_end' => $this->input->post('user_end'),
					);
					$FUNC = array(
						'mat_func' => $this->input->post('matricula'),
						'tipoFunc' => ('2'),
					);

					$func_check = $this->func_model->func_check($LOGIN['mat_func']);

					if (!$func_check) {
						$this->user_model->reg_func($FUNC);

						$var = $this->input->post('i');
						for ($j = 0; $j <= $var; $j++){
							$FONE_FUNC = array(
								'mat_func' => $this->input->post('matricula'),
								'fone_func' => $this->input->post("fone_func[$j]"),
							);
							$this->user_model->reg_fone_func($FONE_FUNC);
						}

						$this->user_model->reg_usuario($LOGIN);
						$this->session->set_flashdata('success_msg', 'Funcionário registrado com sucesso!');
						redirect(base_url(''));
					}
					else {
						$this->session->set_flashdata('error_msg', 'Erro no registro, verifique se os dados estão corretos');
						redirect(base_url(''));
					}
				}

				else {
					$this->session->set_flashdata('error_msg', 'Erro no registro, verifique se os dados estão corretos');
					redirect(base_url(''));
				}
			}
    }
    /*  Ele recebe e valida um formulário com as informações de cadastro, como,
        nome, login, senha... Se o usuário for um professor, ele poderá levar
        5 livros, e terá que confirmar sua siape para comprovar a docência. Se
        o usuário for do tipo aluno, ele poderá levar 3 livros , e terá que usar
        sua matrícula para comprovar a discência. Se o usuário for um funcionário
        poderá levar 4 livros, e confirmará com o número registro dos funcionário.
        Caso aja algum parâmetro inválido, aparecerá uma mensagem de erro.  */

    public function livros($isbn){
            $this->session->set_flashdata('success_msg', '');
            $user = $this->session->userdata('nivel_usuario');
            $data = array(
              'liv' => $this->sys_model->consulta_livro_menu($isbn),
              'liv_foco' => $this->sys_model->buscarI($isbn),
              'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
              'autor' => $this->db->get("AUTORES")->result()
            );
            $this->load->view('templates/header.php');

            if ($user === 'administrador'):
                $nav = 'nav_adm';
            elseif ($user === 'usuario'):
                $nav = 'nav_user';
            elseif ($user === 'bibliotecario'):
                $nav = 'nav_blib';
            endif;
            $this->load->view('templates/'.$nav);
            $this->load->view('pages/livro', $data);
            $this->load->view('templates/footer.php');
    }

    public function categoria($categoria){
            $this->session->set_flashdata('success_msg', '');
            $user = $this->session->userdata('nivel_usuario');
            $data = array(
              'cat'=>$this->sys_model->consulta_categoryBycod($categoria),
              'liv' => $this->sys_model->buscarIC($categoria),
              'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
              'autor' => $this->db->get("AUTORES")->result()

            );
            $this->load->view('templates/header.php');

            if ($user === 'administrador'):
                $nav = 'nav_adm';
            elseif ($user === 'usuario'):
                $nav = 'nav_user';
            elseif ($user === 'bibliotecario'):
                $nav = 'nav_blib';
            endif;
            $this->load->view('templates/'.$nav);
            $this->load->view('pages/categoria', $data);
            $this->load->view('templates/footer.php');
    }

    public function editora($editora){
            $this->session->set_flashdata('success_msg', '');
            $user = $this->session->userdata('nivel_usuario');
            $data = array(
              'cat'=>str_replace("%20", " ", $editora),
              'liv' => $this->sys_model->buscarIE(str_replace("%20", " ", $editora)),
              'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
              'autor' => $this->db->get("AUTORES")->result()
            );
            $this->load->view('templates/header.php');

            if ($user === 'administrador'):
                $nav = 'nav_adm';
            elseif ($user === 'usuario'):
                $nav = 'nav_user';
            elseif ($user === 'bibliotecario'):
                $nav = 'nav_blib';
            endif;
            $this->load->view('templates/'.$nav);
            $this->load->view('pages/editora', $data);
            $this->load->view('templates/footer.php');
    }

    public function curso($curso){
            $this->session->set_flashdata('success_msg', '');
            $user = $this->session->userdata('nivel_usuario');
            $data = array(
              'cat'=>$curso,
              'liv'=>$this->sys_model->consultaProfsCurso($curso)
            );
            $this->load->view('templates/header.php');

            if ($user === 'administrador'):
                $nav = 'nav_adm';
            elseif ($user === 'usuario'):
                $nav = 'nav_user';
            elseif ($user === 'bibliotecario'):
                $nav = 'nav_blib';
            endif;
            $this->load->view('templates/'.$nav);
            $this->load->view('pages/curso', $data);
            $this->load->view('templates/footer.php');
    }

    public function consulta(){
            $this->session->set_flashdata('success_msg', '');
            $user = $this->session->userdata('nivel_usuario');
            $data = array(
              'title' => $this->sys_model->consultaEmprestimo(),
              'livros' => $this->db->get("LIVROS")->result()
            );
            $this->load->view('templates/header.php');

            if ($user === 'administrador'):
                $nav = 'nav_adm';
            elseif ($user === 'usuario'):
                $nav = 'nav_user';
            elseif ($user === 'bibliotecario'):
                $nav = 'nav_blib';
            endif;
            $this->load->view('templates/'.$nav);
            $this->load->view('pages/consulta', $data);
            $this->load->view('templates/footer.php');
    }
    /*  Ele solicita uma vericação de nível de usuário, e após ver se no banco ha
        o livro e a disponibilidade do mesmo, e  logo após carrega a página de
        acordo com o nível de usuário.  */

    public function trataEmprestimoLivro(){
		$user = $this->input->post('username');
		$isbn = $this->input->post('isbnEmp');
		$test_1 = $this->sys_model->consulta_especifico_USUARIO($user);
		$test_2 = $this->sys_model->consulta_especifico_Livro($isbn);
		if($test_1 && !$isbn) {
			$isbn = $this->sys_model->consulta_especifico_ISBN($this->input->post('nomeObra'))->ISBN;
			redirect(base_url('emprestimoLivro/' . $isbn . '/' . $user));
		}
		elseif($test_2 && !$isbn) {
			$isbn = $this->sys_model->consulta_especifico_ISBN($this->input->post('nomeObra'))->ISBN;
			redirect(base_url('emprestimoLivro/' . $isbn . '/' . $user));
		}
		elseif(!$test_1){
			$this->session->set_flashdata('error_msg', 'Usuário inexistente, tente novamente');
			redirect(base_url('consulta'));
		}
		elseif(!$test_2){
			$this->session->set_flashdata('error_msg', 'ISBN inexistente, tente novamente');
			redirect(base_url('consulta'));
		}
	}
    /*  Ele recebe dois parâmetros, que são o username e o ibsn, depois ele
        fará uma consulta no banco e mostrará o título para aquele número e
        depois redireciona a página para a de empréstimos.  */

    public function emprestimoLivro($ident = NULL, $usuario = NULL){
            if($usuario == NULL){
              $usuario = $this->session->userdata('usuario');
            }
            $user = $this->session->userdata('usuario');
            $data = array(
                'title' => $this->sys_model->consultaTitulos(),
                'nome' =>$this->sys_model->consulta_especifico_Usuario($usuario)->nome,
                'username' =>$this->sys_model->consulta_especifico_Usuario($usuario)->username,
                'tipoUsuario' =>$this->sys_model->consulta_especifico_Usuario($usuario)->tipoUsuario,
                'nome' =>$this->sys_model->consulta_especifico_Usuario($usuario)->nome,
                'username' =>$this->sys_model->consulta_especifico_Usuario($usuario)->username,
                'tipoUsuario' =>$this->sys_model->consulta_especifico_Usuario($usuario)->tipoUsuario,
                'livros' => $this->db->get("LIVROS")->result(),
                'ISBN' => $ident,
                'titulo' =>  $this->user_model->livroByISBN($ident)->titulo
            );
            $this->load->view('templates/header.php');
            $this->load->view('pages/emprestimoLivro', $data);
            $this->load->view('templates/footer.php');
    }
    /*  Ele recebe como parâmetro a identificação do livro e o tipo de usuário,
        depois ele consulta o livro, e verifica o usuário que solicitou. */

    public function envEmprestimo($ident = NULL){
            $user = $this->session->userdata('usuario');
            $data = array(
                'title' => $this->sys_model->consultaTitulos(),
                'tipoUsuario' =>$this->sys_model->consulta_especifico_Usuario($user)->tipoUsuario,
                'livros' => $this->db->get("LIVROS")->result()
            );
            $EMPRESTIMOS = array(
            'ISBN' => $this->input->post('ISBN'),
            'username' => $this->input->post('username'),
            'data_reserva' => $this->input->post('data_reserva'),
            'prazo_dev' => $this->input->post('prazo_dev'),
            );
              $qtd_check= $this->user_model->getQtdLivros($this->input->post('ISBN'));
              $res_check = $this->user_model->check_emprestimo($ident);
              $res_check_l = $this->user_model->check_emprestimo_usuario($this->input->post('ISBN'),$this->input->post('username'));
              $res_check_qtd = $this->user_model->getQtdMax($this->input->post('username'));
              $res_check_reserv = $this->sys_model->consultaReserva($this->input->post('ISBN'), $this->input->post('username'));
              $solicitacao = $this->db->query('select id_req, username from REQUISICAO natural join USUARIO where username = "'.$this->input->post('username').'";')->result();

              if (!$res_check && !$res_check_l && $res_check_qtd && $qtd_check && !$solicitacao) {
                  $this->user_model->reg_emprestimo($EMPRESTIMOS);
                  $this->user_model->dec_livro($this->input->post('ISBN'));
                  $this->user_model->inc_user($this->input->post('username'));
                  $this->session->set_flashdata('success_msg', 'Emprestimo realizado com sucesso!');
                  if($res_check_reserv){
                    $this->db->get("RESERVA");
                    $this->db->where('ISBN',$this->input->post('ISBN'));
                    $this->db->where('username',$this->input->post('username'));
                    $this->db->delete('RESERVA');
                  }
                  redirect(base_url('meusEmprestimos'));
              }
              else {
                if(!$qtd_check){
                    $this->session->set_flashdata('error_msg', 'Não existem exemplares disponíveis');
                    redirect(base_url('emprestimoLivro/'.$EMPRESTIMOS['ISBN'].'/'.$EMPRESTIMOS['username']));
                }
                elseif($res_check_l){
                    $this->session->set_flashdata('error_msg', 'Usuário já realizou este empréstimo');
                    redirect(base_url('emprestimoLivro/'.$EMPRESTIMOS['ISBN'].'/'.$EMPRESTIMOS['username']));
                }
                elseif(!$res_check_qtd){
                    $this->session->set_flashdata('error_msg', 'Usuário já realizou o número máximo de empréstimos');
                    redirect(base_url('emprestimoLivro/'.$EMPRESTIMOS['ISBN'].'/'.$EMPRESTIMOS['username']));
                }elseif($solicitacao){
                  $this->session->set_flashdata('error_msg', 'Usuário realizou a requisição de cancelamento de conta.');
          				redirect(base_url('emprestimoLivro/'.$EMPRESTIMOS['ISBN'].'/'.$EMPRESTIMOS['username']));
                }
              }
              $this->load->view('templates/header.php');
              $this->load->view('templates/nav_user.php');
              $this->load->view('pages/home', $data);
              $this->load->view('templates/footer.php');
    }
    /*  Tem como entrada o número ISBN do livro, e a partir disso procura no banco
        o título do livro, ver o tipo de usuário e pega o livro. Depois  cria um
        array que recebe informações de ISBN, username,  a data de reserva e a
        data de devolução . Depois verifica a quantidade de livro no acervo, após
        isso, verifica se há exemplares, verifica se o usuário ainda pode fazer
        empréstimo, ver se o usuário ainda pode pegar novos livros, depois cria uma
        tupla com informações do usuário e do livro. Depois adiciona o empréstimo
        no banco, diminui a quantidade de livros disponíveis, acrescenta no usuário
        cadastrado +1 livro. Caso aja algum livro indisponível, ou se o usuário já
        pegou esse livro, ou se já estourou a quantidade de livros que possa pegar,
        então irá retornar uma resposta de erro ao usuário. */

    public function meusEmprestimos(){
        $user = $this->session->userdata('nivel_usuario');
        $data = array(
            'title' => $this->sys_model->consulta_meusEmprestimos($this->session->userdata('usuario'))
        );
        $this->load->view('templates/header.php');

        if ($user === 'administrador'):
            $nav = 'nav_adm';
        elseif ($user === 'usuario'):
            $nav = 'nav_user';
        elseif ($user === 'bibliotecario'):
            $nav = 'nav_blib';
        endif;

        $this->load->view('templates/'.$nav);
        $this->load->view('pages/meusEmprestimos', $data);
        $this->load->view('templates/footer.php');
    }
    /*  Verifica qual o tipo de usuário e faz uma consulta no banco dele para
        mostrar no loyout de acordo com o tipo de usuário. */

    public function alterarEmprestimos(){
        $user = $this->session->userdata('nivel_usuario');
        $data = array(
            'title' => $this->sys_model->consulta_meusEmprestimos($this->session->userdata('usuario')),
            'usuarios' => $this->db->get("USUARIO")->result(),
            'emprestimo' => $this->db->get("EMPRESTIMOS")->result()
        );
        $this->load->view('templates/header.php');
        if ($user === 'administrador'):
            $nav = 'nav_adm';
        elseif ($user === 'bibliotecario'):
            $nav = 'nav_blib';
        endif;
        $this->load->view('templates/'.$nav);
        $this->load->view('pages/finalizarEmprestimos', $data);
        $this->load->view('templates/footer.php');
    }
    /*  Verifica o tipo de usuário e cria um array com os títulos armazenados
        no banco de emprestimos do usuário. */

    public function editarEmprestimo($isbn = NULL, $username = NULL){
        $user_id = $this->session->userdata('nivel_usuario');
        if($user_id === 'administrador' || $user_id === 'bibliotecario'){
            $this->db->where('username',$username);
            $data['emprestimo'] = $this->db->get('EMPRESTIMOS')->result();
            $data['username'] = $username;
            $data['isbn'] = $isbn;
            $data['titulo'] = $this->sys_model->consulta_especifico_LIVRO($isbn)->titulo;
            $data['nome'] = $this->sys_model->consulta_especifico_USUARIO($username)->nome;
            $data['emprestimo'] = $this->user_model->checkDataEmprestimo($isbn, $username)->data_reserva;
            $data['dev'] = $this->user_model->checkDataEmprestimo($isbn, $username)->prazo_dev;
            $this->load->view('templates/header');
            $this->load->view('pages/editarEmprestimo', $data);
            $this->load->view('templates/footer');
        }
        else{
            redirect(base_url('alterarEmprestimos'));
        }
    }
    /*  Recebe como parâmetro o ISBN e o username do usuário que será modificado,
        e  então verifica o nível de usuário presente. Se for administrador ou
        o bibliotecario, eles podem podem modificar o username, isbn, data de
        devolução e etc do emprestimo dos livros. */

    public function updateEmprestimo(){
            $user_id = $this->session->userdata('nivel_usuario');
            $this->form_validation->set_rules('data_reserva', 'Data de Emprestimo', 'trim|required');
            $this->form_validation->set_rules('prazo_dev', 'Prazo de Devolução', 'trim|required');
            $this->form_validation->set_rules('username', 'Nome de usuário', 'trim|required');
            $this->form_validation->set_rules('isbn', 'ISBN', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error_msg', 'Preencha todos os campos.');
            }
            else{
                    $data_reserva = $this->input->post('data_reserva');
                    $prazo_dev = $this->input->post('prazo_dev');
                    $isbn = $this->input->post('isbn');
                    $username = $this->input->post('username');
                    $test1 = $this->user_model->checkDataAtual($data_reserva);
                    $test2 = $this->user_model->checkDataAtual($prazo_dev);
                    $DATA = array(
                        'data_reserva' => $data_reserva,
                        'prazo_dev' => $prazo_dev
                    );
                    if($test1 && !$test2){
                        $this->db->where('ISBN', $isbn);
                        $this->db->where('username', $username);
                        if($this->db->update('EMPRESTIMOS', $DATA)){
                            $this->session->set_flashdata('success_msg', 'Registro atualizado');
                            redirect(base_url('consultaEmprestimo'));
                        }
                       else{
                           $this->session->set_flashdata('success_msg', 'Erro na atualização');
                           redirect(base_url('consultaEmprestimo'));
                       }
                    }
                    else{
                        $this->session->set_flashdata('error_msg', 'Não foi possível atualizar o registro');
                        redirect(base_url('baixaEmprestimo/'.$username));
                    }
            }
        }
        /*  Verifica o nível de usuário e cria um formulário com data de reserva,
            prazo de devolução, username e ISBN, se algum dos campos não for
            preenchida, então será mostrado um alerta para o preenchimento.
            Depois será preenchido a data de emprestimo, a prazo de devolução,
            e o ISBN. Se as datas forem diferentes, então procurará o ISBN do
            livro e o usuário e criará um emprestimo. Senão, mostrará um erro e
            redireciona para página de consulta. */

    public function sem_acesso(){
      $this->load->view('pages/error_page');
    }
    /*  Carregará uma página de erro  */

    function baixaEmprestimo($ident = NULL){
        $user = $this->session->userdata('nivel_usuario');
        $data = array(
            'username' => $ident,
            'title' => $this->sys_model->consulta_meusEmprestimos($this->session->userdata('usuario')),
            'usuarios' => $this->db->get("USUARIO")->result(),
            'emprestimo' => $this->sys_model->consultaEmprestimo()
        );
        $this->load->view('templates/header.php');
        if ($user === 'administrador'):
            $nav = 'nav_adm';
        elseif ($user === 'bibliotecario'):
            $nav = 'nav_blib';
        endif;
        $this->load->view('templates/'.$nav);
        $this->load->view('pages/baixaEmprestimo', $data);
        $this->load->view('templates/footer.php');
    }
    /*  Verifica o nível de usuário e mostra um array com o username, título,
        usuário e emprestimos para o administrador e o bibliotecario. */

    function devEmprestimo($ident = NULL, $username = NULL){
        $user = $this->session->userdata('nivel_usuario');
        $data['livros'] = $this->db->get("LIVROS")->result();

        if ( $user === 'bibliotecario' || $user === 'administrador') {
            $this->user_model->inc_livro($ident);
            $this->user_model->dec_user($username);
            $this->db->where('ISBN',$ident);
            $this->db->where('username',$username);
            $this->db->delete('EMPRESTIMOS');
            $this->session->set_flashdata('success_msg', 'Operação realizada!');
            redirect(base_url('consultaEmprestimo'));
        }
        else {
            $this->session->set_flashdata('error_msg', 'Não foi possível realizar a solicitação');
            redirect(base_url(''));
        }

        $this->load->view('templates/header.php');

        if ($user === 'administrador'):
            $nav = 'nav_adm';
        elseif ($user === 'bibliotecario'):
            $nav = 'nav_blib';
        endif;

        $this->load->view('templates/'.$nav);
        $this->load->view('pages/baixaEmprestimo', $data);
        $this->load->view('templates/footer.php');
    }

	public function reserva(){
		$user = $this->session->userdata('nivel_usuario');
		$data = array(
			'title' => $this->sys_model->consultaEmprestimo(),
			'livros' => $this->db->get("LIVROS")->result()
		);
		$this->load->view('templates/header.php');

		if ($user === 'administrador'):
			$nav = 'nav_adm';
		elseif ($user === 'usuario'):
			$nav = 'nav_user';
		elseif ($user === 'bibliotecario'):
			$nav = 'nav_blib';
		endif;
		$this->load->view('templates/'.$nav);
		$this->load->view('pages/reserva', $data);
		$this->load->view('templates/footer.php');
	}
  /*  Ele solicita uma vericação de nível de usuário, e após consultar se no
      banco há algum livro disponível(não emprestado) ele "pega" esse livro e
      carrega a página de acordo com o nível de usuário.  */

	public function reservaLivro($ident = NULL){
		$user = $this->session->userdata('usuario');
		$data = array(
			'title' => $this->sys_model->consultaTitulos(),
			'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
			'username' =>$this->sys_model->consulta_especifico_Usuario($user)->username,
			'tipoUsuario' =>$this->sys_model->consulta_especifico_Usuario($user)->tipoUsuario,
			'livros' => $this->db->get("LIVROS")->result(),
			'ISBN' => $ident,
			'titulo' =>  $this->user_model->livroByISBN($ident)->titulo
		);
		$this->load->view('templates/header.php');
		$this->load->view('pages/reservaLivro', $data);
		$this->load->view('templates/footer.php');
	}
  /*  Ele recebe como parâmetro a identificação do livro, e o tipo de usuário,
      depois ele consulta o livro no banco, e verifica se o usuário que reservou.  */

	public function envReserva($ident = NULL){
		$user = $this->session->userdata('usuario');
		$data = array(
			'title' => $this->sys_model->consultaTitulos(),
			'tipoUsuario' =>$this->sys_model->consulta_especifico_Usuario($user)->tipoUsuario,
			'livros' => $this->db->get("LIVROS")->result()
		);
		$RESERVA = array(
			'ISBN' => $this->input->post('ISBN'),
			'username' => $this->input->post('username'),
			'data_reserva' => $this->input->post('data_reserva'),
		);
		$res_check = $this->user_model->check_reserva_usuario($this->input->post('ISBN'),$this->input->post('username'));
		$emp_check = $this->user_model->check_emprestimo_usuario($this->input->post('ISBN'),$this->input->post('username'));
    $solicitacao = $this->db->query('select id_req, username from REQUISICAO natural join USUARIO where username = "'.$this->input->post('username').'";')->result();
		if (!$res_check && !$emp_check && !$solicitacao) {
			$this->user_model->reg_reserva($RESERVA);
			$this->session->set_flashdata('success_msg', 'Reserva realizada com sucesso!');
			redirect(base_url('minhasReservas'));
		}
		else {
			if($res_check) {
				$this->session->set_flashdata('error_msg', 'Usuário já realizou esta reserva');
				redirect(base_url('reservaLivro/' . $RESERVA['ISBN']));
			}
			elseif($emp_check) {
				$this->session->set_flashdata('error_msg', 'Usuário encontra-se com o livro alugado');
				redirect(base_url('reservaLivro/' . $RESERVA['ISBN']));
			}elseif($solicitacao){
        $this->session->set_flashdata('error_msg', 'Usuário realizou a requisição de cancelamento de conta.');
				redirect(base_url('reservaLivro/' . $RESERVA['ISBN']));
      }
		}
		$this->load->view('templates/header.php');
		$this->load->view('templates/nav_user.php');
		$this->load->view('pages/home', $data);
		$this->load->view('templates/footer.php');
	}
  /*  Cria um array com username, nome e livro do usuário e cria outra com o ISBN,
      username e data de emprestimo e checka as reservas e emprestimos no banco,
      e depois confirma ou impede a nova reserva feita pelo usuário.  */

	public function minhasReservas(){
		$user = $this->session->userdata('nivel_usuario');
		$data = array(
			'title' => $this->sys_model->consulta_minhasReservas($this->session->userdata('usuario'))
		);
		$this->load->view('templates/header.php');

		if ($user === 'administrador'):
			$nav = 'nav_adm';
		elseif ($user === 'usuario'):
			$nav = 'nav_user';
		elseif ($user === 'bibliotecario'):
			$nav = 'nav_blib';
		endif;
		$this->load->view('templates/'.$nav);
		$this->load->view('pages/minhasReservas', $data);
		$this->load->view('templates/footer.php');
	}
  /*  Verifica o tipo de usuário e procura no banco dele a lista de reservas
      que foram feitas. Depois, mostra no loyout de cada tipo de usuário. */

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('/'), 'refresh');
    }

    public function erro404(){
       $this->load->view('pages/erro404');
    }

    public function semAcesso(){
       $this->load->view('pages/semAcesso');
    }

    public function caixaPesquisa(){
      $data = array(
        'title' => $this->sys_model->buscar($_POST),
        'nome' =>$this->sys_model->buscar($_POST),
        'cpf' => $this->sys_model->buscar($_POST),
        'autor' => $this->sys_model->buscar($_POST)
      );
      $this->load->view('templates/header');
      $this->load->view('templates/nav_adm');
      $this->load->view('pages/resultPesquisa', $data);
      $this->load->view('templates/footer');
    }

    public function consultaHome($pesq=NULL){
		$user = $this->session->userdata('usuario');
      $data = array(
        'title' => $this->sys_model->consultaHome($pesq),
		'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
		'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
		'autor' => $this->db->get("AUTORES")->result()
      );
      $this->load->view('templates/header');
      $this->load->view('templates/nav_adm');
      $this->load->view('pages/home', $data);
      $this->load->view('templates/footer');
    }

    public function tratarConsultaHome(){
      $caixaHome = $this->input->post('caixaHome');
      redirect(base_url('consultaHome/'.$caixaHome));
    }

    public function consultaProf($pesq=NULL){
      $data = array(
        'title' => $this->sys_model->consultaProf($pesq)
      );
      $this->load->view('templates/header');

		$nivel = $this->session->userdata('nivel_usuario');
		if ($nivel === 'administrador'):
			$nav = 'nav_adm';
		elseif ($nivel === 'usuario'):
			$nav = 'nav_user';
		elseif ($nivel === 'bibliotecario'):
			$nav = 'nav_blib';
		endif;

		$this->load->view('templates/'.$nav);

      $this->load->view('pages/consultaProf', $data);
      $this->load->view('templates/footer');
    }

    public function tratarConsultaProf(){
      $caixaProf = $this->input->post('caixaProf');
      redirect(base_url('consultaProf/'.$caixaProf));
    }

    public function consultaUsuario($pesq=NULL){
      $data = array(
        'title' => $this->sys_model->consultaUsuario($pesq)
      );
      $this->load->view('templates/header');
		$nivel = $this->session->userdata('nivel_usuario');
		if ($nivel === 'administrador'):
			$nav = 'nav_adm';
		elseif ($nivel === 'usuario'):
			$nav = 'nav_user';
		elseif ($nivel === 'bibliotecario'):
			$nav = 'nav_blib';
		endif;

	  $this->load->view('templates/'.$nav);
      $this->load->view('pages/consultaUsuario', $data);
      $this->load->view('templates/footer');
    }

    public function tratarConsultaUsuario(){
      $caixap1 = $this->input->post('caixap1');
      redirect(base_url('consultaUsuario/'.$caixap1));
    }

    public function rconsultaReserva(){
      $data = array(
        'title' => $this->sys_model->buscarReserva($_POST)
      );
      $this->load->view('templates/header');
      $this->load->view('templates/nav_adm');
      $this->load->view('pages/rconsultaReserva', $data);
      $this->load->view('templates/footer');
    }

    public function profs(){
      $data = array(
        'title' => $this->sys_model->buscarProfs($_POST)
      );
      $this->load->view('templates/header');
      $this->load->view('templates/nav_adm');
      $this->load->view('pages/profs', $data);
      $this->load->view('templates/footer');
    }


    public function ordena($tipo = NULL){
      $user = $this->session->userdata('usuario');

      if($tipo == "ISBN"):
          $data = array(
            'title' => $this->sys_model->consultaTitulosISBN(),
            'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
            'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
            'autor' => $this->db->get("AUTORES")->result()
          );
      elseif($tipo == "nomeObra"):
        $data = array(
          'title' => $this->sys_model->consultaTitulosNomeObra(),
          'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
          'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
          'autor' => $this->db->get("AUTORES")->result()
        );
      elseif($tipo == "nomeAutor"):
        $data = array(
          'title' => $this->sys_model->consultaTitulosAutor(),
          'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
          'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
          'autor' => $this->db->get("AUTORES")->result()
        );
      elseif($tipo == "ano"):
        $data = array(
          'title' => $this->sys_model->consultaTitulosLançamento(),
          'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
          'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
          'autor' => $this->db->get("AUTORES")->result()
        );
      elseif($tipo == "edit"):
        $data = array(
          'title' => $this->sys_model->consultaTitulosEdit(),
          'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
          'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
          'autor' => $this->db->get("AUTORES")->result()
        );
      elseif($tipo == "categoria"):
        $data = array(
          'title' => $this->sys_model->consultaTitulosCategoria(),
          'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
          'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
          'autor' => $this->db->get("AUTORES")->result()
        );
      elseif($tipo == "disp"):
        $data = array(
          'title' => $this->sys_model->consultaTitulosDisp(),
          'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
          'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
          'autor' => $this->db->get("AUTORES")->result()
        );
      endif;




      $this->session->set_flashdata('success_msg', 'Bem-vindo, ' . $data['nome']);
      $this->load->view('templates/header.php');

      $sel = $this->sys_model->consulta_especifico_Usuario($user)->nivel_usuario;
      switch ($sel) {
        case "usuario":
          $this->session->set_userdata('usuario', $user);
          $this->session->set_userdata('nivel_usuario', $sel);
          $nav = 'nav_user';
          break;
        case "bibliotecario":
          $this->session->set_userdata('usuario', $user);
          $this->session->set_userdata('nivel_usuario', $sel);
            $nav = 'nav_blib';
          break;
        case "administrador":
          $this->session->set_userdata('usuario', $user);
          $this->session->set_userdata('nivel_usuario', $sel);
          $nav = 'nav_adm';
          break;
        default:
          echo $sel;
          break;
      }

      $this->load->view('templates/'.$nav.'.php');
      $this->load->view('pages/home', $data);
      $this->load->view('templates/footer.php');
    }

    public function meuPerfil(){
      $user = $this->session->userdata('usuario');
      $nivel = $this->session->userdata('nivel_usuario');
      $data = array(
        'title' => $this->sys_model->meuPerfil($user),
        'title2' => $this->sys_model->meuPerfilFone($user)
      );

		if ($nivel === 'administrador'):
			$nav = 'nav_adm';
		elseif ($nivel === 'usuario'):
			$nav = 'nav_user';
		elseif ($nivel === 'bibliotecario'):
			$nav = 'nav_blib';
		endif;

      $this->load->view('templates/header');
      $this->load->view('templates/'.$nav);
      $this->load->view('pages/meuPerfil', $data);
      $this->load->view('templates/footer');
    }

	public function editarPerfil($ident = NULL){
		$user = $this->session->userdata('usuario');
		$nivel = $this->session->userdata('nivel_usuario');
		$data = array(
			'title' => $this->sys_model->meuPerfil($user),
			'title2' => $this->sys_model->meuPerfilFone($user),
			//'title2' => $this->sys_model->editarPerfil($info)
		);

		if ($nivel === 'administrador'):
			$nav = 'nav_adm';
		elseif ($nivel === 'usuario'):
			$nav = 'nav_user';
		elseif ($nivel === 'bibliotecario'):
			$nav = 'nav_blib';
		endif;

		$this->load->view('templates/header');
		$this->load->view('templates/'.$nav);
		$this->load->view('pages/editarPerfil', $data);
		$this->load->view('templates/footer');
	}

	public function tratarEditarPerfilAl(){
		$mat_aluno = $this->input->post('mat_aluno');
		$user_data = array(
			'nome' => $this->input->post('nome'),
			'user_end' => $this->input->post('user_end'),
		);
		$test = $this->user_model->getQntdAlu( $this->input->post('mat_aluno'));

		if ($test){
			$this->db->where('mat_aluno', $mat_aluno);
			if($this->db->update('USUARIO', $user_data)){
				$this->session->set_flashdata('success_msg', 'Registro atualizado');
				redirect(base_url('meuPerfil'));
			}
			else{
				$this->session->set_flashdata('error_msg', 'Erro na atualização');
				redirect(base_url('meuPerfil'));
			}
		}
		else{
			$this->session->set_flashdata('error_msg', 'Erro na atualização, usuário com pendência');
			redirect(base_url('meuPerfil'));
		}
	}

	public function tratarEditarPerfilFunc(){
		$mat_func = $this->input->post('mat_func');
		$user_data = array(
			'nome' => $this->input->post('nome'),
			'user_end' => $this->input->post('user_end'),
		);
		$test = $this->user_model->getQntdFunc( $this->input->post('mat_func'));

		if ($test){
			$this->db->where('mat_func', $mat_func);
			if($this->db->update('USUARIO', $user_data)){
				$this->session->set_flashdata('success_msg', 'Registro atualizado');
				redirect(base_url('meuPerfil'));
			}
			else{
				$this->session->set_flashdata('error_msg', 'Erro na atualização');
				redirect(base_url('meuPerfil'));
			}
		}
		else{
			$this->session->set_flashdata('error_msg', 'Erro na atualização, usuário com pendência');
			redirect(base_url('meuPerfil'));
		}
	}

	public function tratarEditarPerfilProf(){
		$user = $this->session->userdata('tipoUsuario');
		$mat_siape = $this->input->post('mat_siape');
		$user_data = array(
			'nome' => $this->input->post('nome'),
			'user_end' => $this->input->post('user_end'),
		);
		$prof_data = array(
			'telefone_celular' => $this->input->post('telefone_celular')
		);
		$test = $test = $this->user_model->getQntdProf( $this->input->post('mat_siape'));

		if ($test){
			$this->db->where('mat_siape', $mat_siape);
			$this->db->update('PROFESSORES', $prof_data);

			$this->db->where('mat_siape', $mat_siape);

			if($this->db->update('USUARIO', $user_data) && $user==='tipoProf'){
				$this->session->set_flashdata('success_msg', 'Registro atualizado');
				redirect(base_url('meuPerfil'));
			}
			else{
				$this->session->set_flashdata('success_msg', 'Erro na atualização');
				redirect(base_url('meuPerfil'));
			}
		}
		else{
			$this->session->set_flashdata('error_msg', 'Erro na atualização, usuário com pendência');
			redirect(base_url('meuPerfil'));
		}
	}

	public function solicitaRemocao($id = null){   //Exibe as solicitações de remoção realizadas pelos usuários.
		$nivel = $this->session->userdata('nivel_usuario');
		$data = array(
			'solicitacao' => $this->sys_model->requisicoes(),
			'req' => $this->db->query('select * from REQUISICAO where id_req = "'.$id.'";')->row_object()//Array com todas as requisições de remoção do sistema.
		);
		$this->load->view('templates/header');
		$nivel = $this->session->userdata('nivel_usuario');
		if ($nivel === 'administrador'):
			$nav = 'nav_adm';
		elseif ($nivel === 'usuario'):
			$nav = 'nav_user';
		elseif ($nivel === 'bibliotecario'):
			$nav = 'nav_blib';
		endif;


		$this->load->view('templates/'.$nav);
		$this->load->view('pages/solicitacoes', $data);
		$this->load->view('templates/footer');

	}

	public function TrataCancelCadastro(){   //Exibe as solicitações de remoção realizadas pelos usuários.
		$username = $this->session->userdata('username');
		$user = $this->input->post('usuario');
		$senha = $this->input->post('senha');
		$data_user = $this->input->post('data_user');
		$data_senha = $this->input->post('data_senha');

		if ($data_user == $user){
			$result = $this->sys_model->validation($user, $senha);
			if($result){
				$this->session->set_flashdata('success_msg', 'Solicitação enviada ao administrador');
				redirect(base_url("cancelCadastro"));
			}else{
				$this->session->set_flashdata('error_msg', 'Usuário ou senha incorreta');
				redirect(base_url("cancelCadastro"));
			}
		}
		else{
			$this->session->set_flashdata('error_msg', 'Usuário ou senha incorreta');
			redirect(base_url("cancelCadastro"));
		}
		//Murilo faz o tratamento caso seja invalido redirecione pra mesma pagina criando aquele campo de informação(flashdata) falando que as credenciais estão erradas
	}


	public function cancelCadastro($user = null){   //Exibe as solicitações de remoção realizadas pelos usuários.
		$nivel = $this->session->userdata('nivel_usuario');
		$data_user= $this->session->userdata('usuario');
		$data = array(
			'title' => $this->sys_model->meuPerfil($data_user),
		);
		if($user){
			$this->db->query("INSERT INTO `equipe385116`.`REQUISICAO` (`username`) VALUES ( '$user'); ");
			redirect(base_url("/"));
		}else{

			if ($nivel === 'administrador'):
				$nav = 'nav_adm';
			elseif ($nivel === 'usuario'):
				$nav = 'nav_user';
			elseif ($nivel === 'bibliotecario'):
				$nav = 'nav_blib';
			endif;

			$this->load->view('templates/header');
			$this->load->view('templates/'.$nav);
			$this->load->view('pages/cancelCadastro',$data);
			$this->load->view('templates/footer');
		}
	}

}
