<?php
class Users extends CI_Controller {

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
            $this->load->model('sys_model');
            $data = array(
                'title' => $this->sys_model->consultaTitulos()
            );
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav_user.php');
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer.php');
          }
}
