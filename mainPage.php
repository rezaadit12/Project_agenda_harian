<?php
session_start();

require 'Data/data.php';


if(!isset($_SESSION['nama'])){
	header("Location: index.php");
}
$nama = $_SESSION['nama'];
$email = $_SESSION['email'];


if($nama === "Admin"){
    header('Location: admin.php');
}


// require 'Data/function.php';






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


// var_dump($tanggal_parts);
// die;
$tanggal_formatted = substr($tanggal_parts[2], 0, 2) . ' ' . $bulan[(int)$tanggal_parts[1]] . ' ' . $tanggal_parts[0];

// =====================================================================
$tanggal_sebelumnya = date('Y-m-d', strtotime($tanggal . ' -1 day'));
$tanggal_selanjutnya = date('Y-m-d', strtotime($tanggal . ' +1 day'));


// $user = read("SELECT * FROM debug_backend WHERE username = '$nama' ORDER BY id DESC");
$data_nama = read("SELECT * FROM debug_backend ORDER BY id DESC");



if (isset($_GET['today'])) {
    $tanggal = date('Y-m-d');

    $hasil = read("SELECT * FROM debug_backend WHERE date_format(tanggal, '%Y-%m-%d') = '$tanggal' ORDER BY id DESC");
}else if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];
    $hasil = read("SELECT * FROM debug_backend WHERE date_format(tanggal, '%Y-%m-%d') = '$tanggal' ORDER BY id DESC");
}
// else if(isset($_POST['saya'])){
//     $hasil = read("SELECT * FROM debug_backend WHERE username = '$nama' ORDER BY id DESC");
// }
else {
    $tanggal = date('Y-m-d'); 
    $hasil = read("SELECT * FROM debug_backend WHERE date_format(tanggal, '%Y-%m-%d') = '$tanggal' ORDER BY id DESC");
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




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_mainPage.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">

    <title>Agenda Harian | <?= $nama ?></title>

</head>
<style>
    body{
        background-color: #86C8BC;
    }
    .title1{
        background-color: #3876BF;
        color:white;
    }
</style>
<body>

    <nav class="navbar navbar-expand-lg mainNavbar">
        <div class="container">
            <a class="navbar-brand text-light" href="mainPage.php"><img src="img/calendar.png" alt="" width="46"> <span class="weland">Agenda Harian</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto">
                    <form class="d-flex" method="post">
                        
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="cari" required autocomplete="off">
                        </div>
                        <button name="kunci" type="submit" hidden></button>

                    </form>
                </div>
            </div>
            <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <button class="btn logoItem " data-bs-toggle="dropdown" aria-expanded="false">
                            <b style="margin-right:7px;"><?= $nama ?></b>

                            <img class="imgUser" src="img/photo-profile-default-circle.svg" width="40" id="user-image">
                            </button>
                            <ul class="dropdown-menu">
                            <li><p class="dropdown-item"><?= $nama; ?></p></li>
                            <li><a class="dropdown-item text-primary"  href="Data/logout.php">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-4">
                <div class="alert title1" role="alert">
                    <center>
                        <h4>Form Kegiatan</h4>
                    </center>
                </div>

                <div class="card mb-3 login" >
                    
                    <form action="" method="post">
                        <div class="card-body">
                            
                        <button type="button" class="btn btn-primary tombolTambahData" style="width: 55%;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-plus"></i> Buat Kegiatan
                        </button>
                        <button type="submit" id="semua" name="semua" class="btn btn-secondary">Semua Kegiatan</button>
                    </form>

                    <form action="" method="get">
                        <div class="form-group mt-4">
                            <div class="form-label">Cari Kegiatan :</div>
                            <input type="date" class="form-control" name="tanggal" id="selesai" required>
                        </div>
                        <div class="form-group mt-4">
                            <input type="submit" value="Tampilkan" class="btn btn-success w-100">
                        </div>
                    </form>

                    <div class="form-group mt-4">
                        <div class="form-label">
                        <form action="" method="post">


                            <button class="text" type="submit" name="myPlan">Kegiatan Saya :</button>                   
                        </form>
                        
                        </div>
                            <?php foreach($data_nama as $data): ?>
                                <?php if($nama == $data['username'] && $email == $data['email']):?>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <?= $data["isi_agenda"]; ?>
                                            <div class="option">
                                                <a href="/" data-id="<?= $data['id']?>" class="tampilModalUbah" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa-solid fa-pen-to-square"></i></a> |
                                                <!-- <a href="/" data-id="<?= $data['id']?>" class="tampilDataUser" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa-solid fa-circle-info"></i></a> | -->
                                                <!-- <a href="Data/selesai.php?id=<?= $data['id']; ?>" onclick="return confirm('Apakah kegiatan anda sudah selesai')"><i class="fa-solid fa-square-check"></i></a>  -->
                                                <a href="#" onclick="contoh()"><i class="fa-solid fa-square-check"></i></a> 

                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div id="calendar">
                    <div class="date" style="display: flex;">
                        <div class="div " style="display: flex;">
                            <h2>
                                <!-- ================= -->
                                <?= $tanggal_formatted ?> 
                                <!-- ================== -->
                                <a href="?tanggal=<?= $tanggal_sebelumnya; ?>"><i class="fa-solid fa-chevron-left mx-lg-3"></i></a> 
                                <a href="?tanggal=<?= $tanggal_selanjutnya; ?>"><i class="fa-solid fa-chevron-left fa-rotate-180"> </i> </a>
                            </h2>
                            <div class="option mx-5">
                                <a href="?today" class="btn btn-dark" >Today</a>
                            </div>
                        </div>
                    </div>

                    <?php $i = 1;?>
                    <?php foreach($hasil as $data): ?>  
                        <div class="card mt-3 mb-4">
                            <div class="card-header">
                                <i>
                                Dibuat oleh : 
                                <?php
                                
                                    if($nama == $data['username'] && $email == $data['email']){
                                        echo "<b>Anda</b>";
                                    }else{
                                        echo $data['username'];
                                    }
                                ?>
                                </i>
                                <?php if($thasil) : ?>
                                    | <?= $data['tanggal'] ?> 
                                <?php endif; ?>
                            </div>

                            <div class="card-body">
                                <?php if(strlen($data['gambar']) > 1):?>
                                    <img class="mb-1" src="img_user/<?= $data["gambar"]?>" width="400"><hr>
                                <?php endif;?>
                                
                                <h3 class="card-title"><?= $data['isi_agenda'];?></h3>
                                <p class="card-text"><?= nl2br($data['rincian']);?></p>
                            </div>
                        </div>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                    <?php if($null): ?>
                        <div class="card mt-5">
                            <div class="card-body">
                                <center>
                                    <h4>Tidak Ada Kegiatan</h4>
                                </center>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        

    <!-- Modal -->
    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="formModalLabel">Buat Kegiatan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">

            <!-- ====== type hidden ======= -->
                <input type="hidden"  name="gambarLama" id="gambarLama">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="name" id="name">
                <input type="hidden" name="nama_user" value="<?= $nama?>">
                <input type="hidden" name="email" value="<?= $email ?>">


                <div class="card-body">
                    <div class="form-group">
                        <div class="form-label"><b>Nama Kegiatan :</b></div>
                        <input class="form-control" type="text" id="judul" name="judul_kegiatan" required autocomplete="off"><br>
                    </div>
                    <div class="form-group">
                        <div class="form-label"><b>Upload gambar</b> (jika diperlukan) :</div>
                        <input class="form-control" type="file" name="gambar" id="gambar"><br>
                    </div>

                    <div class="form-group">
                        <div class="form-label"><b>Rincian :</b></div>
                        <textarea name="kegiatan" class="form-control" id="kegiatan" cols="30" rows="2" placeholder="(Tidak Wajib)"></textarea><br>
                    </div>
                    <div class="form-group">
                        <div class="form-label"><b>Tanggal :</b></div>
                        <input type="datetime-local" class="form-control" id="tanggal" name="tanggal_kegiatan" required autocomplete="off">
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary " name="tambah_kegiatan">Tambah</button>
                </div>
            </form>

        </div>
        </div>
    </div>

    <script src="js/script.js"></script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

        function contoh() {

            Swal.fire({
                title: 'Kamu yakin?',
                text: "Pastikan kegiatanmu sudah terselesaikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya yakin'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "Data/selesai.php?id=<?= $data['id']; ?>";

                    }
                })
        }
    </script>

</body>
</html>

<?php

if(isset($_POST['tambah_kegiatan'])){
    if(create($_POST) > 0){
        echo"<script>
        Swal.fire(
            'Berhasil',
            'kegiatan berhasil ditambahkan!',
            'success'
        ).then((result) => {
                    if (result) {
                        document.location.href = 'mainPage.php';
                    }
                });
            </script>";
    }else{
        echo"<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Terjadi kesalahan, coba lagi!'
          }).then((result) => {
                    if (result) {
                        document.location.href = 'mainPage.php';
                    }
                });
            </script>";
    }
}
?>

