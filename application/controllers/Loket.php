<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pasien_model');
        $this->load->model('Pendaftaranpasien_model');
        $this->load->model('RekamMedis_model');
    }

    function index()
    {
        if ($this->session->userdata('role') == 'loket') {
            $data['judul'] = "Selamat Datang";
            $this->load->view("layout_loket/header");
            $this->load->view("loket/vw_dashboard", $data);
            $this->load->view("layout_loket/footer");
        } else {
            redirect(base_url('auth'));
        }
    }

    function getDataPendaftaran()
    {
        $data['judul'] = "Selamat Datang";
        $data['data_pendaftaran'] = $this->Pendaftaranpasien_model->get();

        for ($i = 0; $i < count($data['data_pendaftaran']); $i++) {
            $idPasien = $data['data_pendaftaran'][$i]['id_pasien'];
            $dataPasien = $this->Pasien_model->getById($idPasien);

            $data['data_pendaftaran'][$i]['nama_pasien'] = $dataPasien['nama_pasien'];
            $data['data_pendaftaran'][$i]['no_hp'] = $dataPasien['no_hp'];
            $data['data_pendaftaran'][$i]['nik'] = $dataPasien['nik'];
            $data['data_pendaftaran'][$i]['jenis_kelamin'] = $dataPasien['jenis_kelamin'];
            $data['data_pendaftaran'][$i]['tanggal_lahir'] = $dataPasien['tanggal_lahir'];
            $data['data_pendaftaran'][$i]['alamat'] = $dataPasien['alamat'];
        }

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
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required', [
            'required' => 'Nama Pasien Wajib di Isi'
        ]);
        $this->form_validation->set_rules('nik', 'NIK', 'required', [
            'required' => 'NIK Wajib di Isi'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', [
            'required' => 'No HP Wajib di Isi'
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', [
            'required' => 'Tanggal Lahir Wajib di Isi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Alamat Wajib di Isi'
        ]);
        $this->form_validation->set_rules('no_hp', 'No HP', 'required', [
            'required' => 'No HP Wajib di Isi'
        ]);

        if ($this->form_validation->run() == false) {
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
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pasien Berhasil Ditambah!</div>');
            redirect(base_url('loket/getdatapasien'));
        }
    }
    function cariPasien()
    {
        // $search_query = $this->input->get('search_query');
        // $data['results'] = $this->Pasien_model->search_data($search_query);
        $data['results'] = $this->Pasien_model->get();
        $this->load->view("layout_loket/header");
        $this->load->view("loket/vw_pasienlama", $data);
        $this->load->view("layout_loket/footer");
    }

    // function search()
    // {
    //     $search_query = $this->input->get('search_query');
    //     $results = $this->Pasien_model->search_data($search_query);
    //     echo json_encode($results);
    // }
    function detailPasien($id_pasien)
    {
        $data['judul'] = "Halaman Detail Pasien";
        $data['pasien'] = $this->Pasien_model->getById($id_pasien);
        $data['riwayat_pasien'] = $this->Pendaftaranpasien_model->getByIdPasien($id_pasien);
        $this->load->view("layout_loket/header");
        $this->load->view("loket/vw_detailpasien", $data);
        $this->load->view("layout_loket/footer");
    }
    function riwayatPasien($id_antrian)
    {
        $data['judul'] = "Halaman Riwayat Berobat Pasien";
        $data['riwayat'] = $this->RekamMedis_model->getByIdPendaftaran($id_antrian);
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
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pasien Berhasil Ditambah!</div>');
        redirect(base_url('loket/getdatapasien'));
    }
    function antrianPasien()
    {
        $now = date('Y-m-d H:i:s');
        $idPasien = $this->input->post('id_pasien');

        $data = [
            'tanggal_pendaftaran' => $this->input->post('tanggal_pendaftaran'),
            'id_pasien' => $this->input->post('id_pasien'),
            'poliklinik' => $this->input->post('poliklinik'),
            'status' => "Menunggu",
        ];
        $this->Pendaftaranpasien_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pendaftaran Berhasil Ditambah!</div>');
        redirect(base_url('Loket/getDataPendaftaran'));
    }
}
