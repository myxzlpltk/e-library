<?php

/*
 * compile script tag automatically
 * using base url
 */

function script($url=null){
	if(!is_null($url)){
		return '<script src="'.base_url($url) .'" type="text/javascript"></script>';
	}
}

function cover($str){
	return base_url('buku/cover/'.$str);
}

function thumb($str){
	return base_url('buku/thumb/'.$str);
}

function thumb_file($str){
	$thumb = explode('.', $str);
	$thumb[count($thumb)-2] .= '_thumb';
	return implode('.', $thumb);
}

function has($id=null){
	if(!empty($id)){
		return 'error invalid';
	}
	else{
		return '';
	}
}

function dict_segment($value=null){
	if($value=='log'){
		return '<i class="fa fa-clock-o"></i> ';
	}
	elseif($value=='slider'){
		return '<i class="fa fa-photo"></i> ';
	}
	elseif($value=='error'){
		return '<i class="fa fa-warning"></i> ';
	}
	elseif($value=='kode'){
		return '<i class="fa fa-qrcode"></i> ';
	}
	elseif($value=='pencarian'){
		return '<i class="fa fa-search"></i> ';
	}
	elseif($value=='statistik'){
		return '<i class="fa fa-bar-chart"></i> ';
	}
	elseif($value=='ruang_unggahan'){
		return '<i class="fa fa-hdd-o"></i> ';
	}
	elseif($value=='impor'){
		return '<i class="fa fa-upload"></i> ';
	}
	elseif(substr($value, 0,4)=='edit'){
		return '<i class="fa fa-edit"></i> ';
	}
	elseif(substr($value, 0,6)=='tambah'){
		return '<i class="fa fa-plus"></i> ';
	}
	elseif(substr($value, 0,5)=='lihat'){
		return '<i class="fa fa-eye"></i>';
	}
	else{
		return null;
	}
}

function dict_base($value=null){
	if($value=='user'){
		return '<a href="'.base_url('admin/user').'"><i class="fa fa-users"></i>'.ucwords('Data User').'</a>';
	}
	elseif($value=='kategori'){
		return '<a href="'.base_url('admin/kategori').'"><i class="fa fa-tags"></i>'.ucwords('Data Kategori').'</a>';
	}
	elseif($value=='buku'){
		return '<a href="'.base_url('admin/buku').'"><i class="fa fa-book"></i>'.ucwords('Data Buku').'</a>';
	}
	elseif($value=='konfigurasi'){
		return '<a href="'.base_url('admin/konfigurasi').'"><i class="fa fa-cogs"></i>'.ucwords('Konfigurasi').'</a>';
	}
	elseif($value=='laporan'){
		return '<a href="'.base_url('admin/laporan').'"><i class="fa fa-line-chart"></i>'.ucwords('Laporan').'</a>';
	}
	else{
		return null;
	}
}

function dump($arr=null){
	echo "<pre>";
	var_dump($arr);
	echo "</pre>";
}

/*
 * PATH HELPER
 * this script used for compile
 * any relative path for non direct file
 */

function bookpath($str=null){
	return './uploads/buku/img/'.$str;
}

function pdfpath($str=null){
	return './uploads/buku/pdf/'.$str;
}

function sliderpath($str=null){
	return './uploads/slider/'.$str;
}

function zippath($str=null){
	$ci =& get_instance();
	return './uploads/zip/'.$str;
}

function lampiranpath($id=null,$str=null){
	return './uploads/lampiran/'.$id.'/'.$str;
}

/*
 *---------------------------------------------------------------
 * HARD SCRIPT
 *---------------------------------------------------------------
 *
 * If you want to change or rewrite code
 * make sure you have a backup and have
 * a smart mind to think about it
 */

function day_chart($array=null,$number=20){
	$now = date_now();
	for ($i=0; $i < $number; $i++) { 
		$data[$i]['label'] = date('Y-m-d', strtotime("-$i days"));
		$data[$i]['data'] = '0';
	}
	foreach ($array as $key => $value) {
		$date = date_create($value->label);
		$diff = date_diff($date,date_create());
		$index = $diff->format("%a");
		$data[$index]['data'] = $value->data;
	}
	return array_reverse($data);
}

function get_code($len=6){
	$str = 'AB1CD2EFG3HI4JKL5MN6OPQ7RS8TUV9WX0YZ';
	$str = str_shuffle($str);
    $arr = str_split($str);
    $result = '';
    for ($i=0; $i < $len; $i++) { 
        $result .= $arr[mt_rand(0,35)];
    }
    return $result;
}

function flip_number($str){
	$data = str_split('QPWOEIRUTY');
	if(empty(intval($str))){
		$data = array_flip($data);
	}
	$str = str_split($str);
	$result = '';
	foreach ($str as $key) {
		$result .= @$data[$key];
	}
	return $result;
}

function rand_num($len=4){
	$exp = pow(10, $len);
	$min = $exp*0.1;
	$max = $exp-1;
    return mt_rand($min,$max);
}

function encode_verif($str=null){
	if(!empty(intval($str))){
		$len = mt_rand(1,5);

		$key = rand_num($len);
		$lock = flip_number($key);

		$str = flip_number($str);
		$str = $str.$lock;

		$str = strrev(get_code(6).$str);
		$str = str_rot13($str);
		$str = base64_encode($str);
		$str = flip_number($len).$str;
		return urlencode($str);
	}
}

function decode_verif($str){
	if($str = strval($str)){
		$str = urldecode($str);

		$len = substr($str, 0, 1);
		$str = substr($str, 1);
		$len = flip_number($len);

		$str = base64_decode($str);
		$str = str_rot13($str);
		$str = strrev($str);
		$str = substr($str,6);

		$lock = substr($str, strlen($str)-$len);
		$key = flip_number($lock);
		$str = substr($str, 0, strlen($str)-$len);

		$str = flip_number($str);
		if(!empty(intval($str))){
			return $str;
		}
	}
}

function not_found(){
	$ci =& get_instance();
	$ci->output->set_status_header(404);
	$ci->load->view('error_404');
	echo $ci->output->get_output();
	exit(4);
}