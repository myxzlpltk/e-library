<?php

define('EVENT_VERSION', '1.0');

/**
* EVENT WHAT HAPPEN ON CONTROLLER
*/
class Event{

	protected $ci;

	public function __construct(){
		$this->ci =& get_instance();
	}

	function log($aksi='', $judul='', $keterangan='', $btn=''){
        $data = array(
            'id_user' => $this->ci->session->userdata('id_user'),
            'aksi' => $aksi,
            'judul' => $judul,
            'keterangan' => $keterangan,
            'btn' => $btn,
        );
        $this->ci->db->insert('log', $data);;
    }

    function entri_kode($id=null,$type=null,$to=null){
        $data = array(
            'code' => get_code(),
            'id_user' => $id,
            'type' => $type,
            'expired' => date_format(date_modify(date_create(),'+6 hours'),'Y-m-d H:i:s')
        );
        $this->ci->db->insert('verifikasi', $data);
        $id_verifikasi = $this->ci->db->insert_id();
        $id_secure = encode_verif($id_verifikasi);

        if($this->send_code($to,$data['code'],$id_secure,$type)){
            $where = array(
                'id_verifikasi !=' => $id_verifikasi,
                'id_user' => $id,
                'type' => $type,
                'status_verif' => null
            );
            $this->ci->db->where($where)->update('verifikasi',array('status_verif'=>2));
            
            $this->ci->session->set_flashdata('success', 'Silahkan buka email anda dan masukkan kode verifikasi.');
            redirect('verifikasi/lihat/'.$id_secure);
        }
        else{
            log_message('error','Email gagal dikirim');
            $w = array('id_verifikasi' => $id_verifikasi);
            $d = array('status_verif'=>'3');
            $this->ci->db->where($w)->update('verifikasi',$d);
            $this->ci->session->set_flashdata('error', 'Terjadi masalah! Kode verifikasi gagal dikirim coba lagi nanti');
        }
    }

    function send_code($to=null, $code=null, $verif=null, $type=null){
        $data = get_mail($to,$code,$verif,$type);

        $this->ci->load->library('email');

        $this->ci->email->from('noreplybappedatulungagung@gmail.com', 'E-Library BAPPEDA Tulungagung');
        $this->ci->email->to($to); 
        if($type=='register'){
            $this->ci->email->subject('Verifikasi Pendaftaran Anggota E-Library');
        }
        elseif($type=='forgot'){
            $this->ci->email->subject('Kode Verifikasi Lupa Password');
        }
        $this->ci->email->message($data); 
         
        return @$this->ci->email->send();
    }

    function start_session($user){
        $data = array(
            'id_user' => $user->id_user,
            'nama_user' => $user->nama_user,
            'username' => $user->username,
            'rule' => $user->rule,
            'email' => $user->email,
            'validated' => boolval($user->verifikasi_email),
        );
        $this->ci->session->set_userdata($data);
    }

    /*
     * VIEW LOADER
     */

    function view($file=null,$data=null){
        $data['_kategori'] = $this->ci->db->get('kategori')->result();
        $this->ci->load->view($file, $data);
    }

    function view_admin($file=null,$data=null){
        if($this->ci->uri->segment(1)){
            $data['breadcrumb'][0] = '<a href="'.base_url('admin').'"><i class="fa fa-home"></i> '.ucwords($this->ci->uri->segment(1)).'</a>';
        }
        if($this->ci->uri->segment(2)){
            $data['breadcrumb'][1] = dict_base($this->ci->uri->segment(2));
        }
        if($this->ci->uri->segment(3)){
            $data['breadcrumb'][2] = '<a href="'.base_url('admin/'.$this->ci->uri->slash_segment(3)).'">'.dict_segment($this->ci->uri->segment(3)).humanize(ucwords($this->ci->uri->segment(3))).'</a>';
        }
        if($this->ci->uri->segment(4)){
            $data['breadcrumb'][3] = '<a href="#"><div class="label label-primary">#'.humanize(ucwords($this->ci->uri->segment(4))).'</div></a>';
        }

        $data['_n'] = 'notifikasi';
        $this->ci->load->view('admin/'.$file, $data);
    }

}