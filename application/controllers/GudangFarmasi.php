<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class GudangFarmasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obatgudang_model');
        $this->load->model('Permintaan_model');
        $this->load->model('Detailpermintaan_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Laporangudang_model');
        $this->load->model('LPLPO_model');
        $this->load->model('Pengeluarangudang_model');
    }

    function index()
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'dashboard';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['obat_masuk'] = $this->Obatgudang_model->total_obat_masuk();
            $data['obat_keluar'] = $this->Pengeluarangudang_model->total_obat_keluar();
            $data['obat_masuk_per_pengadaan'] = $this->Obatgudang_model->total_obat_masuk_per_pengadaan();
            $data['top_ten_obat_keluar'] = $this->Pengeluarangudang_model->top_ten_obat_keluar();

            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_dashboardgudang", $data);
            $this->load->view("layout_gudangfarmasi/footergudang");
        } else {
            redirect(base_url('auth'));
        }
    }

    function getDataObat()
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'obat';
            $data['data_obat'] = $this->Obatgudang_model->get();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_obatgudang", $data);
            $this->load->view("layout_gudangfarmasi/footergudang");
        } else {
            redirect(base_url('auth'));
        }
    }

    function getPermintaan()
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'permintaan obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['permintaan_obat'] = $this->Permintaan_model->get();

            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_permintaanobat", $data);
            $this->load->view("layout_gudangfarmasi/footergudang");
        } else {
            redirect(base_url('auth'));
        }
    }

    function getPengadaan()
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'pengadaan obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->form_validation->set_rules('kode_obat', 'Kode Obat', 'required', [
                'required' => 'Kode Obat Wajib di Isi'
            ]);
            $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required', [
                'required' => 'Nama Obat Wajib di Isi'
            ]);
            $this->form_validation->set_rules('satuan', 'Satuan/Kemasan', 'required', [
                'required' => 'Satuan/Kemasan Wajib di Isi'
            ]);
            $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required', [
                'required' => 'Harga Satuan Wajib Wajib di Isi'
            ]);
            $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required', [
                'required' => 'Jumlah Masuk Wajib di Isi'
            ]);
            $this->form_validation->set_rules('pengadaan', 'Pengadaan', 'required', [
                'required' => 'Kategori Pengadaan Wajib di Isi'
            ]);
            $this->form_validation->set_rules('expire', 'Tanggal Expire', 'required', [
                'required' => 'Tanggal Expire Obat Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view("layout_gudangfarmasi/headergudang", $data);
                $this->load->view("gudangfarmasi/vw_pengadaanobat", $data);
                $this->load->view("layout_gudangfarmasi/footergudang");
            } else {
                $now = date('Y-m-d H:i:s');
                $pengadaan = $this->input->post('pengadaan');

                $data = [
                    'kode_obat' => $this->input->post('kode_obat'),
                    'nama_obat' => $this->input->post('nama_obat'),
                    'satuan' => $this->input->post('satuan'),
                    'harga_satuan' => $this->input->post('harga_satuan'),
                    'jumlah_masuk' => $this->input->post('jumlah_masuk'),
                    'pengadaan' => $this->input->post('pengadaan'),
                    'expire' => $this->input->post('expire'),
                    'tanggal_masuk' => $now,
                ];
                $idObat = $this->Obatgudang_model->insert($data);

                $dataLaporan = [
                    'id_obat' => $idObat,
                    'stokawal_apbd1' => 0,
                    'masuk_apbd1' => 0,
                    'pemakaian_apbd1' => 0,
                    'ed_apbd1' => 0,
                    'sisastok_apbd1' => 0,
                    'stokawal_apbd2' => 0,
                    'masuk_apbd2' => 0,
                    'pemakaian_apbd2' => 0,
                    'ed_apbd2' => 0,
                    'sisastok_apbd2' => 0,
                    'stokawal_dak' => 0,
                    'masuk_dak' => 0,
                    'pemakaian_dak' => 0,
                    'ed_dak' => 0,
                    'sisastok_dak' => 0,
                ];
                if ($pengadaan == 'APBD I') {
                    $dataLaporan['masuk_apbd1'] = $this->input->post('jumlah_masuk');
                    $dataLaporan['sisastok_apbd1'] = $dataLaporan['stokawal_apbd1'] + $dataLaporan['masuk_apbd1'];
                } else if ($pengadaan == 'APBD II') {
                    $dataLaporan['masuk_apbd2'] = $this->input->post('jumlah_masuk');
                    $dataLaporan['sisastok_apbd2'] = $dataLaporan['stokawal_apbd2'] + $dataLaporan['masuk_apbd2'];
                } else if ($pengadaan == 'DAK') {
                    $dataLaporan['masuk_dak'] = $this->input->post('jumlah_masuk');
                    $dataLaporan['sisastok_dak'] = $dataLaporan['stokawal_dak'] + $dataLaporan['masuk_dak'];
                }
                $this->Laporangudang_model->insert($dataLaporan);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
                redirect(base_url('gudangfarmasi/getdataobat'));
            }
        } else {
            redirect(base_url('auth'));
        }
    }

    function getLaporan()
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'lplpo';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $data['lplpo_gudang'] = $this->LPLPO_model->getLplpoGudang();
            $data['lplpo_apotek'] = $this->LPLPO_model->getLplpoApotek();
            $data['lplpo_pustu'] = $this->LPLPO_model->getLplpoPustu();
            $data['lplpo_poned'] = $this->LPLPO_model->getLplpoPoned();

            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_laporan", $data);
            $this->load->view("layout_gudangfarmasi/footergudang");
        } else {
            redirect(base_url('auth'));
        }
    }

    function getLaporanGudang()
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'laporan obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['data_laporan'] = $this->Laporangudang_model->get();

            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_laporangudang", $data);
            $this->load->view("layout_gudangfarmasi/footergudang");
        } else {
            redirect(base_url('auth'));
        }
    }

    public function filterDataByMonth($selectedMonth)
    {
        try {
            $data = $this->Laporangudang_model->filterDataBySelectedMonth($selectedMonth);
            echo json_encode($data);
        } catch (Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }

    function savedata()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            'kode_obat' => $this->input->post('kode_obat'),
            'nama_obat' => $this->input->post('nama_obat'),
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga_satuan'),
            'jumlah_masuk' => $this->input->post('stok'),
            'pemakaian' => $this->input->post('pemakaian'),
            'expire' => $now,
        ];
        $this->Obatgudang_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
        redirect(base_url('gudang/getdataobat'));
    }

    function ubahStatusPermintaan()
    {
        $id_permintaan_obat = $this->input->post('id_permintaan_obat');
        $id_user_puskesmas = $this->input->post('id_user_puskesmas');
        $statusbaru =  $this->input->post('status');
        $permintaan =  $this->input->post('permintaan');
        $now = date('Y-m-d H:i:s');

        // Simpan data permintaan
        $this->Permintaan_model->updatestatus($statusbaru, $id_permintaan_obat);

        $keperluan = "";
        if (strtolower($permintaan) == 'poned') {
            $keperluan = "Permintaan obat oleh PONED";
        } else if (strtolower($permintaan) == 'puskesmas pembantu') {
            $keperluan = "Permintaan obat oleh PUSTU";
        } else if (strtolower($permintaan) == 'apotek') {
            $keperluan = "Permintaan obat oleh Apotek";
        }

        // Kurangi stok obat
        if ($statusbaru == 'Selesai') {
            $jumlah_obat_keluar = $this->input->post('jumlah_permintaan');
            // $kode_obat = $this->input->post('kode_obat');
            $nama_obat = $this->input->post('nama_obat');

            $dataObatYangDipilih = $this->Obatgudang_model->getByNameExp($nama_obat);
            $sisa_obat_keluar = $jumlah_obat_keluar;
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
                        $this->Obatgudang_model->updateStok($data['id_obat'], 0);

                        // Simpan riwayat pengeluaran
                        $riwayat = [
                            'id_obat' => $data['id_obat'],
                            'keperluan' => $keperluan,
                            'jumlah' => $data['jumlah_masuk'],
                            'tanggal_pengeluaran' => $now,
                        ];
                        $this->Pengeluarangudang_model->insert($riwayat);

                        // Simpan riwayat ke dalam laporan
                        $dataLaporan = [
                            'id_obat' => $data['id_obat'],
                            'stokawal_apbd1' => 0,
                            'masuk_apbd1' => 0,
                            'pemakaian_apbd1' => 0,
                            'ed_apbd1' => 0,
                            'sisastok_apbd1' => 0,
                            'stokawal_apbd2' => 0,
                            'masuk_apbd2' => 0,
                            'pemakaian_apbd2' => 0,
                            'ed_apbd2' => 0,
                            'sisastok_apbd2' => 0,
                            'stokawal_dak' => 0,
                            'masuk_dak' => 0,
                            'pemakaian_dak' => 0,
                            'ed_dak' => 0,
                            'sisastok_dak' => 0,
                        ];
                        if ($data['$pengadaan'] == 'APBD I') {
                            $dataLaporan['stokawal_apbd1'] = $data['jumlah_masuk'];
                            $dataLaporan['pemakaian_apbd1'] = $data['jumlah_masuk'];
                            $dataLaporan['sisastok_apbd1'] = 0;
                        } else if ($data['$pengadaan'] == 'APBD II') {
                            $dataLaporan['stokawal_apbd2'] = $data['jumlah_masuk'];
                            $dataLaporan['pemakaian_apbd2'] = $data['jumlah_masuk'];
                            $dataLaporan['sisastok_apbd2'] = 0;
                        } else if ($data['$pengadaan'] == 'DAK') {
                            $dataLaporan['stokawal_dak'] = $data['jumlah_masuk'];
                            $dataLaporan['pemakaian_dak'] = $data['jumlah_masuk'];
                            $dataLaporan['sisastok_dak'] = 0;
                        }
                        $this->Laporangudang_model->insert($dataLaporan);
                    } else {
                        // Update stok obat
                        $this->Obatgudang_model->updateStok($data['id_obat'], $sisa_stok_obat);

                        // Simpan riwayat pengeluaran
                        $riwayat = [
                            'id_obat' => $data['id_obat'],
                            'keperluan' => $keperluan,
                            'jumlah' => $data['jumlah_masuk'] - $sisa_stok_obat,
                            'tanggal_pengeluaran' => $now,
                        ];
                        $this->Pengeluarangudang_model->insert($riwayat);

                        // Simpan riwayat ke dalam laporan
                        $dataLaporan = [
                            'id_obat' => $data['id_obat'],
                            'stokawal_apbd1' => 0,
                            'masuk_apbd1' => 0,
                            'pemakaian_apbd1' => 0,
                            'ed_apbd1' => 0,
                            'sisastok_apbd1' => 0,
                            'stokawal_apbd2' => 0,
                            'masuk_apbd2' => 0,
                            'pemakaian_apbd2' => 0,
                            'ed_apbd2' => 0,
                            'sisastok_apbd2' => 0,
                            'stokawal_dak' => 0,
                            'masuk_dak' => 0,
                            'pemakaian_dak' => 0,
                            'ed_dak' => 0,
                            'sisastok_dak' => 0,
                        ];
                        if ($data['pengadaan'] == 'APBD I') {
                            $dataLaporan['stokawal_apbd1'] = $data['jumlah_masuk'];
                            $dataLaporan['pemakaian_apbd1'] = $data['jumlah_masuk'] - $sisa_stok_obat;
                            $dataLaporan['sisastok_apbd1'] = $sisa_stok_obat;
                        } else if ($data['pengadaan'] == 'APBD II') {
                            $dataLaporan['stokawal_apbd2'] = $data['jumlah_masuk'];
                            $dataLaporan['pemakaian_apbd2'] = $data['jumlah_masuk'] - $sisa_stok_obat;
                            $dataLaporan['sisastok_apbd2'] = $sisa_stok_obat;
                        } else if ($data['pengadaan'] == 'DAK') {
                            $dataLaporan['stokawal_dak'] = $data['jumlah_masuk'];
                            $dataLaporan['pemakaian_dak'] = $data['jumlah_masuk'] - $sisa_stok_obat;
                            $dataLaporan['sisastok_dak'] = $sisa_stok_obat;
                        }
                        $this->Laporangudang_model->insert($dataLaporan);
                    }
                } else {
                    break;
                }
            }
        } else {
            ///
        }

        $pesan = '';
        if ($statusbaru == 'Selesai') {
            $pesan = 'Permintaan sudah selesai, Silahkan datang ke Gudang Farmasi untuk pengambilan obat';
        } else if ($statusbaru == 'Dibatalkan') {
            $pesan = 'Permintaan dibatalkan karena persediaan obat habis';
        }

        $datanotif = [
            'id_user' => $id_user_puskesmas,
            'pesan' => $pesan,
            'status' => '0',
            'tanggal_notif' => $now,
        ];
        $this->Notifikasi_model->insert($datanotif);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status Permintaan Obat Berhasil Diubah!</div>');
        redirect(base_url('GudangFarmasi/getPermintaan'));
    }

    public function updateStok()
    {
        $id_obat = $this->input->post('id_obat');
        $jumlah_lama = $this->input->post('jumlah_lama');
        $jumlah_baru = $this->input->post('jumlah_baru');
        $pengadaan = $this->input->post('pengadaan');

        $total = $jumlah_lama + $jumlah_baru;
        $this->Obatgudang_model->updateStok($id_obat, $total);

        $dataLaporan = [
            'id_obat' => $id_obat,
            'stokawal_apbd1' => 0,
            'masuk_apbd1' => 0,
            'pemakaian_apbd1' => 0,
            'ed_apbd1' => 0,
            'sisastok_apbd1' => 0,
            'stokawal_apbd2' => 0,
            'masuk_apbd2' => 0,
            'pemakaian_apbd2' => 0,
            'ed_apbd2' => 0,
            'sisastok_apbd2' => 0,
            'stokawal_dak' => 0,
            'masuk_dak' => 0,
            'pemakaian_dak' => 0,
            'ed_dak' => 0,
            'sisastok_dak' => 0,
        ];
        if ($pengadaan == 'APBD I') {
            $dataLaporan['stokawal_apbd1'] = $jumlah_lama;
            $dataLaporan['masuk_apbd1'] = $jumlah_baru;
            $dataLaporan['sisastok_apbd1'] = $jumlah_lama + $jumlah_baru;
        } else if ($pengadaan == 'APBD II') {
            $dataLaporan['stokawal_apbd2'] = $jumlah_lama;
            $dataLaporan['masuk_apbd2'] = $jumlah_baru;
            $dataLaporan['sisastok_apbd2'] = $jumlah_lama + $jumlah_baru;
        } else if ($pengadaan == 'DAK') {
            $dataLaporan['stokawal_dak'] = $jumlah_lama;
            $dataLaporan['masuk_dak'] = $jumlah_baru;
            $dataLaporan['sisastok_dak'] = $jumlah_lama + $jumlah_baru;
        }
        $this->Laporangudang_model->insert($dataLaporan);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Stok obat berhasil ditambah!</div>');
        redirect(base_url('GudangFarmasi/getDataObat'));
    }

    function EditObat($id)
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['obat'] = $this->Obatgudang_model->getById($id);
            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_editobatgudang", $data);
            $this->load->view("layout_gudangfarmasi/footergudang");
        } else {
            redirect(base_url('auth'));
        }
    }

    function update()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            'kode_obat' => $this->input->post('kode_obat'),
            'nama_obat' => $this->input->post('nama_obat'),
            'satuan' => $this->input->post('satuan'),
            'harga_satuan' => $this->input->post('harga_satuan'),
            'jumlah_masuk' => $this->input->post('jumlah_masuk'),
            'pengadaan' => $this->input->post('pengadaan'),
            'expire' => $this->input->post('expire'),
        ];
        $id_obat = $this->input->post('id_obat');
        $this->Obatgudang_model->update(['id_obat' => $id_obat], $data);
        redirect(base_url('GudangFarmasi/getDataObat'));
    }

    function hapus($id_obat)
    {
        $this->Obatgudang_model->delete($id_obat);
        redirect(base_url('GudangFarmasi/getDataObat'));
    }

    function getPengeluaranGudang()
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'pengeluaran obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['results_baru'] = $this->Obatgudang_model->getByName();

            $this->form_validation->set_rules('status_pengeluaran', 'Status Pengeluaran', 'required', [
                'required' => 'Status Pengeluaran Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                // var_dump($data['results_baru']);
                $this->load->view("layout_gudangfarmasi/headergudang", $data);
                $this->load->view("gudangfarmasi/vw_pengeluarangudang", $data);
                $this->load->view("layout_gudangfarmasi/footergudang2");
            } else {
                $now = date('Y-m-d H:i:s');
                $status_pengeluaran = $this->input->post('status_pengeluaran');

                if ($status_pengeluaran == 'permintaan_gudang') {
                    $jumlah_lama = intval($this->input->post('jumlah_lama'));
                    $jumlah_keluar = intval($this->input->post('jumlah'));

                    // Cek stok
                    if ($jumlah_keluar > $jumlah_lama) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok Obat Tidak Cukup!</div>');
                        redirect(base_url('GudangFarmasi/getPengeluaranGudang'));
                    }

                    $dataObatYangDipilih = $this->Obatgudang_model->getByNameExp($this->input->post('nama_obat'));
                    $sisa_obat_keluar = $jumlah_keluar;
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
                                $this->Obatgudang_model->updateStok($data['id_obat'], 0);

                                // Simpan riwayat pengeluaran
                                $riwayat = [
                                    'id_obat' => $data['id_obat'],
                                    'keperluan' => $this->input->post('keperluan'),
                                    'tanggal_pengeluaran' => $now,
                                    'jumlah' => $data['jumlah_masuk'],
                                ];
                                $this->Pengeluarangudang_model->insert($riwayat);

                                // Simpan riwayat ke dalam laporan
                                $laporan = [
                                    'id_obat' => $data['id_obat'],
                                    'stok_awal_apbd1' => 0,
                                    'masuk_apbd1' => 0,
                                    'pemakaian_apbd1' => 0,
                                    'ed_apbd1' => 0,
                                    'sisastok_apbd1' => 0,
                                    'stok_awal_apbd2' => 0,
                                    'masuk_apbd2' => 0,
                                    'pemakaian_apbd2' => 0,
                                    'ed_apbd2' => 0,
                                    'sisastok_apbd2' => 0,
                                    'stok_awal_dak' => 0,
                                    'masuk_dak' => 0,
                                    'pemakaian_dak' => 0,
                                    'ed_dak' => 0,
                                    'sisastok_dak' => 0,
                                ];
                                if ($data['pengadaan'] == 'APBD I') {
                                    $laporan['stok_awal_apbd1'] = $data['jumlah_masuk'];
                                    $laporan['pemakaian_apbd1'] = $data['jumlah_masuk'];
                                } else if ($data['pengadaan'] == 'APBD II') {
                                    $laporan['stok_awal_apbd2'] = $data['jumlah_masuk'];
                                    $laporan['pemakaian_apbd2'] = $data['jumlah_masuk'];
                                } else if ($data['pengadaan'] == 'DAK') {
                                    $laporan['stok_awal_dak'] = $data['jumlah_masuk'];
                                    $laporan['pemakaian_dak'] = $data['jumlah_masuk'];
                                }
                                $this->Laporangudang_model->insert($laporan);
                            } else {
                                // Update stok obat
                                $this->Obatgudang_model->updateStok($data['id_obat'], $sisa_stok_obat);

                                // Simpan riwayat pengeluaran
                                $riwayat = [
                                    'id_obat' => $data['id_obat'],
                                    'keperluan' => $this->input->post('keperluan'),
                                    'tanggal_pengeluaran' => $now,
                                    'jumlah' => $data['jumlah_masuk'] - $sisa_stok_obat,
                                ];
                                $this->Pengeluarangudang_model->insert($riwayat);

                                // Simpan riwayat ke dalam laporan
                                $laporan = [
                                    'id_obat' => $data['id_obat'],
                                    'stokawal_apbd1' => 0,
                                    'masuk_apbd1' => 0,
                                    'pemakaian_apbd1' => 0,
                                    'ed_apbd1' => 0,
                                    'sisastok_apbd1' => 0,
                                    'stokawal_apbd2' => 0,
                                    'masuk_apbd2' => 0,
                                    'pemakaian_apbd2' => 0,
                                    'ed_apbd2' => 0,
                                    'sisastok_apbd2' => 0,
                                    'stokawal_dak' => 0,
                                    'masuk_dak' => 0,
                                    'pemakaian_dak' => 0,
                                    'ed_dak' => 0,
                                    'sisastok_dak' => 0,
                                ];
                                if ($data['pengadaan'] == 'APBD I') {
                                    $laporan['stokawal_apbd1'] = $data['jumlah_masuk'];
                                    $laporan['pemakaian_apbd1'] = $data['jumlah_masuk'] - $sisa_stok_obat;
                                    $laporan['sisastok_apbd1'] = $sisa_stok_obat;
                                } else if ($data['pengadaan'] == 'APBD II') {
                                    $laporan['stokawal_apbd2'] = $data['jumlah_masuk'];
                                    $laporan['pemakaian_apbd2'] = $data['jumlah_masuk'] - $sisa_stok_obat;
                                    $laporan['sisastok_apbd2'] = $sisa_stok_obat;
                                } else if ($data['pengadaan'] == 'DAK') {
                                    $laporan['stokawal_dak'] = $data['jumlah_masuk'];
                                    $laporan['pemakaian_dak'] = $data['jumlah_masuk'] - $sisa_stok_obat;
                                    $laporan['sisastok_dak'] = $sisa_stok_obat;
                                }
                                $this->Laporangudang_model->insert($laporan);
                            }
                        } else {
                            break;
                        }
                    }

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengeluaran Obat Berhasil Disimpan!</div>');
                    redirect(base_url('GudangFarmasi/getPengeluaranGudang'));
                } else if ($status_pengeluaran == 'obat_expire') {
                    $dataObatExpired = $this->Obatgudang_model->getObatExpired($this->input->post('nama_obat'));

                    if (!empty($dataObatExpired)) {
                        // Hapus data obat yang expired
                        foreach ($dataObatExpired as $dt) {
                            $this->Obatgudang_model->updateStok($dt['id_obat'], 0);

                            // Simpan riwayat ke dalam laporan
                            $laporan = [
                                'id_obat' => $dt['id_obat'],
                                'stokawal_apbd1' => 0,
                                'masuk_apbd1' => 0,
                                'pemakaian_apbd1' => 0,
                                'ed_apbd1' => 0,
                                'sisastok_apbd1' => 0,
                                'stokawal_apbd2' => 0,
                                'masuk_apbd2' => 0,
                                'pemakaian_apbd2' => 0,
                                'ed_apbd2' => 0,
                                'sisastok_apbd2' => 0,
                                'stokawal_dak' => 0,
                                'masuk_dak' => 0,
                                'pemakaian_dak' => 0,
                                'ed_dak' => 0,
                                'sisastok_dak' => 0,
                            ];

                            if ($dt['pengadaan'] == "APBD I") {
                                $laporan['stokawal_apbd1'] = $dt['jumlah_masuk'];
                                $laporan['ed_apbd1'] = $dt['jumlah_masuk'];
                            } else if ($dt['pengadaan'] == "APBD II") {
                                $laporan['stokawal_apbd2'] = $dt['jumlah_masuk'];
                                $laporan['ed_apbd2'] = $dt['jumlah_masuk'];
                            } else if ($dt['pengadaan'] == "DAK") {
                                $laporan['stokawal_dak'] = $dt['jumlah_masuk'];
                                $laporan['ed_dak'] = $dt['jumlah_masuk'];
                            }

                            $this->Laporangudang_model->insert($laporan);
                        }

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Berhasil!</strong> Data Obat Expired Berhasil Dihapus!</div>');
                        redirect(base_url('GudangFarmasi/getPengeluaranGudang'));
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Gagal!</strong> Tidak Ada Obat Yang Expired!</div>');
                        redirect(base_url('GudangFarmasi/getPengeluaranGudang'));
                    }
                }
            }
        } else {
            redirect(base_url('auth'));
        }
    }

    public function cetak_lplpo()
    {
        $dompdf = new Dompdf();

        $data['lplpo_gudang'] = $this->LPLPO_model->getLplpoGudang();
        $data['lplpo_apotek'] = $this->LPLPO_model->getLplpoApotek();
        $data['lplpo_pustu'] = $this->LPLPO_model->getLplpoPustu();
        $data['lplpo_poned'] = $this->LPLPO_model->getLplpoPoned();

        $dompdf->setPaper('Legal', 'Landscape');
        $html = $this->load->view('gudangfarmasi/report_lplpo', $data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan LPLPO ' . date('Y'), array("Attachment" => false));
    }
}
