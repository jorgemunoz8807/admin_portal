<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class News_categories extends CI_Controller
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

        redirect('news_categories/administration');
    }

    function administration()
    {
        try {
            $crud = new Grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('categories_news');
            $crud->set_subject('Categorías');
            $crud->set_language('spanish');

            $crud->unset_export();

            $crud->display_as('name', 'Nombre')
                ->display_as('active', 'Activo');
            /* Generamos la tabla */
            $output = $crud->render();
            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}