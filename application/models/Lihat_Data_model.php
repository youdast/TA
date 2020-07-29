<?php

/**
 * 
 */
class Lihat_Data_model extends CI_model
{

    public function getAllProyek()
    {
        return $this->db->get('proyek')->result_array();
    }

    public function getAllPekerjaan()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_pekerjaan, a.nama_pekerjaan, a.bobot');
        $this->db->from('proyek p');
        $this->db->join('pekerjaan a', 'a.kode_proyek = p.kode_proyek');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPekerjaan()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_pekerjaan, a.nama_pekerjaan, a.bobot, a.bobot_realisasi');
        $this->db->from('proyek p');
        $this->db->join('pekerjaan a', 'a.kode_proyek = p.kode_proyek');
        $this->db->where('a.kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }
}
