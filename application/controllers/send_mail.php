<?php

class Send_Mail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    function index()
    {

        redirect('send_mail/sendMail');
    }
    public function sendMail()
    {
        //cargamos la libreria email de ci
        $this->load->library("email");

        //configuracion para gmail
        $configGmail = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.citmatel.inf.cu',
            'smtp_port' => 25,
            'smtp_user' => 'jorgem',         //Usuario del dominio real.
            'smtp_pass' => 'smtp_password',  //Password del dominio real.
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );

        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configGmail);

        $this->email->from('celma');
        $this->email->to("jorgem@citmatel.inf.cu");
//        $this->email->cc('celma@citmatel.inf.cu');
        $this->email->subject('Probando');
        $this->email->message('<h2>Email enviado con codeigniter haciendo uso del smtp de Paco</h2><hr><br> Te lo digo y lo repito symfnony no sirve es Codeigniter lo que hay pa ustedes');
        $this->email->send();
        //con esto podemos ver el resultado
        var_dump($this->email->print_debugger());
    }

}