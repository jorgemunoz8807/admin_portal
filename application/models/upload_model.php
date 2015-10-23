<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_model extends CI_Model
{

    public function construct()
    {
        parent::__construct();
    }

    /**
     * Función para guardar imagenes en la tabla "images"
     *
     * @param type $imagen Imagen que se desea guardar
     * @param type $description Descripcion de la imagen a guardar
     */
    function upload_img($imagen, $description)
    {
        $data = array(
            'image' => $imagen,
            'description' => $description
        );


        $this->db->insert('images', $data);
    }

    /**
     * Inserta los "id" de "images" y ""news" en la tabla  "news_image" (Relación)
     */
    function upload_news_img()
    {

        $this->db->select_max('id');
        $fk_news = $this->db->get('news');

        $this->db->select_max('id');
        $fk_image = $this->db->get('images');

        $data = array(
            'fk_news' => $fk_news->row()->id,
            'fk_image' => $fk_image->row()->id
        );

        $this->db->insert('news_image', $data);
    }

}