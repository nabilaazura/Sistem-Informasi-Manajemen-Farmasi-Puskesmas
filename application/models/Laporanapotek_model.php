<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporanapotek_model extends CI_Model
{
    public $table = 'laporan_apotek';
    public $id = 'laporan_apotek.id_laporan_apotek';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->select('id_laporan_apotek, created_at, kode_obat, nama_obat, satuan, stok_awal, masuk, pemakaian, ed, sisa_stok');
        $this->db->from('laporan_apotek, obat_apotek');
        $this->db->where('laporan_apotek.id_obat = obat_apotek.id_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_laporan_apotek)
    {
        $this->db->from($this->table);
        $this->db->where('id_laporan_apotek', $id_laporan_apotek);
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
    public function getLatestStock()
    {
        $this->db->from($this->table);
        $this->db->limit(1);
        $this->db->order_by('id_laporan_apotek', "DESC");
        $query = $this->db->get();
        return $query->row_array();
    }
}
