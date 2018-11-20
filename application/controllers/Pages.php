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
            // Whoops, we don't have a page for that!
            show_404();
          }
          //$this->load->view('templates/header.php');
          $this->load->view($page);
          //$this->load->view('templates/footer.php');
        }

        public function aut_login(){
          $user = $this->input->post('username');
          $pass = $this->input->post('pass');
          $result = $this->sys_model->validation($user, $pass);
          if($result){
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
            //$this->load->view('templates/header.php');
            $this->load->view('errologin', $data);
            //$this->load->view('templates/footer.php');
          }

        }

        public function cadastro(){
            //$this->session->set_flashdata('success_msg', 'Cadastrar novo usuário');
            $this->load->view('pages/cadastro');
        }

        public function addUsuario(){
          $this->form_validation->set_rules('nome', 'Nome', 'trim|required|required');
          $this->form_validation->set_rules('username', 'Nome de Usuário', 'trim|required');
          $this->form_validation->set_rules('password', 'Senha', 'trim|required');
          $this->form_validation->set_rules('tipoUsuario', 'Tipo de usuário', 'trim|required');
          $this->form_validation->set_rules('matricula', 'Matrícula', 'trim|required');
          $this->form_validation->set_rules('user_end', 'Endereço', 'trim|required');


          if ($this->form_validation->run() == FALSE) {
              redirect(base_url('cadastro'));
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
                      'nivel_usuario' => ('usuario'),
                      'qntd_livros_max' => ('5'),
                      'qntd_livros' => ('0'),
                      'user_end' => $this->input->post('user_end'),
                  );
                  $prof_check = $this->prof_model->prof_check($LOGIN['mat_siape']);
                  if ($prof_check) {
                      $this->user_model->reg_usuario($LOGIN);
                      $this->session->set_flashdata('success_msg', 'Professor registrado com sucesso!');
                      redirect(base_url('cadastro'));
                  }
                  else {
                      $this->session->set_flashdata('error_msg', 'Erro no registro, verifique se sua Matrícula está correta');
                      redirect(base_url('cadastro'));
                  }
              }

              elseif ($this->input->post('tipoUsuario') == 'tipoAl'){
                  $LOGIN = array(
                      'nome' => $this->input->post('nome'),
                      'username' => $this->input->post('username'),
                      'password' => sha1($this->input->post('password')),
                      'tipoUsuario' => $this->input->post('tipoUsuario'),
                      'mat_aluno' => $this->input->post('matricula'),
                      'nivel_usuario' => ('usuario'),
                      'qntd_livros_max' => ('3'),
                      'qntd_livros' => ('0'),
                      'user_end' => $this->input->post('user_end'),
                  );
                  $alu_check = $this->alu_model->alu_check($LOGIN['mat_aluno']);
                  $dataAluCheck = $this->alu_model->dataAluCheck($LOGIN['mat_aluno']);
                  if ($alu_check && $dataAluCheck) {
                      $this->user_model->reg_usuario($LOGIN);
                      $this->session->set_flashdata('success_msg', 'Aluno registrado com sucesso!');
                      redirect(base_url('cadastro'));
                  }
                  else {

                      if(!$dataAluCheck){
                          $this->session->set_flashdata('error_msg', 'Desculpe, você não pode mais utilizar os serviços da biblioteca.');
                          redirect(base_url('cadastro'));
                      }

                      else{
                      $this->session->set_flashdata('error_msg', 'Erro no registro, verifique se sua Matrícula está correta');
                          redirect(base_url('cadastro'));
                      }
                  }
            }

            elseif ($this->input->post('tipoUsuario') == 'tipoFunc'){
                $LOGIN = array(
                    'nome' => $this->input->post('nome'),
                    'username' => $this->input->post('username'),
                    'password' => sha1($this->input->post('password')),
                    'tipoUsuario' => $this->input->post('tipoUsuario'),
                    'mat_func' => $this->input->post('matricula'),
                    'nivel_usuario' => ('usuario'),
                    'qntd_livros_max' => ('4'),
                    'qntd_livros' => ('0'),
                    'user_end' => $this->input->post('user_end'),
                );

                $func_check = $this->func_model->func_check($LOGIN['mat_func']);

                if ($func_check) {
                    $this->user_model->reg_usuario($LOGIN);
                    $this->session->set_flashdata('success_msg', 'Funcionário registrado com sucesso!');
                    redirect(base_url('cadastro'));
                }
                else {
                    $this->session->set_flashdata('error_msg', 'Erro no registro, verifique se sua Matrícula está correta');
                    redirect(base_url('cadastro'));
                }
            }

            else {
                $this->session->set_flashdata('error_msg', 'Erro no registro, verifique se sua Matrícula está correta');
                redirect(base_url('cadastro'));
            }
        }

    }

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
    public function trataEmprestimoLivro(){
      $user = $this->input->post('username');
      $isbn = $this->input->post('isbnEmp');
      if(!$isbn){
        $isbn = $this->sys_model->consulta_especifico_ISBN($this->input->post('nomeObra'))->ISBN;
      }
      redirect(base_url('emprestimoLivro/'.$isbn.'/'.$user));
    }
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
              if (!$res_check && !$res_check_l && $res_check_qtd && $qtd_check) {
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
                    redirect(base_url('emprestimoLivro/'.$EMPRESTIMOS['ISBN']));
                }
                elseif($res_check_l){
                    $this->session->set_flashdata('error_msg', 'Usuário já realizou este empréstimo');
                    redirect(base_url('emprestimoLivro/'.$EMPRESTIMOS['ISBN']));
                }
                elseif(!$res_check_qtd){
                    $this->session->set_flashdata('error_msg', 'Usuário já realizou o número máximo de empréstimos');
                    redirect(base_url('emprestimoLivro/'.$EMPRESTIMOS['ISBN']));
                }
              }
              $this->load->view('templates/header.php');
              $this->load->view('templates/nav_user.php');
              $this->load->view('pages/home', $data);
              $this->load->view('templates/footer.php');
    }

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

    public function sem_acesso(){
      $this->load->view('pages/error_page');
    }

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
		if (!$res_check && !$emp_check) {
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
			}
		}
		$this->load->view('templates/header.php');
		$this->load->view('templates/nav_user.php');
		$this->load->view('pages/home', $data);
		$this->load->view('templates/footer.php');
	}

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
      $data = array(
        'title' => $this->sys_model->consultaHome($pesq)
      );
      $this->load->view('templates/header');
      $this->load->view('templates/nav_adm');
      $this->load->view('pages/home', $data);
      $this->load->view('templates/footer');
    }

    public function tratarConsultaHome($caixaHome){
      $caixaHome = $this->input->post('caixaHome');
      redirect(base_url('consultaHome/'.$caixaHome));
    }

    public function consultaProf($pesq=NULL){
      $data = array(
        'title' => $this->sys_model->consultaProf($pesq)
      );
      $this->load->view('templates/header');
      $this->load->view('templates/nav_adm');
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
      $this->load->view('templates/nav_adm');
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

<<<<<<< HEAD
    public function meuPerfil(){
      $user = $this->session->userdata('usuario');
      $data = array(
        'title' => $this->sys_model->meuPerfil($user),
        'title2' => $this->sys_model->meuPerfilFone($user)
      );
      $this->load->view('templates/header');
      $this->load->view('templates/nav_adm');
      $this->load->view('pages/meuPerfil', $data);
      $this->load->view('templates/footer');
    }

    public function editarPerfil($info=null){
      $user = $this->session->userdata('usuario');
      $data = array(
        'title' => $this->sys_model->meuPerfil($user),
        //'title2' => $this->sys_model->meuPerfilFone($user),
        'title2' => $this->sys_model->editarPerfil($info)
      );
      $this->load->view('templates/header');
      $this->load->view('templates/nav_adm');
      $this->load->view('pages/editarPerfil', $data['title']);
      $this->load->view('templates/footer');
    }

    public function tratarEditarPerfilAl(){
      $novoInfo = array(
        'nome' => $this->input->post('nome'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
        'user_end' => $this->input->post('user_end'),
        'mat_aluno' => $this->input->post('mat_aluno'),
        'nome_curso' => $this->input->post('nome_curso'),
        'data_de_ingresso' => $this->input->post('data_de_ingresso'),
        'data_de_conclusao_prev' => $this->input->post('data_de_conclusao_prev')
      );
      redirect(base_url('editarPerfil/'.$novoInfo));
    }

    public function tratarEditarPerfilFunc(){
        $info = array(
          'nome' => $this->input->post('nome'),
          'user_end' => $this->input->post('user_end'),
          'username' => $this->input->post('nome')
        );

      redirect(base_url('editarPerfil/'.$info['nome']));
    }

    public function tratarEditarPerfilProf(){
      $info = array(
        'nome' => $this->input->post('nome'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
        'user_end' => $this->input->post('user_end'),
        'telefone_celular' => $this->input->post('telefone_celular'),
        'mat_siape' => $this->input->post('mat_siape'),
        'nome_curso' => $this->input->post('nome_curso'),
        'data_de_contratacao' => $this->input->post('data_de_contratacao')
      );
      redirect(base_url('editarPerfil/'.$novoInfo));
    }

=======

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

    
>>>>>>> 21537a23eece35da4edf201a9e72e067fe8ddc07
}
