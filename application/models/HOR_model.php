<?php
/**
 * 
 */
class HOR_model extends CI_model
{
    public function getOccurence($kode_proyek)
    {
        // $kode_proyek = '001-0518-BAL';
        $this->db->select('occurence');
        $this->db->from('risk_agent');
        $this->db->where('kode_proyek', $kode_proyek);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSeverity($kode_proyek)
    {
        // $kode_proyek = '001-0518-BAL';
        $this->db->select('severity');
        $this->db->from('risk_event');
        $this->db->where('kode_proyek', $kode_proyek);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRelasiR($kode_proyek)
    {
        $this->db->select('nilai');
        $this->db->from('relasi_risiko');
        $this->db->where('kode_proyek', $kode_proyek);
        $this->db->group_by(array('kode_risk_agent', 'kode_risk_event'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getKodeRA($kode_proyek)
    {
        $this->db->select('kode_risk_agent');
        $this->db->from('risk_agent');
        $this->db->where('kode_proyek', $kode_proyek);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ubahDataARP($ARP, $kode_proyek, $kodeRA)
    {
        // $kode_RA = $this->getKodeRA($kode_proyek);
        // $kode_RA = array('A001', 'A002', 'A003', 'A004', 'A005', 'A006', 'A007', 'A008', 'A009', 'A010', 'A011', 'A012', 'A013', 'A014', 'A015', 'A016', 'A017', 'A018');
        $occ = $this->getOccurence($kode_proyek);
        for ($i = 0; $i < count($occ); $i++) {
            $data = array(
                'ARP' => $ARP[$i]
            );

            $this->db->where('kode_proyek', $kode_proyek);
            $this->db->where('kode_risk_agent', $kodeRA[$i]['kode_risk_agent']);
            $this->db->update('risk_agent', $data);
        }
    }

    public function getKodeProyek()
    {
        $this->db->distinct();
        $this->db->select('kode_proyek, nama_proyek');
        $this->db->from('proyek');
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

    public function getARP($kode_proyek)
    {
        $this->db->select('ARP');
        $this->db->from('risk_agent');
        $this->db->where('kode_proyek', $kode_proyek);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDifficulty($kode_proyek)
    {
        $this->db->select('difficulty');
        $this->db->from('mitigasi');
        $this->db->where('kode_proyek', $kode_proyek);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRelasiM($kode_proyek)
    {
        $this->db->select('nilai');
        $this->db->from('relasi_mitigasi');
        $this->db->where('kode_proyek', $kode_proyek);
        $this->db->group_by(array('kode_mitigasi', 'kode_risk_agent'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getKodeM($kode_proyek)
    {
        $this->db->select('kode_mitigasi');
        $this->db->from('mitigasi');
        $this->db->where('kode_proyek', $kode_proyek);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ubahDataETD($ETD, $kode_proyek, $kodeM)
    {
        // $kode_M = array('PA001', 'PA002', 'PA003', 'PA004', 'PA005', 'PA006', 'PA007', 'PA008', 'PA009', 'PA010', 'PA011', 'PA012', 'PA013', 'PA014');
        // $kode_proyek = '001-0518-BAL';
        $diff = $this->getDifficulty($kode_proyek);
        for ($i = 0; $i < count($diff); $i++) {
            $data = array(
                'ETD' => $ETD[$i]
            );

            $this->db->where('kode_proyek', $kode_proyek);
            $this->db->where('kode_mitigasi', $kodeM[$i]['kode_mitigasi']);
            $this->db->update('mitigasi', $data);
        }
    }

    public function getARPafter($kode_proyek)
    {
        $this->db->select('*');
        $this->db->from('risk_agent');
        $this->db->where('kode_proyek', $kode_proyek);
        $this->db->order_by('ARP', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMitigasiByETD($kode_proyek)
    {
        $this->db->select('*');
        $this->db->from('mitigasi');
        $this->db->where('kode_proyek', $kode_proyek);
        $this->db->where('ETD !=', 0);
        $this->db->order_by('ETD', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
