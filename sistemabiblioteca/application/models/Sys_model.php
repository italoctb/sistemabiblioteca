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
                $query = $this->db->get('usuario');
                return $query->row_array();
        }

        public function consultaTitulos(){
                $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from livros natural join categoria natural join livros_has_autores natural join autores;');
                return $query->result();
        }

        public function consultaNivelUsuario($username){
                $query = $this->db->query('select nivel_usuario from usuario where username ="'.$username.'";');
                return $query->row_object();
        }
}
