<?php


require 'data.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo"<script>
                alert('Berhasil menghapus kegiatan!');
                document.location.href = '../admin.php';
            </script>";
}else{
    echo"<script>
                alert('Gagal!, coba lagi');
                document.location.href = '../admin.php';
            </script>";
}