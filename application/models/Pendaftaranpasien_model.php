<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaranpasien_model extends CI_Model
{
    public $table = 'pendaftaran_pasien';
    public $id = 'pendaftaran_pasien.id_pendaftaran';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->from($this->table);
        $this->db->order_by('status', 'asc');
        $this->db->order_by('id_pendaftaran', 'desc');

        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_pendaftaran)
    {
        $this->db->from($this->table);
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByIdPasien($id_pasien)
    {
        $this->db->from($this->table);
        $this->db->where(['id_pasien' => $id_pasien, 'status' => 'Sudah selesai']);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getByIdPendaftaran($id_pendaftaran)
    {
        $this->db->from($this->table);
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function updatestatus($status, $id_pendaftaran)
    {
        $this->db->set('status', $status);
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }
    public function sortPendaftaran()
    {
        $query = $this->db->select('*')
            ->from('pendaftaran_pasien')
            ->order_by('id_pendaftaran', 'desc')
            ->get();

        $result = $query->result();
    }
}
