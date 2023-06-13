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
    function tambahObat()
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
            $this->form_validation->set_rules('expire', 'Tanggal Expire', 'required', [
                'required' => 'Tanggal Expire Obat Wajib di Isi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view("layout_gudangfarmasi/headergudang", $data);
                $this->load->view("gudangfarmasi/vw_tambahobat", $data);
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
                $this->Obatgudang_model->insert($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
                redirect(base_url('gudangfarmasi/getdataobat'));
            }
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
    function getPemasukan()
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Selamat Datang";
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_pemasukanobat", $data);
            $this->load->view("layout_gudangfarmasi/footergudang");
        } else {
            redirect(base_url('auth'));
        }
    }
    function tambahPemasukan()
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Selamat Datang";
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_tambahpemasukan", $data);
            $this->load->view("layout_gudangfarmasi/footergudang");
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
            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_laporan", $data);
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
    function DetailPermintaan($id_permintaan_obat)
    {
        if ($this->session->userdata('role') == 'gudangfarmasi') {
            $role = $this->session->userdata('role');
            $idUser = $this->session->userdata('id');

            $data['judul'] = "Selamat Datang";
            $data['data_permintaan'] = $this->Permintaan_model->getById($id_permintaan_obat);
            $data['notifikasi'] = $this->Notifikasi_model->getByIdUser($idUser);
            $this->load->view("layout_gudangfarmasi/headergudang", $data);
            $this->load->view("gudangfarmasi/vw_detailpermintaan", $data);
            $this->load->view("layout_gudangfarmasi/footergudang");
        } else {
            redirect(base_url('auth'));
        }
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
        $this->Obatgudang_model->update(['id_obat' => $id_obat], $data);
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
}
