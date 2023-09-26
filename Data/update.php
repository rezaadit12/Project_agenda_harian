<?php


require 'data.php';

if(ubah($_POST) > 0){
    echo"<script>
                alert('Kegiatan berhasil diubah!');
                document.location.href = '../mainPage.php';
            </script>";
}else{
    echo"<script>
                alert('Kegiatan gagal diubah!');
                document.location.href = '../mainPage.php';
            </script>";
}