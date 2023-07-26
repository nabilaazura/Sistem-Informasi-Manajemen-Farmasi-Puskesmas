<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pustu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Obatpustu_model');
        $this->load->model('Obatgudang_model');
        $this->load->model('Permintaan_model');
        $this->load->model('Pengeluaran_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Laporanpustu_model');
        $this->load->model('User_model');
        $this->load->model('Pasien_model');
    }
    function index()
    {
        if ($this->session->userdata('role') == 'pustu') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'dashboard';
            $data['obat_masuk'] = $this->Obatpustu_model->total_obat_masuk();
            $data['obat_keluar'] = $this->Pengeluaran_model->total_obat_keluar();
            $data['top_ten_obat_keluar_pustu'] = $this->Pengeluaran_model->top_ten_obat_keluar_pustu();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_pustu/headerpustu", $data);
            $this->load->view("pustu/vw_dashboardpustu", $data);
            $this->load->view("layout_pustu/footerpustu", $data);
        } else {
            redirect(base_url('auth'));
        }
    }
    function getObatPustu()
    {
        if ($this->session->userdata('role') == 'pustu') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['data_obat'] = $this->Obatpustu_model->get();

            $this->load->view("layout_pustu/headerpustu", $data);
            $this->load->view("pustu/vw_obatpustu", $data);
            $this->load->view("layout_pustu/footerpustu");
        } else {
            redirect(base_url('auth'));
        }
    }
    function getPermintaanPustu()
    {
        if ($this->session->userdata('role') == 'pustu') {
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
                $this->load->view("layout_pustu/headerpustu", $data);
                $this->load->view("pustu/vw_permintaanpustu", $data);
                $this->load->view("layout_pustu/footerpustu2");
            } else {
                $now = date('Y-m-d H:i:s');
                $data = [
                    'id_user_puskesmas' => 5,
                    'kode_obat' => $this->input->post('kode_obat'),
                    'nama_obat' => $this->input->post('nama_obat'),
                    'satuan' => $this->input->post('satuan'),
                    'permintaan' => $this->input->post('permintaan'),
                    'tanggal_permintaan' => $now,
                    'jumlah' => $this->input->post('jumlah'),
                    'status' => 'diajukan',
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
                redirect(base_url('Pustu/getPermintaanPustu'));
            }
        } else {
            redirect(base_url('auth'));
        }
    }
    function getPemasukanPustu()
    {
        if ($this->session->userdata('role') == 'pustu') {
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
                $this->load->view("layout_pustu/headerpustu", $data);
                $this->load->view("pustu/vw_pemasukanpustu", $data);
                $this->load->view("layout_pustu/footerpustu");
            } else {
                $now = date('Y-m-d H:i:s');
                $data = [
                    'kode_obat' => $this->input->post('kode_obat'),
                    'nama_obat' => ucwords(trim(strtolower($this->input->post('nama_obat')))),
                    'satuan' => $this->input->post('satuan'),
                    'harga_satuan' => $this->input->post('harga_satuan'),
                    'jumlah_masuk' => $this->input->post('jumlah_masuk'),
                    'tanggal_masuk' => $now,
                    'expire' => $this->input->post('expire'),
                ];
                $id = $this->Obatpustu_model->insert($data);

                $data2 = [
                    'id_obat' => $id,
                    'stok_awal' => 0,
                    'masuk' => $this->input->post('jumlah_masuk'),
                    'pemakaian' => 0,
                    'ed' => 0,
                    'sisa_stok' => $this->input->post('jumlah_masuk'),
                    'created_at' => $now,
                ];
                $this->Laporanpustu_model->insert($data2);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
                redirect(base_url('Pustu/getObatPustu'));
            }
        } else {
            redirect(base_url('auth'));
        }
    }
    function EditObat($id)
    {
        if ($this->session->userdata('role') == 'pustu') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['obat_pustu'] = $this->Obatpustu_model->getById($id);

            $this->load->view("layout_pustu/headerpustu", $data);
            $this->load->view("pustu/vw_editobatpustu", $data);
            $this->load->view("layout_pustu/footerpustu");
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
        $this->Obatpustu_model->update(['id_obat' => $id_obat], $data);
        redirect(base_url('Pustu/getObatPustu'));
    }
    function hapus($id_obat)
    {
        $this->Obatpustu_model->delete($id_obat);
        redirect(base_url('Pustu/getObatPustu'));
    }
    function savedata()
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
        $this->Obatpustu_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
        redirect(base_url('Pustu/getObatPustu'));
    }
    function laporanPustu()
    {
        if ($this->session->userdata('role') == 'pustu') {
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'laporan obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['data_laporan'] = $this->Laporanpustu_model->get();

            $this->load->view("layout_pustu/headerpustu", $data);
            $this->load->view("pustu/vw_laporanpustu", $data);
            $this->load->view("layout_pustu/footerpustu");
        } else {
            redirect(base_url('auth'));
        }
    }
    // function tambahStok($id)
    // {
    //     if ($this->session->userdata('role') == 'pustu') {
    //         $now = date('Y-m-d H:i:s');
    //         $idUser = $this->session->userdata('id');

    //         $data['judul'] = "Halaman Perubahan Obat";
    //         $data['obat_pustu'] = $this->Obatpustu_model->getById($id);
    //         $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

    //         $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required', [
    //             'required' => 'Jumlah Masuk Wajib di Isi'
    //         ]);

    //         if ($this->form_validation->run() == false) {
    //             $this->load->view("layout_pustu/headerpustu", $data);
    //             $this->load->view("pustu/vw_tambahstokpustu", $data);
    //             $this->load->view("layout_pustu/footerpustu");
    //         } else {
    //             // $id = $this->input->post('id_obat');
    //             $stok_baru = $this->input->post('jumlah_masuk');
    //             $stok_akhir = intval($data['obat_pustu']['jumlah_masuk']) + intval($stok_baru);

    //             $this->Obatpustu_model->updateStok($id, $stok_akhir);

    //             $data2 = [
    //                 'id_obat' => $id,
    //                 'stok_awal' => $data['obat_pustu']['jumlah_masuk'],
    //                 'masuk' => $stok_baru,
    //                 'pemakaian' => 0,
    //                 'ed' => 0,
    //                 'sisa_stok' => $stok_akhir,
    //                 'created_at' => $now,
    //             ];

    //             $this->Laporanpustu_model->insert($data2);

    //             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Diubah!</div>');
    //             redirect(base_url('Pustu/getObatPustu'));
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
        $this->Obatpustu_model->updateStok($id_obat, $total);

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
        $this->Laporanpustu_model->insert($data2);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Stok obat berhasil ditambah!</div>');
        redirect(base_url('Pustu/getObatPustu'));
    }
    function getPengeluaranPustu()
    {
        if ($this->session->userdata('role') == 'pustu') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'pengeluaran obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['results_baru'] = $this->Obatpustu_model->getByName();

            $this->form_validation->set_rules('status_pengeluaran', 'Status Pengeluaran', 'required', [
                'required' => 'Status Pengeluaran Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view("layout_pustu/headerpustu", $data);
                $this->load->view("pustu/vw_pengeluaranpustu", $data);
                $this->load->view("layout_pustu/footerpustu2");
            } else {
                $now = date('Y-m-d H:i:s');
                $status_pengeluaran = $this->input->post('status_pengeluaran');

                if ($status_pengeluaran == 'permintaan_pustu') {
                    $jumlah_lama = intval($this->input->post('jumlah_lama'));
                    $jumlah_keluar = intval($this->input->post('jumlah'));

                    // Cek stok
                    if ($jumlah_keluar > $jumlah_lama) {
                        $this->session->set_flashdata('info_pengeluaran_obat', 'Stok Obat Tidak Cukup!');
                        redirect(base_url('Pustu/getPengeluaranPustu'));
                    }

                    $dataObatYangDipilih = $this->Obatpustu_model->getByNameExp($this->input->post('nama_obat'));
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
                                $this->Obatpustu_model->updateStok($data['id_obat'], 0);

                                // Simpan riwayat pengeluaran
                                $riwayat = [
                                    'id_obat' => $data['id_obat'],
                                    'keperluan' => $this->input->post('keperluan'),
                                    'tanggal_pengeluaran' => $now,
                                    'jumlah' => $data['jumlah_masuk'],
                                ];
                                $this->Pengeluaran_model->insert($riwayat);

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
                                $this->Laporanpustu_model->insert($laporan);
                            } else {
                                // Update stok obat
                                $this->Obatpustu_model->updateStok($data['id_obat'], $sisa_stok_obat);

                                // Simpan riwayat pengeluaran
                                $riwayat = [
                                    'id_obat' => $data['id_obat'],
                                    'keperluan' => $this->input->post('keperluan'),
                                    'tanggal_pengeluaran' => $now,
                                    'jumlah' => $data['jumlah_masuk'] - $sisa_stok_obat,
                                ];
                                $this->Pengeluaran_model->insert($riwayat);

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
                                $this->Laporanpustu_model->insert($laporan);
                            }
                        } else {
                            break;
                        }
                    }

                    $this->session->set_flashdata('success_pengeluaran_obat', 'Data Pengeluaran Obat Berhasil Disimpan!');
                    redirect(base_url('Pustu/getPengeluaranPustu'));
                } else if ($status_pengeluaran == 'obat_expire') {
                    $dataObatExpired = $this->Obatpustu_model->getObatExpired($this->input->post('nama_obat'));

                    if (!empty($dataObatExpired)) {
                        // Hapus data obat yang expired
                        foreach ($dataObatExpired as $dt) {
                            var_dump($dt);
                            $this->Obatpustu_model->updateStok($dt['id_obat'], 0);

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
                            $this->Laporanpustu_model->insert($laporan);
                        }

                        $this->session->set_flashdata('successED_pengeluaran_obat', 'Data Obat Expired Berhasil Dihapus!');
                        redirect(base_url('Pustu/getPengeluaranPustu'));
                    } else {
                        $this->session->set_flashdata('error_pengeluaran_obat', 'Tidak Ada Obat Yang Expired!');
                        redirect(base_url('Pustu/getPengeluaranPustu'));
                    }
                }
            }
        } else {
            redirect(base_url('auth'));
        }
    }
    public function filterDataByMonth($selectedMonth)
    {
        try {
            $data = $this->Laporanpustu_model->filterDataBySelectedMonth($selectedMonth);
            echo json_encode($data);
        } catch (Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
    public function obatMasuk()
    {
        if ($this->session->userdata('role') == 'pustu') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'dashboard';
            $data['data_obat'] = $this->Obatpustu_model->get();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_pustu/headerpustu", $data);
            $this->load->view("pustu/vw_obatmasukpustu", $data);
            $this->load->view("layout_pustu/footerpustu");
        } else {
            redirect(base_url('auth'));
        }
    }
    public function obatKeluar()
    {
        if ($this->session->userdata('role') == 'pustu') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'dashboard';
            $data['data_obat_keluar'] = $this->Pengeluaran_model->obat_keluar_pustu();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_pustu/headerpustu", $data);
            $this->load->view("pustu/vw_obatkeluarpustu", $data);
            $this->load->view("layout_pustu/footerpustu");
        } else {
            redirect(base_url('auth'));
        }
    }
}
