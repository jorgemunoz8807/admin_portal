<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */

class News_rss extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('rssparser', 'pagination', 'table'));


    }

    function index()
    {
        redirect('news_rss/get_rss');
    }

    /*   function get_rss()
       {
           //All my rss_source from 'sources' table.

           $config['base_url'] = base_url() . 'news_rss/get_rss';
           $config['total_rows'] = $this->db->get('news_rss')->num_rows();
           $config['per_page'] = 10;
           $config['num_links'] = 4;
           $this->pagination->initialize($config);


           $list_src = $this->db->get('feed_rss')->result();
           $this->db->empty_table('news_rss');
           foreach ($list_src as $src) {
               $rss = $this->rssparser->set_feed_url($src->rss)->set_cache_life(30)->getFeed(50);
               foreach ($rss as $news) {
                   $this->db->insert('news_rss', $news);
               }
           }
           //        $config['full_tag_open'] = '<p>';
           //        $config['full_tag_close'] = '</p>';

           $this->db->select('title, description, author, link');
           $rss_output['records'] = $this->db->get('news_rss', $config['per_page'], $this->uri->segment(3));

           $this->load->view('includes/template', $rss_output);
           //        $this->load->view('test_view', $rss_output);
           //        $this->load->view('news/news_rss_view', $output);
           //        $this->load->view('news/news_rss_view', $rss);
       }
   */
    function get_rss()
    {
        //Set configuration to rssparser.
        $config['base_url'] = base_url() . 'news_rss/get_rss';
        $config['total_rows'] = $this->db->get('news_rss')->num_rows();
        $config['per_page'] = 10;
        $config['num_links'] = 4;
        /* $config['cur_tag_open'] = '<ul class="pagination" ><li >';
         $config['cur_tag_close'] = '</a ></li ></ul >';*/
        $config['full_tag_open'] = '<ul class="pagination paginate_disabled_next" ><li >';
        $config['full_tag_close'] = '</a ></li ></ul >';


        $this->pagination->initialize($config);

        //Get list RSS from database.
        $list_src = $this->db->get('feed_rss')->result();

        $output = array();
        foreach ($list_src as $src) {
            $rss = $this->rssparser->set_feed_url($src->rss)->set_cache_life(30)->getFeed(50);
            foreach ($rss as $news) {
                array_push($output, $news);
            }
        }

        $rss_output['records'] = array_slice($output, $this->uri->segment(3), $config['per_page']);
//        var_dump($rss_output);
//        die;
//        $this->load->view('includes/template', $rss_output);
        $this->load->view('home', $rss_output);
    }
}