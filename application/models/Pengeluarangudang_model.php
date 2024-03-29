<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluarangudang_model extends CI_Model
{
    public $table = 'pengeluaran_gudang';
    public $id = 'pengeluaran_gudang.id_pengeluaran_gudang';
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
    public function getPengeluaranGudang()
    {
        $this->db->select('obat.kode_obat, obat.nama_obat, obat.satuan, jumlah, keperluan, tanggal_pengeluaran');
        $this->db->from('pengeluaran_gudang');
        $this->db->join('obat', 'pengeluaran_gudang.id_obat = obat.id_obat');
        $this->db->order_by('pengeluaran_gudang.id_pengeluaran_gudang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_pengeluaran_gudang)
    {
        $this->db->from($this->table);
        $this->db->where('id_pengeluaran_gudang', $id_pengeluaran_gudang);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function total_obat_keluar()
    {
        $this->db->select('SUM(jumlah) AS total_obat');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function top_ten_obat_keluar()
    {
        $this->db->select('obat.nama_obat, SUM(jumlah) AS total');
        $this->db->from('pengeluaran_gudang, obat');
        $this->db->where('obat.id_obat = pengeluaran_gudang.id_obat');
        $this->db->group_by('pengeluaran_gudang.id_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function obat_keluar_gudang()
    {
        $this->db->select('obat.nama_obat, obat.kode_obat, pengeluaran_gudang.jumlah');
        $this->db->from('pengeluaran_gudang, obat');
        $this->db->where('obat.id_obat = pengeluaran_gudang.id_obat');
        $this->db->group_by('pengeluaran_gudang.id_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
}
