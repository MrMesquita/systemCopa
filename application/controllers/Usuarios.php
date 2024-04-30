<?php

defined('BASEPATH') or exit('Ação não permitida!');

class Usuarios extends CI_Controller{

    public function index(){

        $data = array(
            'titulo' => 'Usuários',
            'sub_titulo' => 'Listando todos os usuários cadastrados no sistema',
            'icon_view' => 'ik ik-users bg-blue',

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

    public function core($user_id = NULL){
        if (!$user_id) {
            // Cadastrar novo usuario
        } else {
            // Editar usuário

            if (!$this->ion_auth->user($user_id)->row()) {
                exit('Usuário não existe');
            } else {
                //Pode editar

                $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[2]|max_length[30]');
                $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[2]|max_length[30]');
                $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[2]|max_length[30]');
                $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|min_length[2]|max_length[200]');
                $this->form_validation->set_rules('password', 'Senha', 'trim|min_length[8]');
                $this->form_validation->set_rules('confirmPassword', 'Confirma senha', 'trim|matches[password]');

                if ($this->form_validation->run()) {
                    echo '<pre>';
                    print_r($this->input->post());
                    exit();
                }else{

                    //Erro de validação 

                    $data = array(
                        'titulo' => 'Editar usuário',
                        'titulo_anterior' => 'Usuários',
                        'sub_titulo' => 'Editando usuário',
                        'icon_view' => 'ik ik-user bg-blue',
                        'user' => $this->ion_auth->user($user_id)->row(),
                        'group' => $this->ion_auth->get_users_groups($user_id)->row(),
    
                    );
    
                    // echo '<pre>';
                    // print_r($data['usuario']);
                    // echo '</pre>';
    
                    $this->load->view('layout/header', $data);
                    $this->load->view('usuarios/core', $data);
                    $this->load->view('layout/footer');
                }
            }
        }
    }
}
