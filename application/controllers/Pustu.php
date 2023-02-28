<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pustu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_pustu/headerpustu");
        $this->load->view("pustu/vw_dashboardpustu", $data);
        $this->load->view("layout_pustu/footerpustu");
    }
    function getObatPustu()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_pustu/headerpustu");
        $this->load->view("pustu/vw_obatpustu", $data);
        $this->load->view("layout_pustu/footerpustu");
    }
    function getPermintaanPustu()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_pustu/headerpustu");
        $this->load->view("pustu/vw_permintaanpustu", $data);
        $this->load->view("layout_pustu/footerpustu");
    }
    function getPemasukanPustu()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_pustu/headerpustu");
        $this->load->view("pustu/vw_pemasukanpustu", $data);
        $this->load->view("layout_pustu/footerpustu");
    }
}