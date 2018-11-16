<?php
class User extends CI_Controller {

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
              if(!($user && $nivel == 'usuario')){
                redirect(base_url('/'));
              }
          }

          public function view($page = 'home'){
              if ( ! file_exists(APPPATH.'views/pages'.$page.'.php'))
              {
                // Whoops, we don't have a page for that!
                show_404();
              }
              $this->load->view('templates/header.php');
              $this->load->view('templates/nav_user.php');
              $this->load->view($page);
              $this->load->view('templates/footer.php');
          }

          public function home(){
            $user = $this->session->userdata('usuario');
            $data = array(
                'title' => $this->sys_model->consultaTitulos(),
                'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
                'cpf' => $this->db->get("LIVROS_has_AUTORES")->result(),
                'autor' => $this->db->get("AUTORES")->result()
            );

            $this->session->set_flashdata('success_msg', 'Bem-vindo, ' . $data['nome']);
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_user.php');
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer.php');
          }

          public function professores(){
            $data = array(
              'title' => $this->sys_model->consultaProf()
            );
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_user.php');
            $this->load->view('pages/profs', $data);
            $this->load->view('templates/footer.php');
          }

          public function consultaUsuario(){
            $data = array(
              'title' => $this->sys_model->consultaUsuario()
            );
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_user.php');
            $this->load->view('pages/consultaUsuario', $data);
            $this->load->view('templates/footer.php');
          }

          public function consultaReserva(){
            $data = array(
              'title' => $this->sys_model->consultaReserva()
            );
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_user.php');
            $this->load->view('pages/consultaReserva', $data);
            $this->load->view('templates/footer.php');
          }
}
