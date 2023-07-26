<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Apotek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obatapotek_model');
        $this->load->model('Obatgudang_model');
        $this->load->model('Permintaan_model');
        $this->load->model('Resep_model');
        $this->load->model('Pendaftaranpasien_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('User_model');
        $this->load->model('Laporanapotek_model');
        $this->load->model('Pengeluaranapotek_model');
        $this->load->model('Pasien_model');
    }
    function index()
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'dashboard';
            $data['obat_masuk'] = $this->Obatapotek_model->total_obat_masuk();
            $data['obat_keluar'] = $this->Pengeluaranapotek_model->total_obat_keluar();
            $data['top_ten_obat_keluar_apotek'] = $this->Pengeluaranapotek_model->top_ten_obat_keluar_apotek();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_apotek/headerapotek", $data);
            $this->load->view("apotek/vw_dashboardapotek", $data);
            $this->load->view("layout_apotek/footerapotek", $data);
        } else {
            redirect(base_url('auth'));
        }
    }
    function getObatApotek()
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'obat';
            $data['data_obat'] = $this->Obatapotek_model->get();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_apotek/headerapotek", $data);
            $this->load->view("apotek/vw_obatapotek", $data);
            $this->load->view("layout_apotek/footerapotek");
        } else {
            redirect(base_url('auth'));
        }
    }
    function getPermintaanApotek()
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'permintaan obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['results'] = $this->Obatgudang_model->getByName();

            $this->form_validation->set_rules('permintaan', 'Permintaan', 'required', [
                'required' => 'Permintaan Wajib Wajib di Isi'
            ]);
            $this->form_validation->set_rules('jumlah', 'Jumlah Permintaan', 'required', [
                'required' => 'Jumlah Permintaan Obat Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view("layout_apotek/headerapotek", $data);
                $this->load->view("apotek/vw_permintaanapotek", $data);
                $this->load->view("layout_apotek/footerapotek2");
            } else {
                $now = date('Y-m-d H:i:s');
                $data = [
                    'id_user_puskesmas' => 3,
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
                redirect(base_url('Apotek/getPermintaanApotek'));
            }
        } else {
            redirect(base_url('auth'));
        }
    }
    function detailResep($id_pendaftaran)
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'resep';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['riwayat_resep'] = $this->Resep_model->getByIdPendaftaran($id_pendaftaran);
            $this->load->view("layout_apotek/headerapotek", $data);
            $this->load->view("apotek/vw_detailresep", $data);
            $this->load->view("layout_apotek/footerapotek");
        } else {
            redirect(base_url('auth'));
        }
    }

    public function cetak_resep($id_pendaftaran)
    {
        $dompdf = new Dompdf();
        $data['riwayat_resep'] = $this->Resep_model->getByIdPendaftaran($id_pendaftaran);
        // var_dump($data['riwayat_resep']['resep']);
        // $data['nama_pasien'] = $this->Resep_model->get($id_resep);
        $data['tanggal_pendaftaran'] = $this->Pendaftaranpasien_model->getByIdPendaftaran($id_pendaftaran);
        // $data['lplpo_pustu'] = $this->LPLPO_model->getLplpoPustu();
        // $data['lplpo_poned'] = $this->LPLPO_model->getLplpoPoned();
        // echo htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

        $dompdf->setPaper('A9', 'horizontal');
        $html = $this->load->view('apotek/resep_resi', $data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Resi Obat Pasien ' . date('Y'), array("Attachment" => false));
    }

    function resepPasien()
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'resep';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $data['resep'] = $this->Resep_model->get();
            $this->load->view("layout_apotek/headerapotek", $data);
            $this->load->view("apotek/vw_reseppasien", $data);
            $this->load->view("layout_apotek/footerapotek");
        } else {
            redirect(base_url('auth'));
        }
    }
    function getPemasukanApotek()
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $data['judul'] = "Halaman Tambah Obat";

            $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required', [
                'required' => 'Nama Obat Wajib di Isi'
            ]);
            $this->form_validation->set_rules('satuan', 'Satuan/Kemasan', 'required', [
                'required' => 'Satuan/Kemasan Wajib di Isi'
            ]);

            $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required', [
                'required' => 'Stok Wajib di Isi'
            ]);
            $this->form_validation->set_rules('expire', 'Tanggal Expire', 'required', [
                'required' => 'Tanggal Expire Obat Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view("layout_apotek/headerapotek", $data);
                $this->load->view("apotek/vw_pemasukanapotek", $data);
                $this->load->view("layout_apotek/footerapotek");
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

                $id_obat = $this->Obatapotek_model->insert($data);
                // $stok_masuk = $this->input->post('jumlah_masuk');
                // $stok_awal = 0;

                // if ($this->Laporanapotek_model->getLatestStock()) {
                //     $stok_awal = $this->Laporanapotek_model->getLatestStock()['stok_awal'];
                // }

                $data2 = [
                    'id_obat' => $id_obat,
                    'stok_awal' => 0,
                    'masuk' => $this->input->post('jumlah_masuk'),
                    'pemakaian' => 0,
                    'ed' => 0,
                    'sisa_stok' => $this->input->post('jumlah_masuk'),
                    'created_at' => $now,
                ];
                $this->Laporanapotek_model->insert($data2);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
                redirect(base_url('Apotek/getObatApotek'));
            }
        } else {
            redirect(base_url('auth'));
        }
    }
    function EditObat($id)
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['obat_apotek'] = $this->Obatapotek_model->getById($id);

            $this->load->view("layout_apotek/headerapotek", $data);
            $this->load->view("apotek/vw_editobatapotek", $data);
            $this->load->view("layout_apotek/footerapotek");
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
        $this->Obatapotek_model->update(['id_obat' => $id_obat], $data);
        redirect(base_url('Apotek/getObatApotek'));
    }
    function hapus($id_obat)
    {
        $this->Obatapotek_model->delete($id_obat);
        redirect(base_url('Apotek/getObatApotek'));
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
        $this->Obatapotek_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
        redirect(base_url('Apotek/getObatApotek'));
    }
    function laporanApotek()
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'laporan apotek';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['data_laporan'] = $this->Laporanapotek_model->get();

            $this->load->view("layout_apotek/headerapotek", $data);
            $this->load->view("apotek/vw_laporanapotek", $data);
            $this->load->view("layout_apotek/footerapotek");
        } else {
            redirect(base_url('auth'));
        }
    }
    public function updateStok()
    {
        $id_obat = $this->input->post('id_obat');
        $jumlah_lama = $this->input->post('jumlah_lama');
        $jumlah_baru = $this->input->post('jumlah_baru');

        $total = $jumlah_lama + $jumlah_baru;
        $this->Obatapotek_model->updateStok($id_obat, $total);

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
        $this->Laporanapotek_model->insert($data2);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Stok obat berhasil ditambah!</div>');
        redirect(base_url('Apotek/getObatApotek'));
    }
    function tambahStok($id)
    {
        if ($this->session->userdata('role') == 'apotek') {
            $now = date('Y-m-d H:i:s');
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Halaman Perubahan Obat";
            $data['obat_apotek'] = $this->Obatapotek_model->getById($id);
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required', [
                'required' => 'Jumlah Masuk Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view("layout_apotek/headerapotek", $data);
                $this->load->view("apotek/vw_tambahstok", $data);
                $this->load->view("layout_apotek/footerapotek");
            } else {
                // $id = $this->input->post('id_obat');
                $stok_baru = $this->input->post('jumlah_masuk');
                $stok_akhir = intval($data['obat_apotek']['jumlah_masuk']) + intval($stok_baru);

                $this->Obatapotek_model->updateStok($id, $stok_akhir);

                $data2 = [
                    'id_obat' => $id,
                    'stok_awal' => $data['obat_apotek']['jumlah_masuk'],
                    'masuk' => $stok_baru,
                    'pemakaian' => 0,
                    'ed' => 0,
                    'sisa_stok' => $stok_akhir,
                    'created_at' => $now,
                ];

                $this->Laporanapotek_model->insert($data2);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Diubah!</div>');
                redirect(base_url('Apotek/getObatApotek'));
            }
        } else {
            redirect(base_url('auth'));
        }
    }
    function getPengeluaranApotek()
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'pengeluaran obat';
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $data['results_baru'] = $this->Obatapotek_model->getByName();

            $this->form_validation->set_rules('status_pengeluaran', 'Status Pengeluaran', 'required', [
                'required' => 'Status Pengeluaran Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view("layout_apotek/headerapotek", $data);
                $this->load->view("apotek/vw_pengeluaranapotek", $data);
                $this->load->view("layout_apotek/footerapotek2");
            } else {
                $now = date('Y-m-d H:i:s');
                $status_pengeluaran = $this->input->post('status_pengeluaran');

                if ($status_pengeluaran == 'permintaan_apotek') {
                    $jumlah_lama = intval($this->input->post('jumlah_lama'));
                    $jumlah_keluar = intval($this->input->post('jumlah'));

                    // Cek stok
                    if ($jumlah_keluar > $jumlah_lama) {
                        $this->session->set_flashdata('info_pengeluaran_obat', 'Stok Obat Tidak Cukup!');
                        redirect(base_url('Apotek/getPengeluaranApotek'));
                    }

                    $dataObatYangDipilih = $this->Obatapotek_model->getByNameExp($this->input->post('nama_obat'));
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
                                $this->Obatapotek_model->updateStok($data['id_obat'], 0);

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
                                $this->Laporanapotek_model->insert($laporan);
                            } else {
                                // Update stok obat
                                $this->Obatapotek_model->updateStok($data['id_obat'], $sisa_stok_obat);

                                // Simpan riwayat pengeluaran
                                $riwayat = [
                                    'id_obat' => $data['id_obat'],
                                    'keperluan' => $this->input->post('keperluan'),
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

                    $this->session->set_flashdata('success_pengeluaran_obat', 'Data Pengeluaran Obat Berhasil Disimpan!');
                    redirect(base_url('Apotek/getPengeluaranApotek'));
                } else if ($status_pengeluaran == 'obat_expire') {
                    $dataObatExpired = $this->Obatapotek_model->getObatExpired($this->input->post('nama_obat'));

                    if (!empty($dataObatExpired)) {
                        // Hapus data obat yang expired
                        foreach ($dataObatExpired as $dt) {
                            var_dump($dt);
                            $this->Obatapotek_model->updateStok($dt['id_obat'], 0);

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
                            $this->Laporanapotek_model->insert($laporan);
                        }

                        $this->session->set_flashdata('successED_pengeluaran_obat', 'Data Obat Expired Berhasil Dihapus!');
                        redirect(base_url('Apotek/getPengeluaranApotek'));
                    } else {
                        $this->session->set_flashdata('error_pengeluaran_obat', 'Tidak Ada Obat Yang Expired!');
                        redirect(base_url('Apotek/getPengeluaranApotek'));
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
            $data = $this->Laporanapotek_model->filterDataBySelectedMonth($selectedMonth);
            echo json_encode($data);
        } catch (Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
    public function obatMasuk()
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'dashboard';
            $data['data_obat'] = $this->Obatapotek_model->get();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_apotek/headerapotek", $data);
            $this->load->view("apotek/vw_obatmasukapotek", $data);
            $this->load->view("layout_apotek/footerapotek");
        } else {
            redirect(base_url('auth'));
        }
    }
    public function obatKeluar()
    {
        if ($this->session->userdata('role') == 'apotek') {
            $idUser = $this->session->userdata('id');

            $data['menu'] = 'dashboard';
            $data['data_obat_keluar'] = $this->Pengeluaranapotek_model->obat_keluar_apotek();
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);

            $this->load->view("layout_apotek/headerapotek", $data);
            $this->load->view("apotek/vw_obatkeluarapotek", $data);
            $this->load->view("layout_apotek/footerapotek");
        } else {
            redirect(base_url('auth'));
        }
    }
}
