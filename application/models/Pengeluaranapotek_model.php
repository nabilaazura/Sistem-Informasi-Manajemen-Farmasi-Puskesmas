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
    public function getPengeluaranApotek()
    {
        $this->db->select('obat_apotek.kode_obat, obat_apotek.nama_obat, obat_apotek.satuan, jumlah, keperluan, tanggal_pengeluaran');
        $this->db->from('pengeluaran_apotek');
        $this->db->join('obat_apotek', 'pengeluaran_apotek.id_obat = obat_apotek.id_obat');
        $this->db->order_by('pengeluaran_apotek.id_pengeluaran_apotek', 'DESC');
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
    public function total_obat_keluar()
    {
        $this->db->select('SUM(jumlah) AS total_obat');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function top_ten_obat_keluar_apotek()
    {
        $this->db->select('obat_apotek.nama_obat, SUM(jumlah) AS total');
        $this->db->from('pengeluaran_apotek, obat_apotek');
        $this->db->where('obat_apotek.id_obat = pengeluaran_apotek.id_obat');
        $this->db->group_by('pengeluaran_apotek.id_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function obat_keluar_apotek()
    {
        $this->db->select('obat_apotek.nama_obat, obat_apotek.kode_obat, pengeluaran_apotek.jumlah');
        $this->db->from('pengeluaran_apotek, obat_apotek');
        $this->db->where('obat_apotek.id_obat = pengeluaran_apotek.id_obat');
        $this->db->group_by('pengeluaran_apotek.id_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
}
