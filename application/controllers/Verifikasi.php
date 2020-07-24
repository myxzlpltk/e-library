<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('m_user');
        $this->load->helper('surel');
    }

    public function index($id=null){
    	if($this->session->userdata('id_user')&&!$this->session->userdata('validated')){
            $where = array(
                'verifikasi.id_user' => $this->session->userdata('id_user'),
                'type' => 'register',
                'expired >= NOW()' => null,
                'status_verif' => null
            );
            $data = $this->m_user->get_verif($where,1)->row();
            if($data){
                redirect('verifikasi/lihat/'.encode_verif($data->id_verifikasi));
            }
            else{
                $this->event->entri_kode($this->session->userdata('id_user'),'register',$this->session->userdata('email'));
                redirect('profil');
            }
        }
        else{
            $this->session->set_flashdata('success', 'Akun sudah terverifikasi');
            redirect('profil');
        }
    }
    
    public function lihat($id=null){
    	if($this->form_validation->run('verifikasi') == FALSE){
            $where = array(
                'id_verifikasi' => decode_verif($id),
                'status_verif' => null,
                'expired >= NOW()' => null
            );
            $data['ver'] = $this->m_user->get_verif($where)->row();
            $data['id'] = $id;
            if($data['ver']){
                $this->load->view('verifikasi', $data);
            }
            else{
            	not_found();
            }
        }
        else{
        	$response = $this->input->post('g-recaptcha-response');
            $captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lclr1UUAAAAAIhUr5e8lPglPPZFuzqkTNHWVaP0&response=$response"));
            if($captcha->success){
                $where = array(
                    'id_verifikasi' => decode_verif($id),
                    'status_verif' => null,
                    'code' => $this->input->post('kode'),
                    'expired >= NOW()' => null
                );
                $data = $this->m_user->get_verif($where)->row();
                if($data){
                    $this->crud->update_data($where,array('status_verif'=>'1'),'verifikasi');
                    if($data->type=='register'){
                        $this->crud->update_data(array('id_user'=>$data->id_user),array('verifikasi_email'=>'1'),'user');
                        $this->load->view('verifikasi_sukses');
                    }
                    elseif($data->type=='forgot'){
                        $this->session->set_flashdata('success', 'Silahkan ganti kata sandi anda');
                        $this->session->set_tempdata('isAllowedToResetPassword',TRUE,300);
                        $this->session->set_tempdata('id_user_resetPass',$data->id_user,300);
                        redirect('lupa_kata_sandi/form');
                    }
                    else{
                        not_found();
                    }
                }
                else{
                    $this->session->set_flashdata('error','Kode verifikasi salah');
                    redirect('verifikasi/lihat/'.$id);
                }
            }
            else{
                $this->session->set_flashdata('error','reCAPCTCHA tidak valid');
                redirect('verifikasi/lihat/'.$id);
            }
        }
    }

    public function perbarui($id=null){
        $where = array(
            'id_verifikasi' => decode_verif($id),
            'expired >= NOW()' => null,
            'status_verif' => null
        );
        $data = $this->m_user->get_verif($where)->row();
        if($data){
            $this->event->entri_kode($data->id_user,$data->type,$data->email);
        }
        else{
            not_found();
        }
    }

}