<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model
{
    public $table = 'pengeluaran_pustu';
    public $id = 'pengeluaran_pustu.id_pengeluaran_pustu';
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
    public function getById($id_pengeluaran_pustu)
    {
        $this->db->from($this->table);
        $this->db->where('id_pengeluaran_pustu', $id_pengeluaran_pustu);
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

    public function top_ten_obat_keluar_pustu()
    {
        $this->db->select('obat_pustu.nama_obat, SUM(jumlah) AS total');
        $this->db->from('pengeluaran_pustu, obat_pustu');
        $this->db->where('obat_pustu.id_obat = pengeluaran_pustu.id_obat');
        $this->db->group_by('pengeluaran_pustu.id_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function obat_keluar_pustu()
    {
        $this->db->select('obat_pustu.nama_obat, obat_pustu.kode_obat, pengeluaran_pustu.jumlah');
        $this->db->from('pengeluaran_pustu, obat_pustu');
        $this->db->where('obat_pustu.id_obat = pengeluaran_pustu.id_obat');
        $this->db->group_by('pengeluaran_pustu.id_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
}
