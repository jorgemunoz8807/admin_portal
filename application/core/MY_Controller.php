<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Private_Controller extends CI_Controller
{

    public $user;

    /*
        La clase Private_Controller hereda de CI_Controller
        ahora aqui establecemos el usuario logueado.
    */
    function __construct()
    {
        parent::__construct();

        // Se carga el modelo de usuarios.
        $this->load->model('users');

        // Se carga el helper url y form.
        $this->load->helper('url');
        $this->load->helper('form');

        // Se carga la libreria form_validation.
        $this->load->library('form_validation');

        // Se le asigna a la informacion a la variable $user.
        $this->user = @$this->session->userdata('logged_user');
    }

}