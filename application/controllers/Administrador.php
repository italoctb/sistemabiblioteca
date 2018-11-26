<?php
class Administrador extends CI_Controller{

          function __construct(){
              parent::__construct();
              $user = $this->session->userdata('usuario');
              $nome = $this->session->userdata('nome');
              $nivel = $this->session->userdata('nivel_usuario');
              $this->load->model('user_model');
              $this->load->model('func_model');
              $this->load->model('prof_model');
              $this->load->model('alu_model');
              $this->load->model('sys_model');
              $this->load->helper('url');
              $this->load->helper('form');
              $this->load->library('session');
              $this->load->library(array('form_validation', 'email'));
              if(!($user && $nivel == 'administrador')){
                redirect(base_url('/'));
              }
          }
          /*  Função que cria dados cadastrais de um usuário, como nome, login,
              senha e outros... */

          public function view($page = 'home'){
              if ( ! file_exists(APPPATH.'views/pages'.$page.'.php'))
              {show_404();}

              $this->load->view('templates/header');
              $this->load->view('templates/nav_adm');
              $this->load->view($page);
              $this->load->view('templates/footer');
          }

          public function home(){
            $user = $this->session->userdata('usuario');
            $data = array(
                'title' => $this->sys_model->consultaTitulos(),
                'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
                'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
                'autor' => $this->db->get("AUTORES")->result()
            );
            $this->session->set_flashdata('other_msg', 'Bem-vindo, ' . $data['nome']);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer');
          }
          /*  Função que carrega a página inicial.  */

