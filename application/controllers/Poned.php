<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poned extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_poned/headerponed");
        $this->load->view("poned/vw_dashboardponed", $data);
        $this->load->view("layout_poned/footerponed");
    }
    function getObatPoned()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_poned/headerponed");
        $this->load->view("poned/vw_obatponed", $data);
        $this->load->view("layout_poned/footerponed");
    }
    function getPermintaanPoned()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_poned/headerponed");
        $this->load->view("poned/vw_permintaanponed", $data);
        $this->load->view("layout_poned/footerponed");
    }
    function getPemasukanPoned()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_poned/headerponed");
        $this->load->view("poned/vw_pemasukanponed", $data);
        $this->load->view("layout_poned/footerponed");
    }
}