<?php
$root = '../';
include $root . 'includes/cek-login.php';
include $root . 'koneksi.php';
include $root . 'includes/fungsi.php';

// Mengunggah foto jalur dan mengembalikan nama file barunya.
// Jika foto tidak valid, tampilkan pesan lalu kembali ke halaman $kembali.
function upload($kembali)
{
    $namaFile = $_FILES['foto']['name'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === UPLOAD_ERR_NO_FILE) {
        pesanDanPindah('Foto harus diisi', $kembali);
    }
    if ($error !== UPLOAD_ERR_OK) {
        pesanDanPindah('Foto gagal diunggah', $kembali);
    }

    // hanya menerima file gambar
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    if (!in_array($ekstensi, ['jpg', 'jpeg', 'png'])) {
        pesanDanPindah('File harus berupa gambar (jpg, jpeg, png)', $kembali);
    }

    // nama file diacak supaya tidak bentrok dengan file lain
    $namaBaru = uniqid() . '.' . $ekstensi;
    if (!move_uploaded_file($tmpName, '../img_jalur/' . $namaBaru)) {
        pesanDanPindah('Foto gagal disimpan', $kembali);
    }
    return $namaBaru;
}

// Menghapus file foto dari folder img_jalur
function hapusFoto($namaFile)
{
    $path = '../img_jalur/' . $namaFile;
    if (is_file($path)) {
        unlink($path);
    }
}

if (isset($_POST['simpan'])) {
    // ===== Create =====
    $nama = trim($_POST['nama']);
    $tarif = trim($_POST['tarif']);
    $deskripsi = trim($_POST['deskripsi']);

    if ($nama === '' || $tarif === '' || $deskripsi === '') {
        pesanDanPindah('Pastikan Anda mengisi semua data', 'jalur-entry.php');
    }
    if (!is_numeric($tarif) || $tarif <= 0) {
        pesanDanPindah('Tarif harus berupa angka lebih dari nol', 'jalur-entry.php');
    }
    $tarif = (int) $tarif;
    $foto = upload('jalur-entry.php');

    $stmt = mysqli_prepare($koneksi, 'INSERT INTO tb_jalur (foto, nama_jalur, tarif, deskripsi) VALUES (?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'ssis', $foto, $nama, $tarif, $deskripsi);
    mysqli_stmt_execute($stmt);

    pesanDanPindah('Data jalur berhasil ditambahkan', 'jalur.php');
} elseif (isset($_POST['edit'])) {
    // ===== Update =====
    $id = (int) $_POST['id'];
    $kembali = 'jalur-edit.php?id=' . $id;

    $jalur = ambilJalur($koneksi, $id);
    if ($jalur === null) {
        pesanDanPindah('Data jalur tidak ditemukan', 'jalur.php');
    }

    $nama = trim($_POST['nama']);
    $tarif = trim($_POST['tarif']);
    $deskripsi = trim($_POST['deskripsi']);

    if ($nama === '' || $tarif === '' || $deskripsi === '') {
        pesanDanPindah('Pastikan Anda mengisi semua data', $kembali);
    }
    if (!is_numeric($tarif) || $tarif <= 0) {
        pesanDanPindah('Tarif harus berupa angka lebih dari nol', $kembali);
    }
    $tarif = (int) $tarif;

    // Foto hanya diganti jika admin memilih file baru
    $gantiFoto = $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE;
    $foto = $gantiFoto ? upload($kembali) : $jalur['foto'];

    $stmt = mysqli_prepare($koneksi, 'UPDATE tb_jalur SET foto = ?, nama_jalur = ?, tarif = ?, deskripsi = ? WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'ssisi', $foto, $nama, $tarif, $deskripsi, $id);
    mysqli_stmt_execute($stmt);

    // Foto lama dihapus setelah data berhasil diperbarui
    if ($gantiFoto) {
        hapusFoto($jalur['foto']);
    }

    pesanDanPindah('Data jalur berhasil diubah', 'jalur.php');
} elseif (isset($_POST['hapus'])) {
    // ===== Delete =====
    $id = (int) $_POST['id'];

    $jalur = ambilJalur($koneksi, $id);
    if ($jalur === null) {
        pesanDanPindah('Data jalur tidak ditemukan', 'jalur.php');
    }

    $stmt = mysqli_prepare($koneksi, 'DELETE FROM tb_jalur WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    try {
        mysqli_stmt_execute($stmt);
    } catch (mysqli_sql_exception $e) {
        // 1451 = data masih dipakai tabel lain (foreign key dari tb_pengiriman)
        if ($e->getCode() === 1451) {
            pesanDanPindah('Jalur tidak bisa dihapus karena masih dipakai data pengiriman', 'jalur.php');
        }
        throw $e;
    }
    hapusFoto($jalur['foto']);

    pesanDanPindah('Data jalur berhasil dihapus', 'jalur.php');
} else {
    header('Location: jalur.php');
}
