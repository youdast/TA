<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required' => 'Email harus diisi!',
			'valid_email' => 'Email ini tidak valid!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', [
			'required' => 'Password harus diisi!',
		]);
		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		//jika user ada
		if ($user) {
			//jika user aktif
			if ($user['status_aktif'] == 1) {
				//cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					// if ($user['role_id'] == 1) {
					// 	redirect('admin');
					// } else {
					// 	redirect('profil');
					// }
					switch ($user['role_id']) {
						case 1:
							redirect('profil');
							break;
						case 2:
							redirect('profil');
							break;
						case 3:
							redirect('profil');
							break;
						case 4:
							redirect('profil');
							break;
					}
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
			Password salah!
		  </div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
			Email belum aktif.
		  </div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
			Email belum pernah terdaftar.
		  </div>');
			redirect('auth');
		}
	}

	public function daftar()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Nama harus diisi!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'required' => 'Email harus diisi!',
			'is_unique' => 'Email ini sudah terdaftar!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
			'required' => 'Password harus diisi!',
			'matches' => 'Password harus sama!',
			'min_length' => 'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Daftar';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/daftar');
			$this->load->view('templates/auth_footer');
		} else {

			$data = [
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'foto' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'status_aktif' => 0,
				'tanggal_pembuatan' => time()
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
			Selamat, akun anda sudah dibuat. silahkan login
		  </div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
			Anda sudah logout.
		  </div>');
		redirect('auth');
	}

	public function blocked()
	{
		echo 'Access Blocked';
	}
}
