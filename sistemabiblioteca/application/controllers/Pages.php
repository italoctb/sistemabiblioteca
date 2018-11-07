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

          $this->load->model('my_model');
          $result = $this->my_model->validation($user, $pass);
          if($result){
            $data['title'] = "Sucesso";
            $this->load->view('templates/header.php');
            $this->load->view('autenticate', $data);
            $this->load->view('templates/footer.php');
          }else{
            $data['title'] = "Erro de login";
            //$this->load->view('templates/header.php');
            $this->load->view('errologin', $data);
            //$this->load->view('templates/footer.php');
          }

        }
}
