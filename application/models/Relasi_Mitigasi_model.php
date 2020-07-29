<?php
/**
 * 
 */
class Relasi_Mitigasi_model extends CI_model
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
        $this->db->join('relasi_mitigasi a', 'a.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAgent()
    {
        $this->db->distinct();
        $this->db->select('kode_risk_agent');
        $this->db->from('relasi_mitigasi');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getMitigasi()
    {
        $this->db->distinct();
        $this->db->select('kode_mitigasi');
        $this->db->from('relasi_mitigasi');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
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

    public function getAllMitigasi()
    {
        $this->db->select('kode_mitigasi');
        $this->db->from('mitigasi');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getNilai()
    {
        $this->db->select('nilai');
        $this->db->from('relasi_mitigasi');
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $this->db->group_by(array('kode_risk_agent', 'kode_mitigasi'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllRelasiM()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_mitigasi, a.kode_risk_agent, a.nilai');
        $this->db->from('proyek p');
        $this->db->join('relasi_mitigasi a', 'a.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataRelasiM()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_mitigasi, a.kode_risk_agent, a.nilai');
        $this->db->from('proyek p');
        $this->db->join('relasi_mitigasi a', 'a.kode_proyek = p.kode_proyek');
        $this->db->where('a.kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahDefaultRM()
    {
        $agent = $this->getAllAgent();
        $mitigasi = $this->getAllMitigasi();
        $nilai = 0;
        for ($i = 0; $i < count($agent); $i++) {
            for ($j = 0; $j < count($mitigasi); $j++) {
                // echo $agent[$i]['kode_risk_agent'];
                // echo '<br>';
                // echo $event[$j]['kode_risk_event'];
                // echo '<br>';
                // echo $nilai;
                // echo '<hr>';
                $data = array(
                    'kode_proyek' => $this->input->post('kode_proyek', true),
                    'kode_risk_agent' => $agent[$i]['kode_risk_agent'],
                    'kode_mitigasi' => $mitigasi[$j]['kode_mitigasi'],
                    'nilai' => $nilai
                );
                $this->db->insert('relasi_mitigasi', $data);
            }
        }
    }

    public function tambahDataRM()
    {
        $data = array(
            'kode_proyek' => $this->input->post('kode_proyek', true),
            'kode_mitigasi' => $this->input->post('kode_mitigasi', true),
            'kode_risk_agent' => $this->input->post('kode_risk_agent', true),
            'nilai' => $this->input->post('nilai', true)
        );

        $this->db->insert('relasi_mitigasi', $data);
    }

    public function getDataUbahRM($kode1, $kode2, $kode3)
    {
        $this->db->select('*');
        $this->db->from('relasi_mitigasi');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_mitigasi', $kode2);
        $this->db->where('kode_risk_agent', $kode3);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahDataRM()
    {
        $data = array(
            'kode_proyek' => $_POST['kode_proyek'],
            'kode_mitigasi' => $_POST['kode_mitigasi'],
            'kode_risk_agent' => $_POST['kode_risk_agent'],
            'nilai' => $_POST['nilai'],
        );

        $this->db->where('kode_proyek', $_POST['kode_proyek']);
        $this->db->where('kode_mitigasi', $_POST['kode_mitigasi']);
        $this->db->where('kode_risk_agent', $_POST['kode_risk_agent']);
        $this->db->update('relasi_mitigasi', $data);
    }
}
