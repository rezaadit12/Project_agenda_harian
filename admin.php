<?php

session_start();
require 'Data/function.php';

$nama = $_SESSION['nama'];
$email = $_SESSION['email'];

if(isset($_GET['tanggal'])){
    $tanggal = $_GET['tanggal'];

}

if($nama !== "Admin"){
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


if(isset($_GET['tanggal'])){
    $result = "tanggal= $tanggal ";
}else if(isset($_GET['today'])){
    $result = 'today';
}else{
    $result = "tanggal=".date('Y-m-d');
}

if(isset($_POST['semua'])){
    unset($_GET['today']);
    unset($_GET['tanggal']);
    $result = 'all=plan';
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
    <link rel="stylesheet" type="text/css" href="css/style_admin.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <title>Admin WePlan</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg  mainNavbar">
        <div class="container">
            <a class="navbar-brand text-light" href="admin.php"><img src="img/calendar.png" alt="" width="46"> <span>WePlan</span></a>
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
                            <a href="?today" name="today" class="btn btn-success">Today</a>
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
                            <button class="btn logoItem " data-bs-toggle="dropdown" aria-expanded="false">
                            <b style="margin-right:7px;"><?= $nama ?></b>

                            <img class="imgUser" src="img/photo-profile-default-circle.svg" width="40" id="user-image">
                            </button>
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
    <div class="container mt-5  mb-4">
        <div class="navigation mb-4">
            <form action="" method="post">
                <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Opsi 
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="register.php">Tambah User</a></li>
                        <li><a class="dropdown-item" href="DataUser.php">Lihat data user</a></li>
                        <li><a class="dropdown-item" href="DataAdmin.php">Lihat data admin</a></li>
                        <li><a class="dropdown-item" href="laporan_exel.php?<?=$result; ?>">Export kegiatan</a></li>
                    </ul>
                    <button type="submit" id="semua" name="semua" class="btn btn-warning">Semua Kegiatan</button>
                </div>
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
                        <a href="#" onclick="contoh()" class="link-danger" ><i class="fa-solid fa-trash"></i> Hapus</a>
                        
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
        <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="formModalLabel">Buat Kegiatan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden"  name="gambarLama" id="gambarLama">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="name" id="name">
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
    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

        function contoh(){
            Swal.fire({
                title: 'Kamu yakin?',
                text: "Periksa kembali sebelum menghapus kegiatan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "Data/selesai1.php?id=<?= $dataUser['id']; ?>";

                    }
                })
        }
    </script>
</body>
</html>