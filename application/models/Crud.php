<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model {
	
	function input_data($data,$table){
        $query = $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function input_batch($data,$table){
        $query = $this->db->insert_batch($table, $data);
        return $query;
    }

    function hapus_data($where,$table){
        $this->db->where($where);
        return $this->db->delete($table);
    }
 
    function update_data($where,$data,$table){
        $this->db->where($where);
        return $this->db->update($table,$data);
    }

    function update_batch($key,$data,$table){
        $this->db->update_batch($table, $data, $key);
        return $this->db->affected_rows();
    }

    function get($table){
        return $this->db->get($table);
    }

    function get_where($where, $table){
        return $this->db->get_where($table, $where);
    }
    function get_where_limit($limit,$where, $table){
        $this->db->limit($limit);
        return $this->db->get_where($table, $where);
    }

    function count($table, $where=null){
        if(!is_null($where)){
            $this->db->where($where);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    
	/* -- LOGIN -- */

	function validate(){
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        $this->db->or_where('username', $username);
        $this->db->or_where('email', $username);
        
        $user = $this->db->get('user')->row();
        if($user){
        	$bool = password_verify($password, $user->password);
            if($bool){
                $this->event->start_session($user);
                $this->event->log('login', 'memulai sesi');
            }
        	return $bool;
        }
        else{
        	return false;
        }
    }
}