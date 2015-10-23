<?php

/**
 * Created by PhpStorm.
 * User: jorgem
 * Date: 1/15/2015
 * Time: 11:30 AM
 */
class Metas extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('perfil') == FALSE
            || $this->session->userdata('perfil') != '1'

        ) {
            redirect(base_url() . 'login');
        }
    }

    function index()
    {
//        $this->load->view('includes/template');
        redirect("metas/administration");
    }

    function administration()
    {
        try {

            $crud = new Grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('metas');
            $crud->set_subject('Meta Datos');
            $crud->set_language('spanish');
            $crud->unset_export();

//            $crud->columns('nombre', 'fk_charset', 'fk_lang', 'active', 'contenido');
            $crud->add_fields('nombre', 'contenido', 'activo');

//            $crud->set_relation('fk_charset', 'meta_charset', 'charset');
//            $crud->set_relation('fk_lang', 'languages', 'language');


            $crud->display_as('activo', 'Estado');

            $output = $crud->render();
            $this->load->view('includes/template', $output);

        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }


    }

    function start_page()
    {

    }
}

?>
