<?php
session_start();

if(!isset($_SESSION['nama'])){
	header("Location: index.php");
}
$nama = $_SESSION['nama'];


if($nama === "admin"){
    header('Location: admin.php');
}


require 'Data/function.php';

if(isset($_POST['tambah_kegiatan'])){
    if(create($_POST) > 0){
        echo"<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
    <title>FrontEnd</title>
    <style>
        body{
            background-color:#d0e7d2;
        }
        a{
            text-decoration: none;
        }

        .mainNavbar {
        background-color: black; /* Ganti dengan warna latar belakang yang sesuai */
        box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.1); /* Atur bayangan sesuai preferensi Anda */
    }
        .card-body .option {
            float: right;
        }

        /* .login{
            background-color:antiquewhite;
        } */

        span{
            font-family: "Helvetica Neue",Helvetica;
            font-size: 24px;
        }

        .title1{
            background-color:#016A70;
            color:white;
        }

        .mainNavbar, .logoItem{
            color: white;
            background-color: #4682A9;
        }

        .logoItem img{
            border-radius: 50px;
        }

        .mainButton{
            background-color: #b3abab;
        }

        .text{
            background-color: white;
            border: none; 
            font-style:italic;
            text-decoration:underline;
            color:purple;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg mainNavbar">
        <div class="container">
            <a class="navbar-brand text-light" href=""><img src="img/calendar.png" alt="" width="46"> <span>WePlan</span></a>
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
                                <img src="img/kang.jpeg" width="40" id="user-image">
                                <b><?= $nama ?></b>
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
                            
                        <button type="button" class="btn btn-danger tombolTambahData" style="width: 55%;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-plus"></i> Buat Kegiatan
                        </button>
                        <button type="submit" id="semua" name="semua" class="btn btn-warning">Semua Kegiatan</button>
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
                                <?php if($nama == $data['username']):?>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <?= $data["isi_agenda"]; ?>
                                            <div class="option">
                                                <a href="/" data-id="<?= $data['id']?>" class="tampilModalUbah" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa-solid fa-pen-to-square"></i></a> |
                                                <!-- <a href="/" data-id="<?= $data['id']?>" class="tampilDataUser" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa-solid fa-circle-info"></i></a> | -->
                                                <a href="Data/selesai.php?id=<?= $data['id']; ?>" onclick="return confirm('Apakah kegiatan anda sudah selesai')"><i class="fa-solid fa-square-check"></i></a> 

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
                                <a href="?tanggal=<?=$tanggal_selanjutnya; ?>"><i class="fa-solid fa-chevron-left fa-rotate-180"> </i> </a>
                            </h2>
                            <div class="option mx-5">
                                <a href="?today" class="btn btn-secondary" >Today</a>
                            </div>
                        </div>
                    </div>

                    <?php $i = 1;?>
                    <?php foreach($hasil as $data): ?>  
                        <div class="card mt-3 mb-4">
                            <div class="card-header">
                                Dibuat oleh : 
                                <?php
                                    if($nama == $data['username']){
                                        echo "<b>Anda</b>";
                                    }else{
                                        echo $data['username'];
                                    }
                                ?>
                                <?php if($thasil) : ?>
                                    | <?= $data['tanggal'] ?> 
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $data['isi_agenda'];?></h5>
                                <p class="card-text"><?=  nl2br($data['rincian']);?></p>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="formModalLabel">Buat Kegiatan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="" method="POST">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="name" id="name">
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-label">Judul </div>
                            <input class="form-control" type="text" id="judul" name="judul_kegiatan" required autocomplete="off"><br>
                        </div>
                        <div class="form-group">
                        <div class="form-label">Deskripsi Kegiatan</div>
                            <textarea name="kegiatan" class="form-control" id="kegiatan" cols="30" rows="2" placeholder="Tidak wajib di isi"></textarea><br>
                        </div>
                        <div class="form-group">
                        <div class="form-label">Tanggal</div>
                            <input type="date" class="form-control" id="tanggal" name="tanggal_kegiatan" required autocomplete="off">
                        </div>
                            <input type="hidden" name="nama_user" value="<?= $nama?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary " name="tambah_kegiatan">Tambah</button>
                </div>
            </form>

        </div>
        </div>
    </div>

    <!-- <script src="js/scr.js"></script> -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scr.js"></script>
</body>
</html>