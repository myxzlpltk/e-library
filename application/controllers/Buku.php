<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
	}

	public function index($id=null){
		$this->event->view('buku');
	}

	public function get_data(){
		if($this->input->is_ajax_request()) {
			$where = array();
			if($this->input->post('judul')){
				$where['judul'] = html_escape($this->input->post('judul'));
				if(empty($this->input->post('last_id'))){
					$cari = array('keyword'=>$this->input->post('judul'));
					$this->crud->input_data($cari,'cari');
				}
			}
			if($this->input->post('kategori')){
				$where['kategori'] = html_escape($this->input->post('kategori'));
			}
			if($this->input->post('last_id')){
				$where['last'] = html_escape(decode_verif($this->input->post('last_id')));
			}

			$buku = $this->m_user->get_buku_user($where,25);
			foreach ($buku as $key => $value) {
				$buku[$key]['id'] = underscore($value['judul']);
			}
			$data = array(
				'thumb' => base_url('buku/thumb/'),
				'kategori' => base_url('buku?kategori[]='),
				'lihat_buku' => base_url('buku/lihat/'),
				'buku' => $buku
			);
			if(isset($value)){
				$data['last'] = encode_verif($value['id']);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
		else{
			not_found();
		}
	}

	public function lihat($id=null){
		$data['id'] = $id;
		$where = array('buku.nama_buku' => humanize($id));
		$data['buku'] = $this->m_user->get_buku($where);
		if(count($data['buku']) == 1){
			$this->load->helper(array('file','number'));
			$data['buku'] = current($data['buku']);

			$data['file'] = get_file_info(pdfpath($data['buku']['file_pdf']));
			$data['unduh'] = $this->m_user->count_unduh($data['buku']['id_buku']);
			$this->event->view('lihat_buku', $data);
		}
		else{
			$this->session->set_flashdata('error','Buku tidak dapat ditemukan');
			redirect('buku');
		}
	}

	public function unduh($id=null){
		$data['id'] = $id;
		$where = array('buku.nama_buku' => humanize($id));
		$data = $this->crud->get_where($where, 'buku')->row();
		$diff = $this->m_user->get_diff($id_buku)->row();
		if($data && $this->session->userdata('id_user')){
			if($this->session->userdata('validated')){
				if(file_exists(pdfpath($data->file_pdf))){
					$this->load->helper('download');

					if(is_null($diff) || $diff->diff > 360){
						$this->event->log('unduh', 'mengunduh buku', 'Sebuah buku telah berhasil di unduh', '/buku/lihat/'.$data->id_buku);
					}
					force_download(pdfpath($data->file_pdf), NULL);
					exit;
				}
				else{
					$this->session->set_flashdata('error', 'File buku tidak ditemukan');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Kamu harus verifikasi email terlebih dahulu');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Kamu harus login terlebih dahulu');
		}
		redirect('buku/lihat/'.$id);
	}

	public function baca($id=null){
		$data['id'] = $id;
		$where = array('buku.nama_buku' => humanize($id));
		$data = $this->crud->get_where($where, 'buku')->row();
		if($data && $this->session->userdata('id_user')){
			if($this->session->userdata('validated')){
				if(file_exists(pdfpath($data->file_pdf))){
					$this->event->log('baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/'.$data->id_buku);
					$this->output->set_content_type('pdf');
					$this->output->set_output(file_get_contents(pdfpath($data->file_pdf)))->_display();
					exit;
				}
				else{
					$this->session->set_flashdata('error', 'File buku tidak ditemukan');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Kamu harus verifikasi email terlebih dahulu');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Kamu harus login terlebih dahulu');
		}
		redirect('buku/lihat/'.$id);
	}

	public function lampiran($id=null){
		$data['id'] = $id;
		$where = array('buku.nama_buku' => humanize($id));
		$buku = $this->crud->get_where($where, 'buku')->row();
		$data = $this->crud->get_where(array('id_buku'=>$buku->id_buku), 'lampiran')->result();
		if(!empty($data)){
			$this->load->library('zip');

			$file = 'lampiran_'.underscore(strtolower($buku->nama_buku)).'.zip';
			foreach ($data as $key => $value) {
				if(file_exists(lampiranpath($buku->id_buku,$value->file_lampiran))){
					$this->zip->read_file(lampiranpath($buku->id_buku,$value->file_lampiran));
				}
			}
			$this->zip->download($file);
		}
		else{
			not_found();
		}
	}

	public function thumb($img=null){
		if(file_exists(bookpath(thumb_file($img)))){
			$this->output->set_content_type('img')->set_output(file_get_contents(bookpath(thumb_file($img))))->_display();
		}
		else{
			$this->output->set_content_type('img')->set_output(file_get_contents('./assets/img/no-pict_thumb.jpg'))->_display();
		}
		exit;
	}
	
	public function cover($img=null){
		if(file_exists(bookpath($img))){
			$this->output->set_content_type('img')->set_output(file_get_contents(bookpath($img)))->_display();
		}
		else{
			$this->output->set_content_type('img')->set_output(file_get_contents('./assets/img/no-pict.jpg'))->_display();
		}
		exit;
	}

	public function autocomplete($str=null){
		if($this->input->is_ajax_request()){
			$cari = array_column($this->m_user->get_search($str),'result');
			$buku = array_column($this->m_user->get_title($str),'result');
			$data = array_merge($buku,$cari);
			asort($data);
			$data = array_fill_keys(array_values(array_unique($data)), null);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
		else{
			not_found();
		}
	}
}