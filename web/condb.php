<?php
// Create connection
$connect = new mysqli('172.20.250.202', 'sa', 'wangchao27443', 'riskhospital');
mysqli_set_charset($connect, 'utf8');

// Check Connection
if ($connect->connect_error) {
    die("Something wrong.: " . $connect->connect_error);
}

?>