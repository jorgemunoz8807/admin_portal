<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class Sites extends CI_Controller
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
        redirect("sites/administration");
    }

    function administration()
    {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('sites');
            $crud->set_subject('Directorio de Sitios');
            $crud->set_language('spanish');
            $crud->unset_export();
            $crud->columns('name', 'url', 'owner', 'active', 'fk_language');
            // $crud->required_fields('name', 'url', 'description', 'fk_type', 'fk_owner');

            $crud->set_relation('fk_type', 'types_site', 'type');
            $crud->set_relation('fk_language', 'languages', 'language');
            $crud->set_relation_n_n('parent', 'parents_site', 'sites', 'child_site', 'parent_site', 'name');
            $crud->set_relation_n_n('owner', 'site_owner', 'owners', 'fk_site', 'fk_owner', 'name');
            $crud->set_relation_n_n('icon', 'site_icon', 'icons', 'fk_site', 'fk_icon', 'icon');
            $crud->set_relation_n_n('text', 'site_text', 'text', 'fk_site', 'fk_text', 'text');
            $crud->set_relation_n_n('category', 'sites_categories', 'categories', 'fk_site', 'fk_category', 'category');
            $crud->set_relation_n_n('tags', 'sites_tags', 'tags', 'fk_site', 'fk_tag', 'tag');

            $crud->change_field_type('description', 'text');


//            $crud->callback_add_field('text', array($this, 'field_add_text_callback'));
//            $crud->callback_add_field('icon', array($this, 'field_icon_callback'));

            $crud->display_as('name', 'Nombre')
                ->display_as('url', 'URL')
                ->display_as('description', 'Descripción')
                ->display_as('active', 'Estado')
                ->display_as('date_publication', 'Inicio de Publicidad')
                ->display_as('published_to_date', 'Fin de Publicidad')
                ->display_as('priority', 'Prioridad')
                ->display_as('category', 'Categoría')
                ->display_as('owner', 'Propietario')
                ->display_as('parent', 'Sitios Padre')
                ->display_as('tags', 'Palabras Claves')
                ->display_as('icon', 'Icono')
                ->display_as('text', 'Texto Adicional')
                ->display_as('fk_language', 'Idioma')
                ->display_as('fk_type', 'Tipo de sitio');

            //$crud->change_field_type('name','file');

            /**
             * Insertando campos en las tablas "icons_site" y "add_text"
             */
            $crud->callback_after_insert(array($this, 'after_insert'));
            $crud->callback_before_delete(array($this, 'before_delete_log'));
            $crud->callback_after_update(array($this, 'after_update_log'));

            $output = $crud->render();

            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal mostramos error */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

//------------Functions_CallBack_Field----------------------------------
    /**
     * @param type $value
     * @param type $primary_key
     * @return string
     *
     * Cambiando el campo de la variable 'icon' por un
     * buscador de ficheros.
     */
    function field_icon_callback()
    {
        return '<input type="file" name="img" />';
    }

//----------------------------------------------
    /**
     * @param type $value
     * @param type $primary_key
     * @return type
     *
     * Cambiando el campo de la variable 'text' por un
     * editor de texto.
     */
    function field_add_text_callback($value, $primary_key)
    {
        return '<textarea rows="1" cols="30" name="add_text"></textarea>';
    }

//------------Functions_CallBack_After_Insert----------------------------------
    /**
     * @param type $post_array
     * @param type $primary_key
     *
     * Inserta el el icono en la tabla 'icons_site' correspondiente
     */
    function after_insert($post_array, $primary_key)
    {


        //Inserta el icono en la tabla " site_icon"
//        $insert = array("icon" => $post_array['icon'],
//            "fk_site" => $primary_key
//        );
//        $this->db->insert('icon', $insert);
//        $this->db->insert('site_icon', $insert);
//
//
//        //Inserta el texto adicional en la tabla "site_text"
//        $insert = array("text" => $post_array['text'],
//            "fk_site" => $primary_key
//        );
//        $this->db->insert('site_text', $insert
//        );


        $format = 'DATE_RFC822';
        $time = time();
        $date = standard_date($format, $time);

        $data = array(
            'action' => 'insert',
            'user' => $this->session->userdata('username'),
            'section' => 'Sitios',
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
        $query = $this->db->get_where('sites', array('id' => $primary_key))->row();

        $format = 'DATE_RFC822';
        $time = time();
        $date = standard_date($format, $time);

        $data = array(
            'action' => 'delete',
            'user' => $this->session->userdata('username'),
            'section' => 'Sitios',
            'fk_section' => $query->id,
            'description' => 'Se ha eliminado el sitio  "' . $query->name . '" con URL "' . $query->url . '"',
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
            'section' => 'Sitios',
            'fk_section' => $primary_key,
            'date' => $date
        );
        $this->db->insert('user_log', $data);
    }


    /**
     * Visualiza los datos de un sitio determinado
     */
}