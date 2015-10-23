<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class rss_setting extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

    }

    function index()
    {
        redirect("rss_setting/administration");
    }

    function administration()
    {

        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('feed_rss');
            $crud->set_subject('RSS');
            $crud->set_language('spanish');

            $crud->display_as('fk_source', 'Fuente de Noticia')
                ->display_as('rss', 'RSS')
                ->display_as('category', 'Categorías');


            $crud->set_relation('fk_source', 'sources', 'name');
            $output = $crud->render();

            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function  test(){
        $this->load->view('test_form');
    }


}