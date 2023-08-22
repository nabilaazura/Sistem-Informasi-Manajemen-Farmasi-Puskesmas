<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan_model extends CI_Model
{
    public $table = 'permintaan_obat';
    public $id = 'permintaan_obat.id_permintaan_obat';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->from($this->table);
        $this->db->order_by('status', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_permintaan_obat)
    {
        $this->db->from($this->table);
        $this->db->where('id_permintaan_obat', $id_permintaan_obat);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function updatestatus($status, $id_permintaan_obat)
    {
        $this->db->set('status', $status);
        $this->db->where('id_permintaan_obat', $id_permintaan_obat);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }
    public function getPermintaanApotek()
    {
        $this->db->select('nama_obat, kode_obat, satuan, permintaan, jumlah, tanggal_permintaan, status');
        $this->db->from('permintaan_obat');
        $this->db->join('user', 'permintaan_obat.id_user_puskesmas = user.id_user');
        $this->db->where('permintaan_obat.permintaan', 'apotek');
        $this->db->where('user.id_user', 3);
        $this->db->order_by('status', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPermintaanPoned()
    {
        $this->db->select('nama_obat, kode_obat, satuan, permintaan, jumlah, tanggal_permintaan, status');
        $this->db->from('permintaan_obat');
        $this->db->join('user', 'permintaan_obat.id_user_puskesmas = user.id_user');
        $this->db->where('permintaan_obat.permintaan', 'poned');
        $this->db->where('user.id_user', 4);
        $this->db->order_by('status', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPermintaanPustu()
    {
        $this->db->select('nama_obat, kode_obat, satuan, permintaan, jumlah, tanggal_permintaan, status');
        $this->db->from('permintaan_obat');
        $this->db->join('user', 'permintaan_obat.id_user_puskesmas = user.id_user');
        $this->db->where('permintaan_obat.permintaan', 'pustu');
        $this->db->where('user.id_user', 5);
        $this->db->order_by('status', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
}
