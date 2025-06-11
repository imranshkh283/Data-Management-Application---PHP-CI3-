<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}
	public function index()
	{
		$data['title'] = 'TrioLogic - Dashboard';
		$this->load->view('admin/template/admin_header', $data);
		$this->load->view('admin/template/side_bar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/template/admin_footer');
	}


	public function bulk_insert()
	{
		for ($i = 1; $i <= 1000; $i++) {
			$this->db->insert('candidates', array('name' => 'Name ' . $i, 'company_name' => 'CompaName ' . $i, 'email' => 'email' . $i . '@gmail.com', 'designation' => 'Designation ' . $i));
		}

		$this->db->select('email');
		$this->db->from('users');
		$this->db->where('email', 'admin@admin.com');
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			$password = 'admin@admin.com';
			$this->db->insert('users', array('email' => 'admin@admin.com', 'password' => password_hash($password, PASSWORD_DEFAULT)));
		}
		echo 'Inserted';
	}
}
