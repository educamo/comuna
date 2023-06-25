<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// Carga la librería de base de datos
		$this->load->database();
	}

	public function get_user($username, $password)
	{
		// Consulta la tabla de usuarios con el nombre de usuario y la contraseña
		$activo = 1;
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where('activo', $activo);
		$query = $this->db->get('users');

		if ($query->num_rows() > 0) // Si hay un resultado
		{
			return $query->row_array(); // Devuelve los datos del usuario
		} else // Si no hay resultados
		{
			return 0; // Devuelve 0
		}
	}

	// Inserta los datos del usuario en la tabla user
	function insertUser($data)
	{
		return $this->db->insert('users', $data);
	}


	public function __destruct()
	{
		$this->db->close();
	}
}
