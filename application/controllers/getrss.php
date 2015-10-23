<?php

/**
 * Created by PhpStorm.
 * User: jorgem
 * Date: 4/7/2015
 * Time: 12:23 PM
 */
class getrss extends CI_Controller
{

    function get_ars()
    {
        // Load RSS Parser
        $this->load->library('rssparser');

        // Get 6 items from granma
        $rss = $this->rssparser->set_feed_url('http://www.granma.cu/feed')->set_cache_life(30)->getFeed(6);

        foreach ($rss as $item) {
            echo $item['title'];
            echo $item['description'];
        }
    }


    /*    function get_logistics_news()
        {
            // Load RSS Parser
            $this->load->library('rssparser');

            // Get RSS
            $rss[] = $this->rssparser->set_feed_url('http://www.3plwire.com/feed/')->set_cache_life(30)->getFeed(1);
            $rss[] = $this->rssparser->set_feed_url('http://www.supplychain.cn/en/rss/articles/')->set_cache_life(30)->getFeed(1);

            foreach ($rss as $feed) {
                foreach ($feed as $item) {
                    echo $item['title'];
                    echo $item['description'];
                }
            }
        }*/

} 