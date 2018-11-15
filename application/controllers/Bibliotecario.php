<?php
class Bibliotecario extends CI_Controller{

          function __construct(){
              parent::__construct();
              $user = $this->session->userdata('usuario');
              $nivel = $this->session->userdata('nivel_usuario');
              if(!($user && $nivel == 'bibliotecario')){
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
              $this->load->view('templates/nav_blib.php');
              $this->load->view($page);
              $this->load->view('templates/footer.php');
          }

          public function home(){
            $this->load->model('sys_model');
            $user = $this->session->userdata('usuario');
            $data = array(
                'title' => $this->sys_model->consultaTitulos(),
                'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome
            );
            $this->session->set_flashdata('success_msg', 'Bem-vindo ' . $data['nome']);
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_blib.php');
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer.php');
          }

          public function professores(){
            $this->load->model('sys_model');
            $data = array(
              'title' => $this->sys_model->consultaProf()
            );
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_blib.php');
            $this->load->view('pages/profs', $data);
            $this->load->view('templates/footer.php');
          }

          public function consultaUsuario(){
            $this->load->model('sys_model');
            $data = array(
              'title' => $this->sys_model->consultaUsuario()
            );
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_blib.php');
            $this->load->view('pages/consultaUsuario', $data);
            $this->load->view('templates/footer.php');
          }

          public function consultaReserva(){
            $this->load->model('sys_model');
            $data = array(
              'title' => $this->sys_model->consultaReserva()
            );
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_blib.php');
            $this->load->view('pages/consultaReserva', $data);
            $this->load->view('templates/footer.php');
          }

          public function minhasReservas(){
            $this->load->model('sys_model');
            $data = array(
              'title' => $this->sys_model->consulta_minhasReservas($this->session->userdata('usuario'))
            );
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_blib.php');
            $this->load->view('pages/minhasReservas', $data);
            $this->load->view('templates/footer.php');
          }

          public function bib_logout(){
            $this->session->sess_destroy();
            redirect(base_url('/'), 'refresh');
          }
}
