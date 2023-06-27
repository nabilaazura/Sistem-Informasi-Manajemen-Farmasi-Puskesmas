<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resep_model extends CI_Model
{
    public $table = 'resep';
    public $id = 'resep.id_resep';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->select('resep.id_pendaftaran, pendaftaran_pasien.tanggal_pendaftaran, pasien.nama_pasien, resep');
        $this->db->from('resep, pendaftaran_pasien, pasien');
        $this->db->where('resep.id_pendaftaran = pendaftaran_pasien.id_pendaftaran AND resep.id_pasien = pasien.id_pasien');
        $this->db->order_by('id_resep', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_resep)
    {
        $this->db->from($this->table);
        $this->db->where('id_resep', $id_resep);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByIdPendaftaran($id_pendaftaran)
    {
        $this->db->select('pasien.nama_pasien, resep');
        $this->db->from('resep, pasien');
        $this->db->where('resep.id_pasien = pasien.id_pasien AND id_pendaftaran = ' . $id_pendaftaran);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    // public function sortPendaftaran()
    // {
    //     $query = $this->db->select('*')
    //         ->from('resep')
    //         ->order_by('id_resep', 'desc')
    //         ->get();

    //     $result = $query->result();
    // }
}
