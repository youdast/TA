<?php

/**
 * 
 */
class Kelola_Proyek_model extends CI_model
{

    public function getAllProyek()
    {
        return $this->db->get('proyek')->result_array();
    }

    public function getRealisasi($kode_proyek)
    {
        $this->db->select('bobot_realisasi');
        $this->db->from('pekerjaan');
        $this->db->where('kode_proyek', $kode_proyek);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function updateStat($kode_proyek, $status)
    {
        $data = array(
            'status' => $status,
        );
        $this->db->where('kode_proyek', $kode_proyek);
        $this->db->update('proyek', $data);
    }

    public function tambahDataProyek()
    {

        $kode = $this->input->post('kode_proyek', true);
        $nama = substr($this->input->post('nama_proyek'), 0, 3);

        $tanggalm = $this->input->post('tanggal_mulai');
        $timem = strtotime($tanggalm);
        // $date1 = date('Y-m-d', $timem);
        $tanggals = $this->input->post('tanggal_selesai');
        $times = strtotime($tanggals);
        // $date2 = date('Y-m-d', $times);
        // $diff=date_diff($date1,$date2);
        $lama = $times - $timem;
        // echo $diff;
        // var_dump($date1);
        $hari_proyek = $lama / 60 / 60 / 24;
        if (($hari_proyek % 7) == 0) {
            $lama_proyek = $hari_proyek / 7;
        } else {
            $lama_proyek = ($hari_proyek / 7) + 1;
        }
        $data = array(
            'kode_proyek' => $kode . $nama,
            'nama_proyek' => $this->input->post('nama_proyek', true),
            'alamat_proyek' => $this->input->post('alamat_proyek', true),
            'biaya_proyek' => $this->input->post('biaya_proyek', true),
            // 'waktu_proyek' => $this->input->post('waktu_proyek', true),
            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'lama_proyek' => $lama_proyek,
            'status' => 'Belum Berlangsung',
        );

        $this->db->insert('proyek', $data);
    }

    public function hapusDataProyek()
    {
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $this->db->delete('proyek');
    }

    public function getDataHapusP($kode)
    {
        $this->db->select('*');
        $this->db->from('proyek');
        $this->db->where('kode_proyek', $kode);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getDataUbah($kode)
    {
        return $this->db->get_where('proyek', ['kode_proyek' => $kode])->row_array();
    }

    public function ubahDataProyek()
    {
        $data = array(
            'nama_proyek' => $_POST['nama_proyek'],
            'alamat_proyek' => $_POST['alamat_proyek'],
            'biaya_proyek' => $_POST['biaya_proyek'],
            'tanggal_mulai' => $_POST['tanggal_mulai'],
            'tanggal_selesai' => $_POST['tanggal_selesai'],
        );

        $this->db->where('kode_proyek', $_POST['kode_proyek']);
        $this->db->update('proyek', $data);
    }
}
