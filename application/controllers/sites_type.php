<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class Sites_type extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->model('sites_model');

        if ($this->session->userdata('perfil') == FALSE
            || $this->session->userdata('perfil') != '1'

        ) {
            redirect(base_url() . 'login');
        }
    }

    function index()
    {
        redirect("sites_type/administration");
    }

    function administration()
    {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('types_site');
            $crud->set_subject('Tipos de Sitios');
            $crud->set_language('spanish');
            $crud->unset_export();

            $crud->required_fields('type');
            $crud->display_as('type', 'Tipo');
            $output = $crud->render();


            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}