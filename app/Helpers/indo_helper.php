<?php

if (!function_exists('tgl_indo')) {
  function tgl_indo($tanggal){
        $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun
 
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  }
}


if (!function_exists('hari_ini')) {
    function hari_ini(){
    $hari = date ("D");
 
    switch($hari){
        case 'Sun':
            $hari_ini = "Minggu";
        break;
 
        case 'Mon':         
            $hari_ini = "Senin";
        break;
 
        case 'Tue':
            $hari_ini = "Selasa";
        break;
 
        case 'Wed':
            $hari_ini = "Rabu";
        break;
 
        case 'Thu':
            $hari_ini = "Kamis";
        break;
 
        case 'Fri':
            $hari_ini = "Jumat";
        break;
 
        case 'Sat':
            $hari_ini = "Sabtu";
        break;
        
        default:
            $hari_ini = "Tidak di ketahui";     
        break;
    }
 
    return "<b>" . $hari_ini . "</b>";
 
    }
}

function greeting() {
    date_default_timezone_set('Asia/Jakarta');
    $date = date ("G : i A");
    if ($date>=0 and $date<10) {
    echo "Selamat Pagi,";
    } else if ($date>=10 and $date<15) {
    echo "Selamat Siang,";
    } else if ($date>=15 and $date<18) {
    echo "Selamat Sore,";
    } else if ($date>=18 and $date<24) {
    echo "Selamat Malam,";
    }else echo "Waktu salah)";
}

function alp($number) {
    $number = intval($number);
    if ($number <= 0) {
       return '';
    }
    $alphabet = '';
    while($number != 0) {
       $p = ($number - 1) % 26;
       $number = intval(($number - $p) / 26);
       $alphabet = chr(65 + $p) . $alphabet;
   }
   return $alphabet;
  }