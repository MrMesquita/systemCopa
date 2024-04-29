<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Usuarios extends CI_Controller {
    
    public function index(){
        
        $data = array(
            'titulo' => 'Usuários',
            'sub_titulo' => 'Listando todos os usuários cadastrados no sistema',
            'usuarios' => $this->ion_auth->users()->result(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/usuarios');
        $this->load->view('layout/footer');
    }
}