<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panduan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
	}

	public function index(){
		$this->event->view('panduan');
	}
}