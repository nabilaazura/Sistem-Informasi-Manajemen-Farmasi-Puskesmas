<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluarangudang_model extends CI_Model
{
    public $table = 'pengeluaran_gudang';
    public $id = 'pengeluaran_gudang.id_pengeluaran_gudang';
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
    public function getById($id_pengeluaran_gudang)
    {
        $this->db->from($this->table);
        $this->db->where('id_pengeluaran_gudang', $id_pengeluaran_gudang);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}
