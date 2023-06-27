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
        $this->load->model('Pengeluaranapotek_model');
        $this->load->model('Laporanapotek_model');
        $this->load->model('Obatapotek_model');
    }

    function index()
    {
        if ($this->session->userdata('role') == 'poliklinik') {
            $data['judul'] = "Selamat Datang";
            $this->load->view("layout_poliklinik/headerpoli");
            $this->load->view("poliklinik/vw_dashboardpoli", $data);
            $this->load->view("layout_poliklinik/footerpoli");
        } else {
            redirect(base_url('auth'));
        }
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
        $data['rekam_medis'] = $this->Pendaftaranpasien_model->getByIdPendaftaran($id_antrian);
        $data['results_baru'] = $this->Obatapotek_model->getByName();

        $this->form_validation->set_rules('keluhan', 'Keluhan Pasien', 'required', [
            'required' => 'Keluhan Pasien Wajib diisi'
        ]);
        $this->form_validation->set_rules('diagnosa', 'Hasil Diagnosa', 'required', [
            'required' => 'Hasil Diagnosa Pasien Wajib Wajib diisi'
        ]);
        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required', [
            'required' => 'Tindakan Wajib diisi'
        ]);
        $this->form_validation->set_rules('tensi', 'Tensi', 'required', [
            'required' => 'Tensi Pasien Wajib diisi'
        ]);
        // $this->form_validation->set_rules('resep', 'Resep', 'required|xss_clean', [
        //     'required' => 'Resep Obat Wajib diisi'
        // ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("layout_poliklinik/headerpoli");
            $this->load->view("poliklinik/vw_rekammedis", $data);
            $this->load->view("layout_poliklinik/footerpoli2");
        } else {
            $now = date('Y-m-d H:i:s');
            $data = [
                'id_pasien' => $this->input->post('id_pasien'),
                'id_antrian' => $this->input->post('id_antrian'),
                'poliklinik' => $this->input->post('poliklinik'),
                'keluhan' => $this->input->post('keluhan'),
                'diagnosa' => $this->input->post('diagnosa'),
                'tindakan' => $this->input->post('tindakan'),
                'tensi' => $this->input->post('tensi'),
                'resep' => $this->input->post('resep', false),
                'dokter' => $this->input->post('dokter'),
            ];
            $dataresep = [
                'id_pendaftaran' => $this->input->post('id_antrian'),
                'id_pasien' => $this->input->post('id_pasien'),
                'resep' => $this->input->post('resep'),
            ];

            $this->RekamMedis_model->insert($data);
            $this->Resep_model->insert($dataresep);
            $this->Pendaftaranpasien_model->updatestatus('Sudah selesai', $this->input->post('id_antrian'));

            // Split the resep
            $resep = $this->input->post('resep', false);
            $items = explode("; ", $resep);

            foreach ($items as $item) {
                if ($item != "") {
                    $dt = explode("(", $item);
                    $namaObat = trim($dt[0]);

                    $dataObatYangDipilih = $this->Obatapotek_model->getByNameExp($namaObat);
                    $sisa_obat_keluar = 1;
                    foreach ($dataObatYangDipilih as $data) {
                        $sisa_stok_obat = $data['jumlah_masuk'];
                        if ($sisa_obat_keluar != 0) {
                            if ($sisa_stok_obat < $sisa_obat_keluar) {
                                $sisa_obat_keluar -= $sisa_stok_obat;
                                $sisa_stok_obat = 0;
                            } else if (intval($data['jumlah_masuk']) > $sisa_obat_keluar) {
                                $sisa_stok_obat -= $sisa_obat_keluar;
                                $sisa_obat_keluar = 0;
                            } else {
                                $sisa_stok_obat = 0;
                                $sisa_obat_keluar = 0;
                            }

                            if ($sisa_stok_obat == 0) {
                                // Update stok obat
                                $this->Obatapotek_model->updateStok($data['id_obat'], 0);

                                // Simpan riwayat pengeluaran
                                $riwayat = [
                                    'id_obat' => $data['id_obat'],
                                    'keperluan' => 'Obat pasien',
                                    'jumlah' => $data['jumlah_masuk'],
                                    'tanggal_pengeluaran' => $now,
                                ];
                                $this->Pengeluaranapotek_model->insert($riwayat);

                                // Simpan riwayat ke dalam laporan
                                $laporan = [
                                    'id_obat' => $data['id_obat'],
                                    'stok_awal' => $data['jumlah_masuk'],
                                    'masuk' => 0,
                                    'pemakaian' => $data['jumlah_masuk'],
                                    'ed' => 0,
                                    'sisa_stok' => 0,
                                    'created_at' => $now,
                                ];
                                $this->Laporanapotek_model->insert($laporan);
                            } else {
                                // Update stok obat
                                $this->Obatapotek_model->updateStok($data['id_obat'], $sisa_stok_obat);

                                // Simpan riwayat pengeluaran
                                $riwayat = [
                                    'id_obat' => $data['id_obat'],
                                    'keperluan' => 'Obat pasien',
                                    'tanggal_pengeluaran' => $now,
                                    'jumlah' => $data['jumlah_masuk'] - $sisa_stok_obat,
                                ];
                                $this->Pengeluaranapotek_model->insert($riwayat);

                                // Simpan riwayat ke dalam laporan
                                $laporan = [
                                    'id_obat' => $data['id_obat'],
                                    'stok_awal' => $data['jumlah_masuk'],
                                    'masuk' => 0,
                                    'pemakaian' => $data['jumlah_masuk'] - $sisa_stok_obat,
                                    'ed' => 0,
                                    'sisa_stok' => $sisa_stok_obat,
                                    'created_at' => $now,
                                ];
                                $this->Laporanapotek_model->insert($laporan);
                            }
                        } else {
                            break;
                        }
                    }
                }
            }

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
    // function StatusAntrian($id_pendaftaran)
    // {
    //     $data['judul'] = "Selamat Datang";
    //     $data['data'] = $this->Pendaftaranpasien_model->getById($id_pendaftaran);
    //     $this->load->view("layout_poliklinik/headerpoli");
    //     $this->load->view("poliklinik/vw_statusantrian", $data);
    //     $this->load->view("layout_poliklinik/footerpoli");
    // }
    // function ubahStatus()
    // {
    //     $id_pendaftaran = $this->input->post('id_pendaftaran');
    //     $statusbaru =  $this->input->post('status');
    //     $this->Pendaftaranpasien_model->updatestatus($statusbaru, $id_pendaftaran);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status Berhasil Diubah</div>');
    //     redirect(base_url('Poliklinik/getDataAntrian'));
    // }
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
