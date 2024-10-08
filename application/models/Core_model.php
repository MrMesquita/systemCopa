<?php

defined('BASEPATH') OR exit('Ação não perimitida');


class Core_model extends CI_Model {

    public function get_all($table = null, $condition = null) {
        if($table && $this->db->table_exists($table)){
            if(is_array($condition)){
                $this->db->where($condition);
            }

            return $this->db->get($table)->result();
        }else{
            return false;
        }
    }

    public function get_by_id($table = null, $condition = null){
        if($table && $this->db->table_exists($table) && is_array($condition)){
            $this->db->where($condition);
            $this->db->limit(1);

            return $this->db->get($table)->row();
        }else{
            return false;
        }
    }

    public function insert($table = null, $data = null){
        if($table && $this->db->table_exists($table) && is_array($data)){
            $this->db->insert($table, $data);

            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }else{
            throw new Exception('Um erro ocorreu ao inserir os dados');
        }
    }

    public function update($table = null, $data = null, $condition = null){
        if($table && $this->db->table_exists($table) && is_array($condition)){
            if($this->db->update($table, $data, $condition)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function delete($table = null, $condition = null){

        if($table && $this->db->table_exists($table) && is_array($condition)){
            if($this->db->delete($table, $condition)){
                $this->session->set_flashdata('sucesso','Dados apagados com sucesso');
            }else{
                $this->session->set_flashdata('error','não foi possível apagar os dados');
            }
        }else{
            return false;
        }
    }
}