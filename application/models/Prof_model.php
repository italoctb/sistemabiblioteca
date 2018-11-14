<?php
  class Prof_model extends CI_model{

    public function register_prof($user){
        $this->db->insert('USUARIO', $user);
     }

      public function login_prof($username,$password,$usuario){
          $this->db->select('*');
          $this->db->from('USUARIO');
          $this->db->where('username',$username);
          $this->db->where('password',$password);
          $this->db->where('tipoUsuario',$usuario);

          if($query=$this->db->get()) {
              return $query->row_array();
          }

          else{
              return false;
          }

      }

      public function prof_check($mat_siape) {
          $query  =  $this->db->get_where(
              'PROFESSORES',
              array(
                  'mat_siape' => $mat_siape,
              )
          );

          return $query->row_array();
      }


      public function prof_log($mat_siape, $nome) {
          $query  =  $this->db->get_where(
              'USUARIO',
              array(
                  'mat_siape' => $mat_siape,
                  'name' => $nome,
              )
          );

          return $query->row_array();
      }

      public function get_professores(){
          return $this->db
              ->order_by('nome')
              ->get('USUARIO');
      }

  }
?>