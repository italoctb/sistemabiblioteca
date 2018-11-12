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

        public function consulta_especifico_Usuario($username){
                $query = $this->db->query('select * from usuario where username ="'.$username.'";');
                return $query->row_object();
        }

        public function consultaProf(){
                $query = $this->db->query('select mat_siape, nome, nome_curso from professores natural join usuario natural join curso;');
                return $query->result();
        }

        public function consultaUsuario(){
                $query = $this->db->query('select username, nome, tipoUsuario, user_end from usuario;');
                return $query->result();
        }

        public function consultaReserva(){
                $query = $this->db->query('select username, nome, titulo, data_reserva, prazo_dev from usuario natural join reserva natural join livros;');
                return $query->result();
        }

        public function consulta_minhasReservas($username){
                $query = $this->db->query('select titulo, data_reserva, prazo_dev from usuario natural join reserva natural join livros where username = "'.$username.'";');
                return $query->result();
        }
}
