<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('validated') || $this->session->userdata('rule')!='admin'){
			redirect('login');
		}
		$this->load->model('m_data');
	}
	
	public function index(){
		if($this->input->get('q')){
			$cari = $this->config->item('pencarian');
			$result = array_column($cari, 'name');
			$data['cari'] = array();
			foreach ($result as $key => $value) {
				similar_text(strtolower($value), strtolower($this->input->get('q')), $percent);
				if($percent > 50){
					array_push($data['cari'], $cari[$key]);
				}
			}
		}
		$data['notif']['jumlah_buku'] = $this->m_data->count_today('tanggal_unggah','buku');
		$data['notif']['jumlah_user'] = $this->m_data->count_today('tanggal_gabung','user');
		$data['notif']['jumlah_unduh'] = $this->m_data->count_today('waktu','log',array('aksi'=>'unduh'));
		$data['notif']['jumlah_sesi'] = $this->m_data->count_today('waktu','log',array('aksi'=>'login'));

		$data['buku_unduh'] = $this->m_data->get_unduh(null,5,true);
		$data['buku_baca'] = $this->m_data->get_baca(null,5,true);
		$this->event->view_admin('admin', $data);
	}
}
