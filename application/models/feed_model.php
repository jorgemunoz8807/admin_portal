<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Feed_model extends CI_Model
{
    public function construct()
    {
        parent::__construct();
    }

    public function get_feeds()
    {
//            $query = $this->db->get('news');
        $query = $this->db->query("SELECT * FROM news WHERE date_time >= CURDATE()");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
          /*  var_dump($data);
            die;*/
            return $data;
        }
    }

}
