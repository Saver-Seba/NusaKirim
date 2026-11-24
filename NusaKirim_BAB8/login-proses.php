<?php
session_start();
include 'koneksi.php';
include 'includes/fungsi.php';

// File ini hanya boleh dibuka lewat submit form login
if (!isset($_POST['login'])) {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

if ($username === '' || $password === '') {
    pesanDanPindah('Username dan password wajib diisi', 'login.php');
}

// Ambil data admin berdasarkan username
$stmt = mysqli_prepare($koneksi, 'SELECT username, password FROM tb_admin WHERE username = ?');
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$admin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

// Username tidak ada atau password tidak cocok dengan hash di database
if ($admin === null || !password_verify($password, $admin['password'])) {
    pesanDanPindah('Username atau password salah, silakan coba lagi', 'login.php');
}

// Login berhasil: simpan username ke session
session_regenerate_id(true);
$_SESSION['username'] = $admin['username'];
header('Location: admin.php');
exit;
