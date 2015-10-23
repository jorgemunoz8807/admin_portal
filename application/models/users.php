<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model
{

    protected $table;
    protected $id;

    /*
        Constructor del modelo, aqui establecemos
        que tabla utilizamos y cual es su llave primaria.
    */
    function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->id = 'id';
    }

    /*
        Con esta funcion comprobamos que exista el
        usuario en la base de datos, si es asi retornamos
        el contenido del registro, de lo contrario se
        retorna FALSE.
    */
    function get($username = '', $password = '')
    {
        return $this->db->get_where(
            $this->table, array(
                'username' => $username,
                'password' => $password
            )
        )->row();
    }


    //Retorna todos los Perfiles de Usuarios
    function users_perfil_get_where()
    {
        $this->db->select('users.perfil');
        $query = $this->db->get_where('users');
        return $query->result();
    }
}