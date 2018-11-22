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
    $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES;');
    return $query->result();
  }

  public function consultaProfsCurso($curso){
    $query = $this->db->query('select nome, mat_siape, telefone_celular from CURSO natural join PROFESSORES natural join USUARIO where nome_curso ="'.$curso.'";');
    return $query->result();
  }

  public function consulta_especifico_USUARIO($username){
    $query = $this->db->query('select * from USUARIO where username ="'.$username.'";');
    return $query->row_object();
  }

  public function consulta_especifico_EDITORA($editora){
    $query = $this->db->query('select * from LIVROS where editora ="'.$editora.'";');
    return $query->row_object();
  }

  public function consulta_categoryBycod($cod){
    $query = $this->db->query('select descricao from CATEGORIA where cod_categoria ="'.$cod.'";');
    return $query->row_object();
  }

  public function consulta_especifico_Livro($isbn){
    $query = $this->db->query('select * from LIVROS where ISBN ="'.$isbn.'";');
    return $query->row_object();
  }
  public function consulta_livro_menu($isbn){
    $query = $this->db->query('select ISBN, titulo, nome, username, data_reserva, prazo_dev from LIVROS natural join EMPRESTIMOS natural join USUARIO where ISBN ='.$isbn.';');
    return $query->result();
  }
  public function consulta_especifico_ISBN($titulo){
    $query = $this->db->query('select ISBN from LIVROS where titulo ="'.$titulo.'";');
    return $query->row_object();
  }

  public function consultaProf($busca=NULL){
    if (empty($busca)) {
      $query = $this->db->query('select * from PROFESSORES natural join USUARIO natural join CURSO;');
    }else{
      $query = $this->db->query("select mat_siape, nome, nome_curso from PROFESSORES natural join USUARIO natural join CURSO where nome like '%".$busca."%' or nome_curso like '%".$busca."%' or mat_siape like '%".$busca."%';");
    }
    return $query->result();
  }

  public function consultaUsuario($busca=null){

    if (empty($busca)) {
      $query = $this->db->query("select * from USUARIO;");
    }else{
      $query = $this->db->query("select * from USUARIO where username like '%".$busca."%' or nome like '%".$busca."%' or tipoUsuario like '%".$busca."%';");
    }
    return $query->result();
  }

  public function consultaEmprestimo($busca=null){

    if (empty($busca)) {
      $query = $this->db->query("select * from USUARIO natural join EMPRESTIMOS natural join LIVROS;");
    }else{
      $query = $this->db->query("select * from USUARIO natural join EMPRESTIMOS natural join LIVROS where username like '%".$busca."%' or nome like '%".$busca."%' or tipoUsuario like '%".$busca."%';");
    }
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

  public function consultaHome($busca=NULL){
    if (empty($busca)) {
      $query = $this->db->query("select * from USUARIO natural join LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES;");
    }else{
      $query = $this->db->query("select * from USUARIO natural join LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES where titulo like '%".$busca."%' or descricao like '%".$busca."%' or nome_autor like '%".$busca."%';");
    };
    return $query->result();
  }

  public function buscarI($busca){
    $query = $this->db->query("select ISBN, titulo, nome_autor, ano_lançamento, editora, cpf, qtd_disp, qtd_copias, descricao from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES where ISBN = $busca;");
    return $query->row_object();
  }

  public function buscarIC($busca){
    $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, cpf, qtd_disp, qtd_copias, descricao from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES where cod_categoria = "'.$busca.'";');
    return $query->result();
  }

  public function buscarIE($busca){
    $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, cpf, qtd_disp, qtd_copias, descricao from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES where editora = "'.$busca.'";');
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
    switch ($q) {
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
    return $query;
  }

  public function editarPerfil($info){
    $q = $this->db->query('select tipoUsuario from USUARIO where username = "'.$info['username'].'";')->row_object();
    switch ($q->tipoUsuario) {
      case 'tipoAl':
        $update = $this->db->update("update CURSO natural join ALUNOS natural join FONE_ALUNOS natural join USUARIO
        set nome = '".$novoInfo->nome."', username = '".$novoInfo->username."', password = '".$novoInfo->password."',
        user_end = '".$novoInfo->user_end."', mat_aluno = '".$novoInfo->mat_aluno."',nome_curso = '".$novoInfo->nome_curso."',
        data_de_ingresso = '".$novoInfo->data_de_ingresso."', data_de_conclusao_prev = '".$novoInfo->data_de_conclusao_prev."'
        where username = '".$user."';");
        return $update->result();
        break;
      case 'tipoProf':
        $update = $this->db->update("update CURSO natural join PROFESSORES natural join USUARIO
        set nome = '".$novoInfo->nome."', username = '".$novoInfo->username."', password = '".$novoInfo->password."',
        user_end = '".$novoInfo->user_end."', telefone_celular = '".$novoInfo->telefone_celular."',
        mat_siape = '".$novoInfo->mat_siape."', nome_curso = '".$novoInfo->nome_curso."', data_de_contratacao = '".$novoInfo->data_de_contratacao."'
        where username = '".$user."';");
        return $update->result();
      break;
      case 'tipoFunc':
        $update = $this->db->query("update FUNCIONARIOS natural join FONE_FUNC natural join USUARIO
        set nome = '".$info['nome']."',
        user_end = '".$info['user_end']."'
        where username = '".$info['username']."';");
        $query = $this->db->query("select * from CURSO natural join PROFESSORES natural join USUARIO where username = '".$info['username']."';");
        return $query-result();
        break;
      default:
        $query = array();
        break;
    }
    //return $update->result();
  }

  public function requisicoes(){
    $query = $this->db->query('select * from REQUISICAO;');
    return $query->result();
  }


  public function consultaTitulosISBN(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY ISBN;');
    return $query->result();
  }

  public function consultaTitulosNomeObra(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY titulo;');
    return $query->result();
  }

  public function consultaTitulosAutor(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY nome_autor;');
    return $query->result();
  }


  public function consultaTitulosLançamento(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY ano_lançamento DESC;');
    return $query->result();
  }

   public function consultaTitulosEdit(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria,nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY editora;');
    return $query->result();
  }

   public function consultaTitulosCategoria(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY descricao;');
    return $query->result();
  }

   public function consultaTitulosDisp(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY qtd_disp DESC;');
    return $query->result();
  }
}
