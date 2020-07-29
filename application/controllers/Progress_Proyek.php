<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Progress_Proyek extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Progress_Proyek_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Kelola Proyek';
        $data['proyek'] = $this->Progress_Proyek_model->getAllProyek();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('progress_proyek/index', $data);
        $this->load->view('templates/footer');
    }

    public function progress_pekerjaan()
    {
        $data['judul'] = 'Progress Pekerjaan';
        $data['proyek'] = $this->Progress_Proyek_model->getAllProyek();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['progress'] = $this->Progress_Proyek_model->getProgress();
        $data['progproy'] = $this->Progress_Proyek_model->getProgressByProy();
        $data['pegproy'] = $this->Progress_Proyek_model->getPekerjaanByProy();
        $data['bobotr'] = $this->Progress_Proyek_model->getBobotR($this->input->post('kode_proyek'));


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('progress_proyek/progress_pekerjaan', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPP()
    {
        $data['judul'] = 'Progress Pekerjaan';
        $data['proyek'] = $this->Progress_Proyek_model->getAllProyek();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['progress'] = $this->Progress_Proyek_model->getProgress();
        $data['progproy'] = $this->Progress_Proyek_model->getProgressByProy();
        $data['pegproy'] = $this->Progress_Proyek_model->getPekerjaanByProy();

        $this->form_validation->set_rules('kode_proyek', 'Kode Proyek', 'required|trim', [
            'required' => 'Kode Proyek harus diisi!'
        ]);
        // $this->form_validation->set_rules('kode_pekerjaan', 'Kode Pekerjaan', 'required|trim', [
        //     'required' => 'Kode Pekerjaan harus diisi!'
        // ]);
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
            'required' => 'Tanggal harus diisi!'
        ]);
        for ($i = 0; $i < count($data['pegproy']); $i++) {
            //     echo $this->input->post($i);
            $this->form_validation->set_rules($i, 'Bobot Realisasi', 'required|trim', [
                'required' => 'Bobot Realisasi ke-' . $i . ' harus diisi!'
            ]);
        }
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('progress_proyek/progress_pekerjaan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Progress_Proyek_model->tambahDataPP();
            for ($i = 0; $i < count($data['pegproy']); $i++) {
                $kode_pekerjaan[$i] = $data['pegproy'][$i]['kode_pekerjaan'];
            }
            $this->hitungRealisasi($this->input->post('kode_proyek'), $kode_pekerjaan);
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Progress_Proyek/progress_pekerjaan');
        }
    }

    public function getubahPP()
    {
        echo json_encode($this->Progress_Proyek_model->getDataUbahPP($_POST['kode_proyek'], $_POST['kode_pekerjaan'], $_POST['tanggal']));
    }

    public function gethapusPP()
    {
        echo json_encode($this->Progress_Proyek_model->getDataHapusPP($_POST['kode_proyek'], $_POST['kode_pekerjaan'], $_POST['tanggal']));
    }

    public function ubahPP()
    {
        $data['judul'] = 'Progress Pekerjaan';
        $data['proyek'] = $this->Progress_Proyek_model->getAllProyek();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['progress'] = $this->Progress_Proyek_model->getProgress();
        $data['progproy'] = $this->Progress_Proyek_model->getProgressByProy();
        $data['pegproy'] = $this->Progress_Proyek_model->getPekerjaanByProy();

        $this->form_validation->set_rules('kode_proyek', 'Kode Proyek', 'required|trim', [
            'required' => 'Kode Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('kode_pekerjaan', 'Kode Pekerjaan', 'required|trim', [
            'required' => 'Kode Pekerjaan harus diisi!'
        ]);
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
            'required' => 'Tanggal harus diisi!'
        ]);
        $this->form_validation->set_rules('bobot_realisasi', 'Bobot Realisasi', 'required|trim', [
            'required' => 'Bobot Realisasi harus diisi!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('progress_proyek/progress_pekerjaan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Progress_Proyek_model->ubahDataPP();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Progress_Proyek/progress_pekerjaan');
        }
    }

    public function hapusPP()
    {
        $this->Progress_Proyek_model->hapusDataPP();
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Progress_Proyek/progress_pekerjaan');
    }

    public function hitungRealisasi($kode_proyek, $kode_pekerjaan)
    {
        $bobot = $this->Progress_Proyek_model->getBobot($kode_proyek);
        $bobotReal = $this->Progress_Proyek_model->getBobotR($kode_proyek);
        var_dump($bobot);
        echo '<hr>';
        var_dump($bobotReal);
        echo '<hr>';

        // for ($i = 0; $i < count($bobotReal); $i++) {
        //     $bbt[$i] = $bobotReal[$i]['bobot_realisasi'];
        // }
        // $bobotr = array_chunk($bbt, count($bobot));


        // var_dump($bobotr);
        // $i = 1;
        // $j = 1;
        $total = 0;
        // $total = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);


        for ($j = 0; $j < count($bobot); $j++) {
            $bobothasil[$j] = $bobot[$j]['bobot'] * $bobotReal[$j]['bobot_realisasi'] / 100;

            echo $bobothasil[$j];
            echo "<br>";
            $this->Progress_Proyek_model->updateFullProgress($kode_proyek, $kode_pekerjaan[$j], $bobothasil[$j]);
            $total += $bobothasil[$j];
        }
        echo $total;
    }
}
