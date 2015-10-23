<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class News extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('perfil') == FALSE
            || $this->session->userdata('perfil') != '1'

        ) {
            redirect(base_url() . 'login');
        }
//        $this->output->enable_profiler(TRUE);
    }

    function index()
    {
        redirect("news/administration");
    }

    /*
     *
     * */

    function administration()
    {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('news');
            $crud->set_subject('Noticias');
            $crud->set_language('spanish');
            $crud->unset_export();

            $crud->columns('title', 'author', 'summary', 'date_time', 'active');
            $crud->required_fields('title', 'author', 'fk_source', 'date_time', 'priority', 'category', 'tags');
//            $crud->add_fields('title', 'author', 'image', 'footer_text', 'date_time', 'url', 'summary', 'text', 'fk_source', 'priority', 'active', 'category', 'tags', 'img');

            $crud->set_relation('fk_source', 'sources', 'name');
            $crud->set_relation_n_n('category', 'news_categories', 'categories', 'fk_news', 'fk_category', 'category');
            $crud->set_relation_n_n('tags', 'news_tags', 'tags', 'fk_news', 'fk_tag', 'tag');

            $crud->set_field_upload('image', 'assets/uploads/news/');

            $crud->display_as('title', 'Título')
                ->display_as('summary', 'Sumario')
                ->display_as('text', 'Texto')
                ->display_as('author', 'Autor')
                ->display_as('date_time', 'Fecha')
                ->display_as('active', 'Estado')
                ->display_as('comment_url', 'URL')
                ->display_as('comment_count', 'Comentarios')
                ->display_as('category', 'Categoría')
                ->display_as('tags', 'Palabras Claves')
                ->display_as('image', 'Imagen principal')
                ->display_as('priority', 'Prioridad')
                ->display_as('fk_source', 'Fuente')
                ->display_as('img', 'Imágenes Adicionales')
                ->display_as('footer_text', 'Texto de imagen');

            $crud->set_relation_n_n('img', 'news_image', 'images', 'fk_news', 'fk_image', 'image');
//            $crud->set_field_upload('img', 'assets/uploads/news/');


//            $crud->set_field_upload('img', 'uploads/news/');

//            $crud->callback_add_field('img', array($this, 'add_field_image_callback'));
//            $crud->callback_edit_field('img', array($this, 'edit_field_image_callback'));


            /* Generamos la tabla */

//            $crud->callback_after_insert(array($this, 'after_insert'));
//            $crud->callback_before_delete(array($this, 'before_delete_log'));
//            $crud->callback_after_update(array($this, 'after_update_log'));


//
            $output = $crud->render();

            $this->load->view('includes/template', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    /**
     * Adicion de campos en Agregar Noticia.
     * @return string
     */
    function add_field_image_callback($var)
    {

        return '
     <div>
         <label>Descripción</label>
         <br/>
       <input id="field-comment_url" name="description" type="text" value=""  maxlength="128">
         <br/>
         <input  type="file" name="img"/>
         <br/>
         <br/>

      </div>

      <div>
         <label>Descripción</label>
         <br/>
        <input id="field-comment_url" name="description1" type="text" value=""  maxlength="128">
         <br/>
         <input type="file" name="img1" />
         <br/>
         <br/>
      </div>
       <div>
         <label>Descripción</label>
         <br/>
        <input id="field-comment_url" name="description2" type="text" value=""  maxlength="128">
         <br/>
         <input type="file" name="img2" />
         <br/>
      </div>';
    }

    /**
     *  Adicion de campos en Editar Noticia.
     * @return string
     */
    function edit_field_image_callback($value, $primary_key)
    {
        $this->load->model('news_model');
        $images_id = $this->news_model->news_images_get_where($primary_key);

        $fk_images = '';
        $fk_images1 = '';
        $fk_images2 = '';

        $img = '';
        $img1 = '';
        $img2 = '';

        $description = '';
        $description1 = '';
        $description2 = '';

        if (count($images_id) == 1) {
            $fk_images = $images_id[0]->fk_image;
            $description = $this->news_model->images_get_where($fk_images)->description;

            $img = $this->news_model->images_get_where($fk_images)->image;
        }

        if (count($images_id) == 2) {
            $fk_images = $images_id[0]->fk_image;
            $fk_images1 = $images_id[1]->fk_image;

            $description = $this->news_model->images_get_where($fk_images)->description;
            $description1 = $this->news_model->images_get_where($fk_images1)->description;

            $img = $this->news_model->images_get_where($fk_images)->image;
            $img1 = $this->news_model->images_get_where($fk_images)->image;
        }

        if (count($images_id) == 3) {
            $fk_images = $images_id[0]->fk_image;
            $fk_images1 = $images_id[1]->fk_image;
            $fk_images2 = $images_id[2]->fk_image;

            $description = $this->news_model->images_get_where($fk_images)->description;
            $description1 = $this->news_model->images_get_where($fk_images1)->description;
            $description2 = $this->news_model->images_get_where($fk_images2)->description;

            $img = $this->news_model->images_get_where($fk_images)->image;
            $img1 = $this->news_model->images_get_where($fk_images)->image;
            $img2 = $this->news_model->images_get_where($fk_images)->image;
        }


        return '

<div>
    <img src="' . base_url() . 'assets/uploads/news/' . $img . '" height="50"  href="' . base_url() . 'uploads/news/' . $img . '"/>
    <a class="delete-anchor" id="delete_1122390802" href="' . base_url() . 'news/delete_img">eliminar</a>
    <input type="file" name="img"/>
    <br/>

    <input id="field-comment_url" name="comment_url" type="text" value="' . $description . '" maxlength="128">
    <br/>
    <br/>
    <br/>

</div>

<div>
    <img src="' . base_url() . 'assets/uploads/news/' . $img1 . '" height="50">
    <a class="delete-anchor" id="delete_1122390802" href="javascript:void(0)">eliminar</a>
    <input  type="file" name="img"/>
    <br/>
    <input id="field-comment_url" name="comment_url" type="text" value="' . $description1 . '" maxlength="128">
    <br/>
    <br/>
    <br/>
</div>

<div>
    <img src="' . base_url() . 'assets/uploads/news/' . $img2 . '" height="50">
    <a class="delete-anchor" id="delete_1122390802" href="javascript:void(0)">eliminar</a>
    <input  type="file" name="img"/>
    <br/>
    <input id="field-comment_url" name="comment_url" type="text" value="' . $description2 . '" maxlength="128">
    <br/>
    <br/>
</div>
        ';
    }

    /**
     * Inserta las imagenes luego del insert natural del grocery
     */
    function after_insert($post_array, $primary_key)
    {
        $config['upload_path'] = 'assets/uploads/news/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width'] = '2024';
        $config['max_height'] = '2008';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('img')) {
            $img = $this->upload->data();

            $this->upload_model->upload_img($img['file_name'], $_POST['description']);
            $this->upload_model->upload_news_img();
        }
        if ($this->upload->do_upload('img1')) {
            $img = $this->upload->data();
            $this->upload_model->upload_img($img['file_name'], $_POST['description1']);
            $this->upload_model->upload_news_img();
        }
        if ($this->upload->do_upload('img2')) {
            $img = $this->upload->data();
            $this->upload_model->upload_img($img['file_name'], $_POST['description2']);
            $this->upload_model->upload_news_img();
        }

        $format = 'DATE_RFC822';
        $time = time();
        $date = standard_date($format, $time);

        $data = array(
            'action' => 'insert',
            'user' => $this->session->userdata('username'),
            'section' => 'Noticias',
            'fk_section' => $primary_key,
            'date' => $date
        );
        $this->db->insert('user_log', $data);
    }


    function before_delete_log($primary_key)
    {
        $query = $this->db->get_where('news', array('id' => $primary_key))->row();

        $format = 'DATE_RFC822';
        $time = time();
        $date = standard_date($format, $time);

        $data = array(
            'action' => 'delete',
            'user' => $this->session->userdata('username'),
            'section' => 'Noticias',
            'fk_section' => $query->id,
            'description' => 'Se ha eliminado la noticia  "' . $query->title . '" de autor "' . $query->author . '"',
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
            'section' => 'Noticias',
            'fk_section' => $primary_key,
            'date' => $date
        );
        $this->db->insert('user_log', $data);
    }


//   /**
//    * Funcion para adicionar imagenes a una noticia específica
//    * @param type $var
//    */
//   function add_image($var) {
//      $add_img = $this->load->view('news/news_img_view');
//      // $this->load->view('includes/template', $add_img);
//   }


}