<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('dashboard');
		}
		$data['title'] = 'TrioLogic - Admin';
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/index');
		$this->load->view('admin/template/footer');
	}

	public function authenticate()
	{

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

		$this->form_validation->set_message('required', 'The {field} field is required.');
		$this->form_validation->set_message('valid_email', 'Please enter a valid {field} address.');
		$this->form_validation->set_message('min_length', 'The {field} must be at least {param} characters long.');

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('error', validation_errors());
			$this->index();
		} else {

			// $password = 'admin@admin.com';
			// $this->db->insert('users', array('email' => 'admin@admin.com', 'password' => password_hash($password, PASSWORD_DEFAULT)));

			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$user = $this->user_model->get_user_by_email($email);

			if ($user) {

				if (password_verify($password, $user->password)) {
					$sess_array = array(
						'id' => $user->id,
						'email' => $user->email,
						'logged_in' => TRUE
					);
					$this->session->set_userdata($sess_array);
					$this->session->set_flashdata('success', 'You have been successfully logged in!');
					redirect('dashboard');
				} else {

					$this->session->set_flashdata('error', 'Invalid Email or Password.');
					$this->index();
				}
			} else {

				$this->session->set_flashdata('error', 'Invalid Email or Password.');
				$this->index();
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', 'You have been successfully logged out.');
		redirect('login');
	}

	public function dashboard()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$data['user_email'] = $this->session->userdata('email');
		$this->load->view('dashboard_view', $data);
	}
}
