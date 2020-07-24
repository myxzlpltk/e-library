<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
	}

	public function index(){
		$where = array(
			'id_user' => $this->session->userdata('id_user')
		);
		$data['user'] = $this->crud->get_where($where, 'user')->row();
		if($data['user']){
			$data['unduh'] = $this->m_user->get_log_unduh_buku(5);
			$data['baca'] = $this->m_user->get_log_baca_buku(5);
			$this->event->view('profil', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Silahkan login terlebih dahulu');
			redirect('login');
		}
	}

	public function edit(){
		if($this->form_validation->run('edit_profil') == FALSE){
			$where = array('id_user' => $this->session->userdata('id_user'));
			$data['user'] = $this->crud->get_where($where, 'user')->row();
			if($data['user']){
				$this->event->view('edit_profil', $data);
			}
			else{
				$this->session->set_flashdata('error','Silahkan login terlebih dahulu');
				redirect('login');
			}
		}
		else{
			$where = array('id_user' => $this->session->userdata('id_user'));
			$data = array(
				'nama_user' => $this->input->post('nama_user'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
			);
			$this->crud->update_data($where,$data,'user');
			$this->session->set_flashdata('success','Edit data berhasil dilakukan');
			redirect('profil');
		}
	}

	public function ganti_password(){
		if($this->form_validation->run('ganti_password') == FALSE){
			$where = array('id_user' => $this->session->userdata('id_user'));
			$user = $this->crud->get_where($where, 'user')->row();
			if($user){
				$this->event->view('edit_password');
			}
			else{
				$this->session->set_flashdata('error','Silahkan login terlebih dahulu');
				redirect('login');
			}
		}
		else{
			$where = array('id_user' => $this->session->userdata('id_user'));
			$data = array('password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT));
			$this->crud->update_data($where,$data,'user');
			$this->session->set_flashdata('success','Password berhasil diganti');
			redirect('profil');
		}
	}

	/* -- PRIVATE HELPER -- */

	function username_edit($str=null){
		$where = array('username'=>$str);
		$data = $this->crud->get_where($where,'user')->num_rows();
		if($str==$this->session->userdata('username') || $data==0){
			return true;
		}
		else{
			$this->form_validation->set_message('username_edit', 'Username telah dipakai');
			return false;
		}
	}

	function email_edit($str){
		$where = array('email'=>$str);
		$data = $this->crud->get_where($where,'user')->num_rows();
		if($str==$this->session->userdata('email') || $data==0){
			return true;
		}
		else{
			$this->form_validation->set_message('email_edit', 'Email telah didaftarkan');
			return false;
		}
	}

	function old_password($str=null){
		$where = array('id_user'=>$this->session->userdata('id_user'));
		$data = $this->crud->get_where($where,'user')->row();
		if(password_verify($str, $data->password)){
			return true;
		}
		else{
			$this->form_validation->set_message('old_password', 'Password lama salah');
			return false;
		}
	}
}