<?php


require 'data.php';



$bulan = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
];

if (isset($_GET['today'])) {
    $tanggal = date('Y-m-d'); 
}
else if (isset($_GET['tanggal'])) {
    if($_GET['tanggal'] == null){  
        echo "<script>
                alert('Input tanggal terlebih dahulu!');
                window.location.href= 'index.php';
            </script>";
    }else{
        $tanggal = $_GET['tanggal'];
    } 
}
else {
    $tanggal = date('Y-m-d'); 
}

$tanggal_parts = explode('-', $tanggal);
$tanggal_formatted = $tanggal_parts[2] . ' ' . $bulan[(int)$tanggal_parts[1]] . ' ' . $tanggal_parts[0];

// =====================================================================
$tanggal_sebelumnya = date('Y-m-d', strtotime($tanggal . ' -1 day'));
$tanggal_selanjutnya = date('Y-m-d', strtotime($tanggal . ' +1 day'));


// $user = read("SELECT * FROM debug_backend WHERE username = '$nama' ORDER BY id DESC");
$data_nama = read("SELECT * FROM debug_backend ORDER BY id DESC");


if (isset($_GET['today'])) {
    $tanggal = date('Y-m-d'); 
    $hasil = read("SELECT * FROM debug_backend WHERE tanggal = '$tanggal' ORDER BY id DESC");
}else if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];
    $hasil = read("SELECT * FROM debug_backend WHERE tanggal = '$tanggal' ORDER BY id DESC");
}
// else if(isset($_POST['saya'])){
//     $hasil = read("SELECT * FROM debug_backend WHERE username = '$nama' ORDER BY id DESC");
// }
else {
    $tanggal = date('Y-m-d'); 
    $hasil = read("SELECT * FROM debug_backend WHERE tanggal = '$tanggal' ORDER BY id DESC");
}

$null = false;
$thasil = false;

if(isset($_POST['semua'])){
    $tanggal_formatted = "Semua Kegiatan";
    $hasil = read("SELECT * FROM debug_backend ORDER BY id DESC");
    $thasil = true;
}else if(isset($_POST['myPlan'])){
    $thasil = true;
    $tanggal_formatted = "kegiatan saya";
    $hasil = read("SELECT * FROM debug_backend WHERE username = '$nama'AND email = '$email' ORDER BY id DESC");
    
}

if(isset($_POST["kunci"])){
    $tanggal_formatted = "Hasil pencarian";

    if($_POST['kunci'] == null){ 
        $hasil = cari($_POST["cari"]);
    }
}

if(count($hasil) === 0){
    $null = true;
}

$popUp = false;



// $result = 0;
// if (isset($_GET['result'])) {
//     $result =  $_GET['result'];
// }
?>
