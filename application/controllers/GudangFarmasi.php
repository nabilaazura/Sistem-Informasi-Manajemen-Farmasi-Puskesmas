<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
    }
    function index()
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Selamat Datang";
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
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
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Selamat Datang";
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
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Selamat Datang";
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
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Halaman Tambah Obat";
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
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Selamat Datang";
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            // $data['data_laporan'] = $this->Laporangudang_model->get();

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
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Selamat Datang";
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['data_laporan'] = $this->Laporangudang_model->get();

            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_laporangudang", $data);
            $this->load->view("layout_gudangfarmasi/footergudang");
        } else {
            redirect(base_url('auth'));
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
        $now = date('Y-m-d H:i:s');

        // Simpan data permintaan
        $this->Permintaan_model->updatestatus($statusbaru, $id_permintaan_obat);

        $pesan = '';
        if ($statusbaru == 'Diproses') {
            $pesan = 'Permintaan obat sedang di proses';
        } else if ($statusbaru == 'Bisa Dijemput') {
            $pesan = 'Silahkan datang ke Gudang Farmasi untuk pengambilan obat';
        } else if ($statusbaru == 'Selesai') {
            $pesan = 'Permintaan dibatalkan karena persediaan obat habis';
        }

        $datanotif = [
            'id_user' => $id_user_puskesmas,
            'pesan' => $pesan,
            'status' => '0',
            'tanggal_notif' => $now,
        ];
        $this->Notifikasi_model->insert($datanotif);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status Berhasil Diubah</div>');
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
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Selamat Datang";
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $now = date('Y-m-d H:i:s');
            if ($this->form_validation->run() == false) {
                $data['judul'] = "Halaman Perubahan Obat";
                $data['obat'] = $this->Obatgudang_model->getById($id);
                $this->load->view("layout_gudangfarmasi/headergudang", $data);
                $this->load->view("gudangfarmasi/vw_editobatgudang", $data);
                $this->load->view("layout_gudangfarmasi/footergudang");
            } else {

                $now = date('Y-m-d H:i:s');
                $data = [
                    'kode_obat' => $this->input->post('kode_obat'),
                    'nama_obat' => $this->input->post('nama_obat'),
                    'satuan' => $this->input->post('satuan'),
                    'harga_satuan' => $this->input->post('harga_satuan'),
                    'jumlah_masuk' => $this->input->post('jumlah_masuk'),
                    'expire' => $this->input->post('expire'),
                    'tanggal_masuk' => $now,
                ];
                $id = $this->input->post('id_obat');
                $this->Obatgudang_model->update(['id_obat' => $id], $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Diubah!</div>');
                redirect(base_url('GudangFarmasi/getDataObat'));
            }
        } else {
            redirect(base_url('auth'));
        }
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

            $data['judul'] = "Selamat Datang";
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            // $data['results'] = $this->Obatponed_model->get();
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
                                    'stok_awal' => $data['jumlah_masuk'],
                                    'masuk' => 0,
                                    'pemakaian' => $data['jumlah_masuk'],
                                    'ed' => 0,
                                    'sisa_stok' => 0,
                                    'created_at' => $now,
                                ];
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
                                    'stok_awal' => $data['jumlah_masuk'],
                                    'masuk' => 0,
                                    'pemakaian' => $data['jumlah_masuk'] - $sisa_stok_obat,
                                    'ed' => 0,
                                    'sisa_stok' => $sisa_stok_obat,
                                    'created_at' => $now,
                                ];
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
                            var_dump($dt);
                            $this->Obatgudang_model->updateStok($dt['id_obat'], 0);

                            // Simpan riwayat ke dalam laporan
                            $laporan = [
                                'id_obat' => $dt['id_obat'],
                                'stok_awal' => $dt['jumlah_masuk'],
                                'masuk' => 0,
                                'pemakaian' => 0,
                                'ed' => $dt['jumlah_masuk'],
                                'sisa_stok' => 0,
                                'created_at' => $now,
                            ];
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
}
