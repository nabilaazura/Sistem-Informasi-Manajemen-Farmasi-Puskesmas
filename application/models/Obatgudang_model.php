<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obatgudang_model extends CI_Model
{
    public $table = 'obat';
    public $id = 'obat.id_obat';
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
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function delete($id_obat)
    {
        $this->db->where($this->id, $id_obat);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    // public function sortPermintaan()
    // {
    //     $query = $this->db->select('*')
    //         ->from('permintaan_obat')
    //         ->order_by('tanggal_permintaan', 'desc')
    //         ->get();

    //     $result = $query->result();
    // }
}
