<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_Pekerjaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Kelola_Pekerjaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Kelola Pekerjaan';
        $data['proyek'] = $this->Kelola_Pekerjaan_model->getAllProyek();
        $data['pekerjaan'] = $this->Kelola_Pekerjaan_model->getAllPekerjaan();
        $data['pekproy'] = $this->Kelola_Pekerjaan_model->getPekerjaan();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['status'] = 1;

        if (count($data['pekproy']) == 0) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_pekerjaan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Kelola Pekerjaan';
        $data['proyek'] = $this->Kelola_Pekerjaan_model->getAllProyek();
        $data['pekerjaan'] = $this->Kelola_Pekerjaan_model->getAllPekerjaan();
        $data['pekproy'] = $this->Kelola_Pekerjaan_model->getPekerjaan();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if (count($data['pekproy']) == 0) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }

        $this->form_validation->set_rules('kode_proyek', 'Kode Proyek', 'required|trim', [
            'required' => 'Kode Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('kode_pekerjaan', 'Kode Pekerjaan', 'required|trim', [
            'required' => 'Kode Pekerjaan harus diisi!'
        ]);
        $this->form_validation->set_rules('nama_pekerjaan', 'Nama Pekerjaan', 'required|trim', [
            'required' => 'Nama Pekerjaan harus diisi!'
        ]);
        $this->form_validation->set_rules('bobot', 'Bobot', 'required|trim|numeric', [
            'required' => 'Bobot harus diisi!',
            'numeric' => 'Bobot harus merupakan angka satuan %!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelola_pekerjaan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Kelola_Pekerjaan_model->tambahDataPekerjaan();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Kelola_Pekerjaan');
        }
    }

    public function getubahPK()
    {
        echo json_encode($this->Kelola_Pekerjaan_model->getDataModal($_POST['kode_proyek'], $_POST['kode_pekerjaan']));
    }

    public function ubah()
    {
        $data['judul'] = 'Kelola Pekerjaan';
        $data['proyek'] = $this->Kelola_Pekerjaan_model->getAllProyek();
        $data['pekerjaan'] = $this->Kelola_Pekerjaan_model->getAllPekerjaan();
        $data['pekproy'] = $this->Kelola_Pekerjaan_model->getPekerjaan();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if (count($data['pekproy']) == 0) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }

        $this->form_validation->set_rules('kode_proyek', 'Kode Proyek', 'required|trim', [
            'required' => 'Kode Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('kode_pekerjaan', 'Kode Pekerjaan', 'required|trim', [
            'required' => 'Kode Pekerjaan harus diisi!'
        ]);
        $this->form_validation->set_rules('nama_pekerjaan', 'Nama Pekerjaan', 'required|trim', [
            'required' => 'Nama Pekerjaan harus diisi!'
        ]);
        $this->form_validation->set_rules('bobot', 'Bobot', 'required|trim|numeric', [
            'required' => 'Bobot harus diisi!',
            'numeric' => 'Bobot harus merupakan angka satuan %!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelola_pekerjaan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Kelola_Pekerjaan_model->ubahDataPekerjaan($_POST);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Kelola_Pekerjaan');
        }
    }

    public function gethapusPK()
    {
        echo json_encode($this->Kelola_Pekerjaan_model->getDataModal($_POST['kode_proyek'], $_POST['kode_pekerjaan']));
    }

    public function hapus()
    {
        $this->Kelola_Pekerjaan_model->hapusDataPK();
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Kelola_Pekerjaan');
    }
}
