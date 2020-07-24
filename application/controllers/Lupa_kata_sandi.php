<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lupa_kata_sandi extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('m_user');
        $this->load->helper('surel');
    }

    public function index(){
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('forgot_pass');
        }
        else{
            $response = $this->input->post('g-recaptcha-response');
            $captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lclr1UUAAAAAIhUr5e8lPglPPZFuzqkTNHWVaP0&response=$response"));
            if($captcha->success){
                $where = array(
                    'email' => html_escape($this->input->post('email'))
                );
                $data = $this->crud->get_where($where, 'user')->row();
                if($data){
                    $this->event->entri_kode($data->id_user,'forgot',$data->email);
                    redirect('lupa_kata_sandi');
                }
                else{
                    $this->session->set_flashdata('error', 'Akun dengan email tersebut tidak ditemukan');
                    redirect('lupa_kata_sandi');
                }
            }
            else{
                $this->session->set_flashdata('error','reCAPCTCHA tidak valid');
                redirect('verifikasi/lihat/'.$id);
            }
        }
    }

    function form(){
        if($this->session->tempdata('isAllowedToResetPassword')){
            if($this->form_validation->run('reset_password') == FALSE){
                $this->load->view('form_lupa_kata_sandi');
            }
            else{
                $response = $this->input->post('g-recaptcha-response');
                $captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lclr1UUAAAAAIhUr5e8lPglPPZFuzqkTNHWVaP0&response=$response"));
                if($captcha->success){
                    $where = array(
                        'id_user' => $this->session->tempdata('id_user_resetPass')
                    );
                    $data = array(
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
                    );
                    $this->crud->update_data($where,$data,'user');
                    $this->session->set_flashdata('success', 'Kata sandi berhasil di reset');
                    $this->session->unset_tempdata('isAllowedToResetPassword');
                    $this->session->unset_tempdata('id_user_resetPass');
                    redirect('login');
                }
                else{
                    $this->session->set_flashdata('error','reCAPCTCHA tidak valid');
                    redirect('verifikasi/form');
                }
            }
        }
        else{
            not_found();
        }
    }
}