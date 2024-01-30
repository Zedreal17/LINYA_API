<?php
$host = 'localhost';
$dbname = 'linyaprojectdb';
$username = 'root';
$password = '';

$db = mysqli_connect($host, $username, $password, $dbname);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>