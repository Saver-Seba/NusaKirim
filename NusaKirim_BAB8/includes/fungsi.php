<?php
// Menampilkan popup alert, memindahkan halaman, lalu menghentikan proses.
function pesanDanPindah($pesan, $tujuan)
{
    echo '<script>alert(' . json_encode($pesan) . '); window.location = ' . json_encode($tujuan) . ';</script>';
    exit;
}

// Mengambil satu baris jalur berdasarkan id, null jika tidak ditemukan.
function ambilJalur($koneksi, $id)
{
    $stmt = mysqli_prepare($koneksi, 'SELECT * FROM tb_jalur WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}
