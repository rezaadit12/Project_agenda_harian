<?php
$conn = mysqli_connect("localhost", "root","", "agenda_team");


function registrasi($data) {
    global $conn;

    $email = strtolower(stripcslashes($data["email"]));
    $username = strtolower(stripcslashes($conn, $data["username"]));
    $password = mysqli_real_escape_string($data["password"]);

    $password = password_hash($password, PASSWORD_DEFAULT);

mysqli_query($conn, "INSERT INTO register VALUES('', '$email', '$username', '$password')");
return mysqli_affected_rows($conn);
}
?>