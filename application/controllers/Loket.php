<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_loket/header");
        $this->load->view("loket/vw_dashboard", $data);
        $this->load->view("layout_loket/footer");
    }

    function getDataPendaftaran()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_loket/header");
        $this->load->view("loket/vw_datapendaftaran", $data);
        $this->load->view("layout_loket/footer");
    }
    function getDataPasien()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_loket/header");
        $this->load->view("loket/vw_datapasien", $data);
        $this->load->view("layout_loket/footer");
    }
    function tambahPendaftaran()
    {
        $data['judul'] = "Formulir Pasien Baru";
        $this->load->view("layout_loket/header");
        $this->load->view("loket/vw_pasienbaru", $data);
        $this->load->view("layout_loket/footer");
    }
    function cariPasien()
    {
        $data['judul'] = "Halaman Pasien Lama";
    }
}