          public function professores(){
            $data = array(
              'title' => $this->sys_model->consultaProf($_POST)
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/profs', $data);
            $this->load->view('templates/footer');
          }
          /* Consulta no banco os professores cadastrados.  */

          public function consultaUsuario(){
            $data = array(
              'title' => $this->sys_model->consultaUsuario()
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/consultaUsuario', $data);
            $this->load->view('templates/footer');
          }

          public function consultaEmprestimo($pesq=null){
            $data = array(
              'title' => $this->sys_model->consultaEmprestimo($pesq)
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/consultaEmprestimo', $data);
            $this->load->view('templates/footer');
          }
          /* Procura no banco os emprestimos que foram feitos.  */

          public function tratarConsultaEmp(){
            $caixaE = $this->input->post('caixaE');
            $nivel = $this->session->userdata('nivel_usuario');
        		if ($nivel === 'administrador'):
        			$nav = 'admin';
        		elseif ($nivel === 'usuario'):
        			$nav = 'user';
        		elseif ($nivel === 'bibliotecario'):
        			$nav = 'blib';
        		endif;

            redirect(base_url($nav.'/consultaEmprestimo/'.$caixaE));
          }
          /*  Função que exclui ou realiza o empréstimo.  */

		public function consultaReserva($pesq=NULL){
			$data = array(
				'title' => $this->sys_model->consultaReserva($pesq)
			);
			$this->load->view('templates/header');
			$this->load->view('templates/nav_adm');
			$this->load->view('pages/consultaReserva', $data);
			$this->load->view('templates/footer');
		}
    /* Procura no banco as reservas que foram feitos.  */

    public function tratarconsultaReserva(){
      $caixaR = $this->input->post('caixaR');
      redirect(base_url('consultaReserva/'.$caixaR));
    }
    /*  Função que exclui ou realiza a reserva.  */

		public function alterarReserva(){
			$user = $this->session->userdata('nivel_usuario');
			$data = array(
				'consulta' => $this->sys_model->consultaReserva(),
				'usuarios' => $this->db->get("USUARIO")->result(),
				'reserva' => $this->db->get("RESERVA")->result()
			);
			$this->load->view('templates/header.php');

			if ($user === 'administrador'):
				$nav = 'nav_adm';
			elseif ($user === 'bibliotecario'):
				$nav = 'nav_blib';
			endif;

			$this->load->view('templates/'.$nav);
			$this->load->view('pages/alterarReserva', $data);
			$this->load->view('templates/footer.php');
		}
    /*  Verifica o nível e usuário e procura no banco as reservas feitas
        e então, as modifica. */

	function emprestimoReserva($ident = NULL, $username = NULL){
		$user = $this->session->userdata('nivel_usuario');
		$data['reserva'] = $this->db->get("RESERVA")->result();

		if ( $user === 'administrador') {
			$this->user_model->dec_livro($ident);
			$this->user_model->inc_user($username);
			$this->db->where('ISBN',$ident);
			$this->db->where('username',$username);
			$this->db->delete('RESERVA');
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
		$this->load->view('pages/alterarReserva', $data);
		$this->load->view('templates/footer.php');
	}

	function cancelReserva($ident = NULL, $username = NULL){
		$user = $this->session->userdata('nivel_usuario');
		$data['reserva'] = $this->db->get("RESERVA")->result();

		if ( $user === 'administrador' || $user === 'bibliotecario') {
			$this->db->where('ISBN',$ident);
			$this->db->where('username',$username);
			$this->db->delete('RESERVA');
			$this->session->set_flashdata('success_msg', 'Operação realizada!');
			redirect(base_url('alterarReserva'));
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
		$this->load->view('pages/alterarReserva', $data);
		$this->load->view('templates/footer.php');
	}
    /*  Função que cancela a reserva feita pelo usuário.  */

          public function meusEmprestimos(){
            $data = array(
              'title' => $this->sys_model->consulta_meusEmprestimos($this->session->userdata('usuario'))
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/meusEmprestimos', $data);
            $this->load->view('templates/footer');
          }

          public function addCadastro(){
            //$this->session->set_flashdata('success_msg', 'Cadastrar novo usuário');
            $data = array(
              'title' => $this->sys_model->consulta_meusEmprestimos($this->session->userdata('usuario'))
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/addCadastro', $data);
            $this->load->view('templates/footer');
          }
          /* Função para cadastrar novo usuáro no banco.  */

	public function registro_usuario(){
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
					redirect(base_url('addCadastro'));
				}
				else {
					$this->session->set_flashdata('error_msg', 'Erro no registro, verifique se os dados estão corretos');
					redirect(base_url('addCadastro'));
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

        //$alu_check = $this->alu_model->alu_check($LOGIN['mat_aluno']);
        if (true) { //Para facilitar a demonstração, removeremos a clausula de checagem de aluno.
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
            redirect(base_url('addCadastro'));
          }
          else {
            $this->session->set_flashdata('error_msg', 'Desculpe, o aluno não pode ser cadastrado devido a data de conclusao de curso.');
            redirect(base_url('addCadastro'));
          }
        }
        else{
          $this->session->set_flashdata('error_msg', 'Erro no registro, verifique se sua Matrícula está correta');
          redirect(base_url('addCadastro'));
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
					redirect(base_url('addCadastro'));
				}
				else {
					$this->session->set_flashdata('error_msg', 'Erro no registro, verifique se os dados estão corretos');
					redirect(base_url('addCadastro'));
				}
			}

			else {
				$this->session->set_flashdata('error_msg', 'Erro no registro, verifique se os dados estão corretos');
				redirect(base_url('addCadastro'));
			}
		}
	}

          public function removerCadastro(){
                  $user = $this->session->userdata('nivel_usuario');
                  $data = array(
                      'title' => $this->sys_model->consultaUsuario(),
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
                  $this->load->view('pages/removerCadastro', $data);
                  $this->load->view('templates/footer.php');
          }
          /*  Função e verifica os usuários no banco e remove eles. */

          public function trataRemover(){
            $user = $this->input->post('username');
            redirect(base_url("deletarUsuario/$user"));
          }
          /*  Função que deleta o usuário.  */

          public function editarUsuario($ident = NULL){
              $user_id = $this->session->userdata('nivel_usuario');
              $data['NOME'] = $this->user_model->sel_usuario();
              if($user_id === 'administrador'){
                  $this->db->where('username',$ident);
                  $data['usuario'] = $this->db->get('USUARIO')->result();
                  $this->load->view('templates/header');
                  $this->load->view('pages/editarUsuario', $data);
                  $this->load->view('templates/footer');
              }
              else{
                  {redirect(base_url('admin/consultaUsuario'));}
              }
          }

          public function updateUsuario(){
            $user_id = $this->session->userdata('nivel_usuario');
            $this->form_validation->set_rules('username', 'Usuário', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error_msg', 'Preencha todos os campos.');
            }

            else{
                    $nome = $this->input->post('nome');
                    $mat = $this->input->post('matricula');
                    $tipo = $this->input->post('tipoUsuario');

                    if ($tipo == 'tipoFunc'):
                      $mat_tipo = 'mat_func';
                    elseif ($tipo == 'tipoAl'):
                      $mat_tipo = 'mat_aluno';
                    elseif ($tipo == 'tipoProf'):
                      $mat_tipo = 'mat_siape';
                    endif;

                    $test = $this->user_model->getQntdByMat($mat_tipo, $mat);
                    $LOGIN = array(
                        'nome' => $this->input->post('nome'),
                        'username' => $this->input->post('username'),
                        'user_end' => $this->input->post('user_end')
                    );

                    if($test){

                        $this->db->where($mat_tipo, $mat);
                        if($this->db->update('USUARIO', $LOGIN) && $user_id==='administrador'){
                            $this->session->set_flashdata('success_msg', 'Registro atualizado');
                            redirect(base_url('admin/consultaUsuario'));
                        }
                       else{
                           $this->session->set_flashdata('success_msg', 'Erro na atualização');
                           redirect(base_url('admin/consultaUsuario'));
                       }
                    }
                    else{
                        $this->session->set_flashdata('error_msg', 'Usuário com débito não pode ser atualizado');
                        redirect(base_url('admin/consultaUsuario'));
                    }
            }
        }
        /*  Função que permite modificar alguma informação do usuário, mas pelo
            administrador, podendo até aumentar a quantidade max de livros. */

		public function editarCadastro(){
			$user_id = $this->session->userdata('nivel_usuario');
			$data = array(
				'title' => $this->sys_model->consultaUsuario()
			);
			$data['NOME'] = $this->user_model->sel_usuario();
			if($user_id === 'administrador'){
				$data['usuario'] = $this->db->get('USUARIO')->result();
				$this->load->view('templates/header');
				$this->load->view('templates/nav_adm');
				$this->load->view('pages/editarCadastro', $data);
				$this->load->view('templates/footer');
			}
			else{
				{redirect(base_url('admin/consultaUsuario'));}
			}
		}

        public function deletarUsuario($ident = NULL){

            $test = $this->user_model->getQntdByUsername($ident);

            if($test){
                $this->db->where('username',$ident);
                $this->db->delete('USUARIO');
                $this->session->set_flashdata('success_msg', 'Registro deletado');
                redirect(base_url('admin/consultaUsuario'));            }
            else {
                $this->session->set_flashdata('error_msg', 'Usuário com débito não pode ser deletado');
                redirect(base_url('admin/consultaUsuario'));
            }


        }
        /*  Função que deleta o usuário se ele não possuir uma alguma pendencia
            na biblioteca. */
        public function solicitaRemocao($id = null){
          $data = array(
              'solicitacao' => $this->sys_model->requisicoes(),
              'req' => $this->db->query('select * from REQUISICAO where id_req = "'.$id.'";')->row_object()
            );
          $this->load->view('templates/header');
          $this->load->view('templates/nav_adm');
          $this->load->view('pages/solicitacoes', $data);
          $this->load->view('templates/footer');
        }
        /*  Exibe as solicitações de remoção realizadas pelos usuários.
            E seleciona array com todas as requisições de remoção do sistema. */

        public function TrataCancelCadastro(){   //Exibe as solicitações de remoção realizadas pelos usuários.
          $user = $this->input->post('usuario');
          $senha = $this->input->post('senha');
          $result = $this->sys_model->validation($user, $senha);
          if($result){
            redirect(base_url("cancelCadastro/$user"));
          }else{
            echo "erro!";
          }
          //Murilo faz o tratamento caso seja invalido redirecione pra mesma pagina criando aquele campo de informação(flashdata) falando que as credenciais estão erradas
        }


        public function cancelCadastro($user = null){   //Exibe as solicitações de remoção realizadas pelos usuários.
          if($user){
            $this->db->query("INSERT INTO `equipe385116`.`REQUISICAO` (`username`) VALUES ( '$user'); ");
            redirect(base_url("/"));
          }else{
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/cancelCadastro');
            $this->load->view('templates/footer');
          }
        }
        /*  Fumção que cancela o cadastro de algum usuário. */




}
