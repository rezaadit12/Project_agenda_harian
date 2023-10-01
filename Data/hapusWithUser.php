<?php

require 'data.php';


$name = $_GET['name'];
$email = $_GET['email'];

$result1 = mysqli_query($conn, "DELETE FROM debug_backend WHERE username = '$name' AND email = '$email '");
$result2 = mysqli_query($conn, "DELETE FROM user WHERE username = '$name' AND email = '$email '");


if($result1 && $result2){
    echo "berhasil";
}