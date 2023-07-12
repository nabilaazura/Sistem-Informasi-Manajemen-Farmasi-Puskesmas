<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['judul'] = "Selamat Datang";

        $this->load->view("layout_auth/header_auth");
        $this->load->view("auth/login", $data);
        $this->load->view("layout_auth/footer_auth");

        // $this->form_validation->set_rules('username', 'Username', 'trim|required', [
        //     'required' => 'Nama Pengguna wajib diisi',
        // ]);
        // $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]', [
        //     'required' => 'Kata Sandi wajib diisi',
        //     'min_length' => 'Kata Sandi terlalu pendek',
        // ]);
        // if ($this->form_validation->run() == false) {
        //     $this->load->view("layout_auth/header_auth");
        //     $this->load->view("auth/login", $data);
        //     $this->load->view("layout_auth/footer_auth");
        // } else {
        //     $this->cek_login();
        // }
    }

    function cek_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        if ($user) {
            if ($password == $user['password']) {
                $data = [
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'id' => $user['id_user'],
                ];
                $this->session->set_userdata($data);

                if ($user['role'] == 'loket') {
                    redirect(base_url('loket'));
                } else if ($user['role'] == 'gudangfarmasi') {
                    redirect(base_url('gudangfarmasi'));
                } else if ($user['role'] == 'poliklinik') {
                    redirect(base_url('poliklinik'));
                } else if ($user['role'] == 'poned') {
                    redirect(base_url('poned'));
                } else if ($user['role'] == 'pustu') {
                    redirect(base_url('pustu'));
                } else if ($user['role'] == 'apotek') {
                    redirect(base_url('apotek'));
                } else if ($user['role'] == 'admin') {
                    redirect(base_url('admin'));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata Sandi Salah!</div>');
                redirect(base_url('auth'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun Pengguna Belum Terdaftar! </div>');
            redirect(base_url('auth'));
        }
    }
    function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Logout!</div>');
        redirect(base_url('auth'));
    }
    function registrasi()
    {
        $data['judul'] = "Selamat Datang";
        $this->load->view("layout_auth/header_auth");
        $this->load->view("auth/registrasi", $data);
        $this->load->view("layout_auth/footer_auth");

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username ini sudah terdaftar!',
            'required' => 'Username Wajib di isi'
        ]);
        $this->form_validation->set_rules(
            'password',
            'confirm_Password',
            'required|trim|min_length[8]|matches[confirm_password]',
            [
                'matches' => 'Password Tidak Sama',
                'min_length' => 'Password Terlalu Pendek',
                'required' => 'Password harus diisi'
            ]
        );
        $this->form_validation->set_rules('confirm_password', 'Password', 'required|trim|matches[password]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            // $this->load->view("layout_auth/header_auth");
            // $this->load->view("auth/registrasi", $data);
            // $this->load->view("layout_auth/footer_auth");
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),

                'role' => "User",
                'date_created' => time()

            ];
            $this->userrole->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akunmu telah berhasil terdaftar, Silahkan Login! </div>');
            redirect('auth');
        }
    }
}
