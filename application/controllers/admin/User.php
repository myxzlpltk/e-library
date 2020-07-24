<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('validated') || $this->session->userdata('rule')!='admin'){
			redirect('login');
		}
		$this->load->model('m_data');
	}

	public function index(){
		$this->event->view_admin('user');
	}

	public function get_data(){
		if($this->input->is_ajax_request()){
			$table = 'user';
			$primaryKey = 'id_user';
			$columns = array(
				array('db' => 'id_user', 'dt' => 0),
				array('db' => 'nama_user', 'dt' => 1),
				array('db' => 'username', 'dt' => 2),
				array(
					'db' => 'rule',
					'dt' => 3,
					'formatter' => function($d,$row){
						return '<span class="btn bg-orange btn-sm">'.$d.'</span>';
					}
				),
				array(
					'db' => 'tanggal_gabung',
					'dt' => 4,
					'formatter' => function($d,$row){
						return fix_date($d,true);
					}
				),
				array(
					'db' => 'verifikasi_email',
					'dt' => 5,
					'formatter' => function($d,$row){
						if($d=='1'){
							return '<p class="text-center"><span class="fa fa-check-circle fa-2x text-primary" data-toggle="tooltip" title="Terverifikasi"></span></p>';
						}
						else{
							return '<p class="text-center"><span class="fa fa-check-circle fa-2x text-gray" data-toggle="tooltip" title="Belum Diverifikasi"></span></p>';
						}
					}
				),
				array(
					'db' => 'id_user',
					'dt' => 6,
					'formatter' => function($d,$row){
						return '<a href="'.base_url('admin/user/lihat/'.$d).'" class="btn btn-success btn-sm"><span class="fa fa-eye"></span></a>';
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
				SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
			);
		}
		else{
			not_found();
		}
	}

	public function lihat($id=null){
		$where = array('id_user' => $id);
		$data['user'] = $this->crud->get_where($where, 'user')->row();
		if($data['user']){
			$log = array('log.id_user' => $id);
			$data['unduh'] = $this->m_data->get_unduh($log,5,true);
			$data['baca'] = $this->m_data->get_baca($log,5,true);
			$this->event->view_admin('lihat_user', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Data user tidak ada!');
			redirect('admin/user');
		}
	}

	public function hapus($id=null){
		if($this->input->is_ajax_request()){
			$where = array('id_user' => $id);
			$user = $this->crud->get_where($where, 'user')->row();
			if($user){
				$this->crud->hapus_data($where,'user');
				$this->crud->hapus_data($where,'log');
				$this->crud->hapus_data($where,'verifikasi');
				$this->crud->hapus_data(array('btn'=>'/user/lihat/'.$id), 'log');
				$this->event->log('user', 'menghapus user', 'User bernama '.$user->nama_user.' telah berhasil di hapus');
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

	public function ganti($id=null){
		if($this->input->is_ajax_request()){
			$where = array('id_user' => $id);
			$user = $this->crud->get_where($where, 'user')->row();
			if($user){
				$data = array('password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT));
				$this->crud->update_data($where,$data,'user');
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

	public function get_user_log(){
        if($this->input->is_ajax_request()){
            $where = array();
            if($this->input->post('last')){
                $where['id_log < '.$this->input->post('last')] = null;
            }
            if($this->input->post('id_user')){
                $where['log.id_user'] = $this->input->post('id_user');
            }
            $result = $this->m_data->get_log($where)->result_array();
            echo json_encode($result);
        }
        else{
            not_found();
        }
    }
}