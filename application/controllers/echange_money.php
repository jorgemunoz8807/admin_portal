<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class Echange_money extends CI_Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function index()
    {

        redirect('echange_money/administration');
    }

    function administration()
    {
        try {

            $crud = new Grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('rates_change');
            $crud->set_subject('Cambio de Moneda');
            $crud->set_language('spanish');
            $crud->unset_export();

            $crud->set_relation('fk_operation', 'operation', 'operation');

            $crud->display_as('coin', 'Moneda')
                ->display_as('change', 'Cambio')
                ->display_as('fk_operation', 'Operación');

            $output = $crud->render();
            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}