<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Api extends CI_Controller{

    public function getClassificacao(){
        $core_model = new Core_model();
        header('Content-type: application/json');

        if(!$this->db->table_exists('classificacao')){
            echo json_encode(['message' =>'Tabela não encontrada']); 
            die();
        }

        $tabela = $core_model->get_all('classificacao', array('status' => 1));
        echo json_encode($tabela);
    }

    public function getClassificacaoByCopa($copa_id){
        $core_model = new Core_model();
        header('Content-type: application/json');

        if(!$this->db->table_exists('classificacao')){
            echo json_encode(['message' =>'Tabela não encontrada']); 
            die();
        }

        $tabela = $core_model->get_all('classificacao', array('status' => 1, 'copa_id'=>$copa_id));
        echo json_encode($tabela);
    }
    
    public function getCopas(){
        $core_model = new Core_model();
        header('Content-type: application/json; ngrok-skip-browser-warning');

        if(!$this->db->table_exists('copas')){
            echo json_encode(['message' =>'Tabela não encontrada']); 
            die();
        }

        $tabela = $core_model->get_all('copas', array('status' => 1));
        echo json_encode($tabela);
    }
}