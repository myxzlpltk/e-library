<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
		if ($this->form_validation->run('login') == FALSE){
            if($this->session->userdata('id_user')){
                redirect('logout');
            }
            else{
    			$this->load->view('login');
            }
        }
        else{
        	$result = $this->crud->validate();
        	if($result){
                if($this->session->userdata('validated')){
            		$this->session->set_flashdata('success', 'Selamat Datang!');
                    if($this->session->userdata('rule')=='admin'){
                        redirect('admin');
                    }
                    else{
                        redirect($this->input->get('redirect'));
                    }
                }
                else{
                    redirect('verifikasi');
                }
        	}
        	else{
        		$this->session->set_flashdata('error', 'Username dan Password tidak cocok! Login Gagal!');
        		if($this->input->post('redirect')){
                    redirect('login?redirect='.$this->input->post('redirect'));
                }
                else{
                    redirect('login');	
                }
        	}
        }
	}

	public function logout(){
        if($this->session->userdata('id_user')){
            $this->event->log('logout', 'mengakhiri sesi');
        }
        $this->session->sess_destroy();
        redirect($this->input->get('redirect'));
    }
}
