<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'payday';
$connect= new mysqli($host, $username, $password, $database)or
 die("Error establishing database connection: ".mysqli_error($connect));
?>