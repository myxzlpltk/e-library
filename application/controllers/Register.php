<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('m_user');
        $this->load->helper('surel');
    }

	public function index(){
		if ($this->form_validation->run('register') == FALSE){
			$this->load->view('register');
        }
        else{
            $response = $this->input->post('g-recaptcha-response');
            $captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lclr1UUAAAAAIhUr5e8lPglPPZFuzqkTNHWVaP0&response=$response"));
            if($captcha->success){
            	$data = array(
                    'nama_user' => $this->input->post('nama_user'),
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'rule' => 'user'
                );
                $id = $this->crud->input_data($data, 'user');
                $this->event->entri_kode($id,'register',$data['email']);
                $this->ci->session->set_flashdata('error', 'Silahkan masuk untuk memulai sesi.');
                redirect('login');
            }
            else{
                $this->session->set_flashdata('error', 'reCAPTCHA tidak valid');
                redirect('register');
            }
        }
	}

}
