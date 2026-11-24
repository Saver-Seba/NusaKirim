<?php
$root = '../';
include $root . 'includes/cek-login.php';
include $root . 'koneksi.php';

// Muat library DOMPDF (unduh dompdf dari getcomposer.org atau
// install lewat Composer: composer require dompdf/dompdf)
require_once $root . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$sql = "SELECT p.*, j.nama_jalur FROM tb_pengiriman p
        LEFT JOIN tb_jalur j ON p.id_jalur = j.id
        ORDER BY p.tanggal ASC";
$result = mysqli_query($koneksi, $sql);

// Bangun konten HTML yang akan dijadikan PDF
$html = '
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  body  { font-family: sans-serif; font-size: 12px; }
  h2    { text-align: center; margin-bottom: 4px; }
  p.sub { text-align: center; color: #555; margin-top: 0; }
  table { width: 100%; border-collapse: collapse; margin-top: 16px; }
  th    { background: #0B3C5D; color: #fff; padding: 6px 8px; text-align: left; }
  td    { padding: 5px 8px; border-bottom: 1px solid #ddd; }
  tr:nth-child(even) td { background: #f5f8fb; }
</style>
</head>
<body>
<h2>Laporan Data Pengiriman</h2>
<p class="sub">NusaKirim - Website Pengiriman dan Distribusi Barang</p>
<table>
  <thead>
    <tr>
      <th>No</th><th>No. Resi</th><th>Pengirim</th>
      <th>Tujuan</th><th>Jalur</th><th>Status</th><th>Tanggal</th>
    </tr>
  </thead>
  <tbody>';

$no = 1;
while ($data = mysqli_fetch_assoc($result)) {
    $html .= '<tr>
      <td>' . $no++ . '</td>
      <td>' . htmlspecialchars($data['no_resi'])   . '</td>
      <td>' . htmlspecialchars($data['pengirim'])  . '</td>
      <td>' . htmlspecialchars($data['tujuan'])    . '</td>
      <td>' . htmlspecialchars($data['nama_jalur'] ?? '-') . '</td>
      <td>' . htmlspecialchars($data['status'])    . '</td>
      <td>' . date('d M Y', strtotime($data['tanggal'])) . '</td>
    </tr>';
}

$html .= '</tbody></table></body></html>';

// Konfigurasi DOMPDF
$options = new Options();
$options->set('defaultFont', 'sans-serif');
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Unduh PDF ke browser
$dompdf->stream('laporan-pengiriman.pdf', ['Attachment' => true]);
