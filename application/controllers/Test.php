<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index(){
		$this->event->view('test');
	}

	public function run($i=null){
		$encrypt = encode_verif($i);
		$decrypt = decode_verif($encrypt);
		if($decrypt != $i){
			$output = array(
				'encrypt' => $encrypt,
				'decrypt' => $decrypt,
				'status' => 'error'
			);
		}
		else{
			$output = array(
				'encrypt' => $encrypt,
				'decrypt' => $decrypt,
				'status' => 'success'
			);
		}
		echo json_encode($output);
	}

}

/* End of file Test.php */
/* Location: ./application/controllers/Test.php */