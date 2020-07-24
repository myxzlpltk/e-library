<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('validated') || $this->session->userdata('rule')!='admin'){
			redirect('login');
		}
		$this->load->model('m_data');
	}

    public function index(){
        $this->event->view_admin('konfigurasi');
    }

    public function slider(){
        $data['slider'] = $this->m_data->get_slider()->result();
        $this->event->view_admin('slider', $data);
    }

    public function update_slider(){
        if($this->input->is_ajax_request()) {
            $data = $this->input->post('data');
            $ar = $this->crud->update_batch('id_slider',$data,'slider');
            $result = array(
                'status' => 'success',
                'affected_rows' => $ar
            );
            echo json_encode($result);
        }
        else{
            not_found();
        }
    }

    public function tambah_slider(){
        if($this->input->post('tipe_slider')){
            if(!empty($_FILES['file'])&&$this->input->post('tipe_slider')=='image'){
                $config = array(
                    'file_name' => "slider_".time(),
                    'upload_path' => './uploads/slider/',
                    'allowed_types' => 'gif|jpg|png',
                    'max_size' => 4096,
                );

                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('file')){
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                }
                else{
                    $gbr = $this->upload->data();
                    $data = array(
                        'file_slider' => $gbr['file_name'],
                        'urutan_slider' => '0',
                        'tipe_slider' => 'image'
                    );
                    $this->crud->input_data($data, 'slider');
                }
            }
            elseif($this->input->post('tipe_slider')=='video'&&!empty($this->input->post('url'))){
                $data = array(
                    'file_slider' => $this->input->post('url'),
                    'urutan_slider' => '0',
                    'tipe_slider' => 'video'
                );
                $this->crud->input_data($data, 'slider');
            }
            redirect('admin/konfigurasi/slider');
        }
        else{
            not_found();
        }
    }

    public function hapus_slider($id=null){
        if($this->input->is_ajax_request()){
            $where = array('id_slider' => $id);
            $data = $this->crud->get_where($where,'slider')->row();
            if($data){
                if(file_exists('./uploads/slider/'.$data->file_slider)&&$data->tipe_slider=='image'){
                    unlink('./uploads/slider/'.$data->file_slider);
                }
                $this->crud->hapus_data($where,'slider');
                echo json_encode($data);
            }
            else{
                not_found();
            }
        }
        else{
            not_found();
        }
    }
}