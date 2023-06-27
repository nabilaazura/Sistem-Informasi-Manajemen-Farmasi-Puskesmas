<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obatpustu_model extends CI_Model
{
    public $table = 'obat_pustu';
    public $id = 'obat_pustu.id_obat';
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
    public function getById($id_obat)
    {
        $this->db->from($this->table);
        $this->db->where('id_obat', $id_obat);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByName()
    {
        $this->db->select('kode_obat, nama_obat, satuan, harga_satuan, SUM(jumlah_masuk) as stok');
        $this->db->from($this->table);
        $this->db->group_by('nama_obat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getByNameExp($namaObat)
    {
        $this->db->from($this->table);
        $this->db->where('nama_obat', $namaObat);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getObatExpired($namaObat)
    {
        // $this->db->select('id_obat');
        $this->db->from($this->table);
        $this->db->like('nama_obat', $namaObat);
        $this->db->where('expire <= now()');
        $this->db->where('jumlah_masuk != 0');
        $query = $this->db->get();
        return $query->result_array();
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
    // public function deleteObatExpired($ids)
    // {
    //     $this->db->where_in($this->id, $ids);
    //     $this->db->delete($this->table);
    //     return $this->db->affected_rows();
    // }
    public function updateStok($id_obat, $stok)
    {
        $this->db->update($this->table, ['jumlah_masuk' => $stok], ['id_obat' => $id_obat]);
        return $this->db->affected_rows();
    }
}
