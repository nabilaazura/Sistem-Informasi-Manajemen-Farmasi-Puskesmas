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
        $this->load->model('Notifikasi_model');
    }

    function index()
    {
        if ($this->session->userdata('role') == 'loket') {
            $data['menu'] = 'dashboard';
            $data['total_pasien'] = $this->Pasien_model->total_pasien();
            $data['total_pasien_bulan_ini'] = $this->Pasien_model->total_pasien_per_bulan();
            $data['total_pasien_hari_ini'] = $this->Pasien_model->total_pasien_per_hari();
            $data['data_pasien'] = $this->Pasien_model->get_pasien_by_month();

            $this->load->view("layout_loket/header", $data);
            $this->load->view("loket/vw_dashboard", $data);
            $this->load->view("layout_loket/footer", $data);
        } else {
            redirect(base_url('auth'));
        }
    }

    function getDataPendaftaran()
    {
        $data['menu'] = 'data pendaftaran';
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

        $this->load->view("layout_loket/header", $data);
        $this->load->view("loket/vw_datapendaftaran", $data);
        $this->load->view("layout_loket/footer");
        $this->load->database();
    }

    function getDataPasien()
    {
        $data['menu'] = 'data pasien';
        $data['data_pasien'] = $this->Pasien_model->get();

        $this->load->view("layout_loket/header", $data);
        $this->load->view("loket/vw_datapasien", $data);
        $this->load->view("layout_loket/footer");
    }

    function pendaftaranPasien()
    {
        $data['menu'] = 'data pendaftaran';

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
            $this->load->view("layout_loket/header", $data);
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

            // Create notification
            $notif = [
                'id_user' => 7,
                'pesan' => 'Pasien baru telah terdaftar dalam sistem',
                'status' => 0,
                'tanggal_notif' => $now
            ];
            $this->Notifikasi_model->insert($notif);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pasien Baru Berhasil Ditambah!</div>');
            redirect(base_url('loket/getDataPendaftaran'));
        }
    }

    function cariPasien()
    {
        // $search_query = $this->input->get('search_query');
        // $data['results'] = $this->Pasien_model->search_data($search_query);
        $data['menu'] = 'data pasien';
        $data['results'] = $this->Pasien_model->get();

        $this->load->view("layout_loket/header", $data);
        $this->load->view("loket/vw_pasienlama", $data);
        $this->load->view("layout_loket/footer2");
    }

    // function search()
    // {
    //     $search_query = $this->input->get('search_query');
    //     $results = $this->Pasien_model->search_data($search_query);
    //     echo json_encode($results);
    // }
    function antrianPasien()
    {
        $now = date('Y-m-d H:i:s');
        $idPasien = $this->input->post('id_pasien');

        $data = [
            'tanggal_pendaftaran' => $now,
            'id_pasien' => $this->input->post('id_pasien'),
            'poliklinik' => $this->input->post('poliklinik'),
            'dokter' => $this->input->post('dokter'),
            'status' => "Menunggu",
        ];
        $this->Pendaftaranpasien_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pendaftaran Berhasil Ditambah!</div>');
        redirect(base_url('Loket/getDataPendaftaran'));
    }
    function detailPasien($id_pasien)
    {
        $data['menu'] = 'data pasien';
        $data['pasien'] = $this->Pasien_model->getById($id_pasien);
        $data['riwayat_pasien'] = $this->Pendaftaranpasien_model->getByIdPasien($id_pasien);

        $this->load->view("layout_loket/header", $data);
        $this->load->view("loket/vw_detailpasien", $data);
        $this->load->view("layout_loket/footer");
    }

    function riwayatPasien($id_antrian)
    {
        $data['menu'] = 'data pasien';
        $data['riwayat'] = $this->RekamMedis_model->getByIdPendaftaran($id_antrian);

        $this->load->view("layout_loket/header", $data);
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
}
