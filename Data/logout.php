<?php
session_start();
session_unset();
session_destroy();

setcookie('useid', '', time() - 3600, '/');
setcookie('usemailuser', '', time() - 3600, '/');

header("location: ../index.php");

?>