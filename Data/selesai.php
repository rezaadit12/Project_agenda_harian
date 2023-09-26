<?php


require 'data.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo"<script>
                alert('Kegiatan terselesaikan!');
                document.location.href = '../mainPage.php';
            </script>";
}else{
    echo"<script>
                alert('Gagal!, coba lagi');
                document.location.href = '../mainPage.php';
            </script>";
}