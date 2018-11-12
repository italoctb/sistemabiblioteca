<?php
class Pages extends CI_Controller {

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
          $this->load->model('sys_model');
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
}
