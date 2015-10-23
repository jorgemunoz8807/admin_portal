<?
$this->load->library('pagination');
$this->load->library('table');

foreach ($rss as $news) {
    if (!$news == null) {
        foreach ($news as $item) {

            $config['base_url'] = base_url() . 'test/index';
            $config['total_rows'] = count($news);
            $config['per_page'] = 10;
            $config['num_links'] = 4;

            $this->pagination->initialize($config);
            $data['records'] = $this->db->get('tags', $config['per_page']);



            echo $item['title'];
            echo '</br>';
            echo $item['description'];
            echo '</br>';
            echo $item['author'];
            echo '</br>';
            echo $item['pubDate'];
            echo '</br>';
            echo $item['link'];
            echo '</br>';
            echo '**************************************************************';
            echo '</br>';
            echo '**************************************************************';
            echo '</br>';
            echo '**************************************************************';
            echo '</br>';
        }
    }
}
?>
