<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_user_by_email($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));

		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return null;
	}
}
