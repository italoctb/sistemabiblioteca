<?php
  class User_model extends CI_model{

    public function register_user($user){
        $this->db->insert('USUARIO', $user);
    }

      public function reg_usuario($user){
          $this->db->insert('USUARIO', $user);
      }

      public function reg_reserva($RESERVA){
          $this->db->insert('RESERVA', $RESERVA);
      }

      public function dec_livro($ISBN){
          $this->db->set('qtd_disp', 'qtd_disp-1',FALSE);
          $this->db->where('ISBN', $ISBN);
          $this->db->update('LIVROS');
      }

      public function inc_livro($ISBN){
          $this->db->set('qtd_disp', 'qtd_disp+1',FALSE);
          $this->db->where('ISBN', $ISBN);
          $this->db->update('LIVROS');
      }

      public function dec_user($username){
          $this->db->set('qntd_livros', 'qntd_livros-1',FALSE);
          $this->db->where('username', $username);
          $this->db->update('USUARIO');
      }

      public function inc_user($username){
          $this->db->set('qntd_livros', 'qntd_livros+1',FALSE);
          $this->db->where('username', $username);
          $this->db->update('USUARIO');
      }

      public function check_reserva($ISBN){
          $this->db->select('*');
          $this->db->from('LIVROS');
          $this->db->where('ISBN',$ISBN);
          $this->db->where('qtd_disp',0);

          if($query=$this->db->get()) {
              return $query->row_array();
          }

          else{
              return false;
          }

      }

      public function check_reserva_usuario($ISBN, $username){
          $this->db->select('*');
          $this->db->from('RESERVA');
          $this->db->where('ISBN',$ISBN);
          $this->db->where('username',$username);

          if($query=$this->db->get()) {
              return $query->row_array();
          }

          else{
              return false;
          }
      }

      public function login_user($username,$password,$usuario){
          $this->db->select('*');
          $this->db->from('USUARIO');
          $this->db->where('username',$username);
          $this->db->where('password',$password);
          $this->db->where('nivel_usuario',$usuario);

          if($query=$this->db->get()) {
              return $query->row_array();
          }

          else{
              return false;
          }

      }

      public function get_nome(){
          return $this->db
              ->order_by('nome')
              ->get('USUARIO');
      }

      public function get_qtd_livro($ISBN){
          $this->db->select('*');
          $this->db->from('LIVROS');
          $this->db->where('ISBN',$ISBN);

          if($query=$this->db->get()) {
              return $query->qtd_disp;
          }

          else{
              return false;
          }
      }
      public function livroByISBN($ISBN){
                $query = $this->db->query('select titulo FROM LIVROS where ISBN = "'.$ISBN.'";');
                return $query->row_object();
        }

       // public function livroByISBN($ISBN){
       //          $query = $this->db->query('select * from LIVROS where ISBN ="'.$ISBN.'";');
       //          return $query->row_object();
       //  }

      public function getQntdByName($nome=null){
          $this->db->select('*');
          $this->db->from('USUARIO');
          $this->db->where('nome',$nome);
          $this->db->where('qntd_livros',0);

          if($query=$this->db->get()) {
              return $query->row_array();
          }

          else{
              return false;
          }

      }

      public function getQntdByUsername($usernome=null){
          $this->db->select('*');
          $this->db->from('USUARIO');
          $this->db->where('username',$usernome);
          $this->db->where('qntd_livros',0);

          if($query=$this->db->get()) {
              return $query->row_array();
          }

          else{
              return false;
          }

      }

      public function getQntdByMat($tipo, $mat){
          $this->db->select('*');
          $this->db->from('USUARIO');
          $this->db->where($tipo, $mat);
          $this->db->where('qntd_livros',0);

          if($query=$this->db->get()) {
              return $query->row_array();
          }

          else{
              return false;
          }

      }

      public function getQntdFunc($mat=null){
          $this->db->select('*');
          $this->db->from('USUARIO');
          $this->db->where('mat_func',$mat);
          $this->db->where('qntd_livros',0);

          if($query=$this->db->get()) {
              return $query->row_array();
          }

          else{
              return false;
          }

      }

      public function getQntdProf($mat=null){
          $this->db->select('*');
          $this->db->from('USUARIO');
          $this->db->where('mat_siape',$mat);
          $this->db->where('qntd_livros',0);

          if($query=$this->db->get()) {
              return $query->row_array();
          }

          else{
              return false;
          }

      }

      public function getQntdAlu($mat=null){
          $this->db->select('*');
          $this->db->from('USUARIO');
          $this->db->where('mat_aluno',$mat);
          $this->db->where('qntd_livros',0);

          if($query=$this->db->get()) {
              return $query->row_array();
          }

          else{
              return false;
          }

      }

      public function getQtdMax($username=null){
          $query = $this->db->get_where("USUARIO","username='$username'")->result();

          foreach ($query as $row)
          {
              $result_res = $row->qntd_livros;
              $result_max = $row->qntd_livros_max;
              $result = $result_max-$result_res;
          }
            if($result>=0){
                return $result;
            }
            else{
                return false;
            }
      }

      public function getQtdLivros($ISBN=null){
          $query = $this->db->get_where("LIVROS","ISBN='$ISBN'")->result();

          foreach ($query as $row)
          {
              $result_qtd = $row->qtd_disp;
          }
          if($result_qtd>=0){
              return $result_qtd;
          }
          else{
              return false;
          }
      }

      public function sel_usuario(){
          $usuario = $this->get_nome();
          $options = "<option value = ''>Selecionar Funcionario</option>".PHP_EOL;
          foreach ($usuario -> result() as $usuario){
                  $options .= "<option value = '{$usuario->nome}'> {$usuario->nome} </option>".PHP_EOL;
          }
          return $options;
      }
  }
?>