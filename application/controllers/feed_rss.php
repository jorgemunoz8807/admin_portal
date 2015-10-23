<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Feed_rss extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('feed_model');
    }

    public function index()
    {
        $data['feed_name'] = 'Portal Cuba';
        $data['encoding'] = 'utf-8';
        $data['titulo'] = 'Portal Cuba';
        $data['author'] = 'Portal Cuba';
        $data['feed_url'] = base_url() . 'feed_rss';
        $data['page_language'] = 'es';
        $data['page_description'] = ' Servicio de noticias del Portal Cuba';
        $data['webmaster'] = 'jorgem@citmatel.inf.cu';
       /* $data['date_rss'] = date(DATE_RSS);*/

        header("Content-Type: application/rss+xml; charset=utf-8");
//        header('Content-Type: text/html; charset=utf-8');

        $data['list_news'] = $this->feed_model->get_feeds();
        //cargamos la vista con el array data que tiene todo lo que necesitamosd
        $this->load->view('feed_RSS/feed_view', $data);
    }
}
