<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Carga el modelo de login
		$this->load->model('Login_model');
	}

	public function index()
	{
		// Muestra la vista de login
		$this->load->view('login');
	}

	public function loginchk()
	{
		// Obtiene los valores del formulario
		$username = $this->input->post('txt_username');
		$password = $this->input->post('txt_password');

		// Establece las reglas de validación
		$this->form_validation->set_rules('txt_username', 'Usuario', 'trim|required');
		$this->form_validation->set_rules('txt_password', 'Contraseña', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			// La validación falla, muestra la vista de login con los errores
			$this->load->view('login');
		}
		else
		{
			// La validación pasa, verifica si el usuario y la contraseña son correctos
			$usr_result = $this->Login_model->get_user($username, $password);
			if ($usr_result > 0) // El usuario existe y está activo
			{
				// Establece las variables de sesión
				$sessiondata = array(
					'username' => $username,
					'loginuser' => TRUE
				);
				$this->session->set_userdata($sessiondata);
				redirect('site/members'); // Redirige a la página de miembros
			}
			else
			{
				// El usuario o la contraseña son incorrectos, muestra un mensaje de error
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Usuario o contraseña inválidos</div>');
				redirect('login/index'); // Redirige a la página de login
			}
		}
    }
}