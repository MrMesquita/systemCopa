<?php

ob_start();
defined('BASEPATH') or exit('Ação não permitida!');

class Participantes extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if(!$this->ion_auth->logged_in()){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
            'titulo' => 'Participantes',
            'sub_titulo' => 'Listando todos os participantes cadastrados no sistema',
            'icon_view' => 'ik ik-users bg-blue',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/systemCopa.js',
            ),
            'participantes' => $this->core_model->get_all('participantes', array('status' => 1))
        );

        $this->load->view('layout/header', $data);
        $this->load->view('participantes/index');
        $this->load->view('layout/footer');
    }

    public function core(){
        $data = array(
            'titulo' => 'Cadastro de participantes',
            'sub_titulo' => 'Cadastrando um participante no sistema',
            'icon_view' => 'ik ik-users bg-blue',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/systemCopa.js',
            ),
            'action' => base_url('participantes/add')
        );

        $this->load->view('layout/header', $data);
        $this->load->view('participantes/core');
        $this->load->view('layout/footer');
    }

    public function add(){
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('email','Email','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('telefone','Telefone','trim|required|min_length[11]|max_length[12]');
        
        if ($this->form_validation->run()) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];

            if ($this->core_model->insert('participantes', array('nome' => $nome, 'email' => $email, 'telefone' => $telefone))) {
                $this->session->set_flashdata('success','Participante cadastrado com sucesso');
            } else {
                $this->session->set_flashdata('error','Não foi possível cadastrar o participante');
            }
            redirect('participantes');
            ob_end_flush();
        } 
    }

    public function edit($participante_id = NULL){
        $data = array(
            'titulo' => 'Editando participante',
            'sub_titulo' => 'editando dados de um participante no sistema',
            'icon_view' => 'ik ik-user bg-blue',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/systemCopa.js',
            ),
            'participante' => $this->core_model->get_by_id('participantes',array('id' => $participante_id)),
            'action' => base_url('participantes/edit/'.$participante_id)
        );

        $this->load->view('layout/header', $data);
        $this->load->view('participantes/core', $data);
        $this->load->view('layout/footer');

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('email','Email','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('telefone','Telefone','trim|required|min_length[11]|max_length[12]');

        if($this->form_validation->run()){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];

            if ($this->core_model->update('participantes', ['nome' => $nome, 'email' => $email, 'telefone' => $telefone], ['id' => $participante_id])) {
                $this->session->set_flashdata('success','Participante atualizado com sucesso');
            } else {
                $this->session->set_flashdata('error','Não foi possível cadastrar o participante');
            }
            redirect('participantes');
            ob_end_flush();
        }

    }
}