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
                //Pode editar!

                ob_start();
                $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[2]|max_length[30]');
                $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[2]|max_length[30]');
                $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[2]|max_length[30]|callback_username_check');
                $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|min_length[2]|max_length[200]|callback_email_check');
                $this->form_validation->set_rules('password', 'Senha', 'trim|min_length[8]');
                $this->form_validation->set_rules('confirmPassword', 'Confirma senha', 'trim|matches[password]');

                if ($this->form_validation->run()) {
                
                    $data = elements(
                        array(
                            'first_name',
                            'last_name',
                            'username',
                            'email',
                            'password', 
                            'active', 
                        ), $this->input->post()
                    );

                    $password = $this->input->post('password');

                    //não atualizar senha
                    if(!$password){
                        unset($data['password']);
                    }

                    $data = html_escape($data);

                    // echo '<pre>';
                    // print_r($perfil_atual);
                    // exit();
                    
                    if($this->ion_auth->update($user_id, $data)){
                        // pega perfil(grupo) atual pelo id da url. retorna um objeto
                        $perfil_atual = $this->ion_auth->get_users_groups($user_id)->row();

                        // pega o perfil que foi enviado no post. retorna um id
                        $perfil_post = $this->input->post('perfil');

                        // se for diferente atualiza o grupo
                        if($perfil_atual->id != $perfil_post){

                            $this->ion_auth->remove_from_group($perfil_atual->id, $user_id);
                            $this->ion_auth->add_to_group($perfil_post, $user_id);
                        }
                        $this->session->set_flashdata('success','Dados atualizados com sucesso');
                    }else{
                        $this->session->set_flashdata('error','Não foi possível atualizar os dados');
                    }
                    

                    // echo '<script>window.location.href = /usuarios/ </script>';
                    redirect($this->router->fetch_class());
                    ob_end_flush();
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

    
                    $this->load->view('layout/header', $data);
                    $this->load->view('usuarios/core', $data);
                    $this->load->view('layout/footer');
                }
            }
        }
    }

    public function username_check($username){
        $user_id = $this->input->post('user_id');

        if($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $user_id))){
            $this->form_validation->set_message('username_check', 'Esse usuário já existe');
            return false;
        }else{
            return true;
        }
    }

    public function email_check($email){
        $user_id = $this->input->post('user_id');

        if($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $user_id))){
            $this->form_validation->set_message('email_check', 'Esse email já está cadastrado');
            return false;
        }else{
            return true;
        }
    }
}
