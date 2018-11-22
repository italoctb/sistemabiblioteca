<?php
class Sys_model extends CI_Model {

  //Conectar ao banco de dados
  public function __construct()
  {
    $this->load->database();
  }

  //Verifica se aquele usuário é valido para ter acesso ao sistema
  public function validation($user, $pass)
  {
    $this->db->where('username', $user);
    $this->db->where('password', sha1($pass));
    $query = $this->db->get('USUARIO');
    return $query->row_array();
  }

  //Retorna todos os títulos do acervo.
  public function consultaTitulos(){
    $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES;');
    return $query->result();
  }

  //Busca todos os professores que são usuários do sistema de determinado curso recebido por parâmetro. 
  public function consultaProfsCurso($curso){
    $query = $this->db->query('select nome, mat_siape, telefone_celular from curso natural join professores natural join usuario where nome_curso ="'.$curso.'";');
    return $query->result();
  }

  //Consulta determinado usuário através do seu nome de login recebido por parâmetro.
  public function consulta_especifico_USUARIO($username){
    $query = $this->db->query('select * from USUARIO where username ="'.$username.'";');
    return $query->row_object();
  }

  //Consulta os livros que pertencem a determinada editora recebida por parâmetro.
  public function consulta_especifico_EDITORA($editora){
    $query = $this->db->query('select * from LIVROS where editora ="'.$editora.'";');
    return $query->row_object();
  }

  //Consulta uma determinada categoria de acordo com seu código recebido por parâmetro.
  public function consulta_categoryBycod($cod){
    $query = $this->db->query('select descricao from CATEGORIA where cod_categoria ="'.$cod.'";');
    return $query->row_object();
  }

  //Consulta todos os livros que pertencem aquele código ISBN recebido por parâmetro.
  public function consulta_especifico_Livro($isbn){
    $query = $this->db->query('select * from LIVROS where ISBN ="'.$isbn.'";');
    return $query->row_object();
  }

  //Consulta todos os livros reservados de determinado código ISBN recebido por parâmetro.
  public function consulta_livro_menu($isbn){
    $query = $this->db->query('select ISBN, titulo, nome, username, data_reserva, prazo_dev from LIVROS natural join EMPRESTIMOS natural join USUARIO where ISBN ='.$isbn.';');
    return $query->result();
  }

  //Consulta o código de um livro cujo título recebido por parâmetro.
  public function consulta_especifico_ISBN($titulo){
    $query = $this->db->query('select ISBN from LIVROS where titulo ="'.$titulo.'";');
    return $query->row_object();
  }

  //Caso não houver parâmetro, será retornado uma consulta de todos os professores vinculados. Caso o valor recebido não for vazio, será retornado a mesma consulta dos professores segundo (nome OU nome do curso OU matricula siape) digitado no campo de pesquisa.
  public function consultaProf($busca=NULL){
    if (empty($busca)) {
      $query = $this->db->query('select * from PROFESSORES natural join USUARIO natural join CURSO;');
    }else{
      $query = $this->db->query("select mat_siape, nome, nome_curso from PROFESSORES natural join USUARIO natural join CURSO where nome like '%".$busca."%' or nome_curso like '%".$busca."%' or mat_siape like '%".$busca."%';");
    }
    return $query->result();
  }
  
  //Caso não houver parâmetro, será retornado uma consulta de todos os usuários vinculados. Caso o valor recebido não for vazio, será retornado a mesma consulta dos usuários segundo  (nome de usuario OU nome OU tipo do usuario) digitado no campo de pesquisa.
  public function consultaUsuario($busca=null){

    if (empty($busca)) {
      $query = $this->db->query("select * from USUARIO;");
    }else{
      $query = $this->db->query("select * from USUARIO where username like '%".$busca."%' or nome like '%".$busca."%' or tipoUsuario like '%".$busca."%';");
    }
    return $query->result();
  }

  //Caso não houver parâmetro, será retornado uma consulta de todos os usuários e seus empréstimos vinculados. Caso o valor recebido não for vazio, será retornado a mesma consulta dos usuários segundo (nome de usuário OU nome OU tipo usuario) digitado no campo de pesquisa.
  public function consultaEmprestimo($busca=null){

    if (empty($busca)) {
      $query = $this->db->query("select * from USUARIO natural join EMPRESTIMOS natural join LIVROS;");
    }else{
      $query = $this->db->query("select * from USUARIO natural join EMPRESTIMOS natural join LIVROS where username like '%".$busca."%' or nome like '%".$busca."%' or tipoUsuario like '%".$busca."%';");
    }
    return $query->result();
  }

