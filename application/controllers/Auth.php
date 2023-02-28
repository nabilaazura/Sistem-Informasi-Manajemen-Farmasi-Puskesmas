<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_auth/header_auth");
        $this->load->view("auth/login", $data);
        $this->load->view("layout_auth/footer_auth");
    }
    function registrasi()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_auth/header_auth");
        $this->load->view("auth/registrasi", $data);
        $this->load->view("layout_auth/footer_auth");
    }
}