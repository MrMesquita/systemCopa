<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Classificacao extends CI_Controller{

    public $ion_auth;
    public $session;
    public $router;
    public $load;
    public $core_model;
    public $form_validation;
    private $icon;

    public function __construct(){
        parent::__construct();

        $this->ion_auth = new Ion_auth();
        $this->router = new CI_Router();
        $this->load = new CI_Loader();
        $this->core_model = new Core_model();
        $this->form_validation = new CI_Form_validation();
        $this->icon = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-table' viewBox='0 0 16 16'><path d='M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z'/></svg>";

        if(!$this->ion_auth->logged_in()){
            redirect(base_url('login'));
        }
    }

    public function index(){
        $data = array(
            'titulo' => 'Classificação',
            'sub_titulo' => 'Listando todas as classificações cadastradas no sistema',
            'icon_view' => $this->icon,
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/systemCopa.js',
            ),
            'classificacoes' => $this->core_model->get_all('classificacao', array('status' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('classificacao/index');
        $this->load->view('layout/footer');
    }

    public function core(){
        $data = array(
            'titulo' => 'Cadastrando classificação',
            'sub_titulo' => 'Cadastrando classificação',
            'icon_view' => $this->icon,
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
            'action' => base_url('classificacao/add'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('classificacao/core', $data);
        $this->load->view('layout/footer');
    }

    public function add(){
        $time_id = $_POST['time'];
        $copa_id = $_POST['copa'];
        $pts = $_POST['pts'];
        $jogo = $_POST['jogo'];
        $vitoria = $_POST['vitoria'];
        $empate = $_POST['empate'];
        $derrota = $_POST['derrota'];
        $gol_marcado = $_POST['gol_marcado'];
        $gol_contra = $_POST['gol_contra'];
        $saldo_gol = $_POST['saldo_gol'];

        if($this->core_model->insert('classificacao', 
            array(
                'time_id' => $time_id, 
                'copa_id' => $copa_id, 
                'pts' => $pts, 
                'jogo' => $jogo, 
                'vitoria' => $vitoria, 
                'empate' => $empate, 
                'derrota' => $derrota, 
                'gol_marcado' => $gol_marcado, 
                'gol_contra' => $gol_contra, 
                'saldo_gol' => $saldo_gol
            )
        )){
            $this->session->set_flashdata('success','Classificação cadastrada com sucesso');
        }else{
            $this->session->set_flashdata('error','Não foi possível cadastrar a classificação');
        }
        redirect('/classificacao');
    }

    public function edit($classificacao_id = null){
        $data = array(
            'titulo' => 'Editando classificação',
            'sub_titulo' => 'Editando uma classificação registrada no sistema',
            'icon_view' => $this->icon,
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/systemCopa.js',
            ),
            'classificacao' => $this->core_model->get_by_id('classificacao', array('id' => $classificacao_id)),
            'times' => $this->core_model->get_all('times', array('status' => 1)),
            'copas' => $this->core_model->get_all('copas', array('status' => 1)),
            'action' => base_url('classificacao/editAction/'.$classificacao_id),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('classificacao/core', $data);
        $this->load->view('layout/footer');
    }

    public function editAction($classificacao_id){
        $time_id = $_POST['time'];
        $copa_id = $_POST['copa'];
        $pts = $_POST['pts'];
        $jogo = $_POST['jogo'];
        $vitoria = $_POST['vitoria'];
        $empate = $_POST['empate'];
        $derrota = $_POST['derrota'];
        $gol_marcado = $_POST['gol_marcado'];
        $gol_contra = $_POST['gol_contra'];
        $saldo_gol = $_POST['saldo_gol'];

        if(isset($_POST) && isset($classificacao_id)){
            if ($this->core_model->update('classificacao', array('time_id' => $time_id, 'copa_id' => $copa_id, 'pts' => $pts, 'jogo' => $jogo, 'vitoria' => $vitoria, 'empate' => $empate, 'derrota' => $derrota, 'gol_marcado' => $gol_marcado, 'gol_contra' => $gol_contra, 'saldo_gol' => $saldo_gol), 
            array('id' => $classificacao_id))) {
                $this->session->set_flashdata('success','Classificação atualizada com sucesso');
            } else {
                $this->session->set_flashdata('error','Não foi possível atualizar a classificação');
            }
            redirect('classificacao');
        }
    }

    public function del($classificacao_id = null){
        $classificacao = $this->core_model->get_by_id('classificacao', array('id' => $classificacao_id, 'status' => 1));
        if(!$classificacao_id || !$classificacao){
            $this->session->set_flashdata('error','Classificação não encontrada');
        } else {
            if($this->core_model->update('classificacao', array('status' => 0), array('id' => $classificacao_id)) ) {
                $this->session->set_flashdata('success','Classificação excluida com sucesso');
            } else {
                $this->session->set_flashdata('error','Não foi possível excluir a classificação');
            }
        }
        redirect($this->router->fetch_class());
    }
}