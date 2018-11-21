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
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer');
          }

          public function professores(){
            $data = array(
              'title' => $this->sys_model->consultaProf()
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/profs', $data);
            $this->load->view('templates/footer');
          }

          public function consultaUsuario(){
            $data = array(
              'title' => $this->sys_model->consultaUsuario()
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/consultaUsuario', $data);
            $this->load->view('templates/footer');
          }

          public function consultaEmprestimo(){
            $data = array(
              'title' => $this->sys_model->consultaEmprestimo()
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/consultaEmprestimo', $data);
            $this->load->view('templates/footer');
          }

		public function consultaReserva(){
			$data = array(
				'title' => $this->sys_model->consultaReserva()
			);
			$this->load->view('templates/header');
			$this->load->view('templates/nav_adm');
			$this->load->view('pages/consultaReserva', $data);
			$this->load->view('templates/footer');
		}

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

		if ( $user === 'administrador') {
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
					'cod_curso' => $this->input->post('cod_curso_prof'),
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
						redirect(base_url('addCadastro'));
					}
					else {
						$this->session->set_flashdata('error_msg', 'Desculpe, o aluno não pode ser cadastrado.');
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

          public function trataRemover(){
            $user = $this->input->post('username');
            redirect(base_url('deletarUsuario/'.$user));
          }

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

        public function deletarUsuario($ident = NULL){
            $user_id = $this->session->userdata('nivel_usuario');
            if($user_id === 'administrador'){
                $test = $this->user_model->getQntdByUsername($ident);
                if($test) {
                    $this->db->where('username',$ident);
                    if ($this->db->delete('USUARIO')):
                        $this->session->set_flashdata('success_msg', 'Registro deletado');
                        redirect(base_url('admin/consultaUsuario'));
                    else:
                        $this->session->set_flashdata('error_msg', 'Erro ao deletar registro');
                        redirect(base_url('admin/consultaUsuario'));
                    endif;
                }
                else {
                    $this->session->set_flashdata('error_msg', 'Usuário com débito não pode ser deletado');
                    redirect(base_url('admin/consultaUsuario'));
                }
            }
            else{
                {redirect(base_url('admin/home'));}
            }

        }

        public function solicitaRemocao(){   //Exibe as solicitações de remoção realizadas pelos usuários.
          $data = array(
              'solicitacao' => $this->sys_model->requisicoes() //Array com todas as requisições de remoção do sistema.
            );
          $this->load->view('templates/header');
          $this->load->view('templates/nav_adm');
          $this->load->view('pages/solicitaRemocao', $data);
          $this->load->view('templates/footer');

        }


        public function confirmaSolicitacao($ident = NULL){  //Recebe o username do usuário a ser removido.

                $test = $this->user_model->getQntdByUsername($ident); //Verifica se o usuário possui alguma pendência.
                if($test) { //Sem pendências na biblioteca.
                  $this->db->where('username',$ident);
                  if ( $this->db->delete('REQUISICAO')): //Remove a requisição de remoção do usuário.

                      $this->db->where('username',$ident);
                      $this->db->delete('USUARIO'); //Remove o usuário do sistema.

                      $this->session->set_flashdata('success_msg', 'Registro deletado');
                      redirect(base_url('solicitaRemocao'));
                  else:
                      $this->session->set_flashdata('error_msg', 'Erro ao deletar registro');
                      redirect(base_url('solicitaRemocao'));
                  endif;
                }else {
                    $this->session->set_flashdata('error_msg', 'Usuário com débito não pode ser deletado');
                    redirect(base_url('solicitaRemocao'));
                }




        }





}
