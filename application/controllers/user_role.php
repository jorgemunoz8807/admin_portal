<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class User_role extends CI_Controller
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

        redirect('user_role/administration');
    }

    function administration()
    {
        try {
//            $this->output->enable_profiler(TRUE);
            /**
             * Cargar Roles de Usuarios existentes
             */
//            $user_role = $this->users->users_perfil_get_where();
//            $role = array();
//            for ($i = 0; $i < count($user_role); $i++) {
//                $role[$i] = $user_role[$i]->perfil;
//            }


//            var_dump($role);


            $crud = new Grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('users');
            $crud->set_subject('Usuarios');
            $crud->set_language('spanish');
            $crud->unset_export();

            $crud->required_fields('perfil', 'username', 'password');
            $crud->add_fields('username', 'password', 'perfil');
            $crud->display_as('perfil', 'Perfil')
                ->display_as('username', 'Nombre de usuario')
                ->display_as('password', 'Contraseña');

            $crud->set_relation('perfil', 'users_perfil', 'role');

            $crud->field_type('password', 'password');
//            $crud->edit_fields('password', 'password');
//            $crud->field_type('perfil', 'dropdown', array(1 => 'Administrador', 2 => 'Editor'));


            $output = $crud->render();
            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }


}