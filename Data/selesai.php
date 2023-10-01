<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <style>
        body{
            background-color: #d0e7d2;  
        }
    </style>
</head>
<body>
    
<?php


require 'data.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
        echo "<script>
            Swal.fire(
                'Berhasil',
                'Kegiatanmu berhasil diselesaikan!',
                'success'
            ).then((result) => {
                if (result) {
                    document.location.href = '../mainPage.php';
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
                    document.location.href = '../mainPage.php';
                }
            });
        </script>";
}
?>

</body>
</html>
