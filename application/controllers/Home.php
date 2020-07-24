<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
	}

	public function index(){
		$data['slider'] = $this->m_user->get_slider()->result();
		$this->event->view('home', $data);
	}

	public function slider($img=null){
		if(file_exists(sliderpath($img))){
			$this->output->set_content_type('img')->set_output(file_get_contents(sliderpath($img)))->_display();
		}
		exit;
	}

}
