<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poned extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obatponed_model');
        $this->load->model('Obatgudang_model');
        $this->load->model('Permintaan_model');
        $this->load->model('Pengeluaranponed_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Laporanponed_model');
        $this->load->model('User_model');
        $this->load->model('Pasien_model');
    }
    function index()
    {
        if ($this->session->userdata('role') == 'poned') {
            $idUser = $this->session->userdata('id');
            $data['menu'] = 'dashboard';

            $data['obat_masuk'] = $this->Obatponed_model->total_obat_masuk();
            $data['obat_keluar'] = $this->Pengeluaranponed_model->total_obat_keluar();
            $data['top_ten_obat_keluar_poned'] = $this->Pengeluaranponed_model->top_ten_obat_keluar_poned();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_poned/headerponed", $data);
            $this->load->view("poned/vw_dashboardponed", $data);
            $this->load->view("layout_poned/footerponed", $data);
        } else {
            redirect(base_url('auth'));
        }
    }
    function getObatPoned()
    {
        if ($this->session->userdata('role') == 'poned') {
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['data_obat'] = $this->Obatponed_model->get();
            $this->load->view("layout_poned/headerponed", $data);
            $this->load->view("poned/vw_obatponed", $data);
            $this->load->view("layout_poned/footerponed");
        } else {
            redirect(base_url('auth'));
        }
    }
    function getPermintaanPoned()
    {
        if ($this->session->userdata('role') == 'poned') {
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'permintaan obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['results_baru'] = $this->Obatgudang_model->getByName();

            $this->form_validation->set_rules('permintaan', 'Permintaan', 'required', [
                'required' => 'Permintaan Wajib Wajib di Isi'
            ]);
            $this->form_validation->set_rules('jumlah', 'Jumlah Permintaan', 'required', [
                'required' => 'Jumlah Permintaan Obat Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view("layout_poned/headerponed", $data);
                $this->load->view("poned/vw_permintaanponed", $data);
                $this->load->view("layout_poned/footerponed2");
            } else {
                $now = date('Y-m-d H:i:s');
                $data = [
                    'id_user_puskesmas' => 4,
                    'kode_obat' => $this->input->post('kode_obat'),
                    'nama_obat' => $this->input->post('nama_obat'),
                    'satuan' => $this->input->post('satuan'),
                    'permintaan' => $this->input->post('permintaan'),
                    'tanggal_permintaan' => $now,
                    'jumlah' => $this->input->post('jumlah'),
                    'status' => 'Diajukan',
                ];
                $this->Permintaan_model->insert($data);

                $user_gudang = $this->User_model->getUserGudang();
                $datanotif = [
                    'id_user' => $user_gudang['id_user'],
                    'pesan' => 'Permintaan obat masuk',
                    'status' => '0',
                    'tanggal_notif' => $now,
                ];
                $this->Notifikasi_model->insert($datanotif);

                $this->session->set_flashdata('success_permintaan_obat', 'Data Permintaan Obat Berhasil Dikirim.');
                redirect(base_url('Poned/getPermintaanPoned'));
            }
        } else {
            redirect(base_url('auth'));
        }
    }
    function getPemasukanPoned()
    {
        if ($this->session->userdata('role') == 'poned') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);


            $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required', [
                'required' => 'Nama Obat Wajib di Isi'
            ]);
            $this->form_validation->set_rules('satuan', 'Satuan/Kemasan', 'required', [
                'required' => 'Satuan/Kemasan Wajib di Isi'
            ]);
            $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required', [
                'required' => 'Jumlah Masuk Wajib di Isi'
            ]);
            $this->form_validation->set_rules('expire', 'Tanggal Expire', 'required', [
                'required' => 'Tanggal Expire Obat Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view("layout_poned/headerponed", $data);
                $this->load->view("poned/vw_pemasukanponed", $data);
                $this->load->view("layout_poned/footerponed");
            } else {
                $now = date('Y-m-d H:i:s');
                $kode_obat = $this->input->post('kode_obat');
                $nama_obat = ucwords(trim(strtolower($this->input->post('nama_obat'))));
                $jumlah_masuk = $this->input->post('jumlah_masuk');

                $data = [
                    'kode_obat' => $kode_obat,
                    'nama_obat' => $nama_obat,
                    'satuan' => $this->input->post('satuan'),
                    'harga_satuan' => $this->input->post('harga_satuan'),
                    'jumlah_masuk' => $jumlah_masuk,
                    'tanggal_masuk' => $now,
                    'expire' => $this->input->post('expire'),
                ];
                $id = $this->Obatponed_model->insert($data);

                $data2 = [
                    'id_obat' => $id,
                    'stok_awal' => 0,
                    'masuk' => $jumlah_masuk,
                    'pemakaian' => 0,
                    'ed' => 0,
                    'sisa_stok' => $jumlah_masuk,
                    'created_at' => $now,
                ];
                $this->Laporanponed_model->insert($data2);

                // Kurangi stok obat di gudang
                // $obat = $this->Obat_model->getById($id);
                // $this->Obat_model->update(['kode_obat' => $kode_obat, 'nama_obat' => $nama_obat], ['jumlah_masuk' => ($obat['jumlah_masuk'] - $jumlah_masuk)]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
                redirect(base_url('Poned/getObatPoned'));
            }
        } else {
            redirect(base_url('auth'));
        }
    }
    function EditObat($id_obat)
    {
        if ($this->session->userdata('role') == 'poned') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['obat_poned'] = $this->Obatponed_model->getById($id_obat);

            $this->load->view("layout_poned/headerponed", $data);
            $this->load->view("poned/vw_editobatponed", $data);
            $this->load->view("layout_poned/footerponed");
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
            'tanggal_masuk' => $now,
            'expire' => $this->input->post('expire'),
        ];
        $id_obat = $this->input->post('id_obat');
        $this->Obatponed_model->update(['id_obat' => $id_obat], $data);
        redirect(base_url('Poned/getObatPoned'));
    }
    function hapus($id_obat)
    {
        $this->Obatponed_model->delete($id_obat);
        redirect(base_url('Poned/getObatPoned'));
    }
    function savedata()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            'kode_obat' => $this->input->post('kode_obat'),
            'nama_obat' => $this->input->post('nama_obat'),
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'tanggal_masuk' => $now,
            'expire' => $this->input->post('expire'),
        ];
        $this->Obatponed_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
        redirect(base_url('Poned/getObatPoned'));
    }
    function laporanPoned()
    {
        if ($this->session->userdata('role') == 'poned') {
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'laporan obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['data_laporan'] = $this->Laporanponed_model->get();

            $this->load->view("layout_poned/headerponed", $data);
            $this->load->view("poned/vw_laporanponed", $data);
            $this->load->view("layout_poned/footerponed");
        } else {
            redirect(base_url('auth'));
        }
    }
    public function filterDataByMonth($selectedMonth)
    {
        try {
            $data = $this->Laporanponed_model->filterDataBySelectedMonth($selectedMonth);
            echo json_encode($data);
        } catch (Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
    // function tambahStok($id)
    // {
    //     if ($this->session->userdata('role') == 'poned') {
    //         $now = date('Y-m-d H:i:s');
    //         $role = $this->session->userdata('role');
    //         $idUser = $this->session->userdata('id');

    //         $data['judul'] = "Halaman Perubahan Obat";
    //         $data['obat_poned'] = $this->Obatponed_model->getById($id);
    //         $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

    //         $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required', [
    //             'required' => 'Jumlah Masuk Wajib di Isi'
    //         ]);

    //         if ($this->form_validation->run() == false) {
    //             $this->load->view("layout_poned/headerponed", $data);
    //             $this->load->view("poned/vw_tambahstokponed", $data);
    //             $this->load->view("layout_poned/footerponed");
    //         } else {
    //             // $id = $this->input->post('id_obat');
    //             $stok_baru = $this->input->post('jumlah_masuk');
    //             $stok_akhir = intval($data['obat_poned']['jumlah_masuk']) + intval($stok_baru);

    //             $this->Obatponed_model->updateStok($id, $stok_akhir);

    //             $data2 = [
    //                 'id_obat' => $id,
    //                 'stok_awal' => $data['obat_poned']['jumlah_masuk'],
    //                 'masuk' => $stok_baru,
    //                 'pemakaian' => 0,
    //                 'ed' => 0,
    //                 'sisa_stok' => $stok_akhir,
    //                 'created_at' => $now,
    //             ];

    //             $this->Laporanponed_model->insert($data2);

    //             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Diubah!</div>');
    //             redirect(base_url('Poned/getObatPoned'));
    //         }
    //     } else {
    //         redirect(base_url('auth'));
    //     }
    // }
    public function updateStok()
    {
        $id_obat = $this->input->post('id_obat');
        $jumlah_lama = $this->input->post('jumlah_lama');
        $jumlah_baru = $this->input->post('jumlah_baru');

        $total = $jumlah_lama + $jumlah_baru;
        $this->Obatponed_model->updateStok($id_obat, $total);

        $now = date('Y-m-d H:i:s');
        $data2 = [
            'id_obat' => $id_obat,
            'stok_awal' => $jumlah_lama,
            'masuk' => $jumlah_baru,
            'pemakaian' => 0,
            'ed' => 0,
            'sisa_stok' => $total,
            'created_at' => $now,
        ];
        $this->Laporanponed_model->insert($data2);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Stok obat berhasil ditambah!</div>');
        redirect(base_url('Poned/getObatPoned'));
    }
    function getPengeluaranPoned()
    {
        if ($this->session->userdata('role') == 'poned') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'pengeluaran obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['results_baru'] = $this->Obatponed_model->getByName();

            $this->form_validation->set_rules('status_pengeluaran', 'Status Pengeluaran', 'required', [
                'required' => 'Status Pengeluaran Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view("layout_poned/headerponed", $data);
                $this->load->view("poned/vw_pengeluaranponed", $data);
                $this->load->view("layout_poned/footerponed2");
            } else {
                $now = date('Y-m-d H:i:s');
                $status_pengeluaran = $this->input->post('status_pengeluaran');

                if ($status_pengeluaran == 'permintaan_poned') {
                    $jumlah_lama = intval($this->input->post('jumlah_lama'));
                    $jumlah_keluar = intval($this->input->post('jumlah'));

                    // Cek stok
                    if ($jumlah_keluar > $jumlah_lama) {
                        $this->session->set_flashdata('info_pengeluaran_obat', 'Stok Obat Tidak Cukup!');
                        redirect(base_url('Poned/getPengeluaranPoned'));
                    }

                    $dataObatYangDipilih = $this->Obatponed_model->getByNameExp($this->input->post('nama_obat'));
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
                                $this->Obatponed_model->updateStok($data['id_obat'], 0);

                                // Simpan riwayat pengeluaran
                                $riwayat = [
                                    'id_obat' => $data['id_obat'],
                                    'keperluan' => $this->input->post('keperluan'),
                                    'tanggal_pengeluaran' => $now,
                                    'jumlah' => $data['jumlah_masuk'],
                                ];
                                $this->Pengeluaranponed_model->insert($riwayat);

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
                                $this->Laporanponed_model->insert($laporan);
                            } else {
                                // Update stok obat
                                $this->Obatponed_model->updateStok($data['id_obat'], $sisa_stok_obat);

                                // Simpan riwayat pengeluaran
                                $riwayat = [
                                    'id_obat' => $data['id_obat'],
                                    'keperluan' => $this->input->post('keperluan'),
                                    'tanggal_pengeluaran' => $now,
                                    'jumlah' => $data['jumlah_masuk'] - $sisa_stok_obat,
                                ];
                                $this->Pengeluaranponed_model->insert($riwayat);

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
                                $this->Laporanponed_model->insert($laporan);
                            }
                        } else {
                            break;
                        }
                    }

                    $this->session->set_flashdata('success_pengeluaran_obat', 'Data Pengeluaran Obat Berhasil Disimpan!');
                    redirect(base_url('Poned/getPengeluaranPoned'));
                } else if ($status_pengeluaran == 'obat_expire') {
                    $dataObatExpired = $this->Obatponed_model->getObatExpired($this->input->post('nama_obat'));

                    if (!empty($dataObatExpired)) {
                        // Hapus data obat yang expired
                        foreach ($dataObatExpired as $dt) {
                            var_dump($dt);
                            $this->Obatponed_model->updateStok($dt['id_obat'], 0);

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
                            $this->Laporanponed_model->insert($laporan);
                        }

                        $this->session->set_flashdata('successED_pengeluaran_obat', 'Data Obat Expired Berhasil Dihapus!');
                        redirect(base_url('Poned/getPengeluaranPoned'));
                    } else {
                        $this->session->set_flashdata('error_pengeluaran_obat', 'Tidak Ada Obat Yang Expired!');
                        redirect(base_url('Poned/getPengeluaranPoned'));
                    }
                }
            }
        } else {
            redirect(base_url('auth'));
        }
    }
    public function obatMasuk()
    {
        if ($this->session->userdata('role') == 'poned') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'dashboard';
            $data['data_obat'] = $this->Obatponed_model->get();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_poned/headerponed", $data);
            $this->load->view("poned/vw_obatmasukponed", $data);
            $this->load->view("layout_poned/footerponed");
        } else {
            redirect(base_url('auth'));
        }
    }
    public function obatKeluar()
    {
        if ($this->session->userdata('role') == 'poned') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'dashboard';
            $data['data_obat_keluar'] = $this->Pengeluaranponed_model->obat_keluar_poned();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_poned/headerponed", $data);
            $this->load->view("poned/vw_obatkeluarponed", $data);
            $this->load->view("layout_poned/footerponed");
        } else {
            redirect(base_url('auth'));
        }
    }
    function getDataPermintaan()
    {
        if ($this->session->userdata('role') == 'poned') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'permintaan obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['daftar_permintaan'] = $this->Permintaan_model->getPermintaanPoned();

            $this->load->view("layout_poned/headerponed", $data);
            $this->load->view("poned/vw_daftarpermintaanponed", $data);
            $this->load->view("layout_poned/footerponed");
        } else {
            redirect(base_url('auth'));
        }
    }
    function getDataPengeluaran()
    {
        if ($this->session->userdata('role') == 'poned') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'pengeluaran obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['daftar_pengeluaran'] = $this->Pengeluaranponed_model->getPengeluaranPoned();

            $this->load->view("layout_poned/headerponed", $data);
            $this->load->view("poned/vw_daftarpengeluaranponed", $data);
            $this->load->view("layout_poned/footerponed");
        } else {
            redirect(base_url('auth'));
        }
    }
}
