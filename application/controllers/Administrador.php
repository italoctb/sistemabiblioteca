<?php
class Administrador extends CI_Controller{

          function __construct(){
              parent::__construct();
              $user = $this->session->userdata('usuario');
              $nivel = $this->session->userdata('nivel_usuario');
              $this->load->model('user_model');
              $this->load->model('func_model');
              $this->load->model('prof_model');
              $this->load->model('alu_model');
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
            $this->load->model('sys_model');
            $data = array(
                'title' => $this->sys_model->consultaTitulos()
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer');
          }

          public function professores(){
            $this->load->model('sys_model');
            $data = array(
              'title' => $this->sys_model->consultaProf()
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/profs', $data);
            $this->load->view('templates/footer');
          }

          public function consultaUsuario(){
            $this->load->model('sys_model');
            $data = array(
              'title' => $this->sys_model->consultaUsuario()
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/consultaUsuario', $data);
            $this->load->view('templates/footer');
          }

          public function consultaReserva(){
            $this->load->model('sys_model');
            $data = array(
              'title' => $this->sys_model->consultaReserva()
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/consultaReserva', $data);
            $this->load->view('templates/footer');
          }

          public function minhasReservas(){
            $this->load->model('sys_model');
            $data = array(
              'title' => $this->sys_model->consulta_minhasReservas($this->session->userdata('usuario'))
            );
            $this->load->view('templates/header');
            $this->load->view('templates/nav_adm');
            $this->load->view('pages/minhasReservas', $data);
            $this->load->view('templates/footer');
          }

          public function addCadastro(){
            //$this->session->set_flashdata('success_msg', 'Cadastrar novo usuário');
            $this->load->model('sys_model');
            $data = array(
              'title' => $this->sys_model->consulta_minhasReservas($this->session->userdata('usuario'))
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
                  $prof_check = $this->user_model->prof_check($LOGIN['mat_siape']);
                  if ($prof_check) {
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
                  $alu_check = $this->alu_model->alu_check($LOGIN['mat_aluno']);
                  if ($alu_check) {
                      $this->user_model->reg_usuario($LOGIN);
                      $this->session->set_flashdata('success_msg', 'Aluno registrado com sucesso!');
                      redirect(base_url('addCadastro'));
                  }
                  else {
                      $this->session->set_flashdata('error_msg', 'Erro no registro, verifique se os dados estão corretos');
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

                  $func_check = $this->func_model->func_check($LOGIN['mat_func']);

                  if ($func_check) {
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

          public function admin_logout(){
            $this->session->sess_destroy();
            redirect(base_url('/'), 'refresh');
          }

}
