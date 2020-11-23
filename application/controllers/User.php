<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	
	public function index()
	{
		$data['title'] = 'My Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			// cek jika ada gambar (file) yang akan diupload
			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']      = '2048';
				$config['upload_path']   = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					// cek dulu gambar lamanya apakah default
					$old_image = $data['user']['image'];
					if ( $old_image != 'default.jpg') {
						// jika bukan, maka hapus saja agar tidak terjadi penumpukan file
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your profile has been updated!</div>');
			redirect('user');
		}
	}

	public function upload()
	{
		$data['title'] = 'Upload File';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['file'] = $this->db->get_where('file', ['user_email' => $this->session->userdata('email')])->result_array();

		$this->form_validation->set_rules('email', 'Email', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/upload-file', $data);
			$this->load->view('templates/footer');
		} else {
			
			$upload_file = $_FILES['file']['name'];
			$pecah = explode(".", $upload_file);
			$file_type = $pecah[1];

			if ($upload_file) {
				$config['allowed_types'] = 'doc|xls|ppt|docx|xlsx|pptx|pdf';
				$config['max_size']      = '5120';
				$config['upload_path']   = './assets/files/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')) {
					$name = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = [
				'date' => time(),
				'user_email' => $this->input->post('email'),
				'file_type' => $file_type,
				'name' => $name
			];

			$this->db->insert('file', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> File berhasil diupload!</div>');
			redirect('user/upload');
		}
	}

	public function hapusfile($id)
	{
		$file = $this->db->get_where('file', ['id' => $id])->row_array();
		$this->db->delete('file', ['id' => $id]);
		unlink(FCPATH . 'assets/files/' . $file['name']);
		redirect('user/upload');
	}
}