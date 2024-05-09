<?php

ob_start();
defined('BASEPATH') or exit('Ação não permitida!');

class Usuarios extends CI_Controller{
    public $ion_auth;
    public $router;
    public $load;
    public $core_model;
    public $form_validation;
    public $input;

    public function __construct(){
        parent::__construct();

        $this->ion_auth = new Ion_auth();
        $this->router = new CI_Router();
        $this->load = new CI_Loader();
        $this->core_model = new Core_model();
        $this->form_validation = new CI_Form_validation();
        $this->input = new CI_Input();

        if(!$this->ion_auth->logged_in()){
            redirect(base_url('login'));
        }
    }

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
            'usuarios' => $this->core_model->get_all('users', array('status' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');
    }

    public function core($user_id = NULL){
        if (!$user_id) {
            $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[2]|max_length[30]|is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|min_length[2]|max_length[200]|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Senha', 'trim|min_length[8]|required');
            $this->form_validation->set_rules('confirmPassword', 'Confirma senha', 'trim|matches[password]|required');

            if ($this->form_validation->run()) {
                $username = html_escape($this->input->post('username'));
                $password = html_escape($this->input->post('password'));
                $email = html_escape($this->input->post('email'));
                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'active' => $this->input->post('active')
                );
                $group = array($this->input->post('perfil'));
                
                $additional_data = html_escape($additional_data);
                if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {
                    $_SESSION['success'] = 'Dados salvos com sucesso';
                } else {
                    $_SESSION['error'] = 'Não foi possível salvar os dados';
                }

                redirect($this->router->fetch_class());
                ob_end_flush();
            } else {
                $data = array(
                    'titulo' => 'Cadastrar usuário',
                    'titulo_anterior' => 'Usuários',
                    'sub_titulo' => 'Cadastrando usuário',
                    'icon_view' => 'ik ik-user bg-blue',
                    'user' => $this->ion_auth->user($user_id)->row(),
                    'group' => $this->ion_auth->get_users_groups($user_id)->row(),
                );
            
                $this->load->view('layout/header', $data);
                $this->load->view('usuarios/core', $data);
                $this->load->view('layout/footer');
            }
        } else {  
            if (!$this->ion_auth->user($user_id)->row()) {
                exit('Usuário não existe');
            } else {
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
                    if (!$password) {
                        unset($data['password']);
                    }

                    $data = html_escape($data);
                    
                    if ($this->ion_auth->update($user_id, $data)) {
                        $perfil_atual = $this->ion_auth->get_users_groups($user_id)->row();

                        $perfil_post = $this->input->post('perfil');

                        if($perfil_atual->id != $perfil_post){
                            $this->ion_auth->remove_from_group($perfil_atual->id, $user_id);
                            $this->ion_auth->add_to_group($perfil_post, $user_id);
                        }

                        $_SESSION['success'] = 'Dados atualizados com sucesso';
                    } else { 
                        $_SESSION['error'] = 'Não foi possível atualizar os dados';
                    }
                    redirect($this->router->fetch_class());
                    ob_end_flush();
                } else { 
                    $data = array(
                        'titulo' => 'Editar usuário',
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

    public function del($user_id = NULL){
        $user = $this->core_model->get_by_id('users', array('id' => $user_id));
        if(!$user_id || !$user){
            $_SESSION['error'] = 'Usuário não encontrado';
        } else {
            if($this->ion_auth->is_admin($user_id)){
                $_SESSION['error'] = 'Não é possível excluir um Administrador';
                redirect($this->router->fetch_class());
                ob_end_flush();
            }
            
            if($this->core_model->update('users', ['status' => 0], ['id' => $user_id]) ) {
                $_SESSION['success'] = 'Usuário excluído com sucesso';
            } else {
                $_SESSION['error'] = 'Não foi possível excluir o usuário';
            }
        }
        redirect($this->router->fetch_class());
        ob_end_flush();
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
