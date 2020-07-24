<?php

function flash(){
	$ci =& get_instance();
	if($ci->session->flashdata('success')){
		$success = '<div class="alert alert-success alert-dismissible" role="alert">';
		$success .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$success .= '<b>'.$ci->session->flashdata('success').'</b>';
		$success .= '</div>';
		echo $success;
	}
	if($ci->session->flashdata('error')){
		$error = '<div class="alert alert-danger alert-dismissible" role="alert">';
		$error .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$error .= '<b>'.$ci->session->flashdata('error').'</b>';
		$error .= '</div>';
		echo $error;
	}
}

function card_flash(){
	$ci =& get_instance();
	if($ci->session->flashdata('success')){
		$success = '<div class="card-alert card-panel green">';
		$success .= '<i class="white-text close material-icons right waves-effect waves-light circle">close</i>';
		$success .= '<span class="white-text">'.$ci->session->flashdata('success').'</span>';
		$success .= '</div>';
		echo $success;
	}
	if($ci->session->flashdata('error')){
		$error = '<div class="card-alert card-panel red">';
		$error .= '<i class="white-text close material-icons right waves-effect waves-light circle">close</i>';
		$error .= '<span class="white-text">'.$ci->session->flashdata('error').'</span>';
		$error .= '</div>';
		echo $error;
	}
}

function callout($tipe=null, $msg="Blank"){
	if($tipe=='danger'){
		echo '<div class="card-panel red waves-effect w-100"><span class="white-text"><i class="material-icons left">warning</i>'.$msg.'</span></div>';
	}
}