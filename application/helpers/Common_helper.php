<?php

function pr($data,$flag) {
	if($flag != 0) {
		echo "<pre>";print_r($data);exit();
	}
}

function is_login() {
	$CI =& get_instance();
	$session = $CI->session->userdata();
	if(!empty($session) && isset($session['user_id'])) {
		return true;
	}
	else {
		redirect(base_url());
	}
}

function is_not_login() {
	$CI =& get_instance();
	$session = $CI->session->userdata();
	if(!empty($session) && isset($session['user_id'])) {
		redirect(base_url().'dashboard');
	}
	else {
		return true;
	}
}