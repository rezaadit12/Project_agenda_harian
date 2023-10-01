<?php
session_start();
require 'Data/data.php';

$nama = $_SESSION['nama'];

if($nama !== "Admin"){
    header('Location: mainPage.php');
}

$name = $_GET['name'];
$email = $_GET['email'];

$personalData = read("SELECT * FROM debug_backend WHERE username = '$name' AND email = '$email'");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">

    <title>Data | <?= $name?></title>
    <style>
        body{
            background-color: #d0e7d2;  
        }
    </style>
</head>
<body>

    <div class="container mt-5 mb-4">
    <div class="alert alert-warning" role="alert">
    <div class="info">
    <h3 class="title"><?= $name?> | <?= $email?></h3>
    <h3></h3>
    </div>
    </div>
        <table class="table table-responsive  table-bordered">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Rincian</th>
              <th scope="col">Gambar</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;?>
            <?php foreach($personalData as $data): ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $data['isi_agenda'];  ?></td>
              <td style="max-width: 300px;"><?= $data['rincian'];  ?></td>
                <?php if(strlen($data['gambar']) > 1): ?>
                    <td><img src="img_user/<?= $data['gambar']?>" alt="" width="200"></td>
                <?php else:?>
                    <td> - </td>
                <?php endif; ?>
            </tr>
            <?php $i++ ;?>
          <?php endforeach; ?>
          <?php if(count($personalData) === 0): ?>
                    <tr>
                        <td colspan="5">
                            <center>
                                <h3 style="color:rgb(192, 188, 188);">Belum menambahkan kegiatan</h3>
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
      <a href="DataUser.php" class="btn btn-danger" style="float: right;">Kembali</a>
    </div>
</body>
</html>