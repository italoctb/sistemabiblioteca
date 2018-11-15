<?php
class Pages extends CI_Controller {
          function __construct(){
              parent::__construct();
              $user = $this->session->userdata('usuario');
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
                if ($alu_check) {
                    $this->user_model->reg_usuario($LOGIN);
                    $this->session->set_flashdata('success_msg', 'Aluno registrado com sucesso!');
                    redirect(base_url('cadastro'));
                }
                else {
                    $this->session->set_flashdata('error_msg', 'Erro no registro, verifique se sua Matrícula está correta');
                    redirect(base_url('cadastro'));
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

    public function sem_acesso(){
      $this->load->view('pages/error_page');
    }
}
