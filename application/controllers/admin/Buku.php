<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('validated') || $this->session->userdata('rule')!='admin'){
			redirect('login');
		}
		$this->load->model('m_data');
	}
	
	public function index(){
		$this->event->view_admin('buku');
	}

	public function get_data(){
		if($this->input->is_ajax_request()){
			$table = 'buku';
			$primaryKey = 'id_buku';
			$columns = array(
				array('db' => 'id_buku', 'dt' => 0),
				array(
					'db' => 'file_buku',
					'dt' => 1,
					'formatter' => function($d,$row){
						return '<img src="'.thumb($d).'" class="img-responsive center-block" style="max-height: 100px;">';
					}
				),
				array('db' => 'nama_buku', 'dt' => 2),
				array('db' => 'deskripsi_buku', 'dt' => 3),
				array(
					'db' => 'id_buku',
					'dt' => 4,
					'formatter' => function($d,$row){
						return '<a href="'.base_url('admin/buku/lihat/'.$d).'" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span></a>';
					}
				),
			);

			$sql_details = array(
				'user' => $this->db->username,
				'pass' => $this->db->password,
				'db'   => $this->db->database,
				'host' => $this->db->hostname
			);

			$this->load->library('ssp');

			echo json_encode(
				SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
			);
		}
		else{
			not_found();
		}
	}

	public function tambah($id=null){
		if ($this->form_validation->run('tambah_buku') == FALSE){
			$data['kategori'] = $this->crud->get('kategori')->result();
			$this->event->view_admin('tambah_buku', $data);
		}
		else{
			$img_cfg = array(
				'file_name' => "buku_".time(),
				'upload_path' => bookpath(),
	            'allowed_types' => 'gif|jpg|png',
	            'max_size' => 4096,
	        );
            $this->load->library('upload', $img_cfg);

            if(!$this->upload->do_upload('file')){
                $this->session->set_flashdata('error', $this->upload->display_errors());
            }
            else{
            	$gbr = $this->upload->data();

                $resize_cfg = array(
	                'image_library' => 'gd2',
					'source_image' => bookpath($gbr['file_name']),
					'maintain_ratio' => TRUE,
					'width' => 225,
					'height' => 300,
					'quality' => 50,
					'create_thumb' => TRUE,
				);
				$this->load->library('image_lib', $resize_cfg);

				if(!$this->image_lib->resize()){
                	$this->session->set_flashdata('error', $this->image_lib->display_errors());
                	unlink(bookpath($gbr['file_name']));
				}
				else{
					$pdf_cfg = array(
		            	'file_name' => 'buku_'.underscore(strtolower($this->input->post('nama_buku'))),
		            	'upload_path' => pdfpath(),
		            	'allowed_types' => 'pdf'
		            );
	            	$this->upload->initialize($pdf_cfg);

	            	if(!$this->upload->do_upload('pdf')){
	            		$this->session->set_flashdata('error', $this->upload->display_errors());
	            		unlink(bookpath($gbr['file_name']));
	            		unlink(bookpath(thumb_file($gbr['file_name'])));
	            	}
	            	else{
	            		$pdf = $this->upload->data();
	            		/* -- memasukkan data buku ke basis data -- */
						$data = array(
							'nama_buku' => $this->input->post('nama_buku'),
							'deskripsi_buku' => $this->input->post('deskripsi_buku'),
							'file_buku' => $gbr['file_name'],
							'file_pdf' => $pdf['file_name'],
							'id_user' => $this->session->userdata('id_user')
						);
						$id = $this->crud->input_data($data, 'buku');
	            		
	            		/* -- mengunggah lampiran buku folder uploads -- */
	            		$lampiran = $_FILES['lampiran'];
	            		if(!empty($lampiran)){
	            			if(!file_exists(lampiranpath($id))){
								mkdir(lampiranpath($id));
							}
		            		$lampiran_cfg = array(
		            			'upload_path' => lampiranpath($id),
		            			'allowed_types' => 'jpg|png|gif|pdf|docx|xlsx|pptx|doc|xls|ppt|mp4|mkv',
		            		);

		            		$this->upload->initialize($lampiran_cfg);
		            		foreach ($lampiran['name'] as $key => $file) {
		            			$_FILES['lmpr']['name'] = $lampiran['name'][$key];
		            			$_FILES['lmpr']['type'] = $lampiran['type'][$key];
		            			$_FILES['lmpr']['tmp_name'] = $lampiran['tmp_name'][$key];
		            			$_FILES['lmpr']['error'] = $lampiran['error'][$key];
		            			$_FILES['lmpr']['size'] = $lampiran['size'][$key];
		            			if($this->upload->do_upload('lmpr')){
		            				$lampiran_file = $this->upload->data();
		            				$lampiran_data[] = array(
		            					'id_buku' => $id,
		            					'file_lampiran' => $lampiran_file['file_name']
		            				);
		            			}
		            		}
		            		if(!empty($lampiran_data)){
		            			$this->crud->input_batch($lampiran_data, 'lampiran');
		            		}
		            	}

	            		/* -- memasukkan data kategori buku ke basis data -- */
						foreach ($this->input->post('kategori') as $key => $value) {
							$kategori[] = array('id_buku'=>$id,'id_kategori'=>$value);
						}
						$this->crud->input_batch($kategori, 'kategori_buku');

						$this->session->set_flashdata('success', 'Data buku berhasil ditambahkan!');
						$this->event->log('buku', 'menambah buku', 'Sebuah buku telah berhasil di tambahkan', '/buku/lihat/'.$id);
						redirect('admin/buku/lihat/'.$id);
					}
				}
            }
            redirect('admin/buku/tambah');
		}
	}

	public function lihat($id=null){
		$where = array('buku.id_buku'=>$id);
		$data['buku'] = $this->m_data->get_buku($where);
		if(count($data['buku']) == 1){
			$this->load->helper(array('file','number'));

			$data['buku'] = array_shift($data['buku']);
			$data['file'] = get_file_info(pdfpath($data['buku']['file_pdf']));
			$data['unduh'] = $this->m_data->get_unduh($where,null,true);
			$data['baca'] = $this->m_data->get_baca($where,null,true);
			$data['id'] = underscore($data['buku']['nama_buku']);
			$this->event->view_admin('lihat_buku', $data);
		}
		else{
			$this->session->set_flashdata('error', 'buku tidak dapat ditemukan');
			redirect('admin/buku');
		}
	}

	public function edit($id=null){
		if($this->form_validation->run('edit_buku') == FALSE){
			$where = array('buku.id_buku'=>$id);
			$data['buku'] = $this->m_data->get_buku($where);
			if(count($data['buku']) == 1){
				$data['buku'] = array_shift($data['buku']);
				$data['kategori'] = $this->crud->get('kategori')->result();
				$this->event->view_admin('edit_buku', $data);
			}
			else{
				redirect('admin/buku');
			}
		}
		else{
			$where = array('id_buku'=>$id);
			$data = array(
				'nama_buku' => $this->input->post('nama_buku'),
				'deskripsi_buku' => $this->input->post('deskripsi_buku')
			);
			foreach ($this->input->post('kategori') as $key => $value) {
				$kategori[] = array('id_buku'=>$id,'id_kategori'=>$value);
			}
			$this->crud->hapus_data($where, 'kategori_buku');
			$this->crud->update_data($where, $data, 'buku');
			$this->crud->input_batch($kategori, 'kategori_buku');
			$this->session->set_flashdata('success', 'Data buku berhasil diedit!');
			$this->event->log('buku', 'mengedit buku', 'Sebuah buku telah berhasil di diedit', '/buku/lihat/'.$id);
			redirect('admin/buku/lihat/'.$id);
		}
	}

	public function edit_sampul($id=null){
		$where = array('buku.id_buku'=>$id);
		$buku = $this->m_data->get_buku($where);
		if(count($buku) == 1){
			$buku = array_shift($buku);

			$img_cfg = array(
				'file_name' => "buku_".time(),
				'upload_path' => bookpath(),
	            'allowed_types' => 'gif|jpg|png',
	            'max_size' => 4096,
	        );

            $this->load->library('upload', $img_cfg);

            if(!$this->upload->do_upload('file')){
                $this->session->set_flashdata('error', $this->upload->display_errors());
            }
            else{
            	$gbr = $this->upload->data();

                $resize_cfg = array(
	                'image_library' => 'gd2',
					'source_image' => bookpath($gbr['file_name']),
					'maintain_ratio' => TRUE,
					'width' => 225,
					'height' => 300,
					'quality' => 50,
					'create_thumb' => TRUE,
				);
				$this->load->library('image_lib', $resize_cfg);

				if(!$this->image_lib->resize()){
                	$this->session->set_flashdata('error', $this->image_lib->display_errors());
                	unlink(bookpath($gbr['file_name']));
				}
				else{
					$data = array('file_buku' => $gbr['file_name']);
					$this->crud->update_data($where,$data,'buku');
					unlink(bookpath($buku['file_buku']));
					unlink(bookpath(thumb_file($buku['file_buku'])));
					$this->session->set_flashdata('success', 'Gambar preview buku berhasil diedit!');
					$this->event->log('buku', 'mengedit preview buku', 'Sebuah preview buku telah berhasil di diedit', '/buku/lihat/'.$id);
				}
			}
		}
		redirect('admin/buku/lihat/'.$id);
	}

	public function edit_berkas($id=null){
		$where = array('buku.id_buku'=>$id);
		$buku = $this->m_data->get_buku($where);
		if(count($buku) == 1){
			$buku = array_shift($buku);
			$config = array(
            	'file_name' => 'buku_'.underscore(strtolower($buku['nama_buku'].'.pdf')),
            	'upload_path' => pdfpath(),
            	'allowed_types' => 'pdf'
            );
        	$this->load->library('upload', $config);

        	if(!$this->upload->do_upload('pdf')){
        		$this->session->set_flashdata('error', $this->upload->display_errors());
        	}
        	else{
        		$pdf = $this->upload->data();
	        	unlink(pdfpath($buku['file_pdf']));
	        	rename(pdfpath($pdf['file_name']), pdfpath($buku['file_pdf']));
	        	$this->session->set_flashdata('success', 'Berkas buku berhasil diedit!');
				$this->event->log('buku', 'mengedit berkas buku', 'Sebuah berkas buku telah berhasil di diedit', '/buku/lihat/'.$id);
        	}
		}
		redirect('admin/buku/lihat/'.$id);
	}

	public function hapus($id=null){
		if($this->input->is_ajax_request()){
			$this->load->helper('file');
			$where = array('id_buku' => $id);
			$buku = $this->crud->get_where($where, 'buku')->row();
			if($buku){
				@ unlink(bookpath($buku->file_buku));
				@ unlink(pdfpath($buku->file_pdf));
				@ unlink(bookpath(thumb_file($buku->file_buku)));
				if(file_exists(lampiranpath($buku->id_buku))){
					delete_files(lampiranpath($buku->id_buku), TRUE);
					rmdir(lampiranpath($buku->id_buku));
				}
				$this->crud->hapus_data($where, 'buku');
				$this->crud->hapus_data($where, 'kategori_buku');
				$this->crud->hapus_data($where, 'lampiran');
				$this->crud->hapus_data(array('btn'=>'/buku/lihat/'.$id), 'log');
				$this->event->log('buku', 'menghapus buku', 'Buku berjudul '.$buku->nama_buku.' telah berhasil di hapus');
				echo json_encode(array('status'=>'success'));
			}
			else{
				not_found();
			}
		}
		else{
			not_found();
		}
	}

	public function unduh($id=null){
		$where = array('buku.id_buku' => $id);
		$buku = $this->m_data->get_buku($where);
		$diff = $this->m_data->get_diff($id)->row();
		if(count($buku) == 1){
			$buku = array_shift($buku);

			$this->load->library('zip');
			$file = 'buku_'.$id.'.zip';

			$this->zip->add_data('info_buku_'.$id.'.json', json_encode($buku));
			$import[0] = 'info_buku_'.$id.'.json';
			if(file_exists(pdfpath($buku['file_pdf']))){
				$this->zip->read_file(pdfpath($buku['file_pdf']));
				$import[1] = $buku['file_pdf'];
			}
			if(file_exists(bookpath($buku['file_buku']))){
				$this->zip->read_file(bookpath($buku['file_buku']));
				$import[2] = $buku['file_buku'];
			}
			if(file_exists(bookpath(thumb_file($buku['file_buku'])))){
				$this->zip->read_file(bookpath(thumb_file($buku['file_buku'])));
				$import[3] = thumb_file($buku['file_buku']);
			}
			$this->zip->add_dir('lampiran');
			$import[4] = array();
			foreach ($buku['lampiran'] as $value) {
				if(file_exists(lampiranpath($buku['id_buku'],$value->file_lampiran))){
					array_push($import[4], $value->file_lampiran);
					$this->zip->read_file(lampiranpath($buku['id_buku'],$value->file_lampiran), 'lampiran/'.$value->file_lampiran);
				}
			}
			if(is_null($diff) || $diff->diff > 360){
				$this->event->log('unduh', 'membackup buku', 'Sebuah buku telah berhasil di backup', '/buku/lihat/'.$id);
			}
			$this->zip->add_data('import.json', json_encode($import));
			$this->zip->download($file);
		}
		else{
			redirect('admin/buku');
		}
	}

	public function impor(){
		if(!($this->input->server('REQUEST_METHOD') == 'POST')){
			$this->event->view_admin('import_buku');
		}
		else{
			$img_cfg = array(
				'file_name' => "import_".time(),
				'upload_path' => zippath(),
	            'allowed_types' => 'zip',
	        );

            $this->load->library('upload', $img_cfg);

            if(!$this->upload->do_upload('berkas')){
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/buku/impor');
            }
            else{
            	$gbr = $this->upload->data();

				$zip = new ZipArchive;
				$full_path = zippath($gbr['file_name']);
		        if($zip->open($full_path) === TRUE){
		        	$import = json_decode($zip->getFromName('import.json'), TRUE);
		        	if(isset($import[0])){
		        		$buku = json_decode($zip->getFromName($import[0]));	
			        	$data = array(
							'nama_buku' => $buku->nama_buku,
							'deskripsi_buku' => $buku->deskripsi_buku,
							'file_buku' => $buku->file_buku,
							'file_pdf' => $buku->file_pdf,
							'id_user' => $this->session->userdata('id_user')
						);
						$id = $this->crud->input_data($data, 'buku');
						foreach ($buku->kategori as $key => $value) {
							$kategori[] = array('id_buku'=>$id,'id_kategori'=>$value->id);
						}
						$this->crud->input_batch($kategori, 'kategori_buku');
			        	if(isset($import[1])){
			        		$zip->extractTo(pdfpath(), $import[1]);
			        	}
			        	if(isset($import[2])){
			        		$zip->extractTo(bookpath(), $import[2]);
			        	}
			        	if(isset($import[3])){
			        		$zip->extractTo(bookpath(), $import[3]);
			        	}
			        	if(!empty($import[4])){
			        		mkdir(lampiranpath($id));
			        		foreach ($import[4] as $value) {
			        			$lampiran[] = array(
			        				'id_buku' => $id,
			        				'file_lampiran' => $value
			        			);
			        			$zip->extractTo(lampiranpath($id), 'lampiran/'.$value);
				        		rename(lampiranpath($id.'/lampiran', $value), lampiranpath($id,$value));
			        		}
			        		rmdir(lampiranpath($id.'/lampiran'));
			        		$this->crud->input_batch($lampiran, 'lampiran');
			        	}
		        	}
		            $zip->close();
		            unlink(zippath($gbr['file_name']));
		            $this->event->log('buku', 'menambah buku', 'Sebuah buku telah berhasil di tambahkan', '/buku/lihat/'.$id);
		            redirect('admin/buku/lihat/'.$id);
		        }
		        else{
                	$this->session->set_flashdata('error', 'Berkas tampaknya dapat di import');
		        	redirect('admin/buku/impor');
		        }
		    }
		}
	}

	public function tambah_lampiran($id=null){
		$where = array('id_buku' => $id);
		$data = $this->crud->get_where($where, 'buku')->row();
		$lampiran = $_FILES['lampiran'];
		if(!empty($data)&&!empty($lampiran)){
			if(!file_exists(lampiranpath($id))){
				mkdir(lampiranpath($id));
			}
    		$config = array(
    			'upload_path' => lampiranpath($id),
    			'allowed_types' => 'jpg|png|gif|pdf|docx|xlsx|pptx|doc|xls|ppt|mp4|mkv',
    		);

    		$this->load->library('upload', $config);
    		foreach ($lampiran['name'] as $key => $file) {
    			$_FILES['lmpr']['name'] = $lampiran['name'][$key];
    			$_FILES['lmpr']['type'] = $lampiran['type'][$key];
    			$_FILES['lmpr']['tmp_name'] = $lampiran['tmp_name'][$key];
    			$_FILES['lmpr']['error'] = $lampiran['error'][$key];
    			$_FILES['lmpr']['size'] = $lampiran['size'][$key];
    			if($this->upload->do_upload('lmpr')){
    				$lampiran_file = $this->upload->data();
    				$lampiran_data[] = array(
    					'id_buku' => $id,
    					'file_lampiran' => $lampiran_file['file_name']
    				);
    			}
    		}
    		if(!empty($lampiran_data)){
    			$this->crud->input_batch($lampiran_data, 'lampiran');
    		}
	    }
	    redirect('admin/buku/lihat/'.$id);
	}

	public function hapus_lampiran($id=null){
		$where = array('id_lampiran'=>$id);
		$data = $this->crud->get_where($where, 'lampiran')->row();
		if(!empty($data)){
			$this->crud->hapus_data($where, 'lampiran');
			@ unlink(lampiranpath($data->id_buku,$data->file_lampiran));
			redirect('admin/buku/lihat/'.$data->id_buku);
		}
		else{
			not_found();
		}
	}

	/* CALLBACK */

	function edit_buku($str){
		$where = array('nama_buku'=>$str);
		$data = $this->crud->get_where($where,'buku')->row();
		if($data->id_buku==$this->input->post('id_buku') || empty($data)){
			return true;
		}
		else{
			$this->form_validation->set_message('edit_buku', 'Nama buku telah dipakai.');
			return false;
		}
	}
}