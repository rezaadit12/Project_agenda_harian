<?php

$conn = mysqli_connect("localhost", "root", "", "db_agendaharian");

function read($data){
    global $conn;
    $result = mysqli_query($conn, $data);
    $arr = [];
    while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }
    return $arr;
}

function create($data){
    global $conn;

    $tanggal = htmlspecialchars( $_POST['tanggal_kegiatan']);
    $judul = htmlspecialchars($_POST['judul_kegiatan']);
    $rincian = htmlspecialchars( $_POST['kegiatan']);
    $user = htmlspecialchars( $_POST['nama_user']);
    $email = htmlspecialchars( $_POST['email']);

    $gambar = upload();
    if(!$gambar){
        return false;
    }


    $query = "INSERT INTO debug_backend 
    VALUES
    ('', '$tanggal', '$judul', '$rincian', '$gambar' ,'$user', '$email' )";

    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
}

function cari($value){
    $query = "SELECT * FROM debug_backend
                WHERE 
                isi_agenda LIKE '%$value%' OR
                username LIKE '%$value%'  OR
                tanggal LIKE '%value%'";

    return read($query);
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM debug_backend WHERE id =$id");
    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;
    $id = $data["id"];
    $tanggal =  ( $data["tanggal_kegiatan"]);
    $isi_agenda =  ( $data["judul_kegiatan"]);
    $rincian =  ( $data["kegiatan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if($_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    }else{
        $gambar = updateGambar();
    }
    

    $mhs = "UPDATE debug_backend SET
            tanggal = '$tanggal',
            isi_agenda = '$isi_agenda',
            rincian = '$rincian',
            gambar = '$gambar'
            WHERE id = $id
            ";   
    mysqli_query($conn, $mhs);
    return mysqli_affected_rows($conn);


}

function register($data){
    global $conn;

    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);
    $conPass = htmlspecialchars($data['confirmPassword']);


    $checkEmail = mysqli_query($conn,  "SELECT email FROM user WHERE email = '$email' ");

    if(mysqli_num_rows($checkEmail) > 0  ){
        echo "<script>
                alert('Email sudah ada sebelumnya');
            </script>";
        return false;
    }


    if($password !== $conPass){
        echo "<script>
                alert('Password tidak sesuai!');
             </script>";
        return false;

    }

    // $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$email','$password')");

    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if($error === 4){

        return true;
    }else{
        
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar =  strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo"<script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    if($ukuranFile > 3000000){
        echo"<script>
        alert('ukuran gambar terlau besar');
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img_user/' . $namaFileBaru);

    return $namaFileBaru;
    }
}

function updateGambar(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if($error === 4){
        return true;
    }else{
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar =  strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo"<script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }


    if($ukuranFile > 3000000){
        echo"<script>
        alert('ukuran gambar terlau besar');
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img_user/' . $namaFileBaru);

    return $namaFileBaru;
    }

}