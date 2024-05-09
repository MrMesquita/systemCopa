<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Times extends CI_Controller{

    public $ion_auth;
    public $session;
    public $router;
    public $load;
    public $core_model;
    public $form_validation;

    public function __construct(){
        parent::__construct();

        $this->ion_auth = new Ion_auth();
        $this->router = new CI_Router();
        $this->load = new CI_Loader();
        $this->core_model = new Core_model();
        $this->form_validation = new CI_Form_validation();

        if(!$this->ion_auth->logged_in()){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
            'titulo' => 'Times',
            'sub_titulo' => 'Listando todos os times cadastrados no sistema',
            'icon_view' => 'ik ik-users bg-blue',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/systemCopa.js',
            ),
            'times' => $this->core_model->get_all('times', array('status' => 1))
        );

        $this->load->view('layout/header', $data);
        $this->load->view('times/index');
        $this->load->view('layout/footer');
    }
        
    public function core(){
        $data = array(
            'titulo' => 'Cadastro de time',
            'sub_titulo' => 'cadastrando time no sistema',
            'icon_view' => 'ik ik-user bg-blue',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'action' => base_url('times/add'),
            'participantes' => $this->core_model->get_all('participantes', array('status' => 1))
        );

        $this->load->view('layout/header', $data);
        $this->load->view('times/core');
        $this->load->view('layout/footer');
    }

    public function add(){
        $nome_time = $_POST['nome_time'];
        $participante_id = $_POST['participante'];

        if(isset($nome_time) && isset($participante_id)){
            if($this->core_model->insert('times', array('nome_time' => $nome_time, 'participante_id' => $participante_id))){
                $this->session->set_flashdata('success','Participante cadastrado com sucesso');
            }else{
                $this->session->set_flashdata('error','Não foi possível cadastrar o participante');
            }
            redirect('/times');
        }
    }

    public function edit($time_id){
        if(!$time_id){
            exit('Time não encontrado');
        }

        $data = array(
            'titulo' => 'Editando time',
            'sub_titulo' => 'editando um time cadastrado no sistema',
            'icon_view' => 'ik ik-user bg-blue',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'action' => base_url('times/editAction/'.$time_id),
            'time' => $this->core_model->get_by_id('times',array('id' => $time_id)),
            'participantes' => $this->core_model->get_all('participantes', array('status' => 1))
        );

        $this->load->view('layout/header', $data);
        $this->load->view('times/core');
        $this->load->view('layout/footer');
    }

    public function editAction($time_id){
        $nome_time = $_POST['nome_time'];
        $participante_id = $_POST['participante'];

        if(isset($nome_time) && isset($participante_id)){
            if ($this->core_model->update('times', array('nome_time' => $nome_time,'participante_id' => $participante_id, 'data_modificacao' => date("Y-m-d H:i:s")), array('id' => $time_id))) {
                $this->session->set_flashdata('success','Time atualizado com sucesso');
            } else {
                $this->session->set_flashdata('error','Não foi possível atualizar o time');
            }
            redirect('times');
        }
    }

    public function del($time_id = null){
        $time = $this->core_model->get_by_id('times', array('id' => $time_id));
        if(!$time_id || !$time){
            $this->session->set_flashdata('error','Time não encontrado');
        } else {
            if($this->core_model->update('times', array('status' => 0), array('id' => $time_id)) ) {
                $this->session->set_flashdata('success','Time excluído com sucesso');
            } else {
                $this->session->set_flashdata('error','Não foi possível excluir o time');
            }
        }
        redirect($this->router->fetch_class());
    }
}