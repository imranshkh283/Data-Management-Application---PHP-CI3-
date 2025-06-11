<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error extends CI_Controller
{

	public function page_missing()
	{
		// Optional: log the error or set custom data
		$data['title'] = "Page Not Found";

		$this->output->set_status_header('404'); // Set 404 status header
		$this->load->view('errors/custom_404', $data); // Load custom view
	}
}
