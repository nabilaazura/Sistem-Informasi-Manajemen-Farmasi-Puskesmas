<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaranponed_model extends CI_Model
{
    public $table = 'pengeluaran_poned';
    public $id = 'pengeluaran_poned.id_pengeluaran_poned';
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
    public function getById($id_pengeluaran_poned)
    {
        $this->db->from($this->table);
        $this->db->where('id_pengeluaran_poned', $id_pengeluaran_poned);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}
