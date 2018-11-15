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
                'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome
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

           public function consulta(){
            $data = array(
              'title' => $this->sys_model->consultaReserva(),
              'livros' => $this->db->get("LIVROS")->result()
            );
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_user.php');
            $this->load->view('pages/consulta', $data);
            $this->load->view('templates/footer.php');
          }

          public function reservaLivro($ident = NULL){
            $user = $this->session->userdata('usuario');
           
            $data['livros'] = $this->db->get("LIVROS")->result();
            $data = array(
                'title' => $this->sys_model->consultaTitulos(),  
                'nome' =>$this->sys_model->consulta_especifico_Usuario($user)->nome,
                'username' =>$this->sys_model->consulta_especifico_Usuario($user)->username,
                'tipoUsuario' =>$this->sys_model->consulta_especifico_Usuario($user)->tipoUsuario,
                'nivel_usuario' =>$this->sys_model->consulta_especifico_Usuario($user)->nivel_usuario
            );
            $data['ISBN'] = $ident;
            $data['titulo'] =  $this->user_model->livroByISBN($ident)->titulo;
            $this->load->view('templates/header.php');
            $this->load->view('pages/reservaLivro', $data);
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

          public function minhasReservas(){
            $data = array(
              'title' => $this->sys_model->consulta_minhasReservas($this->session->userdata('usuario'))
            );
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_user.php');
            $this->load->view('pages/minhasReservas', $data);
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
                  redirect(base_url('user/minhasReservas'));
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


          public function user_logout(){
            $this->session->sess_destroy();
            redirect(base_url('/'), 'refresh');
          }
}
