<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apotek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obatapotek_model');
        $this->load->model('Permintaan_model');
        $this->load->model('Resep_model');
        $this->load->model('Pendaftaranpasien_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('User_model');
    }

    function index()
    {
        if ($this->session->userdata('role') == 'apotek') {
            $data['judul'] = "Selamat Datang";
            $this->load->view("layout_apotek/headerapotek");
            $this->load->view("apotek/vw_dashboardapotek", $data);
            $this->load->view("layout_apotek/footerapotek");
        } else {
            redirect(base_url('auth'));
        }
    }
    function getObatApotek()
    {
        $data['judul'] = "Selamat Datang";
        $data['data_obat'] = $this->Obatapotek_model->get();
        $this->load->view("layout_apotek/headerapotek");
        $this->load->view("apotek/vw_obatapotek", $data);
        $this->load->view("layout_apotek/footerapotek");
    }
    function getPermintaanApotek()
    {
        $data['judul'] = "Halaman Permintaan Obat";
        $this->form_validation->set_rules('kode_obat', 'Kode Obat', 'required', [
            'required' => 'Kode Obat Wajib di Isi'
        ]);
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required', [
            'required' => 'Nama Obat Wajib di Isi'
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan/Kemasan', 'required', [
            'required' => 'Satuan/Kemasan Wajib di Isi'
        ]);
        $this->form_validation->set_rules('permintaan', 'Permintaan', 'required', [
            'required' => 'Permintaan Wajib Wajib di Isi'
        ]);
        $this->form_validation->set_rules('tanggal_permintaan', 'Tanggal Permintaan', 'required', [
            'required' => 'Tanggal Permintaan Obat Wajib di Isi'
        ]);
        $this->form_validation->set_rules('jumlah', 'Jumlah Permintaan', 'required', [
            'required' => 'Jumlah Permintaan Obat Wajib di Isi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("layout_apotek/headerapotek");
            $this->load->view("apotek/vw_permintaanapotek", $data);
            $this->load->view("layout_apotek/footerapotek");
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

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Permintaan Obat Berhasil Dikirim!</div>');
            redirect(base_url('Apotek/getPermintaanApotek'));
        }
    }
    function detailResep($id_pendaftaran)
    {
        $data['judul'] = "Selamat Datang";
        $data['riwayat_resep'] = $this->Resep_model->getByIdPendaftaran($id_pendaftaran);
        $this->load->view("layout_apotek/headerapotek");
        $this->load->view("apotek/vw_detailresep", $data);
        $this->load->view("layout_apotek/footerapotek");
    }
    function resepPasien()
    {
        $data['judul'] = "Selamat Datang";
        $data['resep'] = $this->Resep_model->get();
        $this->load->view("layout_apotek/headerapotek");
        $this->load->view("apotek/vw_reseppasien", $data);
        $this->load->view("layout_apotek/footerapotek");
    }
    function getPemasukanApotek()
    {
        $data['judul'] = "Halaman Tambah Obat";
        $this->form_validation->set_rules('kode_obat', 'Kode Obat', 'required', [
            'required' => 'Kode Obat Wajib di Isi'
        ]);
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required', [
            'required' => 'Nama Obat Wajib di Isi'
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan/Kemasan', 'required', [
            'required' => 'Satuan/Kemasan Wajib di Isi'
        ]);
        $this->form_validation->set_rules('harga', 'Harga Satuan', 'required', [
            'required' => 'Harga Satuan Wajib Wajib di Isi'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required', [
            'required' => 'Stok Wajib di Isi'
        ]);
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required', [
            'required' => 'Tanggal Masuk Obat Wajib di Isi'
        ]);
        $this->form_validation->set_rules('expire', 'Tanggal Expire', 'required', [
            'required' => 'Tanggal Expire Obat Wajib di Isi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("layout_apotek/headerapotek");
            $this->load->view("apotek/vw_pemasukanapotek", $data);
            $this->load->view("layout_apotek/footerapotek");
        } else {
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
            $this->Obatapotek_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
            redirect(base_url('Apotek/getObatApotek'));
        }
    }
    function EditObat($id)
    {
        $now = date('Y-m-d H:i:s');
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Halaman Perubahan Obat";
            $data['obat_apotek'] = $this->Obatapotek_model->getById($id);
            $this->load->view("layout_apotek/headerapotek");
            $this->load->view("apotek/vw_editobatapotek", $data);
            $this->load->view("layout_apotek/footerapotek");
        } else {

            $data = [
                'kode_obat' => $this->input->post('kode_obat'),
                'nama_obat' => $this->input->post('nama_obat'),
                'satuan' => $this->input->post('satuan'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'tanggal_masuk' => $now,
                'expire' => $this->input->post('expire'),
            ];
            $id = $this->input->post('id_obat');
            $this->Obatapotek_model->update(['id_obat' => $id], $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Diubah!</div>');
            redirect(base_url('Apotek/getObatApotek'));
        }
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
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'tanggal_masuk' => $now,
            'expire' => $this->input->post('expire'),
        ];
        $this->Obatapotek_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Obat Berhasil Ditambah!</div>');
        redirect(base_url('Apotek/getObatApotek'));
    }
    function update()
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
        $id_obat = $this->input->post('id_obat');
        $this->Obatapotek_model->update(['id_obat' => $id_obat], $data);
        redirect(base_url('Apotek/getObatApotek'));
    }
}
