


<?php

require 'data.php';

$id = $_POST['id'];

$db = read("SELECT * FROM debug_backend WHERE id = '$id'");

echo json_encode($db);
