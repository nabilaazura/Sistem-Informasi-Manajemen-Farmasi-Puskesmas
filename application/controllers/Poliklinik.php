<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poliklinik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_dashboardpoli", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
    function getDataAntrian()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_antrian", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
    function RekamMedis()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_rekammedis", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
    function getDataPasien()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_datapasienpoli", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
    function detailPasien()
    {
        $data['judul'] = "Halaman Detail Pasien";
        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_detailpasienpoli", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
    function riwayatPasien()
    {
        $data['judul'] = "Halaman Riwayat Berobat Pasien";
        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_riwayatpasienpoli", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
}