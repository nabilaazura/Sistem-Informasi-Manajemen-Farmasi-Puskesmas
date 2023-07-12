<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporanponed_model extends CI_Model
{
    public $table = 'laporan_poned';
    public $id = 'laporan_poned.id_laporan_poned';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->select('obat_poned.nama_obat, SUM(stok_awal) AS "stok_awal", SUM(masuk) AS "masuk", SUM(pemakaian) AS "pemakaian", SUM(ed) AS "ed", SUM(sisa_stok) AS "sisa_stok"');
        $this->db->from('laporan_poned, obat_poned');
        $this->db->where('laporan_poned.id_obat = obat_poned.id_obat');
        $this->db->where('laporan_poned.id_laporan_poned IN (SELECT MAX(id_laporan_poned) FROM laporan_poned GROUP BY id_obat)');
        $this->db->where('MONTH(tanggal_masuk)', date('m'));
        $this->db->group_by('obat_poned.nama_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_laporan_poned)
    {
        $this->db->from($this->table);
        $this->db->where('id_laporan_poned', $id_laporan_poned);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function filterDataBySelectedMonth($selectedMonth)
    {
        $this->db->select('obat_poned.nama_obat, SUM(stok_awal) AS "stok_awal", SUM(masuk) AS "masuk", SUM(pemakaian) AS "pemakaian", SUM(ed) AS "ed", SUM(sisa_stok) AS "sisa_stok"');
        $this->db->from('laporan_poned, obat_poned');
        $this->db->where('laporan_poned.id_obat = obat_poned.id_obat');
        $this->db->where('laporan_poned.id_laporan_poned IN (SELECT MAX(id_laporan_poned) FROM laporan_poned GROUP BY id_obat)');
        $this->db->where('MONTH(tanggal_masuk)', $selectedMonth);

        $this->db->group_by('obat_poned.nama_obat');
        $query = $this->db->get();
        return $query->result();
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
