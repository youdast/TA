
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen_Risiko extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Risk_Event_model');
        $this->load->model('Risk_Agent_model');
        $this->load->model('Mitigasi_model');
        $this->load->model('Relasi_Risiko_model');
        $this->load->model('Relasi_Mitigasi_model');
        $this->load->model('HOR_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Manajemen Risiko Proyek';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manajemen_risiko/index', $data);
        $this->load->view('templates/footer');
    }

    public function risk_event()
    {
        $data['judul'] = 'Risk Event (Kejadian Risiko)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['proyek'] = $this->Risk_Event_model->getAllProyek();
        $data['kproyek'] = $this->Risk_Event_model->getKodeProyek();
        $data['risk'] = $this->Risk_Event_model->getAllRiskEvent();
        $data['RiskE'] = $this->Risk_Event_model->getDataRisk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manajemen_risiko/risk_event', $data);
        $this->load->view('templates/footer');
    }

    public function tambahRE()
    {
        $data['judul'] = 'Risk Event (Kejadian Risiko)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kproyek'] = $this->Risk_Event_model->getKodeProyek();
        $data['risk'] = $this->Risk_Event_model->getAllRiskEvent();
        $data['RiskE'] = $this->Risk_Event_model->getDataRisk();
        $this->form_validation->set_rules('kode_risk_event', 'Kode Risk Event', 'required|trim', [
            'required' => 'Kode Risk Event harus diisi!'
        ]);
        $this->form_validation->set_rules('risk_event', 'Risk Event', 'required|trim', [
            'required' => 'Risk Event harus diisi!'
        ]);
        $this->form_validation->set_rules('severity', 'Severity', 'required|trim|numeric', [
            'required' => 'Severity harus diisi!',
            'numeric' => 'Severity harus berupa angka!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manajemen_risiko/risk_event', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Risk_Event_model->tambahDataRE();
            $this->Risk_Event_model->tambahRelasiRR();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Manajemen_Risiko/risk_event');
        }
    }

    public function hapusRE()
    {
        $this->Risk_Event_model->hapusDataRE();
        $this->Risk_Event_model->hapusRelasiRR();
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Manajemen_Risiko/risk_event');
    }

    public function getubahRE()
    {
        echo json_encode($this->Risk_Event_model->getDataUbahRE($_POST['kode_proyek'], $_POST['kode_risk_event']));
    }

    public function gethapusRE()
    {
        echo json_encode($this->Risk_Event_model->getDataHapusRE($_POST['kode_proyek'], $_POST['kode_risk_event']));
    }

    public function ubahRE()
    {
        $data['judul'] = 'Risk Event (Kejadian Risiko)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('kode_proyek', 'Kode Proyek', 'required|trim', [
            'required' => 'Kode Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('kode_risk_event', 'Kode Risk Event', 'required|trim', [
            'required' => 'Kode Risk Event harus diisi!'
        ]);
        $this->form_validation->set_rules('risk_event', 'Risk Event', 'required|trim', [
            'required' => 'Risk Event harus diisi!'
        ]);
        $this->form_validation->set_rules('severity', 'Severity', 'required|trim|numeric', [
            'required' => 'Severity harus diisi!',
            'numeric' => 'Severity harus merupakan angka!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manajemen_risiko/risk_event', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Risk_Event_model->ubahDataRE($_POST);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Manajemen_Risiko/risk_event');
        }
    }




    public function risk_agent()
    {
        $data['judul'] = 'Risk Agent (Penyebab Risiko)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['proyek'] = $this->Risk_Agent_model->getAllProyek();
        $data['kproyek'] = $this->Risk_Agent_model->getKodeProyek();
        $data['risk'] = $this->Risk_Agent_model->getAllRiskAgent();
        $data['RiskA'] = $this->Risk_Agent_model->getDataRisk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manajemen_risiko/risk_agent', $data);
        $this->load->view('templates/footer');
    }

    public function tambahRA()
    {
        $data['judul'] = 'Risk Agent (Penyebab Risiko)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kproyek'] = $this->Risk_Agent_model->getKodeProyek();
        $data['risk'] = $this->Risk_Agent_model->getAllRiskAgent();
        $data['RiskA'] = $this->Risk_Agent_model->getDataRisk();
        $this->form_validation->set_rules('kode_risk_agent', 'Kode Risk Agent', 'required|trim', [
            'required' => 'Kode Risk Agent harus diisi!'
        ]);
        $this->form_validation->set_rules('risk_agent', 'Risk Event', 'required|trim', [
            'required' => 'Risk Agent harus diisi!'
        ]);
        $this->form_validation->set_rules('occurence', 'Severity', 'required|trim', [
            'required' => 'Occurence harus diisi!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manajemen_risiko/risk_agent', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Risk_Agent_model->tambahDataRA();
            $this->Risk_Agent_model->tambahRelasiRR();
            $this->Risk_Agent_model->tambahRelasiRM();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Manajemen_Risiko/risk_agent');
        }
    }

    public function hapusRA()
    {
        $this->Risk_Agent_model->hapusDataRA();
        $this->Risk_Agent_model->hapusRelasiRR();
        $this->Risk_Agent_model->hapusRelasiRM();

        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Manajemen_Risiko/risk_agent');
    }

    public function getubahRA()
    {
        echo json_encode($this->Risk_Agent_model->getDataUbahRA($_POST['kode_proyek'], $_POST['kode_risk_agent']));
    }

    public function gethapusRA()
    {
        echo json_encode($this->Risk_Agent_model->getDataHapusRA($_POST['kode_proyek'], $_POST['kode_risk_agent']));
    }

    public function ubahRA()
    {
        $data['judul'] = 'Risk Agent (Penyebab Risiko)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('kode_proyek', 'Kode Proyek', 'required|trim', [
            'required' => 'Kode Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('kode_risk_agent', 'Kode Risk Agent', 'required|trim', [
            'required' => 'Kode Risk Agent harus diisi!'
        ]);
        $this->form_validation->set_rules('risk_agent', 'Risk Agent', 'required|trim', [
            'required' => 'Risk Agent harus diisi!'
        ]);
        $this->form_validation->set_rules('occurence', 'Occurence', 'required|trim|numeric', [
            'required' => 'Occurence harus diisi!',
            'numeric' => 'Occurence harus merupakan angka!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manajemen_risiko/risk_agent', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Risk_Agent_model->ubahDataRA($_POST);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Manajemen_Risiko/risk_agent');
        }
    }

    // public function saveNewNilai()
    // {
    //     $newInt = $_POST['newInt'];
    //     echo $newInt;
    //     // $kode_proyek = $_POST['kode_proyek'];
    //     // $kode_risk_agent = $_POST['kode_risk_agent'];
    //     // $kode_risk_event = $_POST['kode_risk_event'];
    //     $kode_proyek = '002-0419-NEW';
    //     $kode_risk_agent = 'A001';
    //     $kode_risk_event = 'E001';
    //     if ($newInt != "") {
    //         $this->db->set('nilai', $newInt);
    //         $this->db->where('kode_proyek', $kode_proyek);
    //         $this->db->where('kode_risk_agent', $kode_risk_agent);
    //         $this->db->where('kode_risk_event', $kode_risk_event);
    //         $this->db->update('relasi_risiko');
    //     }
    // }

    public function relasi_risiko()
    {
        $data['judul'] = 'Relasi Risk Event dan Risk Agent (kejadian dan penyebab)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['proyek'] = $this->Relasi_Risiko_model->getAllProyek();
        $data['kproyek'] = $this->Relasi_Risiko_model->getKodeProyek();
        $data['RelasiR'] = $this->Relasi_Risiko_model->getAllRelasiR();
        $data['Agent'] = $this->Relasi_Risiko_model->getAgent();
        $data['Event'] = $this->Relasi_Risiko_model->getEvent();
        $data['AllAgent'] = $this->Relasi_Risiko_model->getAllAgent();
        $data['AllEvent'] = $this->Relasi_Risiko_model->getAllEvent();
        $data['Nilai'] = $this->Relasi_Risiko_model->getNilai();
        $data['dataRR'] = $this->Relasi_Risiko_model->getDataRelasiR();
        $occ = $this->HOR_model->getOccurence($this->input->post('kode_proyek'));
        $sev = $this->HOR_model->getSeverity($this->input->post('kode_proyek'));
        $rela = $this->HOR_model->getRelasiR($this->input->post('kode_proyek'));
        // $data['relasi'] = $this->HOR_model->getRelasiR($this->input->post('kode_proyek'));

        $jml = count($occ) * count($sev);

        if ($jml == count($rela) and null == !($this->input->post('kode_proyek')) and count($rela) != 0 and $jml != 0) {
            $data['kodep'] = $this->input->post('kode_proyek');
            $data['status'] = 1;
        } else {
            $data['kodep'] = $this->input->post('kode_proyek');
            $this->Relasi_Risiko_model->tambahDefaultRR();
            $data['status'] = 0;
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manajemen_risiko/relasi_risiko', $data);
        $this->load->view('templates/footer');
    }

    // public function tambahRR()
    // {
    //     $this->Relasi_Risiko_model->tambahDefaultRR();
    //     $this->session->set_flashdata('flash', 'Ditambahkan');
    //     redirect('manajemen_risiko/relasi_risiko');
    // }

    public function ubahRR()
    {
        $data['judul'] = 'Relasi Risk Event dan Risk Agent (kejadian dan penyebab)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['proyek'] = $this->Relasi_Risiko_model->getAllProyek();
        $data['kproyek'] = $this->Relasi_Risiko_model->getKodeProyek();
        $data['RelasiR'] = $this->Relasi_Risiko_model->getAllRelasiR();
        $data['Agent'] = $this->Relasi_Risiko_model->getAgent();
        $data['Event'] = $this->Relasi_Risiko_model->getEvent();
        $data['AllAgent'] = $this->Relasi_Risiko_model->getAllAgent();
        $data['AllEvent'] = $this->Relasi_Risiko_model->getAllEvent();
        $data['Nilai'] = $this->Relasi_Risiko_model->getNilai();
        $data['dataRR'] = $this->Relasi_Risiko_model->getDataRelasiR();
        $occ = $this->HOR_model->getOccurence($this->input->post('kode_proyek'));
        $sev = $this->HOR_model->getSeverity($this->input->post('kode_proyek'));
        $rela = $this->HOR_model->getRelasiR($this->input->post('kode_proyek'));

        $jml = count($occ) * count($sev);

        if ($jml == count($rela) and null == !($this->input->post('kode_proyek')) and count($rela) != 0 and $jml != 0) {
            $data['kodep'] = $this->input->post('kode_proyek');
            $data['status'] = 1;
        } else {
            $data['kodep'] = $this->input->post('kode_proyek');
            $this->Relasi_Risiko_model->tambahDefaultRR();
            $data['status'] = 0;
        }

        $this->form_validation->set_rules('kode_risk_agent', 'Kode Risk Agent', 'required|trim', [
            'required' => 'Kode Risk Agent harus diisi!'
        ]);
        $this->form_validation->set_rules('kode_risk_event', 'Kode Risk Event', 'required|trim', [
            'required' => 'Kode Risk Event harus diisi!'
        ]);
        $this->form_validation->set_rules('nilai', 'Nilai', 'required|trim|numeric', [
            'required' => 'Nilai harus diisi!',
            'numeric' => 'Nilai harus berupa Angka'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manajemen_risiko/relasi_risiko', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Relasi_Risiko_model->ubahDataRR();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Manajemen_Risiko/relasi_risiko');
        }
    }

    public function relasi_mitigasi()
    {
        $data['judul'] = 'Relasi Risk Agent dan Mitigasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['proyek'] = $this->Relasi_Mitigasi_model->getAllProyek();
        $data['kproyek'] = $this->Relasi_Mitigasi_model->getKodeProyek();
        $data['RelasiM'] = $this->Relasi_Mitigasi_model->getAllRelasiM();
        $data['Agent'] = $this->Relasi_Mitigasi_model->getAgent();
        $data['Mitigasi'] = $this->Relasi_Mitigasi_model->getMitigasi();
        $data['AllAgent'] = $this->Relasi_Mitigasi_model->getAllAgent();
        $data['AllMitigasi'] = $this->Relasi_Mitigasi_model->getAllMitigasi();
        $data['Nilai'] = $this->Relasi_Mitigasi_model->getNilai();
        $data['dataRM'] = $this->Relasi_Mitigasi_model->getDataRelasiM();
        $ARP = $this->HOR_model->getARP($this->input->post('kode_proyek'));
        $diff = $this->HOR_model->getDifficulty($this->input->post('kode_proyek'));
        $rela = $this->HOR_model->getRelasiM($this->input->post('kode_proyek'));
        // $data['relasi'] = $this->HOR_model->getRelasiR($this->input->post('kode_proyek'));

        $jml = count($ARP) * count($diff);

        if ($jml == count($rela) and null == !($this->input->post('kode_proyek')) and count($rela) != 0 and $jml != 0) {
            $data['kodep'] = $this->input->post('kode_proyek');
            $data['status'] = 1;
        } else {
            $data['kodep'] = $this->input->post('kode_proyek');
            $this->Relasi_Mitigasi_model->tambahDefaultRM();
            $data['status'] = 0;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manajemen_risiko/relasi_mitigasi', $data);
        $this->load->view('templates/footer');
    }

    public function ubahRM()
    {
        $data['judul'] = 'Relasi Risk Agent dan Mitigasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['proyek'] = $this->Relasi_Mitigasi_model->getAllProyek();
        $data['kproyek'] = $this->Relasi_Mitigasi_model->getKodeProyek();
        $data['RelasiM'] = $this->Relasi_Mitigasi_model->getAllRelasiM();
        $data['Agent'] = $this->Relasi_Mitigasi_model->getAgent();
        $data['Mitigasi'] = $this->Relasi_Mitigasi_model->getMitigasi();
        $data['AllAgent'] = $this->Relasi_Mitigasi_model->getAllAgent();
        $data['AllMitigasi'] = $this->Relasi_Mitigasi_model->getAllMitigasi();
        $data['Nilai'] = $this->Relasi_Mitigasi_model->getNilai();
        $data['dataRM'] = $this->Relasi_Mitigasi_model->getDataRelasiM();
        $ARP = $this->HOR_model->getARP($this->input->post('kode_proyek'));
        $diff = $this->HOR_model->getDifficulty($this->input->post('kode_proyek'));
        $rela = $this->HOR_model->getRelasiM($this->input->post('kode_proyek'));
        // $data['relasi'] = $this->HOR_model->getRelasiR($this->input->post('kode_proyek'));

        $jml = count($ARP) * count($diff);

        if ($jml == count($rela) and null == !($this->input->post('kode_proyek')) and count($rela) != 0 and $jml != 0) {
            $data['kodep'] = $this->input->post('kode_proyek');
            $data['status'] = 1;
        } else {
            $data['kodep'] = $this->input->post('kode_proyek');
            $this->Relasi_Mitigasi_model->tambahDefaultRM();
            $data['status'] = 0;
        }

        $this->form_validation->set_rules('kode_risk_agent', 'Kode Risk Agent', 'required|trim', [
            'required' => 'Kode Risk Agent harus diisi!'
        ]);
        $this->form_validation->set_rules('kode_mitigasi', 'Kode Mitigasi', 'required|trim', [
            'required' => 'Kode Mitigasi harus diisi!'
        ]);
        $this->form_validation->set_rules('nilai', 'Nilai', 'required|trim|numeric', [
            'required' => 'Nilai harus diisi!',
            'numeric' => 'Nilai harus berupa Angka'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manajemen_risiko/relasi_mitigasi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Relasi_Mitigasi_model->ubahDataRM();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Manajemen_Risiko/relasi_mitigasi');
        }
    }

    // private function array_split($array, $pieces = 2)
    // {
    //     if ($pieces < 2)
    //         return array($array);
    //     $newCount = ceil(count($array) / $pieces);
    //     $a = array_slice($array, 0, $newCount);
    //     $b = array_split(array_slice($array, $newCount), $pieces - 1);
    //     return array_merge(array($a), $b);
    // }

    public function hitungARP()
    {
        $occ = $this->HOR_model->getOccurence();
        $sev = $this->HOR_model->getSeverity();
        $rela = $this->HOR_model->getRelasiR();
        // print_r($this->HOR_model->getSeverity());

        // echo '<hr>';
        // // $occ[];
        // foreach ($data['occurence'] as $d) :
        //     echo $d['occurence'];
        //     echo '<br>';
        // // $occ[$d];
        // endforeach;
        // echo '<hr>';
        // foreach ($data['severity'] as $d) :
        //     echo $d['severity'];
        //     echo '<br>';
        // endforeach;

        for ($i = 0; $i < count($rela); $i++) {
            $rel[$i] = $rela[$i]['nilai'];
        }

        // $ii = $this->array_split($rel, 2);

        $relasi = array_chunk($rel, count($sev));
        echo '<hr>';

        // print_r($rela);
        // $rel[0] = array(9, 3, 9, 0, 3, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 9, 3, 0, 0, 0, 3, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0);
        // $rel[1] = array(3, 0, 0, 0, 3, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        // $rel[2] = array(3, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        $sum = 0;
        for ($o = 0; $o < count($occ); $o++) {
            $sum = 0;
            for ($i = 0; $i <= 30; $i++) {
                // for ($j = 0; $j < count($rela); $j++) {
                $dati = $sev[$i]['severity'] * $relasi[$o][$i];
                $sum += $dati;
                // }
            }
            $ARP[$o] = $occ[$o]['occurence'] * $sum;
            echo $ARP[$o];
            echo '<br>';
            // echo $occ[$o]['occurence'];
            echo '<hr>';
        }

        echo '<br>';
        echo '<br>';
        echo '<br>';
        $this->HOR_model->ubahDataARP($ARP);

        $kode_proyek = '001-0518-BAL';
        $this->db->select('*');
        $this->db->from('risk_agent');
        $this->db->where('kode_proyek', $kode_proyek);
        $this->db->order_by('ARP', 'DESC');
        $query = $this->db->get()->result_array();
        foreach ($query as $q) :
            echo $q['kode_proyek'];
            echo '<br>';
            echo $q['kode_risk_agent'];
            echo '<br>';
            echo $q['ARP'];
            echo '<hr>';
        endforeach;
        // return $query->result_array();
    }



    public function mitigasi()
    {
        $data['judul'] = 'Mitigasi (Preventive Action)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['proyek'] = $this->Mitigasi_model->getAllProyek();
        $data['kproyek'] = $this->Mitigasi_model->getKodeProyek();
        $data['mit'] = $this->Mitigasi_model->getAllMitigasi();
        $data['datamit'] = $this->Mitigasi_model->getDataMitigasi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manajemen_risiko/mitigasi', $data);
        $this->load->view('templates/footer');
    }
    public function tambahM()
    {
        $data['judul'] = 'Mitigasi (Preventive Action)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kproyek'] = $this->Mitigasi_model->getKodeProyek();
        $data['mit'] = $this->Mitigasi_model->getAllMitigasi();
        $data['datamit'] = $this->Mitigasi_model->getDataMitigasi();
        $this->form_validation->set_rules('kode_mitigasi', 'Kode Mitigasi', 'required|trim', [
            'required' => 'Kode Mitigasi harus diisi!'
        ]);
        $this->form_validation->set_rules('mitigasi', 'Mitigasi', 'required|trim', [
            'required' => 'Mitigasi harus diisi!'
        ]);
        $this->form_validation->set_rules('difficulty', 'Difficulty', 'required|trim', [
            'required' => 'Difficulty harus diisi!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manajemen_risiko/mitigasi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Mitigasi_model->tambahDataM();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Manajemen_Risiko/mitigasi');
        }
    }

    public function hapusM()
    {
        $this->Mitigasi_model->hapusDataM($_POST);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Manajemen_Risiko/mitigasi');
    }

    public function getubahM()
    {
        echo json_encode($this->Mitigasi_model->getDataUbahM($_POST['kode_proyek'], $_POST['kode_mitigasi']));
    }

    public function gethapusM()
    {
        echo json_encode($this->Mitigasi_model->getDataHapusM($_POST['kode_proyek'], $_POST['kode_mitigasi']));
    }

    public function ubahM()
    {
        $data['judul'] = 'Mitigasi (Preventive Action)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kproyek'] = $this->Mitigasi_model->getKodeProyek();
        $data['mit'] = $this->Mitigasi_model->getAllMitigasi();
        $data['datamit'] = $this->Mitigasi_model->getDataMitigasi();
        $this->form_validation->set_rules('kode_proyek', 'Kode Proyek', 'required|trim', [
            'required' => 'Kode Proyek harus diisi!'
        ]);
        $this->form_validation->set_rules('kode_mitigasi', 'Kode Mitigasi', 'required|trim', [
            'required' => 'Kode Mitigasi harus diisi!'
        ]);
        $this->form_validation->set_rules('mitigasi', 'Mitigasi', 'required|trim', [
            'required' => 'Mitigasi harus diisi!'
        ]);
        $this->form_validation->set_rules('difficulty', 'Difficulty', 'required|trim|numeric', [
            'required' => 'Difficulty harus diisi!',
            'numeric' => 'Difficulty harus merupakan angka!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manajemen_risiko/mitigasi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Mitigasi_model->ubahDataM($_POST);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Manajemen_Risiko/mitigasi');
        }
    }
}
