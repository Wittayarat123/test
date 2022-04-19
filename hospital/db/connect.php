<?php
// Create connection
$connect = new mysqli('127.0.0.1', 'root', '12345', 'wangchao_db4');
mysqli_set_charset($connect, 'utf8');

// Check Connection
if ($connect->connect_error) {
    die("Something wrong.: " . $connect->connect_error);
}

?>