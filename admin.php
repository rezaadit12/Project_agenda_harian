<?php

session_start();
require 'Data/function.php';

$nama = $_SESSION['nama'];

if($nama !== "admin"){
    header('Location: mainPage.php');
}

if(isset($_POST['tambah_kegiatan'])){
    if(create($_POST) > 0){
        echo"<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'admin.php';
            </script>";
    }else{
        echo"<script>
                alert('Gagal, Coba lagi!');
                document.location.href = 'admin.php';
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
            background-color: #d0e7d2;  
        }
        span{
            font-family: "Helvetica Neue",Helvetica;
            font-size: 24px;
        }
    .navigation {
        display: flex;
        justify-content: space-between;
    }
    .mainNavbar {
        background-color: black; /* Ganti dengan warna latar belakang yang sesuai */
        box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.1); /* Atur bayangan sesuai preferensi Anda */
    }
    .mainNavbar, .logoItem{
            color: white;
            background-color: #4682A9;
        }

    .linkData {
        justify-content: space-between;

    }

    .today {
        margin-left: 100px;
    }

    .imgUser {
        border-radius: 50%;
    }

    .directionRow1 {
        font-size: 25px;
        margin-left:10px;

    }
    .directionRow2 {
        font-size: 25px;
    }

    a{
        text-decoration:none;
    }


    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg  mainNavbar">
        <div class="container">
            <a class="navbar-brand text-light" href=""><img src="img/calendar.png" alt="" width="46"> <span>WePlan</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto">
                    <form class="d-flex" method="post">


                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                name="cari" required autocomplete="off">
                        </div>
                        <button name="kunci" type="submit" hidden></button>

                    </form>

                    <form action="" method="post">
                        <div div class="today">
                            <a href="?today" class="btn btn-success">Today</a>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <button class="btn logoItem " data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="imgUser" src="img/kang.jpeg" width="40" id="user-image">
                                <b><?= $nama ?></b>

                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <p class="dropdown-item">Admin</p>
                                    
                                </li>
                                <li><a class="dropdown-item text-primary" href="Data/logout.php">Logout <i
                                            class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>



    <div class="container mt-5">
        
        <div class="navigation mb-4">
            <form action="" method="post">
                <button  type="button" class="btn btn-danger tombolTambahData"  data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button>
                <button type="submit" id="semua" name="semua" class="btn btn-warning">Semua Kegiatan</button>
            </form>

            <ul class="nav justify-content-center">
                <h2>
                    <!-- ================= -->
                    <?= $tanggal_formatted ?>
                    <!-- ================== -->
                    <a href="?tanggal=<?= $tanggal_sebelumnya; ?>"><i
                            class="fa-solid fa-chevron-left  directionRow1"></i></a>
                    <a href="?tanggal=<?= $tanggal_selanjutnya; ?>"><i
                            class="fa-solid fa-chevron-left fa-rotate-180 directionRow2"></i> </a>
                </h2>

            </ul>
            <form action="" method="get">
                <div class="searchData">
                    <div class="input-group">
                    <input type="date" class="form-control" name="tanggal" id="selesai" required>
                    <input type="submit" class="btn btn-primary" value="Cari">
                    </div>
                </div>
            </form>
        </div>

        <table class=" table table-responsive  table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Agenda</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($hasil as $dataUser): ?>
                <tr>
                    <td>
                        <?= $i ?>
                    </td>
                    <td>
                        <?= $dataUser['username']; ?>
                    </td>
                    <td>
                        <?= $dataUser['isi_agenda']; ?>
                    </td>
                    <td>
                        <?= $dataUser['tanggal'] ?>
                    </td>
                    <td width="250">

                        <a href="/" data-id="<?= $dataUser['id']?>" class="tampilModalUbahAdmin" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa-solid fa-pen-to-square"></i> Update</a> |
                        <a href="detail.php?id=<?= $dataUser['id']?>" class="link-warning"><i class="fa-solid fa-circle-info"></i> Detail</a> |
                        <a href="Data/selesai1.php?id=<?= $dataUser['id']; ?>" class="link-danger" onclick="return confirm('Yakin ingin menghapus kegitan?')"><i class="fa-solid fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
                <?php if($null): ?>
                    <tr>
                        <td colspan="5">
                            <center>
                                <h3 style="color:rgb(192, 188, 188);">Tidak ada kegiatan</h3>
                            </center>
                        </td>
                    </tr>
                <?php endif; ?>

            </tbody>
            <thead>
                <tr>
                    <td colspan="5" style="color:white;"><p></p></td>
                </tr>
            </thead>
        </table>

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
                            <textarea name="kegiatan" class="form-control" id="kegiatan" cols="30" rows="2"></textarea><br>
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



    <script src="js/scr.js"></script>
    <!-- <script src="script.js"></script> -->
    <script src="js/bootstrap.bundle.min.js"></script>



    
</body>
</html>