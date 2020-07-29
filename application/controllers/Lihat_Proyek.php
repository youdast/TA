<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lihat_Proyek extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Lihat_Data_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Lihat Proyek';
        $data['proyek'] = $this->Lihat_Data_model->getAllProyek();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('lihat_proyek/index', $data);
        $this->load->view('templates/footer');
    }
}
