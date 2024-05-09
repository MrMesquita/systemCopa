<?php
defined('BASEPATH') or exit('Ação não permitida!');

class Participantes extends CI_Controller {

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
        $this->form_validation->set_rules('email','Email','trim|required|min_length[2]|max_length[50]|is_unique[participantes.email]');
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
        } else {
            $this->core();
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
            'action' => base_url('participantes/editAction/'.$participante_id)
        );

        $this->load->view('layout/header', $data);
        $this->load->view('participantes/core', $data);
        $this->load->view('layout/footer');
    }

    public function editAction($participante_id = null){
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('email','Email','trim|required|min_length[2]|max_length[50]|callback_email_check['.$participante_id.']');
        $this->form_validation->set_rules('telefone','Telefone','trim|required|min_length[11]|max_length[12]');

        if($this->form_validation->run()){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];

            date_default_timezone_set('America/Recife');

            if ($this->core_model->update('participantes', ['nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'dataAtualizacao' => date("Y-m-d H:i:s")], ['id' => $participante_id])) {
                $this->session->set_flashdata('success','Participante atualizado com sucesso');
            } else {
                $this->session->set_flashdata('error','Não foi possível cadastrar o participante');
            }
            redirect('participantes');
        } else {
            $this->edit($participante_id);
        }
    }

    public function email_check($emailToCheck, $participante_id){
        if ($this->core_model->get_all('participantes',array('email' => $emailToCheck, 'id !=' => (int) $participante_id))) {
            $this->form_validation->set_message('email_check','O email inserido já existe!');
            return false;
        } else {
            return true;
        }
    }

    public function del($participante_id = null){
        $participante = $this->core_model->get_by_id('participantes', array('id' => $participante_id));
        if(!$participante_id || !$participante){
            $this->session->set_flashdata('error','Usuário não encontrado');
        } else {
            if($this->core_model->update('participantes', array('status' => 0), array('id' => $participante_id)) ) {
                $this->session->set_flashdata('success','Participante excluído com sucesso');
            } else {
                $this->session->set_flashdata('error','Não foi possível excluir o participante');
            }
        }
        redirect($this->router->fetch_class());
    }
}