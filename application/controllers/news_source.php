<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class News_source extends CI_Controller
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

        redirect('news_source/administration');
    }

    function administration()
    {
        try {

            $crud = new Grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('sources');
            $crud->set_subject('Fuentes');
            $crud->set_language('spanish');
            $crud->unset_export();

            $crud->display_as('name', 'Nombre')
                ->display_as('link', 'Enlace (URL)')
                ->display_as('feed_rss', 'RSS (URL)');


            $output = $crud->render();
            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    /*  function testing_after_insert($post_array, $primary_key) {
      $insert = array("id" => $primary_key,
      "test" => 'Ok',
      "images" => 'this is'
      );
      $this->db->insert('testing', $insert);
      //return true;
      }

      function add_field_callback_1() {
      return '+30 <input type="text" maxlength="50" value="" name="images"
      style="width:462px">';
      } */
}