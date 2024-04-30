<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Usuarios extends CI_Controller {
    
    public function index(){
        
        $data = array(
            'titulo' => 'Usuários',
            'sub_titulo' => 'Listando todos os usuários cadastrados no sistema',
            
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),  
            
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/systemCopa.js',
            ), 
            
            'usuarios' => $this->ion_auth->users()->result(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/usuarios');
        $this->load->view('layout/footer');
    }
}