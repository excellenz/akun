<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Upload File';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['file'] = $this->db->get_where('file', ['user_email' => $this->session->userdata('email')])->result_array();

		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('file', '','callback_file_check');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('manager/index', $data);
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
			redirect('manager/index');
		}
	}

}
