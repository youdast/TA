<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['judul'] = 'Kelola User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['users'] = $this->Admin_model->getAllUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Kelola User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['users'] = $this->Admin_model->getAllUser();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim', [
            'required' => 'Email harus diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password harus diisi!'
        ]);
        $this->form_validation->set_rules('role_id', 'Role Id', 'required|trim', [
            'required' => 'Role Id harus diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Admin_model->tambahDataUser();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('admin');
        }
    }

    public function getU()
    {
        echo json_encode($this->Admin_model->getDataModal($_POST['id']));
    }

    public function ubah()
    {
        $data['judul'] = 'Kelola User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['users'] = $this->Admin_model->getAllUser();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim', [
            'required' => 'Email harus diisi!'
        ]);
        $this->form_validation->set_rules('role_id', 'Role Id', 'required|trim', [
            'required' => 'Role Id harus diisi!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->ubahDataUser($_POST);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('admin');
        }
    }

    public function hapus()
    {
        $this->Admin_model->hapusDataU();
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('admin');
    }
}
