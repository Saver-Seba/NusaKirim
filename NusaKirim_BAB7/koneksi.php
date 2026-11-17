<?php
$servername = 'localhost';
$username = 'root';
$password = ''; // isi jika MySQL Anda memakai password
$database = 'db_nusakirim';

// Jika ada error pada koneksi atau query, PHP langsung menghentikan program dengan pesan error
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// membuat koneksi
$koneksi = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($koneksi, 'utf8mb4');
