<?php

class Sites_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    //Se obtien un sistio dependiendo del id que le pasemos
    function sites_get_where($id)
    {

        $query = $this->db->get_where('sites', array('id' => $id));
        if ($query->num_rows() > 0) {
            // sólo retornamos una fila con row(), no result()
            return $query->row();
        }
    }

    //Se obtiene la categoría q corresponde con el $fk_site
    function categories_by_site_get_where($id_category)
    {

        $query = $this->db->get_where('categories_site', array('id' => $id_category));
        if ($query->num_rows() > 0) {
            // sólo retornamos una fila con row(), no result()
            return $query->row();
        }
    }

    //Se obtiene el tipo de sitio q corresponde con el $fk_type
    function type_by_site_get_where($id_type)
    {

        $query = $this->db->get_where('types_site', array('id' => $id_type));
        if ($query->num_rows() > 0) {
            // sólo retornamos una fila con row(), no result()
            return $query->row();
        }
    }

    //Se obtiene el Idioma de sitio q corresponde con el $fk_language
    function language_by_site_get_where($id_language)
    {

        $query = $this->db->get_where('languages', array('id' => $id_language));
        if ($query->num_rows() > 0) {
            // sólo retornamos una fila con row(), no result()
            return $query->row();
        }
    }

    //Se obtiene el Propietario de sitio q corresponde con el $fk_owner
    function owner_by_site_get_where($id_owner)
    {

        $query = $this->db->get_where('owners_site', array('id' => $id_owner));
        if ($query->num_rows() > 0) {
            // sólo retornamos una fila con row(), no result()
            return $query->row();
        }
    }

    //Se obtienen las palabras claves dado el $id del sitio
    function tags_sites_get_where($id)
    {

        $this->db->select('tags_site.tag');
        $this->db->from('tags_site');
        $this->db->join('sites_tags', 'sites_tags.fk_tag = tags_site.id');
        $this->db->join('sites', 'sites.id = sites_tags.fk_site');
        $this->db->where('sites.id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    //Se obtienen los padres dado el $id del sitio
    function parents_sites_get_where($id)
    {
        $this->db->select('parents_site.parent_site');
        $query = $this->db->get_where('parents_site', array('child_site' => $id));
        $parents_id = $query->result();

        // return $parents_id;
        $query = array();
        foreach ($parents_id as $id) {
            $name_parents = $this->db->get_where('sites', array('id' => $id->parent_site));
            array_push($query, $name_parents->result());
        }
        return $query;
    }

    //Se obtienen el texto adicional dado el $id del sitio
    function add_text_sites_get_where($id)
    {
        $this->db->select('add_texts_site.text');
        $query = $this->db->get_where('add_texts_site', array('fk_site' => $id));

        if ($query->num_rows() > 0) {
            // sólo retornamos una fila con row(), no result()
            return $query->row()->text;
        }
    }

    //Se obtienen el icono  dado el $id del sitio
    function icon_sites_get_where($id)
    {
        $this->db->select('icons_site.icon');
        $query = $this->db->get_where('icons_site', array('fk_site' => $id));

        if ($query->num_rows() > 0) {
            // sólo retornamos una fila con row(), no result()
            return $query->row()->icon;
        }
    }

    //Retorna todas las Categorias
    function categories_sites_get_where()
    {
        $this->db->select('categories_site.category');
        $query = $this->db->get_where('categories_site');
        return $query->result();
    }

    //Retorna todos los Tipos de Sitios
    function types_sites_get_where()
    {
        $this->db->select('types_site.type');
        $query = $this->db->get_where('types_site');
        return $query->result();
    }

    //Retorna todos los Idiomas
    function languages_sites_get_where()
    {
        $this->db->select('languages.language');
        $query = $this->db->get_where('languages');
        return $query->result();
    }

    //Retorna todos los Idiomas
    function owners_sites_get_where()
    {
        $this->db->select('owners_site.name');
        $query = $this->db->get_where('owners_site');
        return $query->result();
    }

    //Retorna todas las Palabras Claves
    function all_tags_sites_get_where()
    {
        $this->db->select('tags_site.tag');
        $query = $this->db->get_where('tags_site');
        return $query->result();
    }

    //Retorna todos los Sitios
    function all_sites_get_where()
    {
        $this->db->select('sites.name');
        $query = $this->db->get_where('sites');
        return $query->result();
    }

}

?>
