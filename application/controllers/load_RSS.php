<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Load_RSS extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        // Load RSS Parser
        $this->load->library('rssparser');

        // Get 6 items from granma

        $rss = $this->rssparser->set_feed_url('http://www.granma.cu/feed')->set_cache_life(30)->getFeed(50);


        $iter = 1;
        foreach ($rss as $item) {
            echo $iter . $item['title'];
            echo '</br>';

            $iter = $iter + 1;
//            echo $item['description'];
        }
    }
} 