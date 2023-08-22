<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaranponed_model extends CI_Model
{
    public $table = 'pengeluaran_poned';
    public $id = 'pengeluaran_poned.id_pengeluaran_poned';
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
    public function getPengeluaranPoned()
    {
        $this->db->select('obat_poned.kode_obat, obat_poned.nama_obat, obat_poned.satuan, jumlah, keperluan, tanggal_pengeluaran');
        $this->db->from('pengeluaran_poned');
        $this->db->join('obat_poned', 'pengeluaran_poned.id_obat = obat_poned.id_obat');
        $this->db->order_by('pengeluaran_poned.id_pengeluaran_poned', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_pengeluaran_poned)
    {
        $this->db->from($this->table);
        $this->db->where('id_pengeluaran_poned', $id_pengeluaran_poned);
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

    public function top_ten_obat_keluar_poned()
    {
        $this->db->select('obat_poned.nama_obat, SUM(jumlah) AS total');
        $this->db->from('pengeluaran_poned, obat_poned');
        $this->db->where('obat_poned.id_obat = pengeluaran_poned.id_obat');
        $this->db->group_by('pengeluaran_poned.id_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function obat_keluar_poned()
    {
        $this->db->select('obat_poned.nama_obat, obat_poned.kode_obat, pengeluaran_poned.jumlah');
        $this->db->from('pengeluaran_poned, obat_poned');
        $this->db->where('obat_poned.id_obat = pengeluaran_poned.id_obat');
        $this->db->group_by('pengeluaran_poned.id_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
}
