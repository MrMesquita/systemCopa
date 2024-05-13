<?php
defined('BASEPATH') OR exit ('Ação não permitida');


class Copas extends CI_Controller {
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
            'titulo' => 'Copas',
            'sub_titulo' => 'Listando todas copas registradas no sistema',
            'icon_view' => 'fas fa-trophy bg-blue',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/systemCopa.js',
            ),
            'copas' => $this->core_model->get_all('copas', array('status' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('copas/index');
        $this->load->view('layout/footer');
    }

    public function insert($copa_id = null){

        if (!$copa_id) {

            $this->form_validation->set_rules('copa_name', 'Usuário', 'trim|required|min_length[2]|max_length[30]|is_unique[copas.copa_name]');

            if ($this->form_validation->run()) {

                $data = array(
                    'copa_name' => $this->input->post('copa_name'),
                    'active' => $this->input->post('active'),
                );
                
                $data = html_escape($data);

                if ($this->core_model->insert('copas', $data)) {

                    $this->session->set_flashdata('success','Dados salvos com sucesso');
                } else {
                    $this->session->set_flashdata('error','Não foi possível salvar os dados');
                }

                redirect('copas');
            } else {
                $data = array(
                    'titulo' => 'Cadastrar copa',
                    'titulo_anterior' => 'Copas',
                    'sub_titulo' => 'Cadastrando novas copas',
                    'icon_view' => 'fas fa-trophy bg-blue',
                );
            
                $this->load->view('layout/header', $data);
                $this->load->view('copas/core', $data);
                $this->load->view('layout/footer');
            }
        } else {  
            redirect('/');
        }
    }

    public function edit($copa_id){

            if(!$this->core_model->get_by_id('copas', array('id' => $copa_id))){
                $this->session->set_flashdata('error','Copa não existente no sistema.');
                redirect('copas');
            }

            $this->core_model->get_by_id('copas', array('id' => $copa_id));
            $this->form_validation->set_rules('copa_name', 'Copa', 'trim|required|min_length[2]|max_length[30]|callback_check_copa_name');

            if ($this->form_validation->run()) {  
                $data = elements(
                    array(
                        'copa_name', 
                        'active', 
                    ), $this->input->post()
                );

                $data = html_escape($data);
                
                if ($this->core_model->update('copas', $data, ['id =' => $copa_id])){
                    $this->session->set_flashdata('success','Dados atualizados com sucesso');
                } else { 
                    $this->session->set_flashdata('error','Não foi possível atualizar os dados');
                }

                redirect('copas');
            } else { 
                $data = array(
                    'titulo' => 'Editar copa',
                    'sub_titulo' => 'Editando copas',
                    'icon_view' => 'fas fa-trophy bg-blue',
                    'copa' => $this->core_model->get_by_id('copas', array('id' => $copa_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('copas/core', $data);
                $this->load->view('layout/footer');
            }
        
    }

    public function check_copa_name($copa_name){

        $copa_id = $this->input->post('copa_id');

        if($this->core_model->get_by_id('copas', array('copa_name' => $copa_name, 'id !=' => $copa_id))){
            $this->form_validation->set_message('check_copa_name', 'Essa copa já existe');
            return false;
        }else{
            return true;
        }
    }

    public function delete($copa_id = null){
        $copa = $this->core_model->get_by_id('copas', array('id' => $copa_id));

        if(!$copa_id || !$copa){
            $this->session->set_flashdata('error','Copa não encontrada');
        } else {
            
            if($this->core_model->update('copas', array('status' => 0), array('id' => $copa_id)) ) {
                $this->session->set_flashdata('success','Copa excluída com sucesso');
            } else {
                $this->session->set_flashdata('error','Não foi possível excluir esta copa');
            }
        }
        redirect('copas');
    }
}