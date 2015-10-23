<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class Useful_info extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

//        $this->load->model('sites_model');

        if ($this->session->userdata('perfil') == FALSE
            || $this->session->userdata('perfil') != '1'

        ) {
            redirect(base_url() . 'login');
        }
    }

    function index()
    {
        redirect('useful_info/administration');
    }

    function administration()
    {
        try {

            $crud = new Grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('useful_info');
            $crud->set_subject('Informaciones Útiles');
            $crud->set_language('spanish');
            $crud->unset_export();

            $crud->columns('question', 'active', 'sites', 'banner');

            $crud->set_relation_n_n('sites', 'useful_info_sites', 'sites', 'fk_useful_info', 'fk_site', 'name');
            $crud->set_relation_n_n('banner', 'useful_info_banner', 'banners', 'fk_useful_info', 'fk_banner', 'title');


            $crud->display_as('question', 'Pregunta')
                ->display_as('active', 'Estado')
                ->display_as('priority', 'Prioridad')
                ->display_as('sites', 'Sitio');

            $output = $crud->render();
            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }


}