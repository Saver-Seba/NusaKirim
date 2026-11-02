<?php
session_start();

// File ini hanya boleh dibuka lewat submit form login
if (!isset($_POST['login'])) {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

// Semua field wajib diisi
if ($username === '' || $password === '') {
    header('Location: login.php?error=1');
    exit;
}

// Simpan nama pengguna ke session, lalu masuk ke dashboard
$_SESSION['username'] = $username;
header('Location: admin.php');
exit;