  //Caso não houver parâmetro, será retornado uma consulta de todos os usuários e suas reservas vinculados. Caso o valor recebido não for vazio, será retornado a mesma consulta dos usuários segundo (nome de usuário OU código do livro ISBN) digitado no campo de pesquisa.
  public function consultaReserva($ISBN = NULL, $user = NULL){
    if($ISBN == NULL || $user == NULL){
      $query = $this->db->query('select username, nome, titulo, ISBN, data_reserva from USUARIO natural join RESERVA natural join LIVROS;');
      return $query->result();
    }
    $query = $this->db->query('select username, nome, titulo, ISBN, data_reserva from USUARIO natural join RESERVA natural join LIVROS where username = "'.$user.'" and ISBN = "'.$ISBN.'";');
    return $query->row_object();
  }

  //Consulta dos empréstimos vinculados a um usuário cujo nome de usuário foi recebido por parâmetro.
  public function consulta_meusEmprestimos($username){
    $query = $this->db->query('select ISBN, titulo, data_reserva, prazo_dev from USUARIO natural join EMPRESTIMOS natural join LIVROS where username = "'.$username.'";');
    return $query->result();
  }

  //Consulta das reservas vinculados a um usuário cujo nome de usuário foi recebido por parâmetro.
  public function consulta_minhasReservas($username){
    $query = $this->db->query('select ISBN, titulo, data_reserva from USUARIO natural join RESERVA natural join LIVROS where username = "'.$username.'";');
    return $query->result();
  }

  //
  public function registro_usuario($user){
    $this->db->insert('USUARIO', $user);
  }

  //Consulta geral do sistema onde alguns campos de algumas tabelas relacionadas serão exibidos na home
  public function consultaHome($busca=NULL){
    if (empty($busca)) {
      $query = $this->db->query("select * from USUARIO natural join LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES;");
    }else{
      $query = $this->db->query("select * from USUARIO natural join LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES where titulo like '%".$busca."%' or descricao like '%".$busca."%' or nome_autor like '%".$busca."%';");
    };
    return $query->result();
  }

  //Consulta todos os títulos disponíveis na biblioteca e sua disponibilidade.
  public function buscarI($busca){
    $query = $this->db->query("select ISBN, titulo, nome_autor, ano_lançamento, editora, cpf, qtd_disp, qtd_copias, descricao from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES where ISBN = $busca;");
    return $query->row_object();
  }

  //Consulta todos os títulos disponíveis na biblioteca e sua disponibilidade segundo seu código de categoria recebida por parâmetro.
  public function buscarIC($busca){
    $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, cpf, qtd_disp, qtd_copias, descricao from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES where cod_categoria = "'.$busca.'";');
    return $query->result();
  }

  //Consulta todos os títulos disponíveis na biblioteca e sua disponibilidade segundo sua editora recebida por parâmetro.
  public function buscarIE($busca){
    $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, cpf, qtd_disp, qtd_copias, descricao from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES where editora = "'.$busca.'";');
    return $query->result();
  }

  //Consulta dos usuários segundo (nome de usuario OU nome OU tipo do usuario) digitado no campo de pesquisa.
  public function buscarUsuario($busca){
    $busca = $this->input->post('caixap1');
    if (empty($busca)) {
      return array();
    }
    $query = $this->db->query("select username, nome, tipoUsuario, user_end from USUARIO where username like '%".$busca."%' or nome like '%".$busca."%' or tipoUsuario like '%".$busca."%';");
    return $query->result();
  }

  //Recebe o nome de usuário por parâmetro e define qual tipo ele pertence, a consulta retorna todos os dados do usuário
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

  //Recebe o nome de usuário por parâmetro e define qual tipo ele pertence, a consulta retorna os telefones vinculados ao usuário
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

  //As informações são recebidas por parâmetro em um array para realizar a atualização nos dados do usuário desejado.
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

  //Retorna todas as solicitações de cancelamento do cadastro no sistema
  public function requisicoes(){
    $query = $this->db->query('select * from REQUISICAO;');
    return $query->result();
  }

  //Retorna todas os títulos ordenados por código ISBN
  public function consultaTitulosISBN(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY ISBN;');
    return $query->result();
  }

  //Retorna todas os títulos ordenados por título
  public function consultaTitulosNomeObra(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY titulo;');
    return $query->result();
  }

//Retorna todas os títulos ordenados por nome do autor
  public function consultaTitulosAutor(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY nome_autor;');
    return $query->result();
  }

//Retorna todas os títulos ordenados por ano de lançamento
  public function consultaTitulosLançamento(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY ano_lançamento DESC;');
    return $query->result();
  }

  //Retorna todas os títulos ordenados por editora
  public function consultaTitulosEdit(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria,nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY editora;');
    return $query->result();
  }

  //Retorna todas os títulos ordenados por categoria
  public function consultaTitulosCategoria(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY descricao;');
    return $query->result();
  }

  //Retorna todas os títulos ordenados por disponibilidade
  public function consultaTitulosDisp(){
      $query = $this->db->query('select ISBN, titulo, cod_categoria, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_has_AUTORES natural join AUTORES ORDER BY qtd_disp DESC;');
    return $query->result();
  }
}
