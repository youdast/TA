<?php
/**
 * 
 */
class Risk_Event_model extends CI_model
{
    public function getAllProyek()
    {
        return $this->db->get('proyek')->result_array();
    }

    public function getKodeProyek()
    {
        $this->db->distinct();
        $this->db->select('r.kode_proyek, p.nama_proyek');
        $this->db->from('proyek p');
        $this->db->join('risk_event r', 'r.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllRiskEvent()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, r.kode_risk_event, r.risk_event, r.severity');
        $this->db->from('proyek p');
        $this->db->join('risk_event r', 'r.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataRisk()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, r.kode_risk_event, r.risk_event, r.severity');
        $this->db->from('proyek p');
        $this->db->join('risk_event r', 'r.kode_proyek = p.kode_proyek');
        $this->db->where('r.kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahDataRE()
    {
        $data = array(
            'kode_proyek' => $this->input->post('kode_proyek', true),
            'kode_risk_event' => $this->input->post('kode_risk_event', true),
            'risk_event' => $this->input->post('risk_event', true),
            'severity' => $this->input->post('severity', true)
        );

        $this->db->insert('risk_event', $data);
    }

    public function getAllAgent()
    {
        $this->db->select('kode_risk_agent');
        $this->db->from('risk_agent');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahRelasiRR()
    {
        $agent = $this->getAllAgent();
        $nilai = 0;
        for ($j = 0; $j < count($agent); $j++) {
            $data = array(
                'kode_proyek' => $this->input->post('kode_proyek', true),
                'kode_risk_event' => $this->input->post('kode_risk_event', true),
                'kode_risk_agent' => $agent[$j]['kode_risk_agent'],
                'nilai' => $nilai
            );
            $this->db->insert('relasi_risiko', $data);
        }
    }

    public function hapusDataRE()
    {
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $this->db->where('kode_risk_event', $this->input->post('kode_risk_event'));
        $this->db->delete('risk_event');
    }

    public function hapusRelasiRR()
    {
        $agent = $this->getAllAgent();
        for ($j = 0; $j < count($agent); $j++) {
            $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
            $this->db->where('kode_risk_event', $this->input->post('kode_risk_event'));
            $this->db->where('kode_risk_agent', $agent[$j]['kode_risk_agent']);
            $this->db->delete('relasi_risiko');
        }
    }

    public function getDataUbahRE($kode1, $kode2)
    {
        $this->db->select('*');
        $this->db->from('risk_event');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_risk_event', $kode2);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getDataHapusRE($kode1, $kode2)
    {
        $this->db->select('*');
        $this->db->from('risk_event');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_risk_event', $kode2);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahDataRE()
    {
        $data = array(
            'kode_proyek' => $_POST['kode_proyek'],
            'kode_risk_event' => $_POST['kode_risk_event'],
            'risk_event' => $_POST['risk_event'],
            'severity' => $_POST['severity'],
        );

        $this->db->where('kode_proyek', $_POST['kode_proyek']);
        $this->db->where('kode_risk_event', $_POST['kode_risk_event']);
        $this->db->update('risk_event', $data);
    }
}
