<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Candidate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Candidate_model');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	public function add()
	{
		$current_uri = $this->uri->uri_string();

		if (!$current_uri == 'candidate/add') {
			$this->session->set_flashdata('error', 'Candidate not found');
			redirect('dashboard');
		}

		$data['title'] = 'TrioLogic - Add Candidate';

		$this->load->view('admin/template/admin_header', $data);
		$this->load->view('admin/template/side_bar');
		$data['title_mode'] = 'Add Profile';
		$data['mode'] = 'add';
		$this->load->view('admin/candidate/candidate_form', $data);
		$this->load->view('admin/template/admin_footer');
	}

	public function edit($id)
	{
		if (!$this->Candidate_model->get_candidate_by_id($id)) {
			$this->session->set_flashdata('error', 'Candidate not found');
			redirect('dashboard');
		}

		$data['title'] = (isset($id)) ? 'TrioLogic - Edit Candidate' : 'TrioLogic - Add Candidate';

		$this->load->view('admin/template/admin_header', $data);
		$this->load->view('admin/template/side_bar');
		$data['title'] = (isset($id)) ? 'TrioLogic - Edit Candidate' : 'TrioLogic - Add Candidate';
		$data['title_mode'] = (isset($id)) ? 'Edit Profile' : 'Add Profile';
		$data['mode'] = (isset($id)) ? 'edit' : 'add';
		$data['data'] = $this->Candidate_model->get_candidate_by_id($id);
		$this->load->view('admin/candidate/candidate_form', $data);
		$this->load->view('admin/template/admin_footer');
	}

	public function submit_form()
	{
		$mode = $this->input->post('mode');
		$id = $this->input->post('id');

		if (!isset($mode) || ($mode !== 'add' && $mode !== 'edit')) {
			$this->session->set_flashdata('error', 'Invalid operation mode selected.');
			redirect('dashboard');
		}

		if ($mode === 'add') {
			$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('designation', 'Designation', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[candidates.email]|max_length[100]');
		} elseif ($mode === 'edit') {
			$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('designation', 'Designation', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check_unique[' . $id . ']|max_length[100]');
		}

		if ($this->form_validation->run() === FALSE) {

			$this->session->set_flashdata('error', validation_errors());
			if ($mode === 'edit' && $id) {
				redirect('candidate/edit/' . $id);
			} else {
				redirect('candidate/add');
			}
		} else {

			$data = array(
				'name' => $this->input->post('name', TRUE),
				'company_name' => $this->input->post('company_name', TRUE),
				'email' => $this->input->post('email', TRUE),
				'designation' => $this->input->post('designation', TRUE)
			);

			if ($mode === 'add') {
				$this->Candidate_model->insert_candidate($data); // Assuming a method like insert_candidate
				$this->session->set_flashdata('success', 'Candidate added successfully!');
			} elseif ($mode === 'edit') {
				if ($id) {
					$this->Candidate_model->update_candidate($id, $data); // Assuming a method like update_candidate
					$this->session->set_flashdata('success', 'Candidate updated successfully!');
				} else {
					$this->session->set_flashdata('error', 'Candidate ID missing for update.');
				}
			}
			redirect('dashboard');
		}
	}

	public function email_check_unique($email, $candidate_id)
	{
		if ($this->Candidate_model->is_email_unique_except_current($email, $candidate_id)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('email_check_unique', 'This email is already registered for another candidate.');
			return FALSE;
		}
	}

	public function get_all_candidates()
	{
		if (isset($_GET['search']['value'])) {
			$search = $_GET['search']['value'];
		} else {
			$search = '';
		}
		if (isset($_GET['length'])) {
			$limit = $_GET['length'];
		} elseif ($_GET['length'] == -1) {
			$limit = 1000;
		} else {
			$limit = 10;
		}
		if (isset($_GET['start'])) {
			$offset = $_GET['start'];
		} else {
			$offset = 0;
		}
		$orderType = $_GET['order'][0]['dir'];
		$nameOrder = $_GET['columns'][$_GET['order'][0]['column']]['name'];

		$records = $this->Candidate_model->get_candidate_data($limit, $search,  $offset, $nameOrder, $orderType);
		$data = array();
		$i = 0 + $offset;
		foreach ($records['data']  as $row) {
			$checkbox = '<input type="checkbox" class="row_checkbox" name="id[]" value="' . html_escape($row['id']) . '">';
			$btnEdit = '<a style="border: 1px solid" href="candidate/edit/' . $row['id'] . '" class="btn btn-default btn-sm" role="button">Edit</a>';
			$btnDelete = '<a href="candidate/delete/' . $row['id'] . '" class="btn btn-danger btn-sm" role="button">Delete</a>';
			$data[] = array(
				$row['id'] = $checkbox,
				$row['name'],
				$row['company_name'],
				$row['email'],
				$row['designation'],
				$row['button'] = $btnEdit . ' ' . $btnDelete
			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}

	public function delete($id)
	{
		if (!$this->Candidate_model->get_candidate_by_id($id)) {
			$this->session->set_flashdata('error', 'Candidate not found');
			redirect('dashboard');
		}

		if ($this->Candidate_model->delete_candidate_by_id($id)) {
			$this->session->set_flashdata('success', 'Candidate deleted successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete candidate. Please try again.');
		}
		redirect('dashboard');
	}

	public function bulk_delete()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ids = $this->input->post('id');

			if (!empty($ids) && is_array($ids)) {
				if ($this->Candidate_model->delete_candidates($ids)) {
					$this->session->set_flashdata('success', count($ids) . ' record(s) deleted successfully.');
				} else {
					$this->session->set_flashdata('error', 'Failed to delete records. Please try again.');
				}
			} else {
				$this->session->set_flashdata('error', 'No records selected for deletion.');
			}
		} else {
			$this->session->set_flashdata('error', 'Invalid request.');
		}

		redirect('dashboard');
	}
}
