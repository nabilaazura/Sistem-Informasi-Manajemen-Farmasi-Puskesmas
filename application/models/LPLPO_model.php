<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LPLPO_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    // public function getLplpoGudang()
    // {
    //     $this->db->select('obat.kode_obat, obat.nama_obat, obat.satuan, obat.harga_satuan');
    //     $this->db->select('SUM(laporan_gudang.stokawal_apbd1+laporan_gudang.stokawal_apbd2+laporan_gudang.stokawal_dak) AS stok_awal_gudang');
    //     $this->db->select('SUM(laporan_gudang.masuk_apbd1+laporan_gudang.masuk_apbd2+laporan_gudang.masuk_dak) AS penerimaan');
    //     $this->db->select('SUM(laporan_gudang.stokawal_apbd1+laporan_gudang.stokawal_apbd2+laporan_gudang.stokawal_dak+laporan_gudang.masuk_apbd1+laporan_gudang.masuk_apbd2+laporan_gudang.masuk_dak) AS persediaan');
    //     $this->db->select('SUM(subquery.sisastok_apbd1+subquery.sisastok_apbd2+subquery.sisastok_dak) AS sisa_gudang');
    //     $this->db->select('SUM(laporan_gudang.ed_apbd1+laporan_gudang.ed_apbd2+laporan_gudang.ed_dak) AS ed_gudang');
    //     $this->db->select('SUM(laporan_gudang.pemakaian_apbd1) AS pengeluaran_apbd1');
    //     $this->db->select('SUM(laporan_gudang.pemakaian_apbd2) AS pengeluaran_apbd2');
    //     $this->db->select('SUM(laporan_gudang.pemakaian_dak) AS pengeluaran_dak');
    //     $this->db->select('SUM(laporan_gudang.pemakaian_apbd1+laporan_gudang.pemakaian_apbd2) AS jumlah_pengeluaran');
    //     $this->db->from('obat');
    //     $this->db->join('laporan_gudang', 'obat.id_obat = laporan_gudang.id_obat');
    //     $this->db->join('(SELECT laporan_gudang.id_obat, laporan_gudang.stokawal_apbd1, laporan_gudang.masuk_apbd1, laporan_gudang.pemakaian_apbd1, laporan_gudang.ed_apbd1, laporan_gudang.sisastok_apbd1,
    //                     laporan_gudang.stokawal_apbd2, laporan_gudang.masuk_apbd2, laporan_gudang.pemakaian_apbd2, laporan_gudang.ed_apbd2, laporan_gudang.sisastok_apbd2,
    //                     laporan_gudang.stokawal_dak, laporan_gudang.masuk_dak, laporan_gudang.pemakaian_dak, laporan_gudang.ed_dak, laporan_gudang.sisastok_dak
    //              FROM laporan_gudang
    //              WHERE laporan_gudang.id_laporan_gudang IN (SELECT MAX(id_laporan_gudang) FROM laporan_gudang GROUP BY id_obat)) AS subquery', 'subquery.id_obat = obat.id_obat');
    //     $this->db->group_by('obat.kode_obat, obat.nama_obat');
    //     $query = $this->db->get();

    //     return $query->result_array();
    // }
    public function getLplpoGudang()
    {
        $this->db->select('obat.kode_obat, obat.nama_obat, obat.satuan, obat.harga_satuan');
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
    // public function getLplpoApotek()
    // {
    //     $this->db->select('obat_apotek.kode_obat, obat_apotek.nama_obat, obat_apotek.satuan, obat_apotek.harga_satuan');
    //     $this->db->select('SUM(laporan_apotek.pemakaian) AS pemakaian_apotek');
    //     $this->db->select('SUM(laporan_apotek.ed) AS ed_apotek');
    //     $this->db->select('SUM(laporan_apotek.sisa_stok) AS sisa_apotek');
    //     $this->db->from('obat_apotek');
    //     $this->db->join('laporan_apotek', 'obat_apotek.id_obat = laporan_apotek.id_obat');
    //     $this->db->group_by('obat_apotek.kode_obat, obat_apotek.nama_obat');
    //     $query = $this->db->get();

    //     return $query->result_array();
    // }
    public function getLplpoApotek()
    {
        $this->db->select('obat_apotek.nama_obat, SUM(pemakaian) AS "pemakaian_apotek", SUM(ed) AS "ed_apotek", SUM(sisa_stok) AS "sisa_apotek"');
        $this->db->from('laporan_apotek, obat_apotek');
        $this->db->where('laporan_apotek.id_obat = obat_apotek.id_obat');
        $this->db->where('laporan_apotek.id_laporan_apotek IN (SELECT MAX(id_laporan_apotek) FROM laporan_apotek GROUP BY id_obat)');
        $this->db->group_by('obat_apotek.nama_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    // public function getLplpoPustu()
    // {
    //     $this->db->select('obat_pustu.kode_obat, obat_pustu.nama_obat, obat_pustu.satuan, obat_pustu.harga_satuan');
    //     $this->db->select('SUM(laporan_pustu.pemakaian) AS pemakaian_pustu');
    //     $this->db->select('SUM(laporan_pustu.ed) AS ed_pustu');
    //     $this->db->select('SUM(laporan_pustu.sisa_stok) AS sisa_pustu');
    //     $this->db->from('obat_pustu');
    //     $this->db->join('laporan_pustu', 'obat_pustu.id_obat = laporan_pustu.id_obat');
    //     $this->db->group_by('obat_pustu.kode_obat, obat_pustu.nama_obat');
    //     $query = $this->db->get();

    //     return $query->result_array();
    // }
    public function getLplpoPustu()
    {
        $this->db->select('obat_pustu.nama_obat, SUM(pemakaian) AS "pemakaian_pustu", SUM(ed) AS "ed_pustu", SUM(sisa_stok) AS "sisa_pustu"');
        $this->db->from('laporan_pustu, obat_pustu');
        $this->db->where('laporan_pustu.id_obat = obat_pustu.id_obat');
        $this->db->where('laporan_pustu.id_laporan_pustu IN (SELECT MAX(id_laporan_pustu) FROM laporan_pustu GROUP BY id_obat)');
        $this->db->group_by('obat_pustu.nama_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    // public function getLplpoPoned()
    // {
    //     $this->db->select('obat_poned.kode_obat, obat_poned.nama_obat, obat_poned.satuan, obat_poned.harga_satuan');
    //     $this->db->select('SUM(laporan_poned.pemakaian) AS pemakaian_poned');
    //     $this->db->select('SUM(laporan_poned.ed) AS ed_poned');
    //     $this->db->select('SUM(laporan_poned.sisa_stok) AS sisa_poned');
    //     $this->db->from('obat_poned');
    //     $this->db->join('laporan_poned', 'obat_poned.id_obat = laporan_poned.id_obat');
    //     $this->db->group_by('obat_poned.kode_obat, obat_poned.nama_obat');
    //     $query = $this->db->get();

    //     return $query->result_array();
    // }
    public function getLplpoPoned()
    {
        $this->db->select('obat_poned.nama_obat, SUM(pemakaian) AS "pemakaian_poned", SUM(ed) AS "ed_poned", SUM(sisa_stok) AS "sisa_poned"');
        $this->db->from('laporan_poned, obat_poned');
        $this->db->where('laporan_poned.id_obat = obat_poned.id_obat');
        $this->db->where('laporan_poned.id_laporan_poned IN (SELECT MAX(id_laporan_poned) FROM laporan_poned GROUP BY id_obat)');
        $this->db->group_by('obat_poned.nama_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
}
