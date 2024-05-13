<?php

defined('BASEPATH') or exit('Ação não permitida');

class Login extends CI_Controller
{
    public $ion_auth;
    public $router;
    public $load;
    public $input;

    public function __construct(){
        parent::__construct(); 

        $this->ion_auth = new Ion_auth();
        $this->router = new CI_Router();
        $this->load = new CI_Loader();
        $this->input = new CI_Input();
    }
    
    public function index(){
        $data = array(
            'titulo' => 'login'
        );
        
        $this->load->view('layout/header', $data);
        $this->load->view('login/index');
        $this->load->view('layout/footer');
    }
    
    public function auth(){
        $identity = html_escape($this->input->post('email'));
        $password = html_escape($this->input->post('password'));
        $remember = FALSE;

        if($this->ion_auth->login($identity, $password, $remember)){
            $_SESSION['success'] = 'Seja bem-vindo(a)';
            redirect('/');
        }else{
            $_SESSION['error'] = 'Email e/ou senha inválidos';
            redirect(base_url('login'));
        }
    }

    public function logout(){
        $this->ion_auth->logout();
        redirect('/');
    }
}
