<?php


session_start();
require 'Data/data.php';

$nama = $_SESSION['nama'];

if($nama !== "Admin"){
    header('Location: mainPage.php');
}



$id = $_GET['id'];

$user = read("SELECT * FROM debug_backend WHERE id = '$id'")[0];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Detail | <?= $user['username'];?></title>
    <style>
        body{
            background-color: #D0E7D2;
        }

        .container{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card w-50 mb-5 mt-5">
            <div class="card-body">
                <h5 class="card-title">Dibuat Oleh : <?= $user['username']?> | <?= $user['email']?></h5><hr><br>
                <table>
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td><b>: &nbsp</b></td>
                        <td><?= $user['tanggal']?></td>
                    </tr>
                    <tr>
                        <td><b>Kegiatan</b></td>
                        <td><b>: &nbsp</b></td>
                        <td><?= $user['isi_agenda']?></td>
                    </tr>
                    <?php if(strlen($user['gambar']) > 1):?>
                        <img class="mb-1" src="img_user/<?= $user["gambar"]?>" width="400"><hr>
                    <?php endif;?>
                </table><br><br>
                <b> Rincian kegiatan : </b>
                <p class="card-text ">
                    <?php if($user['rincian'] == null):?>
                        -
                    <?php else:?>
                        <br><?= nl2br($user['rincian']);?>
                    <?php endif; ?>
                </p><br>
                <a href="admin.php" class="btn btn-primary">kembali</a>
            </div>
        </div>
    </div>
</body>
</html>




