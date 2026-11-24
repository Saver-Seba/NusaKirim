<?php
// Dipanggil di baris pertama setiap halaman admin.
// $root = alamat relatif dari halaman pemanggil ke folder utama project
// (admin.php memakai '', halaman di dalam folder jalur/ dan pengiriman/ memakai '../').
session_start();

// Belum login -> kembalikan ke halaman login
if (!isset($_SESSION['username'])) {
    header('Location: ' . $root . 'login.php');
    exit;
}
