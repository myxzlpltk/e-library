<?php

if (!function_exists('bulan')) {
    function bulan($bulan){
        switch ($bulan) {
            case 1:
                $bulan = " Januari ";
                break;
            case 2:
                $bulan = " Februari ";
                break;
            case 3:
                $bulan = " Maret ";
                break;
            case 4:
                $bulan = " April ";
                break;
            case 5:
                $bulan = " Mei ";
                break;
            case 6:
                $bulan = " Juni ";
                break;
            case 7:
                $bulan = " Juli ";
                break;
            case 8:
                $bulan = " Agustus ";
                break;
            case 9:
                $bulan = " September ";
                break;
            case 10:
                $bulan = " Oktober ";
                break;
            case 11:
                $bulan = " November ";
                break;
            case 12:
                $bulan = " Desember ";
                break;

            default:
                $bulan = Date('F');
                break;
        }
        return $bulan;
    }
}

if (!function_exists('hari')) {
    function hari($hari){
        switch ($hari) {
            case 1:
                $hari = "Senin, ";
                break;
            case 2:
                $hari = "Selasa, ";
                break;
            case 3:
                $hari = "Rabu, ";
                break;
            case 4:
                $hari = "Kamis, ";
                break;
            case 5:
                $hari = "Jum'at, ";
                break;
            case 6:
                $hari = "Sabtu, ";
                break;
            case 7:
                $hari = "Minggu, ";
                break;

            default:
                $bulan = Date('l');
                break;
        }
        return $hari;
    }
}

function fix_day($hari){
    switch ($hari) {
        case 0:
            return "Minggu";
            break;
        case 1:
            return "Senin";
            break;
        case 2:
            return "Selasa";
            break;
        case 3:
            return "Rabu";
            break;
        case 4:
            return "Kamis";
            break;
        case 5:
            return "Jum'at";
            break;
        case 6:
            return "Sabtu";
            break;

        default:
            return Date('l');
        break;
    }
}

function fix_date($date=null, $dt=false) {
    if($date!=null){
        $date = date_create($date);
        if($dt){
            return hari(date_format($date,"N")).date_format($date,"d").bulan(date_format($date,"m")).date_format($date,"Y").' Pukul '.date_format($date,"H:i").' WIB';
        }
        else{
            return date_format($date,"d").bulan(date_format($date,"m")).date_format($date,"Y");
        }
    }
    else{
        return 'Tidak Ada';
    }
}

function welcome(){
    $date = localtime(time(), true);
    $jam = $date['tm_hour'];

    if($jam <=4){
        return 'Selamat Malam';
    }
    elseif($jam <= 10){
        return 'Selamat Pagi';
    }
    elseif($jam <= 15){
        return 'Selamat Siang';
    }
    elseif($jam <= 18){
        return 'Selamat Sore';
    }
    elseif($jam <= 24){
        return 'Selamat Malam';
    }
    else{
        return 'Hai';
    }
}

function date_now(){
    $date = date("Y-m-d");
    return $date;
}

function add_month($date, $number=0){
    return date("Y-m-d", strtotime($number." month", strtotime($date)));
}

function jatuh_tempo($d=1){
    $time = strtotime(add_month(date_now(), 1));
    return date("Y-m-".$d, $time);
}