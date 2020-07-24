<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('validated') || $this->session->userdata('rule')!='admin'){
			redirect('login');
		}
		$this->load->model('m_data');
	}

    public function index(){
        $data['kategori'] = $this->m_data->get_kategori()->result();
        $this->event->view_admin('kategori', $data);
    }

    public function lihat($id=null){
        $where = array('kategori.id_kategori'=>$id);
        $data['kategori'] = $this->crud->get_where($where,'kategori')->row();
        if($data['kategori']){
            $this->event->view_admin('lihat_kategori', $data);
        }
        else{
            $this->session->set_flashdata('error','Kategori tidak ditemukan');
            redirect('admin/kategori');
        }
    }

    public function get_data($id=null){
        if($this->input->is_ajax_request()&&!empty($id)){
            $table = 'kategori_buku';
            $primaryKey = 'id_kategori';
            $columns = array(
                array('db' => '`bk`.`id_buku`', 'dt' => 0, 'field' => 'id_buku'),
                array('db' => '`bk`.`nama_buku`', 'dt' => 1, 'field' => 'nama_buku'),
                array('db' => '`bk`.`deskripsi_buku`', 'dt' => 2, 'field' => 'deskripsi_buku'),
                array(
                    'db' => '`bk`.`tanggal_unggah`',
                    'dt' => 3,
                    'formatter' => function($d,$row){
                        return fix_date($d, true);
                    },
                    'field' => 'tanggal_unggah'
                ),
                array(
                    'db' => '`kb`.`id_kategori`',
                    'dt' => 4,
                    'formatter' => function($d,$row){
                        return '<a href="'.base_url('admin/buku/lihat/'.$d).'" class="btn btn-success btn-sm"><span class="fa fa-eye"></span></a>';
                    },
                    'field' => 'id_kategori'
                )
            );
            $joinQuery = "FROM `{$table}` AS `kb` INNER JOIN `kategori` as `k` ON (`k`.`id_kategori` = `kb`.`id_kategori`) INNER JOIN `buku` as `bk` ON (`bk`.`id_buku` = `kb`.`id_buku`)";
            $where = "`kb`.`id_kategori` = '$id'";

            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db'   => $this->db->database,
                'host' => $this->db->hostname
            );

            $this->load->library('mine/ssp');

            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery , $where )
            );
        }
        else{
            not_found();
        }
    }


    public function tambah(){
        if ($this->form_validation->run('tambah_kategori') == FALSE){
            $this->event->view_admin('tambah_kategori');
        }
        else{
            $data = array(
                'nama_kategori' => ucwords($this->input->post('nama_kategori'))
            );
            $id = $this->crud->input_data($data, 'kategori');
            $this->session->set_flashdata('success', 'Kategori baru berhasil ditambahkan!');
            $this->event->log('kategori', 'menambah kategori', 'Kategori '.$this->input->post('nama_kategori').' telah berhasil di tambahkan', '/kategori/lihat/'.$id);
            redirect('admin/kategori');
        }
    }

    public function edit($id=null){
        if($this->input->is_ajax_request()){
            $where = array('id_kategori' => $id);
            $data = array('nama_kategori' => $this->input->post('nama_kategori'));
            $this->crud->update_data($where,$data,'kategori');
            echo json_encode(array('status'=>'success'));
        }
        else{
            not_found();
        }
    }

    public function hapus($id=null){
        $where = array('id_kategori'=>$id);
        $data = $this->crud->get_where($where,'kategori')->row();
        if($data){
            $this->crud->hapus_data($where,'kategori');
            $this->crud->hapus_data($where,'kategori_buku');
            $this->crud->hapus_data(array('btn'=>'/kategori/lihat/'.$id), 'log');
            $this->event->log('kategori', 'menghapus kategori', 'Kategori '.$data->nama_kategori.' telah berhasil di hapus');
            $this->session->set_flashdata('success','Kategori '.$data->nama_kategori.' berhasil dihapus.');
        }
        else{
            $this->session->set_flashdata('error','Kategori tidak ditemukan');
        }
        redirect('admin/kategori');
    }
}