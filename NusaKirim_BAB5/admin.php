<?php
$root = '';
include 'includes/cek-login.php';

// Sapaan sesuai jam (zona waktu WIB)
date_default_timezone_set('Asia/Jakarta');
$jam = (int) date('H');
if ($jam >= 4 && $jam <= 10) {
    $sapaan = 'Selamat Pagi';
} elseif ($jam >= 11 && $jam <= 14) {
    $sapaan = 'Selamat Siang';
} elseif ($jam >= 15 && $jam <= 18) {
    $sapaan = 'Selamat Sore';
} else {
    $sapaan = 'Selamat Malam';
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="assets/icon.png" />
    <link rel="stylesheet" href="css/admin.css" />
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>NusaKirim Admin | Dashboard</title>
  </head>
  <body>
    <div class="sidebar">
      <div class="logo-details">
        <img src="assets/icon.png" alt="" />
        <span class="logo_name">NusaKirim</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="admin.php" class="active">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="jalur/jalur.php">
            <i class="bx bx-box"></i>
            <span class="links_name">Jalur Pengiriman</span>
          </a>
        </li>
        <li>
          <a href="pengiriman/pengiriman.php">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Pengiriman</span>
          </a>
        </li>
        <li>
          <a href="logout.php">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
    </div>

    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
        </div>
        <div class="profile-details">
          <img src="assets/avatar.png" alt="" />
          <span class="admin_name"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
      </nav>

      <div class="home-content">
        <h1 id="text">
          <?php echo $sapaan; ?>, <?php echo htmlspecialchars($_SESSION['username']); ?>
        </h1>
        <p class="subtitle">Berikut ringkasan pengiriman Anda hari ini</p>
        <p id="date" class="date-text"></p>

        <div class="stat-cards" id="statCards">
          <div class="stat-card">
            <img src="assets/ic_box.png" alt="" />
            <div>
              <div class="stat-number" id="statTotal">-</div>
              <div class="stat-label">Total Pengiriman</div>
            </div>
          </div>
          <div class="stat-card">
            <img src="assets/ic_truck.png" alt="" />
            <div>
              <div class="stat-number" id="statDikirim">-</div>
              <div class="stat-label">Sedang Dikirim</div>
            </div>
          </div>
          <div class="stat-card">
            <img src="assets/ic_check.png" alt="" />
            <div>
              <div class="stat-number" id="statSelesai">-</div>
              <div class="stat-label">Selesai</div>
            </div>
          </div>
        </div>

        <div class="panel">
          <div class="panel-header">
            <h3>Riwayat Pengiriman Terbaru</h3>
            <a href="pengiriman/pengiriman.php" class="btn">Lihat Semua</a>
          </div>
          <table class="table-data">
            <thead>
              <tr>
                <th>No. Resi</th>
                <th>Tujuan</th>
                <th>Jalur</th>
                <th>Status</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="strong">NK-2026-001</td>
                <td>Surabaya &rarr; Medan</td>
                <td>Darat</td>
                <td><span class="pill selesai">Selesai</span></td>
                <td>12 Sep 2026</td>
              </tr>
              <tr>
                <td class="strong">NK-2026-002</td>
                <td>Jakarta &rarr; Makassar</td>
                <td>Laut</td>
                <td><span class="pill dikirim">Dikirim</span></td>
                <td>18 Sep 2026</td>
              </tr>
              <tr>
                <td class="strong">NK-2026-003</td>
                <td>Bandung &rarr; Denpasar</td>
                <td>Udara</td>
                <td><span class="pill diproses">Diproses</span></td>
                <td>22 Sep 2026</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <script src="js/admin.js"></script>
  </body>
</html>
