<?php
class Sys_model extends CI_Model {

<<<<<<< HEAD
        public function __construct()
        {
                $this->load->database();
        }

        public function validation($user, $pass)
        {
                $this->db->where('username', $user);
                $this->db->where('password', sha1($pass));
                $query = $this->db->get('USUARIO');
                return $query->row_array();
        }

        public function consultaTitulos(){
                $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES;');
                return $query->result();
        }

        public function consulta_especifico_USUARIO($username){
                $query = $this->db->query('select * from USUARIO where username ="'.$username.'";');
                return $query->row_object();
        }

        public function consulta_especifico_Livro($isbn){
                $query = $this->db->query('select * from LIVROS where isbn ="'.$isbn.'";');
                return $query->row_object();
        }


        public function consultaProf(){
                $query = $this->db->query('select mat_siape, nome, nome_curso from PROFESSORES natural join USUARIO natural join CURSO;');
                return $query->result();
        }

        public function consultaUsuario(){
                $query = $this->db->query('select username, nome, tipoUsuario, user_end from USUARIO;');
                return $query->result();
        }

        public function consultaEmprestimo(){
                $query = $this->db->query('select username, nome, titulo, data_reserva, prazo_dev from USUARIO natural join EMPRESTIMOS natural join LIVROS;');
                return $query->result();
        }

	public function consultaReserva(){
		$query = $this->db->query('select username, nome, titulo, data_reserva from USUARIO natural join RESERVA natural join LIVROS;');
		return $query->result();
	}

        public function consulta_meusEmprestimos($username){
                $query = $this->db->query('select ISBN, titulo, data_reserva, prazo_dev from USUARIO natural join EMPRESTIMOS natural join LIVROS where username = "'.$username.'";');
                return $query->result();
        }

		public function consulta_minhasReservas($username){
			$query = $this->db->query('select ISBN, titulo, data_reserva from USUARIO natural join RESERVA natural join LIVROS where username = "'.$username.'";');
			return $query->result();
		}

//=============================================================================================
        public function registro_usuario($user){
                $this->db->insert('USUARIO', $user);
        }

        public function buscar($busca){
          $busca = $this->input->post('caixap');
          if (empty($busca)) {
            return array();
          }
          $query = $this->db->query("select ISBN, titulo, nome_autor, ano_lançamento, editora, cpf, qtd_disp, qtd_copias, descricao from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES where titulo like '%".$busca."%' or nome_autor like '%".$busca."%';");
          return $query->result();
        }

        public function buscarUsuario($busca){
          $busca = $this->input->post('caixap1');
          if (empty($busca)) {
            return array();
          }
          $query = $this->db->query("select username, nome, tipoUsuario, user_end from USUARIO where username like '%".$busca."%' or nome like '%".$busca."%' or tipoUsuario like '%".$busca."%';");
          return $query->result();
        }

        public function buscarReserva($busca){
          $busca = $this->input->post('caixap2');
          if (empty($busca)) {
            return array();
          }
          $query = $this->db->query("select username, nome, tipoUsuario, user_end from USUARIO where username like '%".$busca."%' or nome like '%".$busca."%' or tipoUsuario like '%".$busca."%';");
          return $query->result();
        }

        public function buscarProfs($busca){
          $busca = $this->input->post('caixap3');
          if (empty($busca)) {
            return array();
          }
          $query = $this->db->query("select mat_siape, nome, nome_curso from PROFESSORES natural join USUARIO natural join CURSO where nome like '%".$busca."%' or nome_curso like '%".$busca."%' or mat_siape like '%".$busca."%';");
          return $query->result();
        }


        public function meuPerfil($user){
          $q = $this->db->query('select tipoUsuario from USUARIO where username ="'.$user.'";')->row_object();
          switch ($q->tipoUsuario) {
            case 'tipoAl':
              $query = $this->db->query("select * from  CURSO natural join ALUNOS natural join USUARIO where username = '".$user."';");
              break;
            case 'tipoProf':
              $query = $this->db->query("select * from CURSO natural join PROFESSORES natural join USUARIO where username = '".$user."';");
            break;
            case 'tipoFunc':
              $query = $this->db->query("select * from FUNCIONARIOS natural join USUARIO where username = '".$user."';");
              break;
            default:
              $query = array();
              break;
          }
          return $query->result();
        }

