<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class Banner extends CI_Controller
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
        redirect('banner/administration');
    }

    function administration()
    {
        try {

            $crud = new Grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('banners');
            $crud->set_subject('banner');
            $crud->set_language('spanish');
            $crud->unset_export();

            $crud->columns('title', 'category', 'fk_type', 'parent', 'active');
//
            $crud->set_relation('fk_type', 'types_banner', 'type');
            $crud->set_relation_n_n('owner', 'banner_owner', 'owners', 'fk_banner', 'fk_owner', 'name');
            $crud->set_relation_n_n('category', 'banner_categories', 'categories', 'fk_banner', 'fk_category', 'category');
            $crud->set_relation_n_n('parent', 'banners_parent', 'banners', 'fk_child', 'fk_parent', 'title');
            $crud->set_relation_n_n('tags', 'banner_tag', 'tags', 'fk_banner', 'fk_tag', 'tag');
//            $crud->set_relation_n_n('text', 'banner_text', 'text', 'fk_banner', 'fk_text', 'text');


            $crud->change_field_type('like', 'hidden');

            $crud->display_as('title', 'Título')
                ->display_as('sumary', 'Sumario')
                ->display_as('email', 'Correo')
                ->display_as('date_publication', 'Inicio de publicidad')
                ->display_as('published_to_date', 'Fin de publicidad')
                ->display_as('active', 'Estado')
                ->display_as('priority', 'Prioridad')
                ->display_as('category', 'Categoría')
                ->display_as('fk_type', 'Tipo')
                ->display_as('owner', 'Propietario')
                ->display_as('parent', 'Banner padre')
                ->display_as('tags', 'Palabras claves');


//            $crud->callback_add_field('text', array($this, 'field_add_text_callback'));

//            $crud->callback_after_insert(array($this, 'after_insert'));

            $output = $crud->render();

            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    /**
     * @param type $value
     * @param type $primary_key
     * @return type
     *
     * Cambiando el campo de la variable 'text' por un
     * editor de texto.
     */
    function field_add_text_callback()
    {
        return '<textarea rows="1" cols="30" name="text"></textarea>';


    }

    /**
     * @param type $post_array
     * @param type $primary_key
     *
     * Inserta el el icono en la tabla 'icons_site' correspondiente
     */
    function after_insert($post_array, $primary_key)
    {

        /*  //Inserta el icono en la tabla " banner_icon"
          $insert = array("icon" => $post_array['icon'],
          "fk_site" => $primary_key
          );
          $this->db->insert('icon', $insert);
          $this->db->insert('site_icon', $insert);

         */
        //Inserta el texto adicional en la tabla "banner_text"
        $insert = array("text" => $post_array['text'],
            "fk_site" => $primary_key
        );
        $this->db->insert('site_text', $insert
        );
    }

}