<?php

/**
 * 
 */
class Kelola_Pekerjaan_model extends CI_model
{

    public function getAllProyek()
    {
        return $this->db->get('proyek')->result_array();
    }


    public function getAllPekerjaan()
    {
        $this->db->select('p.kode_proyek, p.nama_proyek, a.kode_pekerjaan, a.nama_pekerjaan, a.bobot, a.bobot_realisasi');
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

    public function tambahDataPekerjaan()
    {
        $data = array(
            'kode_proyek' => $this->input->post('kode_proyek', true),
            'kode_pekerjaan' => $this->input->post('kode_pekerjaan', true),
            'nama_pekerjaan' => $this->input->post('nama_pekerjaan', true),
            'bobot' => $this->input->post('bobot', true),
        );

        $this->db->insert('pekerjaan', $data);
    }

    public function getDataModal($kode1, $kode2)
    {
        $this->db->select('*');
        $this->db->from('pekerjaan');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_pekerjaan', $kode2);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahDataPekerjaan()
    {
        $data = array(
            'nama_pekerjaan' => $_POST['nama_pekerjaan'],
            'bobot' => $_POST['bobot'],
        );

        $this->db->where('kode_proyek', $_POST['kode_proyek']);
        $this->db->where('kode_pekerjaan', $_POST['kode_pekerjaan']);
        $this->db->update('pekerjaan', $data);
    }

    public function hapusDataPK()
    {
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $this->db->where('kode_pekerjaan', $this->input->post('kode_pekerjaan'));
        $this->db->delete('pekerjaan');
    }
}
