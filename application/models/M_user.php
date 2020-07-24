<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    /* -- selecting log basic -- */
    function count_unduh($id=null){
        $this->db->where('MID(btn,13,LENGTH(btn))', $id);
        $this->db->from('log');
        return $this->db->count_all_results();
    }

    function get_buku($where=null,$limit=null,$bool=false){
        $cat = null;
        if(isset($where['kategori'])){
            $cat = $where['kategori'];
            unset($where['kategori']);
        }
        $this->db->select('*, buku.id_buku as id_buku');
        $this->db->join('kategori_buku','buku.id_buku = kategori_buku.id_buku','left');
        $this->db->where_in('kategori_buku.id_kategori',$cat);
        $this->db->group_by('buku.id_buku');
        $this->db->order_by('buku.id_buku', 'desc');
        $this->db->limit($limit);
        $result = $this->db->get_where('buku', $where)->result_array();
        foreach ($result as $key => $value) {
            $result[$key]['kategori'] = $this->db->select('kategori.id_kategori as id, nama_kategori as kategori')->join('kategori', 'kategori.id_kategori = kategori_buku.id_kategori')->where('id_buku',$value['id_buku'])->get('kategori_buku')->result();
            $result[$key]['lampiran'] = $this->db->select('file_lampiran as file')->where('id_buku',$value['id_buku'])->get('lampiran')->result();
        }
        return $result;
    }

    function get_diff($id=null){
        $this->db->select('EXTRACT(DAY_SECOND FROM TIMEDIFF(NOW(), waktu)) as diff');
        $this->db->where('aksi', 'unduh');
        $this->db->where('btn', '/buku/lihat/'.$id);
        $this->db->order_by('id_log', 'desc');
        $this->db->limit('1');
        return $this->db->get('log');
    }

    function get_verif($where=null,$limit=null){
        $this->db->select('verifikasi.*,user.nama_user,user.rule,user.email,user.username, EXTRACT(DAY_SECOND FROM TIMEDIFF(NOW(), expired)) as diff');
        $this->db->join('user', 'verifikasi.id_user = user.id_user');
        $this->db->order_by('id_verifikasi','desc');
        $this->db->limit($limit);
        return $this->db->get_where('verifikasi', $where);
    }

    function get_slider(){
        $this->db->order_by('urutan_slider');
        return $this->db->get('slider');
    }

    function get_search($str=null){
        if(!is_null($str)){
            $this->db->select('keyword as result');
            $this->db->group_by('keyword');
            $this->db->limit(3);
            $this->db->like('keyword',$str);
            $this->db->having('count(keyword) >', 5);
            return $this->db->get('cari')->result_array();
        }
        else{
            return array();
        }
    }

    function get_title($str=null){
        if(!is_null($str)){
            $this->db->select('nama_buku as result');
            $this->db->group_by('nama_buku');
            $this->db->limit(3);
            $this->db->like('nama_buku',$str);
            return $this->db->get('buku')->result_array();
        }
        else{
            return array();
        }
    }

    /* -- SECURE -- */

    function get_buku_user($where=null,$limit=null){
        $cat = null;
        if(isset($where['kategori'])){
            $cat = $where['kategori'];
            unset($where['kategori']);
        }
        $judul = null;
        if(isset($where['judul'])){
            $judul = $where['judul'];
            unset($where['judul']);
        }
        $this->db->select('buku.id_buku as id,nama_buku as judul,deskripsi_buku as deskripsi,file_buku as sampul');
        $this->db->join('kategori_buku','buku.id_buku = kategori_buku.id_buku','left');
        $this->db->join('kategori','kategori.id_kategori = kategori_buku.id_kategori','left');
        $this->db->where_in('nama_kategori',$cat);
        $this->db->like('nama_buku',$judul);
        if(isset($where['last'])){
        	$this->db->where('buku.id_buku < '.$where['last']);
        }
        $this->db->group_by('buku.id_buku');
        $this->db->order_by('buku.id_buku', 'desc');
        $this->db->limit($limit);
        return $this->db->get('buku')->result_array();
    }

    /* -- PROFIL -- */

    function get_log_unduh_buku($limit=null){
        $this->db->select('MAX(waktu) as waktu,id_buku,deskripsi_buku,nama_buku');
        $this->db->join('buku', 'buku.id_buku = MID(btn,13,LENGTH(btn))');
        $this->db->order_by('waktu','desc');
        $this->db->where('aksi','unduh');
        $this->db->like('btn','/buku/lihat/','after');
        $this->db->limit($limit);
        $this->db->group_by('id_buku');
        $this->db->where('log.id_user',$this->session->userdata('id_user'));
        $result = $this->db->get_where('log')->result_array();
        return $result;
    }

    function get_log_baca_buku($limit=null){
        $this->db->select('MAX(waktu) as waktu,id_buku,deskripsi_buku,nama_buku');
        $this->db->join('buku', 'buku.id_buku = MID(btn,13,LENGTH(btn))');
        $this->db->order_by('waktu','desc');
        $this->db->where('aksi','baca');
        $this->db->like('btn','/buku/lihat/','after');
        $this->db->limit($limit);
        $this->db->group_by('id_buku');
        $this->db->where('log.id_user',$this->session->userdata('id_user'));
        $result = $this->db->get_where('log')->result_array();
        return $result;
    }

}