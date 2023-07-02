<?php
class Admin extends CI_Controller {

  // Método para mostrar la página principal del módulo de administración
  public function index() {
    // Cargamos la vista admin/index.php y le pasamos algunos datos
    $data['titulo'] = 'Módulo de administración';
    $data['usuarios'] = $this->usuario_model->get_all(); // Suponiendo que tenemos un modelo llamado usuario_model
    $this->load->view('admin/index', $data);
  }

  // Método para iniciar sesión en el módulo de administración
  public function login() {
    // Validamos los datos del formulario usando la librería form_validation
    $this->load->library('form_validation');
    $this->form_validation->set_rules('usuario', 'Usuario', 'required');
    $this->form_validation->set_rules('contrasena', 'Contraseña', 'required');

    if ($this->form_validation->run() == FALSE) {
      // Si hay errores de validación, mostramos la vista admin/login.php con los mensajes de error
      $this->load->view('admin/login');
    } else {
      // Si no hay errores de validación, verificamos las credenciales del usuario usando el modelo admin_model
      $usuario = $this->input->post('usuario');
      $contrasena = $this->input->post('contrasena');
      $valido = $this->admin_model->check_login($usuario, $contrasena); // Suponiendo que tenemos un modelo llamado admin_model

      if ($valido) {
        // Si las credenciales son válidas, guardamos los datos del usuario en la sesión y lo redirigimos a la página principal del módulo
        $this->session->set_userdata('usuario', $usuario);
        redirect('admin/index');
      } else {
        // Si las credenciales no son válidas, mostramos un mensaje de error y volvemos a cargar la vista admin/login.php
        $data['error'] = 'Usuario o contraseña incorrectos';
        $this->load->view('admin/login', $data);
      }
    }
  }

  // Método para cerrar sesión en el módulo de administración
  public function logout() {
    // Eliminamos los datos del usuario de la sesión y lo redirigimos a la página de inicio de sesión
    $this->session->unset_userdata('usuario');
    redirect('admin/login');
  }

}
