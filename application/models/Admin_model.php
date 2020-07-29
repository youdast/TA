<?php

/**
 * 
 */
class Admin_model extends CI_model
{

    public function getAllUser()
    {
        return $this->db->get('user')->result_array();
    }

    public function tambahDataUser()
    {

        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'foto' => 'default.jpg',
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => $this->input->post('role_id'),
            'status_aktif' => 1,
            'tanggal_pembuatan' => time()
        ];

        $this->db->insert('user', $data);
    }

    public function hapusDataU()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('user');
    }


    public function getDataModal($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function ubahDataUser()
    {
        $data = array(
            'nama' => $_POST['nama'],
            'email' => $_POST['email'],
            'role_id' => $_POST['role_id'],
            'status_aktif' => $_POST['status_aktif'],
        );

        $this->db->where('id', $_POST['id']);
        $this->db->update('user', $data);
    }
}
