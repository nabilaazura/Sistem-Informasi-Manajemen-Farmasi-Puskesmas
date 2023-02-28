<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pasien_model');
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
        $data['data_pasien'] = $this->Pasien_model->get();
        $this->load->view("layout_loket/header");
        $this->load->view("loket/vw_datapasien", $data);
        $this->load->view("layout_loket/footer");
    }
    function pendaftaranPasien()
    {
        $data['judul'] = "Halaman Tambah Pasien";
        $this->form_validation->set_rules('nama_pasien','Nama Pasien','required', [
            'required'=> 'Nama Pasien Wajib di Isi']);
        $this->form_validation->set_rules('nik','NIK','required', [
            'required'=> 'NIK Wajib di Isi']);
        $this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required', [
            'required'=> 'No HP Wajib di Isi']);
        $this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required', [
            'required'=> 'Tanggal Lahir Wajib di Isi']);
        $this->form_validation->set_rules('alamat','Alamat','required', [
            'required'=> 'Alamat Wajib di Isi']);
        $this->form_validation->set_rules('no_hp','No HP','required', [
            'required'=> 'No HP Wajib di Isi']);

        if($this->form_validation->run() == false){
            $this->load->view("layout_loket/header");
            $this->load->view("loket/vw_pasienbaru", $data);
            $this->load->view("layout_loket/footer");
        } else {
            $now = date('Y-m-d H:i:s');
            $data = [
                'nama_pasien' => $this->input->post('nama_pasien'),
                'nik' => $this->input->post('nik'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'tanggal_registrasi' => $now,
            ];
            $this->Pasien_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Pasien Berhasil Ditambah!</div>');

            redirect(base_url('loket/getdatapasien'));
        }
    }
    function cariPasien()
    {
        $data['judul'] = "Halaman Pasien Lama";
        $this->load->view("layout_loket/header");
        $this->load->view("loket/vw_pasienlama", $data);
        $this->load->view("layout_loket/footer");
    }
    function detailPasien()
    {
        $data['judul'] = "Halaman Detail Pasien";
        $this->load->view("layout_loket/header");
        $this->load->view("loket/vw_detailpasien", $data);
        $this->load->view("layout_loket/footer");
    }
    function riwayatPasien()
    {
        $data['judul'] = "Halaman Riwayat Berobat Pasien";
        $this->load->view("layout_loket/header");
        $this->load->view("loket/vw_riwayatpasien", $data);
        $this->load->view("layout_loket/footer");
    }
    function savedata()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            'nama_pasien' => $this->input->post('nama_pasien'),
            'nik' => $this->input->post('nik'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
            'tanggal_registrasi' => $now,
        ];
        $this->Pasien_model->insert($data);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Pasien Berhasil Ditambah!</div>');
        redirect(base_url('loket/getdatapasien'));
    }
}
