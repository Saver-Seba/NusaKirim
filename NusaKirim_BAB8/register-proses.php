<?php
include 'koneksi.php';
include 'includes/fungsi.php';

// File ini hanya boleh dibuka lewat submit form register
if (!isset($_POST['register'])) {
    header('Location: register.php');
    exit;
}

$email = trim($_POST['email']);
$username = trim($_POST['username']);
$password = $_POST['password'];

if ($email === '' || $username === '' || $password === '') {
    pesanDanPindah('Pastikan Anda mengisi semua data', 'register.php');
}

// Username harus unik
$cek = mysqli_prepare($koneksi, 'SELECT id FROM tb_admin WHERE username = ?');
mysqli_stmt_bind_param($cek, 's', $username);
mysqli_stmt_execute($cek);
mysqli_stmt_store_result($cek);
if (mysqli_stmt_num_rows($cek) > 0) {
    pesanDanPindah('Username sudah digunakan, silakan pilih yang lain', 'register.php');
}

// Password disimpan dalam bentuk hash, bukan teks asli
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($koneksi, 'INSERT INTO tb_admin (email, password, username) VALUES (?, ?, ?)');
mysqli_stmt_bind_param($stmt, 'sss', $email, $hash, $username);
mysqli_stmt_execute($stmt);

pesanDanPindah('Registrasi berhasil, silakan login', 'login.php');
