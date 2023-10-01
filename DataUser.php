<?php
session_start();
require 'Data/data.php';

$nama = $_SESSION['nama'];

if($nama !== "Admin"){
    header('Location: mainPage.php');
}

$akun_user = read("SELECT * FROM user WHERE username != 'Admin' ORDER BY id DESC");
$countUser = count(read("SELECT * FROM user WHERE username != 'Admin'"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <title>Data User</title>
    <style>
        body{
            background-color: #d0e7d2;  
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-4">
        <h3 class="title" style="color:#186F65;">Data User | Total akun : <?= $countUser ?></h3>
        <table class="table table-responsive  table-bordered">
          
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Password</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;?>
            <?php foreach($akun_user as $data): ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $data['username']; ?></td>
              <td><?= $data['email'];  ?></td>
              <td><?= $data['password'];  ?></td>

              <td style="max-width: 200px;">
                <a  href="planUser.php?name=<?= $data['username'];?>&email=<?= $data['email']?>">Kegiatan yang dibuat</a> |
                <a style="color: red;" href="#" onclick="contoh()">Hapus akun user</a> 
              </td>
            </tr>
            <?php $i++ ;?>
          <?php endforeach; ?>
          </tbody>
          <thead>
                <tr>
                    <td colspan="5" style="color:white;"><p></p></td>
                </tr>
            </thead>
        </table>
      <a href="admin.php" class="btn btn-warning" style="float: right;">Kembali</a>
    </div>

    <script type="text/javascript">

      function contoh(){
          Swal.fire({
              title: 'Kamu yakin?',
              text: "JIka kamu menghapus ini, maka kegiatannya juga akan ikut terhapus!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Hapus'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = "Data/hapusWithUser.php?name=<?= $data['username'];?>&email=<?= $data['email']?>";

                  }
              })
      }
    </script>
</body>
</html>