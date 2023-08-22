<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi_model extends CI_Model
{
    public $table = 'notifikasi';
    public $id = 'notifikasi.id_notifikasi';
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
    public function getById($id_notifikasi)
    {
        $this->db->from($this->table);
        $this->db->where('id_notifikasi', $id_notifikasi);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function getByIdUser($id_user)
    {
        $this->db->from($this->table);
        $this->db->where('id_user', $id_user);
        $this->db->order_by($this->id, 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
