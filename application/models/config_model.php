<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Config_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Carga la base de datos si es necesario
        $this->load->database();
    }

    // Define tus métodos aquí
    private function get_config($key)
    {
        // Obtiene el valor de una configuración por su clave
        $query = $this->db->get_where('config', array('key' => $key));
        if ($query->num_rows() > 0) {
            return $query->row()->value;
        } else {
            return null;
        }
    }

    public function get_img()
    {
        $img = $this->get_config('img');
        return $img;
    }

    public function get_logo()
    {
        $logo = $this->get_config('logo');
        return $logo;
    }

    public function get_bgColor()
    {
        $bgColor = $this->get_config('bgColor');
        return $bgColor;
    }

    public function get_favicon()
    {
        $favicon = $this->get_config('favicon');
        return $favicon;
    }

    public function set_config($key, $value)
    {
        // Establece el valor de una configuración por su clave
        $data = array('value' => $value);
        $this->db->where('key', $key);
        return $this->db->update('config', $data);
    }
}
