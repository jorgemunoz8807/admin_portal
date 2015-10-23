<?php

/**
 * Created by PhpStorm.
 * User: jorgem
 * Date: 1/21/2015
 * Time: 1:25 PM
 */
class Test extends CI_Controller
{

    function  index()
    {
        $this->load->library('pagination');
        $this->load->library('table');

        $config['base_url'] = base_url() . 'test/index';
        $config['total_rows'] = $this->db->get('tags')->num_rows();
        $config['per_page'] = 10;
        $config['num_links'] = 4;

        $this->pagination->initialize($config);

        $data['records'] = $this->db->get('tags', $config['per_page']);

        $this->load->view('test_view', $data);

    }

}


//        $config['total_rows'] = count($this->db->get('tags')->result());

//        $data = $this->db->get('tags');

//        var_dump($this->db->get('tags'));
//        die;