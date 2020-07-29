<?php
/**
 * 
 */
class Mitigasi_model extends CI_model
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
        $this->db->join('mitigasi a', 'a.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllMitigasi()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_mitigasi, a.mitigasi, a.difficulty');
        $this->db->from('proyek p');
        $this->db->join('mitigasi a', 'a.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataMitigasi()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_mitigasi, a.mitigasi, a.difficulty');
        $this->db->from('proyek p');
        $this->db->join('mitigasi a', 'a.kode_proyek = p.kode_proyek');
        $this->db->where('a.kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahDataM()
    {
        $data = array(
            'kode_proyek' => $this->input->post('kode_proyek', true),
            'kode_mitigasi' => $this->input->post('kode_mitigasi', true),
            'mitigasi' => $this->input->post('mitigasi', true),
            'difficulty' => $this->input->post('difficulty', true)
        );

        $this->db->insert('mitigasi', $data);
    }

    public function hapusDataM()
    {
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $this->db->where('kode_mitigasi', $this->input->post('kode_mitigasi'));
        $this->db->delete('mitigasi');
    }

    public function getDataUbahM($kode1, $kode2)
    {
        $this->db->select('*');
        $this->db->from('mitigasi');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_mitigasi', $kode2);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getDataHapusM($kode1, $kode2)
    {
        $this->db->select('*');
        $this->db->from('mitigasi');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_mitigasi', $kode2);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahDataM()
    {
        $data = array(
            'kode_proyek' => $_POST['kode_proyek'],
            'kode_mitigasi' => $_POST['kode_mitigasi'],
            'mitigasi' => $_POST['mitigasi'],
            'difficulty' => $_POST['difficulty'],
        );

        $this->db->where('kode_proyek', $_POST['kode_proyek']);
        $this->db->where('kode_mitigasi', $_POST['kode_mitigasi']);
        $this->db->update('mitigasi', $data);
    }
}
