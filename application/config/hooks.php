<?php
defined('BASEPATH') or exit('No direct script access allowed');

$hook['post_controller'][] = array(
	'class'    => '',
	'function' => 'activity_logger',
	'filename' => 'ActivityLogger.php',
	'filepath' => 'hooks'
);
