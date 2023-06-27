<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model
{
    public $table = 'pengeluaran_pustu';
    public $id = 'pengeluaran_pustu.id_pengeluaran_pustu';
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
    public function getById($id_pengeluaran_pustu)
    {
        $this->db->from($this->table);
        $this->db->where('id_pengeluaran_pustu', $id_pengeluaran_pustu);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}
