<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('validated') || $this->session->userdata('rule')!='admin'){
			redirect('login');
		}
		$this->load->model('m_data');
	}

    public function index(){
        $this->event->view_admin('laporan');
    }

    public function log(){
        $this->event->view_admin('laporan_log');
    }

    public function get_log(){
        if($this->input->is_ajax_request()){
            $where = array();
            if($this->input->post('last')){
                $where['id_log < '.$this->input->post('last')] = null;
            }
            if($this->input->post('first')){
                $where['id_log > '.$this->input->post('first')] = null;
            }
            $in = array(
                'aksi' => $this->input->post('aksi'),
                'rule' => $this->input->post('nama_rule')
            );
            $result = $this->m_data->get_log($where, $in)->result_array();
            echo json_encode($result);
        }
        else{
            not_found();
        }
    }

    public function kode(){
        $data['kode'] = array(
            $this->crud->count('verifikasi',array('status_verif'=>null)),
            $this->crud->count('verifikasi',array('status_verif'=>'1')),
            $this->crud->count('verifikasi',array('status_verif'=>'2')),
            $this->crud->count('verifikasi',array('status_verif'=>'3'))
        );
        $this->event->view_admin('laporan_kode', $data);
    }

    public function get_kode(){
        if($this->input->is_ajax_request()){
            $table = 'verifikasi';
            $primaryKey = 'id_verifikasi';
            $columns = array(
                array('db' => 'id_verifikasi', 'dt' => 0),
                array('db' => 'code', 'dt' => 1),
                array(
                    'db' => 'expired',
                    'dt' => 2,
                    'formatter' => function($d,$row){
                        return fix_date($d,true);
                    }
                ),
                array('db' => 'type', 'dt' => 3),
                array(
                    'db' => 'status_verif',
                    'dt' => 4,
                    'formatter' => function($d,$row){
                        if(is_null($d)){
                            return '<span class="label label-primary">Belum Diverifikasi</span>';
                        }
                        elseif($d=='1'){
                            return '<span class="label label-success">Terverifikasi</span>';
                        }
                        else{
                            return '<span class="label label-danger">Dibatalkan</span>';
                        }
                    }
                ),
                array(
                    'db' => 'id_user',
                    'dt' => 5,
                    'formatter' => function($d,$row){
                        return '<a href="'.base_url('admin/user/lihat/'.$d).'" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span></a>';
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

    public function pencarian(){
        $this->event->view_admin('laporan_pencarian');
    }

    public function get_pencarian(){
        if($this->input->is_ajax_request()){
            $table = 'cari';

            $primaryKey = 'id_cari';
            $columns = array(
                array('db' => '`id_cari`', 'dt' => 0, 'field' => 'id_cari'),
                array('db' => '`keyword`', 'dt' => 1, 'field' => 'keyword'),
                array(
                    'db' => 'COUNT(`keyword`)',
                    'dt' => 2,
                    'formatter' => function($d,$row){
                        return $d.' Kali';
                    },
                    'field' => 'id_cari'
                ),
            );
            $joinQuery = "FROM `{$table}`";

            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db'   => $this->db->database,
                'host' => $this->db->hostname
            );

            $this->load->library('mine/ssp');

            echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, '', 'keyword')
            );
        }
        else{
            not_found();
        }
    }

    public function error(){
        $this->load->helper('file');
        $data['logs'] = get_filenames('./application/logs/');
        unset($data['logs'][array_search("index.html",$data['logs'])]);
        $data['logs'] = array_reverse($data['logs']);
        $this->event->view_admin('laporan_error', $data);
    }

    public function get_error($file=null){
        if($this->input->is_ajax_request()){
            $this->load->helper('file');
            echo read_file('./application/logs/'.$file);
        }
        elseif($this->input->get('type') == 'download' && $file != null){
            $this->load->helper('download');;    
            force_download('./application/logs/'.$file, NULL);
            redirect('admin/laporan/error');
        }
        elseif($this->input->get('type') == 'delete' && $file != null){
            unlink('./application/logs/'.$file);
            redirect('admin/laporan/error');
        }
        else{
            not_found();
        }
    }

    public function statistik(){
        $data['cari'] = day_chart($this->m_data->search_chart()->result());
        $data['keyword'] = $this->m_data->keyword_favorite(15)->result();
        $data['aksi_minggu'] = $this->m_data->chart_baca_unduh()->result();
        $this->event->view_admin('statistik', $data);
    }

    public function ruang_unggahan(){
        $this->event->view_admin('ruang_unggahan');
    }

    public function get_ruang_unggahan($type=null){
        if($this->input->is_ajax_request()){
            function process($result){
                $total = 0;
                foreach($result as $key => $value){
                    $total += $value['size'];
                    $data['details'][] = array(
                        'nama' => $value['name'],
                        'ukuran' => byte_format($value['size']),
                        'tanggal' => fix_date(date('Y-m-d H:i:s',$value['date']), true),
                    );
                }
                $data['total'] = byte_format(array_sum(array_column($result, 'size')), 3);
                $data['total_asli'] = array_sum(array_column($result, 'size'));
                return $data;
            }

            switch ($type) {
                case 'gambar':
                    $this->load->helper(array('file','number'));
                    $data = get_dir_file_info(bookpath(), FALSE);
                    $data = process($data);
                    echo json_encode($data);
                    break;
                
                case 'pdf':
                    $this->load->helper(array('file','number'));
                    $data = get_dir_file_info(pdfpath(), FALSE);
                    $data = process($data);
                    echo json_encode($data);
                    break;
                
                
                case 'lampiran':
                    $this->load->helper(array('file','number'));
                    $data = get_dir_file_info(lampiranpath(), FALSE);
                    $data = process($data);
                    echo json_encode($data);
                    break;
                
                default:
                    show_404('show_404');
                    break;
            }
        }
        else{
            not_found();
        }
    }
}