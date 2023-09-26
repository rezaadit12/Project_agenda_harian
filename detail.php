<?php

session_start();

if(!isset($_SESSION['nama'])){
	header("Location: index.php");
}

require 'Data/data.php';

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
            height: 100vh; 
        }




    </style>
</head>
<body>
    <div class="container">
        <div class="card w-50 mb-3">
            <div class="card-body">
                <h4 class="card-title">Dibuat Oleh : <?= $user['username']?></h4><hr><br>
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
                </table><br><br>

                <b> Rincian kegiatan : </b>
                    
                <p class="card-text">
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




