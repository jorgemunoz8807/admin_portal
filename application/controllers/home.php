<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('perfil') == FALSE
            || $this->session->userdata('perfil') != '1'

        ) {
            redirect(base_url() . 'login');
        }
//        $this->output->enable_profiler(TRUE);
    }

    function index()
    {
//        redirect('home/start_page');
        $this->load->view('home/home_view');

    }

    function start_page()
    {

    }
}

?>
