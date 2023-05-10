<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poliklinik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RekamMedis_model');
        $this->load->model('Pendaftaranpasien_model');
        $this->load->model('Pasien_model');
        $this->load->model('Resep_model');
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

        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_antrian", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
    function RekamMedis($id_antrian, $id_pasien)
    {
        $data['judul'] = "Rekam Medis Pasien";
        $data['id_antrian'] = $id_antrian;
        $data['id_pasien'] = $id_pasien;

        $this->form_validation->set_rules('dokter', 'Dokter', 'required', [
            'required' => 'Nama Dokter Wajib di Isi'
        ]);
        $this->form_validation->set_rules('poliklinik', 'Poliklinik', 'required', [
            'required' => 'Poliklinik Wajib di Isi'
        ]);
        $this->form_validation->set_rules('keluhan', 'Keluhan Pasien', 'required', [
            'required' => 'Keluhan Pasien Wajib di Isi'
        ]);
        $this->form_validation->set_rules('diagnosa', 'Hasil Diagnosa', 'required', [
            'required' => 'Hasil Diagnosa Pasien Wajib Wajib di Isi'
        ]);
        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required', [
            'required' => 'Tindakan Wajib di Isi'
        ]);
        $this->form_validation->set_rules('tensi', 'Tensi', 'required', [
            'required' => 'Tensi Pasien Wajib di Isi'
        ]);
        $this->form_validation->set_rules('resep', 'Resep Obat', 'required', [
            'required' => 'Resep Obat Wajib di Isi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("layout_poliklinik/headerpoli");
            $this->load->view("poliklinik/vw_rekammedis", $data);
            $this->load->view("layout_poliklinik/footerpoli");
        } else {
            $data = [
                'id_pasien' => $this->input->post('id_pasien'),
                'id_antrian' => $this->input->post('id_antrian'),
                'poliklinik' => $this->input->post('poliklinik'),
                'keluhan' => $this->input->post('keluhan'),
                'diagnosa' => $this->input->post('diagnosa'),
                'tindakan' => $this->input->post('tindakan'),
                'tensi' => $this->input->post('tensi'),
                'resep' => $this->input->post('resep'),
                'dokter' => $this->input->post('dokter'),
            ];
            $dataresep = [
                'id_pendaftaran' => $this->input->post('id_antrian'),
                'id_pasien' => $this->input->post('id_pasien'),
                'resep' => $this->input->post('resep'),
            ];

            $this->RekamMedis_model->insert($data);
            $this->Resep_model->insert($dataresep);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Rekam Medis Pasien Berhasil Ditambah!</div>');
            redirect(base_url('Poliklinik/getDataAntrian'));
        }
    }
    function getDataPasien()
    {
        $data['judul'] = "Selamat Datang";
        $data['data_pasien'] = $this->Pasien_model->get();
        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_datapasienpoli", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
    function detailPasien($id_pasien)
    {
        $data['judul'] = "Halaman Detail Pasien";
        $data['pasien'] = $this->Pasien_model->getById($id_pasien);
        $data['riwayat_pasien'] = $this->Pendaftaranpasien_model->getByIdPasien($id_pasien);
        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_detailpasienpoli", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
    function riwayatPasien($id_antrian)
    {
        $data['judul'] = "Halaman Riwayat Berobat Pasien";
        $data['riwayat'] = $this->RekamMedis_model->getByIdPendaftaran($id_antrian);
        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_riwayatpasienpoli", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
    // function saveRekamMedis()
    // {
    //     $data = [
    //         'id_pasien' => $this->input->post('id_pasien'),
    //         'id_antrian' => $this->input->post('id_antrian'),
    //         'poliklinik' => $this->input->post('poliklinik'),
    //         'keluhan' => $this->input->post('keluhan'),
    //         'diagnosa' => $this->input->post('diagnosa'),
    //         'tindakan' => $this->input->post('tindakan'),
    //         'tensi' => $this->input->post('tensi'),
    //         'resep' => $this->input->post('resep'),
    //         'dokter' => $this->input->post('dokter'),
    //     ];
    //     var_dump($data);
    //     // $this->RekamMedis_model->insert($data);
    //     // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Rekam Medis Pasien Berhasil Ditambah!</div>');
    //     // redirect(base_url('Poliklinik/getDataAntrian'));
    // }
    function StatusAntrian($id_pendaftaran)
    {
        $data['judul'] = "Selamat Datang";
        $data['data'] = $this->Pendaftaranpasien_model->getById($id_pendaftaran);
        $this->load->view("layout_poliklinik/headerpoli");
        $this->load->view("poliklinik/vw_statusantrian", $data);
        $this->load->view("layout_poliklinik/footerpoli");
    }
    function ubahStatus()
    {
        $id_pendaftaran = $this->input->post('id_pendaftaran');
        $statusbaru =  $this->input->post('status');
        $this->Pendaftaranpasien_model->updatestatus($statusbaru, $id_pendaftaran);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status Berhasil Diubah</div>');
        redirect(base_url('Poliklinik/getDataAntrian'));
    }
    function saveResep()
    {
        $data['judul'] = "Resep Pasien";
        $data['id_pendaftaran'] = $id_pendaftaran;
        $data['id_pasien'] = $id_pasien;

        $this->form_validation->set_rules('resep', 'Resep', 'required', [
            'required' => 'Resep Obat Wajib di Isi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("layout_poliklinik/headerpoli");
            $this->load->view("poliklinik/vw_rekammedis", $data);
            $this->load->view("layout_poliklinik/footerpoli");
        } else {
            $data = [
                'id_pendaftaran' => $this->input->post('id_pendaftaran'),
                'id_pasien' => $this->input->post('id_pasien'),
                'resep' => $this->input->post('resep'),
            ];
            $this->Resep_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Resep Obat Berhasil Dikirim!</div>');
            redirect(base_url('Poliklinik/RekamMedis'));
        }
    }
}
