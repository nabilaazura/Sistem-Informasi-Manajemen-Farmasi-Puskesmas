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
        $this->db->select('obat_apotek.nama_obat, SUM(stok_awal) AS "stok_awal", SUM(masuk) AS "masuk", SUM(pemakaian) AS "pemakaian", SUM(ed) AS "ed", SUM(sisa_stok) AS "sisa_stok"');
        $this->db->from('laporan_apotek, obat_apotek');
        $this->db->where('laporan_apotek.id_obat = obat_apotek.id_obat');
        $this->db->where('laporan_apotek.id_laporan_apotek IN (SELECT MAX(id_laporan_apotek) FROM laporan_apotek GROUP BY id_obat)');
        $this->db->where('MONTH(tanggal_masuk)', date('m'));
        $this->db->group_by('obat_apotek.nama_obat');
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
    public function filterDataBySelectedMonth($selectedMonth)
    {
        $this->db->select('obat_apotek.nama_obat, SUM(stok_awal) AS "stok_awal", SUM(masuk) AS "masuk", SUM(pemakaian) AS "pemakaian", SUM(ed) AS "ed", SUM(sisa_stok) AS "sisa_stok"');
        $this->db->from('laporan_apotek, obat_apotek');
        $this->db->where('laporan_apotek.id_obat = obat_apotek.id_obat');
        $this->db->where('laporan_apotek.id_laporan_apotek IN (SELECT MAX(id_laporan_apotek) FROM laporan_apotek GROUP BY id_obat)');
        $this->db->where('MONTH(tanggal_masuk)', $selectedMonth);

        $this->db->group_by('obat_apotek.nama_obat');
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
    public function getLatestStock()
    {
        $this->db->from($this->table);
        $this->db->limit(1);
        $this->db->order_by('id_laporan_apotek', "DESC");
        $query = $this->db->get();
        return $query->row_array();
    }
}
