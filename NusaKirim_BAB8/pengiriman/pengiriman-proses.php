<?php
$root = '../';
include $root . 'includes/cek-login.php';
include $root . 'koneksi.php';

function pesanPindah($pesan, $url) {
    echo '<script>alert(' . json_encode($pesan) . '); window.location = ' . json_encode($url) . ';</script>';
    exit;
}

if (isset($_POST['simpan'])) {
    // ===== Create =====
    $no_resi  = trim($_POST['no_resi']);
    $pengirim = trim($_POST['pengirim']);
    $tujuan   = trim($_POST['tujuan']);
    $id_jalur = (int) $_POST['id_jalur'];
    $status   = $_POST['status'];
    $tanggal  = $_POST['tanggal'];

    if ($no_resi === '' || $pengirim === '' || $tujuan === '' || !$id_jalur || $tanggal === '') {
        pesanPindah('Pastikan Anda Mengisi Semua Data', 'pengiriman-entry.php');
    }

    $stmt = mysqli_prepare($koneksi, 'INSERT INTO tb_pengiriman (no_resi, pengirim, tujuan, id_jalur, status, tanggal) VALUES (?, ?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sssiss', $no_resi, $pengirim, $tujuan, $id_jalur, $status, $tanggal);

    try {
        mysqli_stmt_execute($stmt);
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            pesanPindah('No. Resi sudah digunakan', 'pengiriman-entry.php');
        }
        throw $e;
    }

    pesanPindah('Data Pengiriman Berhasil Ditambahkan', 'pengiriman.php');

} elseif (isset($_POST['edit'])) {
    // ===== Update =====
    $id       = (int) $_POST['id'];
    $pengirim = trim($_POST['pengirim']);
    $tujuan   = trim($_POST['tujuan']);
    $id_jalur = (int) $_POST['id_jalur'];
    $status   = $_POST['status'];
    $tanggal  = $_POST['tanggal'];

    if ($pengirim === '' || $tujuan === '' || !$id_jalur || $tanggal === '') {
        pesanPindah('Pastikan Anda Mengisi Semua Data', 'pengiriman-edit.php?id=' . $id);
    }

    $stmt = mysqli_prepare($koneksi, 'UPDATE tb_pengiriman SET pengirim=?, tujuan=?, id_jalur=?, status=?, tanggal=? WHERE id=?');
    mysqli_stmt_bind_param($stmt, 'ssissi', $pengirim, $tujuan, $id_jalur, $status, $tanggal, $id);
    mysqli_stmt_execute($stmt);

    pesanPindah('Data Pengiriman Berhasil Diubah', 'pengiriman.php');

} elseif (isset($_POST['hapus'])) {
    // ===== Delete =====
    $id = (int) $_POST['id'];
    $stmt = mysqli_prepare($koneksi, 'DELETE FROM tb_pengiriman WHERE id=?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    pesanPindah('Data Pengiriman Berhasil Dihapus', 'pengiriman.php');

} else {
    header('Location: pengiriman.php');
}
