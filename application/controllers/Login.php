<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Carga el modelo de login
		$this->load->model(array('Login_model', 'config_model'));

		//Carga la librería de form_validation
		$this->load->library('form_validation');

		//cargar variables globales de configuracion
		$logo = $this->config_model->get_logo();
		$imagen = $this->config_model->get_img();
		$bgColor = $this->config_model->get_bgColor();
		$favicon = $this->config_model->get_favicon();

		$GLOBALS['logo'] = $logo;
		$GLOBALS['imagen'] = $imagen;
		$GLOBALS['bgColor'] = $bgColor;
		$GLOBALS['favicon'] = $favicon;
	}

	/**
	 * index function
	 * description: carga por defecto la view login
	 * @return void
	 * @date: [23/06/2023]
	 */
	public function index()
	{
		if ($this->session->has_userdata('username')) {
			// La sesión tiene la variable 'username'
			redirect('site'); // Redirige a la página de miembros
		} else {
			// La sesión no tiene la variable 'username'
			$this->load->view('login'); // Muestra la vista de login
		}
	}

	/**
	 * loginchk function
	 * description: chequea si el usuario existe para iniciar session
	 * @return void
	 * @date: [25/06/2023]
	 */
	public function loginchk()
	{
		// Obtiene los valores del formulario
		$username = $this->input->post('txt_username');
		$password = $this->input->post('txt_password');


		// Establece las reglas de validación
		$this->form_validation->set_rules('txt_username', 'Usuario', 'trim|required|valid_email');
		$this->form_validation->set_rules('txt_password', 'Contraseña', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			// La validación falla, muestra la vista de login con los errores
			$this->load->view('login');
		} else {
			// La validación pasa, verifica si el usuario y la contraseña son correctos
			$usr_result = $this->Login_model->get_user($username, $password);
			if ($usr_result > 0) // El usuario existe y está activo
			{
				// Establece las variables de sesión
				$sessiondata = array(
					'username'  => $username,
					'rol'	    => usr_result['rol'],
					'loginuser' => TRUE
				);
				$this->session->set_userdata($sessiondata);
				redirect('site'); // Redirige a la página de miembros
			} else {
				// El usuario o la contraseña son incorrectos, muestra un mensaje de error
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Usuario o contraseña inválidos</div>');
				redirect('login'); // Redirige a la página de login
			}
		}
	}

	public function register()
	{
		// Set the validation rules
		$this->form_validation->set_rules('first_name', 'Nombre', 'trim|required|alpha|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('last_name', 'Apellido', 'trim|required|alpha|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('email', 'Correo electrónico', 'trim|required|valid_email|is_unique[users.userName]');
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirmar contraseña', 'required|matches[password]');

		// Validate the form data
		if ($this->form_validation->run() == FALSE) {
			// If there are errors, reload the form view
			$this->load->view('registroUser');
		} else {
			// If there are no errors, insert the user's data into the database
			$data = array(
				'userName' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'activo' => 1,
				'rol' => 'user'
			);

			// Insert the data into the user table
			if ($this->Login_model->insertUser($data)) {
				// If they were inserted correctly
				$this->session->set_flashdata('status', 'Se ha registrado exitosamente.');
				redirect('/');
			} else {
				// If there was an error inserting the data, display an error message and reload the form view
				$this->session->set_flashdata('status', 'Hubo un problema al registrarse. Inténtalo de nuevo.');
				$this->load->view('registroUser');
			}
		}
	}



	public function registroUsuario()
	{
		if ($this->session->has_userdata('username')) {
			// La sesión tiene la variable 'username'
			redirect('site'); // Redirige a la página de miembros
		} else {
			$this->load->view('registroUser'); // muestra la vista de registrar usuarios
		}
	}
}
