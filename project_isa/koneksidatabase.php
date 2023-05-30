<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'duon';

$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$db) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
