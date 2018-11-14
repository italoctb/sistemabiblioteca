<?php
  class Alu_model extends CI_model{

    public function register_alu($user){
          $this->db->insert('USUARIO', $user);
      }

      public function login_alu($username,$password,$usuario){
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

      public function alu_check($mat_aluno) {
          $query  =  $this->db->get_where(
              'ALUNOS',
              array(
                  'mat_aluno' => $mat_aluno,
              )
          );

          return $query->row_array();
      }

      public function alu_log($mat_aluno, $nome_aluno) {
          $query  =  $this->db->get_where(
              'USUARIO',
              array(
                  'mat_aluno' => $mat_aluno,
                  'name' => $nome_aluno,
              )
          );

          return $query->row_array();
      }

      public function get_alunos(){
          return $this->db
              ->order_by('nome_aluno')
              ->get('ALUNOS');
      }

      public function sel_alunos(){
        $alunos = $this->get_alunos();
        $options = "<option value = ''>Selecionar Aluno</option>".PHP_EOL;

        foreach ($alunos -> result() as $alunos){
            $test = $this->alu_log($alunos->mat_aluno, $alunos->nome_aluno);
            if(!$test) {
                $options .= "<option value = '{$alunos->nome_aluno}'> {$alunos->nome_aluno} </option> ".PHP_EOL;
            }
        }

        return $options;
      }

      public function sel_mat(){
          $options = "<option value = ''>Matrícula</option>".PHP_EOL;
          $matricula = $this->get_alunos();

          foreach ($matricula -> result() as $alunos){
              $test = $this->alu_log($alunos->mat_aluno, $alunos->nome_aluno);
              if(!$test){
                  $options .= "<option value = '{$alunos->mat_aluno}'> {$alunos->nome_aluno} </option>".PHP_EOL;
              }
          }

          return $options;
      }

      public function getMatriculaByName($id_alu=null){
          return $this->db
              ->where("nome_aluno",$id_alu)
              ->order_by('mat_aluno')
              ->get('ALUNOS');
      }

      public function selectMatricula($id_alu=null){
          $matricula = $this->getMatriculaByName($id_alu);
          $option = "<option>Matrícula</option>";
          foreach($matricula ->result() as $matricula){
              $option = "<option value='{$matricula->mat_aluno}'>$matricula->mat_aluno</option>>";
              return $option;
          }
      }
  }
?>