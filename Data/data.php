
<?php


$conn = mysqli_connect("localhost", "root", "", "dbphpdasar");

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

    $tanggal = htmlspecialchars($_POST['tanggal_kegiatan']);
    $judul = htmlspecialchars($_POST['judul_kegiatan']);
    $rincian = htmlspecialchars($_POST['kegiatan']);
    $user = htmlspecialchars($_POST['nama_user']);

    $query = "INSERT INTO debug_backend 
    VALUES
    ('', '$tanggal', '$judul', '$rincian', '$user')";

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
    $id= $data["id"];
    $tanggal = htmlspecialchars($data["tanggal_kegiatan"]);
    $isi_agenda = htmlspecialchars($data["judul_kegiatan"]);
    $rincian = htmlspecialchars($data["kegiatan"]);
    $username = $data["name"];



    $mhs = "UPDATE debug_backend SET
            tanggal = '$tanggal',
            isi_agenda = '$isi_agenda',
            rincian = '$rincian',
            username = '$username'
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

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$email','$password')");

    return mysqli_affected_rows($conn);

}