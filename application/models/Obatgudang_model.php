<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obatgudang_model extends CI_Model
{
    public $table = 'obat';
    public $id = 'obat.id';
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
    public function getById($id_obat)
    {
        $this->db->from($this->table);
        $this->db->where('id_obat', $id_obat);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}