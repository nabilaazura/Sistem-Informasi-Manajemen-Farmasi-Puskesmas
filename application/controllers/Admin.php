<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    function index()
    {
        if ($this->session->userdata('role') == 'admin') {
            $data['menu'] = 'dashboard';
            $data['data_user'] = $this->User_model->get();
            $this->load->view("layout_admin/headeradmin", $data);
            $this->load->view("admin/vw_user", $data);
            $this->load->view("layout_admin/footeradmin");
        } else {
            redirect(base_url('auth'));
        }
    }

    // function getUser()
    // {
    //     if ($this->session->userdata('role') == 'admin') {
    //         $data['menu'] = 'user';
    //         $data['data_user'] = $this->User_model->get();
    //         $this->load->view("layout_admin/headeradmin", $data);
    //         $this->load->view("admin/vw_user", $data);
    //         $this->load->view("layout_admin/footeradmin");
    //     } else {
    //         redirect(base_url('auth'));
    //     }
    // }

    function updateRole()
    {
        $data = [
            'username' => $this->input->post('nama_obat'),
            'password' => $this->input->post('satuan'),
            'role' => $this->input->post('harga_satuan'),
        ];
        $id_user = $this->input->post('id_user');
        $this->User_model->update(['id_user' => $id_user], $data);
        redirect(base_url('Admin/getUser'));
    }
}
