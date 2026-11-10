-- ============================================================
-- Database NusaKirim
-- Skrip pembuatan database dan tabel sesuai PDF Tugas 6.
-- Jalankan seluruh file menggunakan MySQL/MariaDB.
-- ============================================================

-- Membuat database jika belum tersedia.
CREATE DATABASE IF NOT EXISTS db_nusakirim
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

-- Memilih database yang digunakan.
USE db_nusakirim;

-- Tabel admin untuk data akun.
CREATE TABLE IF NOT EXISTS tb_admin (
  id INT(11) NOT NULL AUTO_INCREMENT,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  username VARCHAR(50) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_admin_username (username)
) ENGINE=InnoDB;

-- Tabel jalur pengiriman; dibuat sebelum tb_pengiriman karena menjadi tabel acuan.
CREATE TABLE IF NOT EXISTS tb_jalur (
  id INT(11) NOT NULL AUTO_INCREMENT,
  foto VARCHAR(50) DEFAULT NULL,
  nama_jalur VARCHAR(50) NOT NULL,
  tarif INT(11) NOT NULL,
  deskripsi TEXT DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Tabel pengiriman dengan foreign key ke tb_jalur.id.
CREATE TABLE IF NOT EXISTS tb_pengiriman (
  id INT(11) NOT NULL AUTO_INCREMENT,
  no_resi VARCHAR(20) NOT NULL,
  pengirim VARCHAR(50) NOT NULL,
  tujuan VARCHAR(100) NOT NULL,
  id_jalur INT(11) NOT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'Diproses',
  tanggal DATE NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_pengiriman_resi (no_resi),
  CONSTRAINT fk_pengiriman_jalur FOREIGN KEY (id_jalur) REFERENCES tb_jalur (id)
) ENGINE=InnoDB;

-- Memverifikasi tabel yang tersedia.
SHOW TABLES;

-- Memverifikasi struktur tabel pengiriman.
DESCRIBE tb_pengiriman;
