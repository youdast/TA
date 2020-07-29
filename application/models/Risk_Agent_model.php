<?php
/**
 * 
 */
class Risk_Agent_model extends CI_model
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
        $this->db->join('risk_agent a', 'a.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllRiskAgent()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_risk_agent, a.risk_agent, a.occurence');
        $this->db->from('proyek p');
        $this->db->join('risk_agent a', 'a.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataRisk()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_risk_agent, a.risk_agent, a.occurence');
        $this->db->from('proyek p');
        $this->db->join('risk_agent a', 'a.kode_proyek = p.kode_proyek');
        $this->db->where('a.kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahDataRA()
    {
        $data = array(
            'kode_proyek' => $this->input->post('kode_proyek', true),
            'kode_risk_agent' => $this->input->post('kode_risk_agent', true),
            'risk_agent' => $this->input->post('risk_agent', true),
            'occurence' => $this->input->post('occurence', true)
        );

        $this->db->insert('risk_agent', $data);
    }

    public function getAllEvent()
    {
        $this->db->select('kode_risk_event');
        $this->db->from('risk_event');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahRelasiRR()
    {
        $event = $this->getAllEvent();
        $nilai = 0;
        for ($j = 0; $j < count($event); $j++) {
            $data = array(
                'kode_proyek' => $this->input->post('kode_proyek', true),
                'kode_risk_agent' => $this->input->post('kode_risk_agent', true),
                'kode_risk_event' => $event[$j]['kode_risk_event'],
                'nilai' => $nilai
            );
            $this->db->insert('relasi_risiko', $data);
        }
    }

    public function getAllMitigasi()
    {
        $this->db->select('kode_mitigasi');
        $this->db->from('mitigasi');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahRelasiRM()
    {
        $mitigasi = $this->getAllMitigasi();
        $nilai = 0;
        for ($j = 0; $j < count($mitigasi); $j++) {
            $data = array(
                'kode_proyek' => $this->input->post('kode_proyek', true),
                'kode_risk_agent' => $this->input->post('kode_risk_agent', true),
                'kode_mitigasi' => $mitigasi[$j]['kode_mitigasi'],
                'nilai' => $nilai
            );
            $this->db->insert('relasi_mitigasi', $data);
        }
    }
    public function hapusRelasiRM()
    {
        $mitigasi = $this->getAllMitigasi();
        for ($j = 0; $j < count($mitigasi); $j++) {
            $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
            $this->db->where('kode_risk_agent', $this->input->post('kode_risk_agent'));
            $this->db->where('kode_mitigasi', $mitigasi[$j]['kode_mitigasi']);
            $this->db->delete('relasi_mitigasi');
        }
    }
    public function hapusRelasiRR()
    {
        $event = $this->getAllEvent();
        for ($j = 0; $j < count($event); $j++) {
            $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
            $this->db->where('kode_risk_agent', $this->input->post('kode_risk_agent'));
            $this->db->where('kode_risk_event', $event[$j]['kode_risk_event']);
            $this->db->delete('relasi_risiko');
        }
    }

    public function hapusDataRA()
    {
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $this->db->where('kode_risk_agent', $this->input->post('kode_risk_agent'));
        $this->db->delete('risk_agent');
    }

    public function getDataUbahRA($kode1, $kode2)
    {
        $this->db->select('*');
        $this->db->from('risk_agent');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_risk_agent', $kode2);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getDataHapusRA($kode1, $kode2)
    {
        $this->db->select('*');
        $this->db->from('risk_agent');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_risk_agent', $kode2);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahDataRA()
    {
        $data = array(
            'kode_proyek' => $_POST['kode_proyek'],
            'kode_risk_agent' => $_POST['kode_risk_agent'],
            'risk_agent' => $_POST['risk_agent'],
            'occurence' => $_POST['occurence'],
        );

        $this->db->where('kode_proyek', $_POST['kode_proyek']);
        $this->db->where('kode_risk_agent', $_POST['kode_risk_agent']);
        $this->db->update('risk_agent', $data);
    }
}
