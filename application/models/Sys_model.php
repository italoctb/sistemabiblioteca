<?php
class Sys_model extends CI_Model {

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

  public function requisicoes(){
    $query = $this->db->query('select * from REQUISICAO;');
    return $query->result();
  }


  public function consultaTitulosISBN(){
      $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY ISBN;');
    return $query->result();
  }

  public function consultaTitulosNomeObra(){
      $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY titulo;');
    return $query->result();
  }

  public function consultaTitulosAutor(){
      $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY nome_autor;');
    return $query->result();
  }


  public function consultaTitulosLançamento(){
      $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY ano_lançamento DESC;');
    return $query->result();
  }

   public function consultaTitulosEdit(){
      $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY editora;');
    return $query->result();
  }

   public function consultaTitulosCategoria(){
      $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY descricao;');
    return $query->result();
  }

   public function consultaTitulosDisp(){
      $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY qtd_disp DESC;');
    return $query->result();
  }
}
