<?php
/**
 * 
 */
class Relasi_Risiko_model extends CI_model
{
    public function getAllProyek()
    {
        return $this->db->get('proyek')->result_array();
    }
    public function getKodeProyek()
    {
        $this->db->distinct();
        $this->db->select('a.kode_proyek, p.nama_proyek');
        $this->db->from('proyek p');
        $this->db->join('relasi_risiko a', 'a.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllAgent()
    {
        $this->db->select('kode_risk_agent');
        $this->db->from('risk_agent');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllEvent()
    {
        $this->db->select('kode_risk_event');
        $this->db->from('risk_event');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAgent()
    {
        $this->db->distinct();
        $this->db->select('kode_risk_agent');
        $this->db->from('relasi_risiko');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getEvent()
    {
        $this->db->distinct();
        $this->db->select('kode_risk_event');
        $this->db->from('relasi_risiko');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getNilai()
    {
        $this->db->select('nilai');
        $this->db->from('relasi_risiko');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $this->db->group_by(array('kode_risk_event', 'kode_risk_agent'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllRelasiR()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_risk_agent, a.kode_risk_event, a.nilai');
        $this->db->from('proyek p');
        $this->db->join('relasi_risiko a', 'a.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataRelasiR()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_risk_agent, a.kode_risk_event, a.nilai');
        $this->db->from('proyek p');
        $this->db->join('relasi_risiko a', 'a.kode_proyek = p.kode_proyek');
        $this->db->where('a.kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahDefaultRR()
    {
        $agent = $this->getAllAgent();
        $event = $this->getAllEvent();
        $nilai = 0;
        for ($i = 0; $i < count($agent); $i++) {
            for ($j = 0; $j < count($event); $j++) {
                // echo $agent[$i]['kode_risk_agent'];
                // echo '<br>';
                // echo $event[$j]['kode_risk_event'];
                // echo '<br>';
                // echo $nilai;
                // echo '<hr>';
                $data = array(
                    'kode_proyek' => $this->input->post('kode_proyek', true),
                    'kode_risk_agent' => $agent[$i]['kode_risk_agent'],
                    'kode_risk_event' => $event[$j]['kode_risk_event'],
                    'nilai' => $nilai
                );
                $this->db->insert('relasi_risiko', $data);
            }
        }
    }

    public function tambahDataRR()
    {
        $data = array(
            'kode_proyek' => $this->input->post('kode_proyek', true),
            'kode_risk_agent' => $this->input->post('kode_risk_agent', true),
            'kode_risk_event' => $this->input->post('kode_risk_event', true),
            'nilai' => $this->input->post('nilai', true)
        );

        $this->db->insert('relasi_risiko', $data);
    }

    public function getDataUbahRR($kode1, $kode2, $kode3)
    {
        $this->db->select('*');
        $this->db->from('relasi_risiko');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_risk_agent', $kode2);
        $this->db->where('kode_risk_event', $kode3);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahDataRR()
    {
        $data = array(
            'kode_proyek' => $_POST['kode_proyek'],
            'kode_risk_agent' => $_POST['kode_risk_agent'],
            'kode_risk_event' => $_POST['kode_risk_event'],
            'nilai' => $_POST['nilai'],
        );

        $this->db->where('kode_proyek', $_POST['kode_proyek']);
        $this->db->where('kode_risk_agent', $_POST['kode_risk_agent']);
        $this->db->where('kode_risk_event', $_POST['kode_risk_event']);
        $this->db->update('relasi_risiko', $data);
    }
}
