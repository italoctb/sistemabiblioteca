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

    public function consulta(){
            $this->session->set_flashdata('success_msg', '');
            $user = $this->session->userdata('nivel_usuario');
            $data = array(
              'title' => $this->sys_model->consultaReserva(),
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
            $data['livros'] = $this->db->get("LIVROS")->result();
            $RESERVA = array(
            'ISBN' => $this->input->post('ISBN'),
            'username' => $this->input->post('username'),
            'data_reserva' => $this->input->post('data_reserva'),
            'prazo_dev' => $this->input->post('prazo_dev'),
            );

              $qtd_check= $this->user_model->getQtdLivros($this->input->post('ISBN'));
              $res_check = $this->user_model->check_reserva($ident);
              $res_check_l = $this->user_model->check_reserva_usuario($this->input->post('ISBN'),$this->input->post('username'));
              $res_check_qtd = $this->user_model->getQtdMax($this->input->post('username'));
              if (!$res_check && !$res_check_l && $res_check_qtd &&  $qtd_check) {
                  $this->user_model->reg_reserva($RESERVA);
                  $this->user_model->dec_livro($this->input->post('ISBN'));
                  $this->user_model->inc_user($this->input->post('username'));
                  $this->session->set_flashdata('success_msg', 'Reserva realizada com sucesso!');
                  redirect(base_url('minhasReservas'));
              }
              else {
                if($res_check_l){
                    $this->session->set_flashdata('error_msg', 'Usuário já realizou este empréstimo');
                    redirect(base_url('reservaLivro/'.$RESERVA['ISBN']));
                  }
                elseif($qtd_check){
                    $this->session->set_flashdata('error_msg', 'Usuário já realizou o número máximo de empréstimos');
                    redirect(base_url('reservaLivro/'.$RESERVA['ISBN']));
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

    public function finalizarEmprestimos(){
        $user = $this->session->userdata('nivel_usuario');
        $data = array(
            'title' => $this->sys_model->consulta_minhasReservas($this->session->userdata('usuario')),
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
        $this->load->view('pages/finalizarEmprestimos', $data);
        $this->load->view('templates/footer.php');
    }

    public function sem_acesso(){
      $this->load->view('pages/error_page');
    }

    function baixaReserva($ident = NULL){
        $user = $this->session->userdata('nivel_usuario');
        $data = array(
            'username' => $ident,
            'title' => $this->sys_model->consulta_minhasReservas($this->session->userdata('usuario')),
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
        $this->load->view('pages/baixaReserva', $data);
        $this->load->view('templates/footer.php');
    }

    function devReserva($ident = NULL, $username = NULL){
        $user = $this->session->userdata('nivel_usuario');
        $data['livros'] = $this->db->get("LIVROS")->result();

        if ( $user === 'bibliotecario' || $user === 'administrador') {
            $this->user_model->inc_livro($ident);
            $this->user_model->dec_user($username);
            $this->db->where('ISBN',$ident);
            $this->db->where('username',$username);
            $this->db->delete('RESERVA');
            $this->session->set_flashdata('success_msg', 'Operação realizada!');
            redirect(base_url('consultaReserva'));
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
        $this->load->view('pages/baixaReserva', $data);
        $this->load->view('templates/footer.php');
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('/'), 'refresh');
    }
}
