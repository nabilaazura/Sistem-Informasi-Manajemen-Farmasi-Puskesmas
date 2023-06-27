<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaranapotek_model extends CI_Model
{
    public $table = 'pengeluaran_apotek';
    public $id = 'pengeluaran_apotek.id_pengeluaran_apotek';
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
    public function getById($id_pengeluaran_apotek)
    {
        $this->db->from($this->table);
        $this->db->where('id_pengeluaran_apotek', $id_pengeluaran_apotek);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}
