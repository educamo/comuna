<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		// Carga la librería de base de datos
		$this->load->database();
	}

	public function get_user($username, $password)
	{
		// Consulta la tabla de usuarios con el nombre de usuario y la contraseña
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('users');

		if ($query->num_rows() > 0) // Si hay un resultado
		{
			return $query->row_array(); // Devuelve los datos del usuario
		}
		else // Si no hay resultados
		{
			return 0; // Devuelve 0
		}
    }
}