
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen extends CI_Controller
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
        $this->load->view('manajemen', $data);
        $this->load->view('templates/footer');
    }

    public function hitungARP($kode_proyek)
    {
        $occ = $this->HOR_model->getOccurence($kode_proyek);
        $sev = $this->HOR_model->getSeverity($kode_proyek);
        $rela = $this->HOR_model->getRelasiR($kode_proyek);
        $kodeRA = $this->HOR_model->getKodeRA($kode_proyek);
        // print_r($this->HOR_model->getSeverity());


        for ($i = 0; $i < count($rela); $i++) {
            $rel[$i] = $rela[$i]['nilai'];
        }

        // $ii = $this->array_split($rel, 2);

        $relasi = array_chunk($rel, count($sev));

        // var_dump($relasi);
        // print_r($rela);
        // $rel[0] = array(9, 3, 9, 0, 3, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 9, 3, 0, 0, 0, 3, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0);
        // $rel[1] = array(3, 0, 0, 0, 3, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        // $rel[2] = array(3, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        $sum = 0;
        for ($o = 0; $o < count($occ); $o++) {
            $sum = 0;
            for ($i = 0; $i < count($sev); $i++) {
                $dati = $sev[$i]['severity'] * $relasi[$o][$i];
                $sum += $dati;
            }
            $ARP[$o] = $occ[$o]['occurence'] * $sum;
        }

        $this->HOR_model->ubahDataARP($ARP, $kode_proyek, $kodeRA);


        // $kode_proyek = '001-0518-BAL';
        // $this->db->select('*');
        // $this->db->from('risk_agent');
        // $this->db->where('kode_proyek', $kode_proyek);
        // $this->db->order_by('ARP', 'DESC');
        // $query = $this->db->get()->result_array();
        // foreach ($query as $q) :
        //     echo $q['kode_proyek'];
        //     echo '<br>';
        //     echo $q['kode_risk_agent'];
        //     echo '<br>';
        //     echo $q['ARP'];
        //     echo '<hr>';
        // endforeach;
        // return $query->result_array();
    }

    public function hitungETD($kode_proyek)
    {
        $ARP = $this->HOR_model->getARP($kode_proyek);
        $diff = $this->HOR_model->getDifficulty($kode_proyek);
        $rela = $this->HOR_model->getRelasiM($kode_proyek);
        $kodeM = $this->HOR_model->getKodeM($kode_proyek);

        for ($i = 0; $i < count($rela); $i++) {
            $rel[$i] = $rela[$i]['nilai'];
        }

        $relasi = array_chunk($rel, count($ARP));

        $sum = 0;
        for ($o = 0; $o < count($diff); $o++) {
            $sum = 0;
            for ($i = 0; $i < count($ARP); $i++) {
                $dati = $ARP[$i]['ARP'] * $relasi[$o][$i];
                $sum += $dati;
            }
            $TE[$o] = $sum;

            $ETD[$o] = $TE[$o] / $diff[$o]['difficulty'];
        }
        $this->HOR_model->ubahDataETD($ETD, $kode_proyek, $kodeM);

        // $kode_proyek = '001-0518-BAL';
        // $this->db->select('*');
        // $this->db->from('mitigasi');
        // $this->db->where('kode_proyek', $kode_proyek);
        // $this->db->order_by('ETD', 'DESC');
        // $query = $this->db->get()->result_array();
        //         return $query->result_array();

        // foreach ($query as $q) :
        //     echo $q['kode_proyek'];
        //     echo '<br>';
        //     echo $q['kode_mitigasi'];
        //     echo '<br>';
        //     echo $q['ETD'];
        //     echo '<hr>';
        // endforeach;
    }

    public function risiko_proyek()
    {
        $data['judul'] = 'Risiko Proyek';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kproyek'] = $this->HOR_model->getKodeProyek();
        $occ = $this->HOR_model->getOccurence($this->input->post('kode_proyek'));
        $sev = $this->HOR_model->getSeverity($this->input->post('kode_proyek'));
        $ARP = $this->HOR_model->getARP($this->input->post('kode_proyek'));
        $diff = $this->HOR_model->getDifficulty($this->input->post('kode_proyek'));
        $relR = $this->HOR_model->getRelasiR($this->input->post('kode_proyek'));
        $relM = $this->HOR_model->getRelasiM($this->input->post('kode_proyek'));

        $jmlRR = count($occ) * count($sev);
        $jmlRM = count($ARP) * count($diff);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        if ($jmlRR == count($relR) and null == !($this->input->post('kode_proyek')) and $jmlRM == count($relM) and $jmlRR != 0 and $jmlRM != 0) {
            $this->hitungARP($this->input->post('kode_proyek'));
            $this->hitungETD($this->input->post('kode_proyek'));
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $data['ARP'] = $this->HOR_model->getARPafter($this->input->post('kode_proyek'));
        $data['ETD'] = $this->HOR_model->getMitigasiByETD($this->input->post('kode_proyek'));
        $this->load->view('manajemen/risiko_proyek', $data);
        $this->load->view('templates/footer');
    }
}
