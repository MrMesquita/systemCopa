<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public $ion_auth;
    public $load;

    public function __construct(){
        parent::__construct();
        
        $this->ion_auth = new Ion_auth();
        $this->load = new CI_Loader();

        if(!$this->ion_auth->logged_in()){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
            'titulo' => 'Home',
        );
        
        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }
}