<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Candidate_model extends CI_Model
{
	private $table = 'candidates';
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_candidate($data)
	{
		$this->db->insert($this->table, $data);
	}

	public function get_candidate_by_id($id)
	{
		$query = $this->db->get_where($this->table, array('id' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return null;
	}

	public function update_candidate($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}


	public function get_candidate_data($limit, $search, $ofset, $ordername, $ordertype)
	{
		$query1 = $this->db->get($this->table);
		$total = $query1->num_rows();

		if (!empty($search)) {
			$this->db->like('name', $search);
			$this->db->or_like('email', $search);
			$this->db->or_like('company_name', $search);
			$this->db->or_like('designation', $search);
		}

		$this->db->order_by($ordername, $ordertype);
		$this->db->limit($limit, $ofset);
		$query = $this->db->get($this->table);

		$totalRecord = $query->result_array();
		$filtered = $query->num_rows();


		return array("recordsTotal" => $filtered, "recordsFiltered" => $total, 'data' => $totalRecord);
	}

	public function delete_candidate_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function delete_candidates($ids)
	{
		if (!is_array($ids) || empty($ids)) {
			return FALSE;
		}
		$this->db->where_in('id', $ids);
		return $this->db->delete($this->table);
	}

	public function is_email_unique_except_current($email, $current_candidate_id)
	{
		$this->db->where('email', $email);
		$this->db->where('id !=', $current_candidate_id);
		$query = $this->db->get($this->table);
		return ($query->num_rows() == 0);
	}
}
