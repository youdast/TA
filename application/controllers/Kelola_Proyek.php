<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_Proyek extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Kelola_Proyek_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Kelola Proyek';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['proyek'] = $this->Kelola_Proyek_model->getAllProyek();
        


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_proyek/index', $data);
        $this->load->view('templates/footer');
    }

    public function updateStatus($kode_proyek)
    {

        $realisasi = $this->Kelola_Proyek_model->getRealisasi($kode_proyek);

        $jmlr = 0;
        foreach ($realisasi as $r) :
            $jmlr += $r['bobot_realisasi'];
        endforeach;

        echo $jmlr;
        if ($jmlr == 0) {
            $status = 'Belum Berlangsung';
        } elseif ($jmlr > 0 and $jmlr < 100) {
            $status = 'Sedang Berlangsung';
        } elseif ($jmlr == 100) {
            $status = 'Sudah Selesai';
        }

        $this->Kelola_Proyek_model->updateStat($kode_proyek, $status);
        $this->session->set_flashdata('flash', 'Direfresh');
        redirect('Kelola_Proyek');
    }

    public function tambah()
    {
        $data['judul'] = 'Kelola Proyek';
        $data['proyek'] = $this->Kelola_Proyek_model->getAllProyek();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('kode_proyek', 'Kode Proyek', 'required|trim', [
            'required' => 'Kode Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('nama_proyek', 'Nama Proyek', 'required|trim', [
            'required' => 'Nama Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('alamat_proyek', 'Alamat Proyek', 'required|trim', [
            'required' => 'Alamat Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('biaya_proyek', 'Biaya Proyek', 'required|numeric|trim', [
            'required' => 'Biaya Proyek harus diisi!',
            'numeric' => 'Biaya Proyek harus berisi angka!'
        ]);
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required', [
            'required' => 'Tanggal Mulai Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required', [
            'required' => 'Tanggal Selesai Proyek harus diisi!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelola_proyek/index', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Kelola_Proyek_model->tambahDataProyek();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Kelola_Proyek');
        }
    }


    public function hapus()
    {
        $this->Kelola_Proyek_model->hapusDataProyek();
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Kelola_Proyek');
    }

    public function gethapusP()
    {
        echo json_encode($this->Kelola_Proyek_model->getDataHapusP($_POST['kode_proyek']));
    }

    public function getubah()
    {
        echo json_encode($this->Kelola_Proyek_model->getDataUbah($_POST['kode_proyek']));
    }

    public function ubah()
    {
        $data['judul'] = 'Kelola Proyek';
        // $data['proyek'] = $this->Kelola_Proyek_model->getDataUbah($kode_proyek);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('kode_proyek', 'Kode Proyek', 'required|trim', [
            'required' => 'Kode Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('nama_proyek', 'Nama Proyek', 'required|trim', [
            'required' => 'Nama Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('alamat_proyek', 'Alamat Proyek', 'required|trim', [
            'required' => 'Alamat Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('biaya_proyek', 'Biaya Proyek', 'required|trim', [
            'required' => 'Biaya Proyek harus diisi!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelola_proyek/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Kelola_Proyek_model->ubahDataProyek($_POST);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Kelola_Proyek');
        }
    }
}
