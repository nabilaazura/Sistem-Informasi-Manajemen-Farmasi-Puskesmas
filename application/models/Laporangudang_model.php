<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporangudang_model extends CI_Model
{
    public $table = 'laporan_gudang';
    public $id = 'laporan_gudang.id_laporan_gudang';
    public function __construct()
    {
        parent::__construct();
    }
    // public function get()
    // {
    //     $this->db->select('obat.kode_obat, obat.nama_obat, stokawal_apbd1, masuk_apbd1, pemakaian_apbd1, ed_apbd1, sisastok_apbd1, stokawal_apbd2, masuk_apbd2, pemakaian_apbd2, ed_apbd2, sisastok_apbd2, stokawal_dak, masuk_dak, pemakaian_dak, ed_dak, sisastok_dak');
    //     $this->db->from('laporan_gudang, obat');
    //     $this->db->where('laporan_gudang.id_obat = obat.id_obat');
    //     $this->db->where('id_laporan_gudang IN (SELECT MAX(id_laporan_gudang) FROM laporan_gudang GROUP BY id_obat)');
    //     $this->db->group_by('obat.nama_obat');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }
    // public function get()
    // {
    //     $this->db->select('obat.kode_obat, obat.nama_obat, SUM(stokawal_apbd1) AS "stokawal_apbd1", SUM(masuk_apbd1) AS "masuk_apbd1", SUM(pemakaian_apbd1) AS "pemakaian_apbd1", SUM(ed_apbd1) AS "ed_apbd1", SUM(sisastok_apbd1) AS "sisastok_apbd1", SUM(stokawal_apbd2) AS "stokawal_apbd2", SUM(masuk_apbd2) AS "masuk_apbd2", SUM(pemakaian_apbd2) AS "pemakaian_apbd2", SUM(ed_apbd2) AS "ed_apbd2", SUM(sisastok_apbd2) AS "sisastok_apbd2", SUM(stokawal_dak) AS "stokawal_dak", SUM(masuk_dak) AS "masuk_dak", SUM(pemakaian_dak) AS "pemakaian_dak", SUM(ed_dak) AS "ed_dak", SUM(sisastok_dak) AS "sisastok_dak"');
    //     $this->db->from('laporan_gudang, obat');
    //     $this->db->where('laporan_gudang.id_obat = obat.id_obat');
    //     $this->db->where('id_laporan_gudang IN (SELECT MAX(id_laporan_gudang) FROM laporan_gudang GROUP BY id_laporan_gudang)');
    //     $this->db->group_by('obat.nama_obat');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }
    public function get()
    {
        $this->db->select('obat.kode_obat, obat.nama_obat');
        $this->db->select_sum('subquery.stokawal_apbd1', 'stokawal_apbd1');
        $this->db->select_sum('subquery.masuk_apbd1', 'masuk_apbd1');
        $this->db->select_sum('subquery.pemakaian_apbd1', 'pemakaian_apbd1');
        $this->db->select_sum('subquery.ed_apbd1', 'ed_apbd1');
        $this->db->select_sum('subquery.sisastok_apbd1', 'sisastok_apbd1');
        $this->db->select_sum('subquery.stokawal_apbd2', 'stokawal_apbd2');
        $this->db->select_sum('subquery.masuk_apbd2', 'masuk_apbd2');
        $this->db->select_sum('subquery.pemakaian_apbd2', 'pemakaian_apbd2');
        $this->db->select_sum('subquery.ed_apbd2', 'ed_apbd2');
        $this->db->select_sum('subquery.sisastok_apbd2', 'sisastok_apbd2');
        $this->db->select_sum('subquery.stokawal_dak', 'stokawal_dak');
        $this->db->select_sum('subquery.masuk_dak', 'masuk_dak');
        $this->db->select_sum('subquery.pemakaian_dak', 'pemakaian_dak');
        $this->db->select_sum('subquery.ed_dak', 'ed_dak');
        $this->db->select_sum('subquery.sisastok_dak', 'sisastok_dak');
        $this->db->from('obat');
        $this->db->join('(SELECT laporan_gudang.id_obat, laporan_gudang.stokawal_apbd1, laporan_gudang.masuk_apbd1, laporan_gudang.pemakaian_apbd1, laporan_gudang.ed_apbd1, laporan_gudang.sisastok_apbd1,
                        laporan_gudang.stokawal_apbd2, laporan_gudang.masuk_apbd2, laporan_gudang.pemakaian_apbd2, laporan_gudang.ed_apbd2, laporan_gudang.sisastok_apbd2,
                        laporan_gudang.stokawal_dak, laporan_gudang.masuk_dak, laporan_gudang.pemakaian_dak, laporan_gudang.ed_dak, laporan_gudang.sisastok_dak
                 FROM laporan_gudang
                 WHERE laporan_gudang.id_laporan_gudang IN (SELECT MAX(id_laporan_gudang) FROM laporan_gudang GROUP BY id_obat)) AS subquery', 'subquery.id_obat = obat.id_obat');
        $this->db->group_by('obat.kode_obat, obat.nama_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_laporan_gudang)
    {
        $this->db->from($this->table);
        $this->db->where('id_laporan_gudang', $id_laporan_gudang);
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
    public function delete($id_laporan_gudang)
    {
        $this->db->where($this->id, $id_laporan_gudang);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
