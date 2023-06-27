<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LPLPO_model extends CI_Model
{
    public $table = 'lplpo';
    public $id = 'lplpo.id_lplpo';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_lplpo)
    {
        $this->db->from($this->table);
        $this->db->where('id_lplpo', $id_lplpo);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function delete($id_lplpo)
    {
        $this->db->where($this->id, $id_lplpo);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
