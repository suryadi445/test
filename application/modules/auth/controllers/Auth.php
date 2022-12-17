<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Login';
		$data['content'] = 'v_login';

		$this->load->view('base', $data);
	}

	public function registration()
	{
		$data['title'] = 'Registrasi';
		$data['content'] = 'v_registrasi';

		$this->load->view('base', $data);
	}

	public function process_regis()
	{
		$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]|max_length[255]|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[3]|max_length[255]');
		if ($this->form_validation->run() == true) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$data_user = array(
				'username' => $username,
				'password' => password_hash($password, PASSWORD_DEFAULT),
			);

			$this->db->insert('users', $data_user);

			$this->session->set_flashdata('success', 'Proses Pendaftaran User Berhasil');
			redirect('auth');
		} else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('auth/registration');
		}
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->db->get_where('users', array('username' => $username));
		if ($query->num_rows() > 0) {
			$data_user = $query->row();
			if (password_verify($password, $data_user->password)) {
				$this->session->set_flashdata('success', 'Proses Login Berhasil');
				$this->session->set_userdata('username', $username);
				redirect('product');
			} else {
				$this->session->set_flashdata('error', 'Password Anda Salah');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('error', 'Anda Belum Terdaftar');
			redirect('auth');
		}
	}
}