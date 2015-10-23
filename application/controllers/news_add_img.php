<?php

class News_add_img extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //cargamos el helper form y url a la vez
        $this->load->helper(array('form', 'url'));
    }

    function index()
    {
        // Revisamos si se ha subido algo
        if (isset($_POST['submit'])) {
            // Cargamos la libreria Upload
            $this->load->library('upload');
        }
        redirect('news_add_img/add_image');

        //
    }

    function add_image()
    {
        //------------------- Imagen #1
        if (!empty($_FILES['userfile']['name'])) {
            // Configuración para el Archivo 1
            $config['upload_path'] = 'assets/uploads/files';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            // Cargamos la configuración del Archivo 1
            $this->upload->initialize($config);

            // Subimos archivo 1
            if ($this->upload->do_upload('userfile')) {
                $data = $this->upload->data();
            } else {
                echo $this->upload->display_errors();
            }
        }

//------------------- Imagen #2
        if (!empty($_FILES['userfile1']['name'])) {
            // La configuración del Archivo 2, debe ser diferente del archivo 1
            // si configuras como el Archivo 1 no hará nada
            $config['upload_path'] = 'assets/uploads/files';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            // Cargamos la nueva configuración
            $this->upload->initialize($config);

            // Subimos el segundo Archivo
            if ($this->upload->do_upload('userfile1')) {
                $data = $this->upload->data();
            } else {
                echo $this->upload->display_errors();
            }
        }
        //------------------- Imagen #3
        if (!empty($_FILES['userfile2']['name'])) {
            // La configuración del Archivo 2, debe ser diferente del archivo 1
            // si configuras como el Archivo 1 no hará nada
            $config['upload_path'] = 'assets/uploads/files';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            // Cargamos la nueva configuración
            $this->upload->initialize($config);

            // Subimos el segundo Archivo
            if ($this->upload->do_upload('userfile2')) {
                $data = $this->upload->data();
            } else {
                echo $this->upload->display_errors();
            }
        }

        //------------------- Imagen #4
        if (!empty($_FILES['userfile3']['name'])) {
            // La configuración del Archivo 2, debe ser diferente del archivo 1
            // si configuras como el Archivo 1 no hará nada
            $config['upload_path'] = 'assets/uploads/files';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            // Cargamos la nueva configuración
            $this->upload->initialize($config);

            // Subimos el segundo Archivo
            if ($this->upload->do_upload('userfile3')) {
                $data = $this->upload->data();
            } else {
                echo $this->upload->display_errors();
            }
        }
        /*  $this->load->view("includes/template", $output); */
    }

}

?>
