<?php
class Site extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // Carga el modelo de login
    $this->load->model(array('config_model'));

    //Carga la librería de form_validation
    $this->load->library(array('form_validation'));

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

  // Método para mostrar la página principal del módulo de administración
  public function index()
  {
    // Cargamos la vista admin/index.php y le pasamos algunos datos
    $data['titulo'] = 'Módulo de administración';
    // $data['usuarios'] = $this->usuario_model->get_all(); // Suponiendo que tenemos un modelo llamado usuario_model
    $vista = 'admin/dashboard ';
    $this->plantilla($vista);
  }

  private function plantilla($vista = '', $data = '')
  {
    $this->load->view('admin/head');
    $this->load->view('admin/menu');
    $this->load->view('admin/sidebar');
    $this->load->view($vista, $data);
    $this->load->view('admin/footer');
  }

  // Método para cerrar sesión en el módulo de administración
  public function logout()
  {
    // Eliminamos los datos del usuario de la sesión y lo redirigimos a la página de inicio de sesión
    $this->session->unset_userdata('usuario');
    redirect('admin/login');
  }
}
