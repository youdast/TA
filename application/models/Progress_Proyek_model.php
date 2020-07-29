<?php

/**
 * 
 */
class Progress_Proyek_model extends CI_model
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

    public function getPekerjaanByProy()
    {
        $this->db->select('a.kode_proyek, p.nama_proyek, a.kode_pekerjaan, a.nama_pekerjaan, a.bobot');
        $this->db->from('proyek p');
        $this->db->join('pekerjaan a', 'a.kode_proyek = p.kode_proyek');
        $this->db->where('a.kode_proyek', $this->input->post('kode_proyek'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahDataPP()
    {
        $pek = $this->getPekerjaanByProy();
        for ($i = 0; $i < count($pek); $i++) {
            $data = array(
                'kode_proyek' => $this->input->post('kode_proyek', true),
                'kode_pekerjaan' => $pek[$i]['kode_pekerjaan'],
                'tanggal' => $this->input->post('tanggal', true),
                'bobot_realisasi' => $this->input->post($i, true),
            );

            $this->db->insert('progress_pekerjaan', $data);
        }
    }

    public function getDataUbahPP($kode1, $kode2, $kode3)
    {
        $this->db->select('*');
        $this->db->from('progress_pekerjaan');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_pekerjaan', $kode2);
        $this->db->where('tanggal', $kode3);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahDataPP()
    {
        $data = array(
            'kode_proyek' => $_POST['kode_proyek'],
            'kode_pekerjaan' => $_POST['kode_pekerjaan'],
            'tanggal' => $_POST['tanggal'],
            'bobot_realisasi' => $_POST['bobot_realisasi'],
        );

        $this->db->where('kode_proyek', $_POST['kode_proyek']);
        $this->db->where('kode_pekerjaan', $_POST['kode_pekerjaan']);
        $this->db->where('tanggal', $_POST['tanggal']);
        $this->db->update('progress_pekerjaan', $data);
    }

    public function getDataHapusPP($kode1, $kode2, $kode3)
    {
        $this->db->select('*');
        $this->db->from('progress_pekerjaan');
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_pekerjaan', $kode2);
        $this->db->where('tanggal', $kode3);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function hapusDataPP()
    {
        $this->db->where('kode_proyek', $this->input->post('kode_proyek'));
        $this->db->where('kode_pekerjaan', $this->input->post('kode_pekerjaan'));
        $this->db->where('tanggal', $this->input->post('tanggal'));
        $this->db->delete('progress_pekerjaan');
    }

    public function updateFullProgress($kode1, $kode2, $kode3)
    {
        $data = array(
            'bobot_realisasi' => $kode3,
        );
        $this->db->where('kode_proyek', $kode1);
        $this->db->where('kode_pekerjaan', $kode2);
        $this->db->update('pekerjaan', $data);
    }

    public function getProgress()
    {
        $this->db->select('pp.tanggal, p.nama_proyek, pp.kode_pekerjaan, pk.nama_pekerjaan, pp.bobot_realisasi');
        $this->db->from('proyek p');
        $this->db->join('progress_pekerjaan pp', 'pp.kode_proyek = p.kode_proyek');
        $this->db->join('pekerjaan pk', 'pk.kode_pekerjaan = pp.kode_pekerjaan');
        $this->db->group_by(array('pp.kode_proyek', 'pp.kode_pekerjaan', 'pp.tanggal'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProgressByProy()
    {
        $this->db->select('pp.tanggal, p.nama_proyek, pp.kode_pekerjaan, pk.nama_pekerjaan, pp.bobot_realisasi');
        $this->db->from('proyek p');
        $this->db->join('progress_pekerjaan pp', 'pp.kode_proyek = p.kode_proyek');
        $this->db->join('pekerjaan pk', 'pk.kode_pekerjaan = pp.kode_pekerjaan');
        $this->db->where('pp.kode_proyek', $this->input->post('kode_proyek'));
        $this->db->group_by(array('pp.kode_pekerjaan', 'pp.tanggal'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getBobot($kode_proyek)
    {
        $this->db->select('bobot');
        $this->db->from('pekerjaan');
        $this->db->where('kode_proyek', $kode_proyek);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getBobotR($kode_proyek)
    {
        $this->db->select_max('tanggal');
        $this->db->from('progress_pekerjaan');
        $this->db->group_by('kode_pekerjaan');
        $subQuery =  $this->db->get_compiled_select();

        $this->db->select('bobot_realisasi');
        $this->db->from('progress_pekerjaan');
        $this->db->where('kode_proyek', $kode_proyek);
        // $this->db->where('`tanggal` NOT IN (SELECT MAX(tanggal) FROM `progress_pekerjaan` GROUP BY `kode_pekerjaan`)', NULL, FALSE);
        // $this->db->group_by('kode_pekerjaan');
        $this->db->where("`tanggal` IN ($subQuery)", NULL, FALSE);
        // $this->db->group_by('kode_pekerjaan');
        $query = $this->db->get();
        return $query->result_array();
    }


    // public function hapusDataProyek($kode_proyek)
    // {
    //     $this->db->where('kode_proyek', $kode_proyek);
    //     $this->db->delete('proyek');
    // }

    // public function getDataUbah($kode)
    // {
    //     return $this->db->get_where('proyek', ['kode_proyek' => $kode])->row_array();
    // }

    // public function ubahDataProyek()
    // {
    //     $data = array(
    //         'nama_proyek' => $_POST['nama_proyek'],
    //         'alamat_proyek' => $_POST['alamat_proyek'],
    //         'biaya_proyek' => $_POST['biaya_proyek'],
    //         'waktu_proyek' => $_POST['waktu_proyek'],
    //         'lama_proyek' => $_POST['lama_proyek'],
    //     );

    //     $this->db->where('kode_proyek', $_POST['kode_proyek']);
    //     $this->db->update('proyek', $data);
    // }
}
