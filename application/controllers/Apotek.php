<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apotek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_apotek/headerapotek");
        $this->load->view("apotek/vw_dashboardapotek", $data);
        $this->load->view("layout_apotek/footerapotek");
    }
    function getObatApotek()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_apotek/headerapotek");
        $this->load->view("apotek/vw_obatapotek", $data);
        $this->load->view("layout_apotek/footerapotek");
    }
    function getPermintaanApotek()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_apotek/headerapotek");
        $this->load->view("apotek/vw_permintaanapotek", $data);
        $this->load->view("layout_apotek/footerapotek");
    }
    function getResep()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_apotek/headerapotek");
        $this->load->view("apotek/vw_resep", $data);
        $this->load->view("layout_apotek/footerapotek");
    }
    function getPemasukanApotek()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_apotek/headerapotek");
        $this->load->view("apotek/vw_pemasukanapotek", $data);
        $this->load->view("layout_apotek/footerapotek");
    }
}