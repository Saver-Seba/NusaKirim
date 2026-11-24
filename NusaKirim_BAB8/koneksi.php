<?php
$servername = 'localhost';   // localhost + socket = Unix socket (lebih cepat dari TCP)
$username   = 'root';
$password   = '';
$database   = 'db_nusakirim';

ini_set('mysqli.default_socket', '/run/mysqld/mysqld.sock');

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die('Connection Failed: ' . mysqli_connect_error());
}
mysqli_set_charset($koneksi, 'utf8mb4');
?>
