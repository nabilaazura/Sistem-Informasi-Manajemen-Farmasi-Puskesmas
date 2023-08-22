<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    public $table = 'pasien';
    public $id = 'pasien.id_pasien';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->from($this->table);
        $this->db->order_by($this->id, 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id_pasien)
    {
        $this->db->from($this->table);
        $this->db->where('id_pasien', $id_pasien);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByName()
    {
        $this->db->select('nama_pasien');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function search_data($search_query)
    {
        $this->db->like('nama_pasien', $search_query);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    public function total_pasien()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function total_pasien_per_bulan()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from($this->table);
        $this->db->where('MONTH(tanggal_registrasi)', date('m'));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function total_pasien_per_hari()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from($this->table);
        $this->db->where('DAY(tanggal_registrasi) = DAY(CURRENT_DATE)');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_pasien_by_month()
    {
        $this->db->select('months.month, COALESCE(COUNT(pasien.tanggal_registrasi), 0) AS total');
        $this->db->from('(SELECT 1 AS month
            UNION SELECT 2
            UNION SELECT 3
            UNION SELECT 4
            UNION SELECT 5
            UNION SELECT 6
            UNION SELECT 7
            UNION SELECT 8
            UNION SELECT 9
            UNION SELECT 10
            UNION SELECT 11
            UNION SELECT 12) AS months', false);
        $this->db->join('pasien', 'MONTH(pasien.tanggal_registrasi) = months.month', 'LEFT');
        $this->db->group_by('months.month');
        $query = $this->db->get();
        return $query->result_array();
    }
}