        public function meuPerfilFone($user){
          $q = $this->db->query('select tipoUsuario from USUARIO where username ="'.$user.'";')->row_object();
          switch ($q->tipoUsuario) {
            case 'tipoAl':
              $query = $this->db->query("select fone_aluno from  CURSO natural join ALUNOS natural join FONE_ALUNOS natural join USUARIO where username = '".$user."';");
              break;
            case 'tipoProf':
              $query = $this->db->query("select * from CURSO natural join PROFESSORES natural join USUARIO where username = '".$user."';");
            break;
            case 'tipoFunc':
              $query = $this->db->query("select fone_func from FUNCIONARIOS natural join FONE_FUNC natural join USUARIO where username = '".$user."';");
              break;
            default:
              $query = array();
              break;
          }
          return $query->result();
        }

=======
  public function __construct()
  {
    $this->load->database();
  }

  public function validation($user, $pass)
  {
    $this->db->where('username', $user);
    $this->db->where('password', sha1($pass));
    $query = $this->db->get('USUARIO');
    return $query->row_array();
  }

  public function consultaTitulos(){
    $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES;');
    return $query->result();
  }

  public function consulta_especifico_USUARIO($username){
    $query = $this->db->query('select * from USUARIO where username ="'.$username.'";');
    return $query->row_object();
  }

  public function consulta_especifico_Livro($isbn){
    $query = $this->db->query('select * from LIVROS where ISBN ="'.$isbn.'";');
    return $query->row_object();
  }

  public function consulta_especifico_ISBN($titulo){
    $query = $this->db->query('select ISBN from LIVROS where titulo ="'.$titulo.'";');
    return $query->row_object();
  }

  public function consultaProf(){
    $query = $this->db->query('select mat_siape, nome, nome_curso from PROFESSORES natural join USUARIO natural join CURSO;');
    return $query->result();
  }

  public function consultaUsuario(){
    $query = $this->db->query('select * from USUARIO;');
    return $query->result();
  }

  public function consultaEmprestimo(){
    $query = $this->db->query('select username, nome, titulo, ISBN, data_reserva, prazo_dev from USUARIO natural join EMPRESTIMOS natural join LIVROS;');
    return $query->result();
  }

  public function consultaReserva($ISBN = NULL, $user = NULL){
    if($ISBN == NULL || $user == NULL){
      $query = $this->db->query('select username, nome, titulo, ISBN, data_reserva from USUARIO natural join RESERVA natural join LIVROS;');
      return $query->result();
    }
    $query = $this->db->query('select username, nome, titulo, ISBN, data_reserva from USUARIO natural join RESERVA natural join LIVROS where username = "'.$user.'" and ISBN = "'.$ISBN.'";');
    return $query->row_object();
  }

  public function consulta_meusEmprestimos($username){
    $query = $this->db->query('select ISBN, titulo, data_reserva, prazo_dev from USUARIO natural join EMPRESTIMOS natural join LIVROS where username = "'.$username.'";');
    return $query->result();
  }

  public function consulta_minhasReservas($username){
    $query = $this->db->query('select ISBN, titulo, data_reserva from USUARIO natural join RESERVA natural join LIVROS where username = "'.$username.'";');
    return $query->result();
  }

  public function registro_usuario($user){
    $this->db->insert('USUARIO', $user);
  }

  public function buscar($busca){
    $busca = $this->input->post('caixap');
    if (empty($busca)) {
      return array();
    }
    $query = $this->db->query("select ISBN, titulo, nome_autor, ano_lançamento, editora, cpf, qtd_disp, qtd_copias, descricao from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES where titulo like '%".$busca."%' or nome_autor like '%".$busca."%';");
    return $query->result();
  }

  public function buscarUsuario($busca){
    $busca = $this->input->post('caixap1');
    if (empty($busca)) {
      return array();
    }
    $query = $this->db->query("select username, nome, tipoUsuario, user_end from USUARIO where username like '%".$busca."%' or nome like '%".$busca."%' or tipoUsuario like '%".$busca."%';");
    return $query->result();
  }

  public function buscarReserva($busca){
    $busca = $this->input->post('caixap2');
    if (empty($busca)) {
      return array();
    }
    $query = $this->db->query("select username, nome, tipoUsuario, user_end from USUARIO where username like '%".$busca."%' or nome like '%".$busca."%' or tipoUsuario like '%".$busca."%';");
    return $query->result();
  }

  public function buscarProfs($busca){
    $busca = $this->input->post('caixap3');
    if (empty($busca)) {
      return array();
    }
    $query = $this->db->query("select mat_siape, nome, nome_curso from PROFESSORES natural join USUARIO natural join CURSO where nome like '%".$busca."%' or nome_curso like '%".$busca."%' or mat_siape like '%".$busca."%';");
    return $query->result();
  }
>>>>>>> b6aba2898a2ada6fbe842370c1f7deed46190f4a
}
