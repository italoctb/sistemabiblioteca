<?php
  class Func_model extends CI_model{

    public function register_func($user){
        $this->db->insert('USUARIO', $user);
    }

      public function login_func($username,$password,$usuario){
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

      public function func_check($mat_func){
          $query  =  $this->db->get_where(
              'FUNCIONARIOS',
              array(
                  'mat_func' => $mat_func,
              )
          );
          return $query->row_array();
      }

      public function func_log($mat_func, $nome_func){
          $query  =  $this->db->get_where(
              'USUARIO',
              array(
                  'mat_func' => $mat_func,
                  'name' => $nome_func,
              )
          );
          return $query->row_array();
      }

      public function get_funcionario(){
          return $this->db
              ->order_by('nome_func')
              ->get('FUNCIONARIOS');
      }

      public function sel_func(){
        $funcionarios = $this->get_funcionario();
        $options = "<option value = ''>Selecionar Funcionario</option>".PHP_EOL;

        foreach ($funcionarios -> result() as $funcionarios){
            $test = $this->func_log($funcionarios->mat_func, $funcionarios->nome_func);
            if(!$test) {
                $options .= "<option value = '{$funcionarios->nome_func}'> {$funcionarios->nome_func} </option> ".PHP_EOL;
            }
        }

        return $options;
      }

      public function sel_mat(){
          $options = "<option value = ''>Matrícula</option>".PHP_EOL;
          $matricula = $this->get_funcionario();

          foreach ($matricula -> result() as $funcionarios){
              $test = $this->func_log($funcionarios->mat_func, $funcionarios->nome_func);
              if(!$test){
                  $options .= "<option value = '{$funcionarios->mat_func}'> {$funcionarios->nome_func} </option>".PHP_EOL;
              }
          }

          return $options;
      }

      public function sel_funcionarios(){
          $funcionarios = $this->get_funcionario();
          $options = "<option value = ''>Selecionar Funcionario</option>".PHP_EOL;

          foreach ($funcionarios -> result() as $funcionarios){
              $test = $this->func_log($funcionarios->mat_func, $funcionarios->nome_func);
              if(!$test){
                $options .= "<option value = '{$funcionarios->nome_func}'> {$funcionarios->nome_func} </option>".PHP_EOL;
              }
          }

          return $options;
      }

      public function getMatByName($id_name=null){
          return $this->db
              ->where("nome_func",$id_name)
              ->order_by('mat_func')
              ->get('FUNCIONARIOS');
      }

      public function selectMatricula($id_name=null){
          $matricula = $this->getMatByName($id_name);
          $option = "<option>Matrícula</option>";
          foreach($matricula ->result() as $matricula){
              $option = "<option value='{$matricula->mat_func}'>$matricula->mat_func</option>>";
              return $option;
          }
      }
  }
?>