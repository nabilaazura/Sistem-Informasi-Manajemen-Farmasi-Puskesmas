<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GudangFarmasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_gudangfarmasi/headergudang");
        $this->load->view("gudangfarmasi/vw_dashboardgudang", $data);
        $this->load->view("layout_gudangfarmasi/footergudang");
    }
    function getDataObat()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_gudangfarmasi/headergudang");
        $this->load->view("gudangfarmasi/vw_obatgudang", $data);
        $this->load->view("layout_gudangfarmasi/footergudang");
    }
    function tambahObat()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_gudangfarmasi/headergudang");
        $this->load->view("gudangfarmasi/vw_tambahobat", $data);
        $this->load->view("layout_gudangfarmasi/footergudang");
    }
    function getPermintaan()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_gudangfarmasi/headergudang");
        $this->load->view("gudangfarmasi/vw_permintaanobat", $data);
        $this->load->view("layout_gudangfarmasi/footergudang");
    }
    function getPemasukan()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_gudangfarmasi/headergudang");
        $this->load->view("gudangfarmasi/vw_pemasukanobat", $data);
        $this->load->view("layout_gudangfarmasi/footergudang");
    }
    function tambahPemasukan()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_gudangfarmasi/headergudang");
        $this->load->view("gudangfarmasi/vw_tambahpemasukan", $data);
        $this->load->view("layout_gudangfarmasi/footergudang");
    }
    function getLaporan()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_gudangfarmasi/headergudang");
        $this->load->view("gudangfarmasi/vw_laporan", $data);
        $this->load->view("layout_gudangfarmasi/footergudang");
    }

}