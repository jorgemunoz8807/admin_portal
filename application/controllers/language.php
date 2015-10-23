<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class Language extends CI_Controller
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
        redirect("language/administration");
    }

    function administration()
    {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('languages');
            $crud->set_subject('Idioma');
            $crud->set_language('spanish');

            $crud->unset_export();

            $crud->display_as('language', 'Idioma')
                ->display_as('acronym', 'Abreviatura');


            $crud->callback_after_insert(array($this, 'after_insert_log'));
            $crud->callback_before_delete(array($this, 'before_delete_log'));
            $crud->callback_after_update(array($this, 'after_update_log'));


            $output = $crud->render();

            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    /**
     * Registro de trazas al insertar datos
     */
    function after_insert_log($post_array, $primary_key)
    {
        $format = 'DATE_RFC822';
        $time = time();
        $date = standard_date($format, $time);

        $data = array(
            'action' => 'insert',
            'user' => $this->session->userdata('username'),
            'section' => 'Idiomas',
            'fk_section' => $primary_key,
            'date' => $date

        );
        $this->db->insert('user_log', $data);
    }

    /**
     * Registro de trazas al eliminar datos
     */
    function before_delete_log($primary_key)
    {
        $query = $this->db->get_where('languages', array('id' => $primary_key))->row();

        $format = 'DATE_RFC822';
        $time = time();
        $date = standard_date($format, $time);

        $data = array(
            'action' => 'delete',
            'user' => $this->session->userdata('username'),
            'section' => 'Idiomas',
            'fk_section' => $query->id,
            'description' => 'Se ha eliminado el idioma "' . $query->language . '" de abreviatura "' . $query->acronym . '"',
            'date' => $date
        );
        $this->db->insert('user_log', $data);
    }

    /**
     * Registro de trazas al actualizar datos
     */
    function after_update_log($value, $primary_key)
    {
        $format = 'DATE_RFC822';
        $time = time();
        $date = standard_date($format, $time);

        $data = array(
            'action' => 'update',
            'user' => $this->session->userdata('username'),
            'section' => 'Idiomas',
            'fk_section' => $primary_key,
            'date' => $date
        );
        $this->db->insert('user_log', $data);
    }
}