<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lihat_Pekerjaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Lihat_Data_model');
    }

    public function index()
    {
        $data['judul'] = 'Lihat Pekerjaan';
        $data['proyek'] = $this->Lihat_Data_model->getAllProyek();
        $data['pekerjaan'] = $this->Lihat_Data_model->getAllPekerjaan();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pekproy'] = $this->Lihat_Data_model->getPekerjaan();
        $data['status'] = 1;

        if (count($data['pekerjaan']) == 0) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('lihat_pekerjaan/index', $data);
        $this->load->view('templates/footer');
    }
}
