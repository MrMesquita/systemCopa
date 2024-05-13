<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public $ion_auth;
    public $load;
    public $core_model;

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
            'titulo' => 'Paineis de copas',
            'sub_titulo' => 'Seleção de copas disponivéis no sistema',
            'icon_view' => 'fas fa-trophy bg-blue',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/systemCopa.js',
            ),
            'classificacoes' => $this->core_model->get_all('classificacao', array('status' => 1)),
            'times' => $this->core_model->get_all('times', array('status' => 1)),
            'copas' => $this->core_model->get_all('copas', array('status' => 1)),
        );
        
        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }

    public function result($copa_id = null) {

        $data = array(
            'titulo' => 'Classificação geral',
            'sub_titulo' => 'Classificação dos campeonatos de futebol de video game',
            'icon_view' => 'fas fa-trophy bg-blue',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/systemCopa.js',
            ),
            'classificacoes' => $this->core_model->get_all('classificacao', array('copa_id' => $copa_id)),
            'times' => $this->core_model->get_all('times', array('status' => 1)),
            'copas' => $this->core_model->get_all('copas', array('id' => $copa_id)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('home/classificacao-copas', $data);
        $this->load->view('layout/footer');
    }
    
}