<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

    /* -- selecting log basic -- */
    function get_log($where=null, $in=array(), $bool=false){
        if($bool){
            $this->db->select('log.*, user.nama_user, user.rule, count(log.id_user) as count');
            $this->db->group_by('log.id_user');
        }
        else{
            $this->db->select('log.*, user.nama_user, user.rule');
        }
        $this->db->join('user', 'log.id_user = user.id_user');
        $this->db->order_by('id_log', 'desc');
        $this->db->limit(25);
        foreach ($in as $key => $value) {
            $this->db->where_in($key, $value);
        }
        return $this->db->get_where('log', $where);
    }

    /* -- selecting basic with specially download buku -- */
    function get_unduh($where=null,$limit=null,$group=false){
        if($group){
            $this->db->select('log.*, user.*, buku.*, count(id_log) as jumlah');
            $this->db->group_by('btn');
            $this->db->order_by('jumlah','desc');
        }
        else{
            $this->db->select('log.*, user.*, buku.*');
            $this->db->order_by('id_log','desc');
        }
        $this->db->join('buku', 'buku.id_buku = MID(btn,13,LENGTH(btn))');
        $this->db->join('user', 'log.id_user = user.id_user');
        $this->db->where('aksi','unduh');
        $this->db->like('btn','/buku/lihat/','after');
        $this->db->limit($limit);
        $result = $this->db->get_where('log', $where)->result_array();
        return $result;
    }

    function get_baca($where=null,$limit=null,$group=false){
        if($group){
            $this->db->select('log.*, user.*, buku.*, count(id_log) as jumlah');
            $this->db->group_by('btn');
            $this->db->order_by('jumlah','desc');
        }
        else{
            $this->db->select('log.*, user.*, buku.*');
            $this->db->order_by('id_log','desc');
        }
        $this->db->join('buku', 'buku.id_buku = MID(btn,13,LENGTH(btn))');
        $this->db->join('user', 'log.id_user = user.id_user');
        $this->db->where('aksi','baca');
        $this->db->like('btn','/buku/lihat/','after');
        $this->db->limit($limit);
        $result = $this->db->get_where('log', $where)->result_array();
        return $result;
    }

    function get_kategori($where=null, $buku=false){
        $this->db->join('kategori_buku', 'kategori.id_kategori = kategori_buku.id_kategori', 'left');
        if ($buku) {
            $this->db->join('buku','kategori_buku.id_buku = buku.id_buku');
        }
        else{
            $this->db->select('kategori.*, count(kategori_buku.id_kategori) as jumlah_buku');
            $this->db->group_by('kategori.id_kategori');
        }
        $this->db->order_by('kategori.nama_kategori');
        return $this->db->get_where('kategori', $where);
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
            $result[$key]['lampiran'] = $this->db->where('id_buku',$value['id_buku'])->get('lampiran')->result();
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
        $this->db->order_by('id_slider','desc');
        return $this->db->get('slider');
    }

    /* -- CHART -- */

    function count_today($column=null,$table=null,$where=array()){
        $this->db->where("DATE_FORMAT(`$column`,'%Y-%m-%d') = CURDATE()");
        $this->db->where($where);
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    function search_chart(){
        $this->db->select("DATE_FORMAT(time,'%Y-%m-%d') as label,count(id_cari) as data");
        $this->db->group_by("label");
        $this->db->where('DATEDIFF(CURDATE(),time) < 20');
        $this->db->order_by('label', 'desc');
        return $this->db->get('cari');
    }

    function keyword_favorite($limit=null){
        $this->db->select('keyword, count(id_cari) as total');
        $this->db->group_by('keyword');
        $this->db->order_by('total', 'desc');
        $this->db->limit($limit);
        return $this->db->get('cari');
    }

    function chart_baca_unduh(){
        $this->db->select("DATE_FORMAT(waktu,'%w') as label, count(id_log) as data");
        $this->db->order_by('label');
        $this->db->group_by('label');
        $this->db->or_where('aksi', 'baca');
        $this->db->or_where('aksi', 'unduh');
        return $this->db->get('log');
    }

}
