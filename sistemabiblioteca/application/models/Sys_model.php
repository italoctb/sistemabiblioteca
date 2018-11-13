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
                $query = $this->db->query('select ISBN, titulo, nome_autor, ano_lançamento, editora, descricao, qtd_disp, qtd_copias from LIVROS natural join CATEGORIA natural join LIVROS_HAS_AUTORES natural join AUTORES;');
                return $query->result();
        }

        public function consulta_especifico_USUARIO($username){
                $query = $this->db->query('select * from USUARIO where username ="'.$username.'";');
                return $query->row_object();
        }

        public function consultaProf(){
                $query = $this->db->query('select mat_siape, nome, nome_curso from PROFESSORES natural join USUARIO natural join CURSO;');
                return $query->result();
        }

        public function consultaUSUARIO(){
                $query = $this->db->query('select username, nome, tipoUSUARIO, user_end from USUARIO;');
                return $query->result();
        }

        public function consultaReserva(){
                $query = $this->db->query('select username, nome, titulo, data_reserva, prazo_dev from USUARIO natural join RESERVA natural join LIVROS;');
                return $query->result();
        }

        public function consulta_minhasReservas($username){
                $query = $this->db->query('select ISBN, titulo, data_reserva, prazo_dev from USUARIO natural join RESERVA natural join LIVROS where username = "'.$username.'";');
                return $query->result();
        }
}
