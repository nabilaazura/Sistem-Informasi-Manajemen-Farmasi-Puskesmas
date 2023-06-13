<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporanpustu_model extends CI_Model
{
    public $table = 'laporan_pustu';
    public $id = 'laporan_pustu.id_laporan_pustu';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->select('id_laporan_pustu, kode_obat, nama_obat, satuan, stok_awal, masuk, pemakaian, ed, sisa_stok');
        $this->db->from('laporan_pustu, obat_pustu');
        $this->db->where('laporan_pustu.id_obat = obat_pustu.id_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_laporan_pustu)
    {
        $this->db->from($this->table);
        $this->db->where('id_laporan_pustu', $id_laporan_pustu);
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
}
