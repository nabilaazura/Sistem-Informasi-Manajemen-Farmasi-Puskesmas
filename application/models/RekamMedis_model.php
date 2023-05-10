<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekamMedis_model extends CI_Model
{
    public $table = 'rekam_medis';
    public $id = 'rekam_medis.id_rekammed';
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
    public function getById($id_rekammed)
    {
        $this->db->from($this->table);
        $this->db->where('id_rekammed', $id_rekammed);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByIdPendaftaran($id_antrian)
    {
        $this->db->from($this->table);
        $this->db->where('id_antrian', $id_antrian);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}
