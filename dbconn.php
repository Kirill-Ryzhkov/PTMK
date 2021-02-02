<?php
$host = 'localhost';
$user = 'root';
$pass = '';

$link = mysqli_connect($host, $user, $pass)
    or die("Error ".mysqli_connect_error($link));

?>
