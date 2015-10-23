<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class User_log extends CI_Controller
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

        redirect('user_log/administration');
    }

    function administration()
    {
        try {
//
            $crud = new Grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('user_log');
            $crud->set_subject('Trazas de Usuarios');
            $crud->set_language('spanish');
            $crud->unset_export();

            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
//            $crud->unset_operations();

            $crud->columns('action', 'user', 'section', 'description', 'date');
            $crud->display_as('action', 'Acción')
                ->display_as('user', 'Usuario')
                ->display_as('section', 'Sección')
                ->display_as('description', 'Descripción')
                ->display_as('date', 'Fecha');


            $output = $crud->render();
            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }


}