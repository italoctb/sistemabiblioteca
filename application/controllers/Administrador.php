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
                  $dataAluCheck = $this->alu_model->dataAluCheck($LOGIN['mat_aluno']);
                  if ($alu_check && $dataAluCheck) {
                      $this->user_model->reg_usuario($LOGIN);
                      $this->session->set_flashdata('success_msg', 'Aluno registrado com sucesso!');
                      redirect(base_url('addCadastro'));
                  }
                  else {
                      if(!$dataAluCheck){
                        $this->session->set_flashdata('error_msg', 'Desculpe, o aluno não pode ser cadastrado.');
                        redirect(base_url('addCadastro'));
                    }

                    else{
                    $this->session->set_flashdata('error_msg', 'Erro no registro, verifique se sua Matrícula está correta');
                        redirect(base_url('addCadastro'));
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

}
