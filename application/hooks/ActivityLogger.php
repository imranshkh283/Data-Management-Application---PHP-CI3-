<?php
defined('BASEPATH') or exit('No direct script access allowed');

function activity_logger()
{
	$CI = &get_instance();

	if (!$CI->session->userdata('id')) {
		return;
	}

	$user   = $CI->session->userdata('id');
	$class  = $CI->router->fetch_class();
	$method = $CI->router->fetch_method();


	$CI->db->insert('activity_log', [
		'userId'      => $user,
		'action'    => "$class/$method",
		'timestamp' => date('Y-m-d H:i:s')
	]);
}
