<?php
$root = '../';
include $root . 'includes/cek-login.php';
include $root . 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = mysqli_prepare($koneksi, 'SELECT * FROM tb_pengiriman WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) {
    echo '<script>alert("Data tidak ditemukan"); window.location = "pengiriman.php";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../assets/icon.png" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <title>NusaKirim Admin | Hapus Pengiriman</title>
  </head>
  <body>
    <div class="sidebar">
      <div class="logo-details">
        <img src="../assets/icon.png" alt="" />
        <span class="logo_name">NusaKirim</span>
      </div>
      <ul class="nav-links">
        <li><a href="../admin.php"><i class="bx bx-grid-alt"></i><span class="links_name">Dashboard</span></a></li>
        <li><a href="../jalur/jalur.php"><i class="bx bx-box"></i><span class="links_name">Jalur Pengiriman</span></a></li>
        <li><a href="pengiriman.php" class="active"><i class="bx bx-list-ul"></i><span class="links_name">Pengiriman</span></a></li>
        <li><a href="../logout.php"><i class="bx bx-log-out"></i><span class="links_name">Log out</span></a></li>
      </ul>
    </div>

    <section class="home-section">
      <nav>
        <div class="sidebar-button"><i class="bx bx-menu sidebarBtn"></i></div>
        <div class="profile-details">
          <img src="../assets/avatar.png" alt="" />
          <span class="admin_name"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
      </nav>

      <div class="home-content">
        <h1>Hapus Pengiriman</h1>
        <p class="subtitle">Data berikut akan dihapus secara permanen</p>

        <div class="form-entry">
          <h3>Ingin menghapus pengiriman <?php echo htmlspecialchars($data['no_resi']); ?>?</h3>
          <table class="table-data" style="margin:16px 0">
            <tr><th>No. Resi</th><td><?php echo htmlspecialchars($data['no_resi']); ?></td></tr>
            <tr><th>Pengirim</th><td><?php echo htmlspecialchars($data['pengirim']); ?></td></tr>
            <tr><th>Tujuan</th><td><?php echo htmlspecialchars($data['tujuan']); ?></td></tr>
            <tr><th>Status</th><td><?php echo htmlspecialchars($data['status']); ?></td></tr>
            <tr><th>Tanggal</th><td><?php echo htmlspecialchars($data['tanggal']); ?></td></tr>
          </table>
          <form action="pengiriman-proses.php" method="post">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
            <button type="submit" name="hapus" class="btn-delete">Ya, Hapus</button>
            <a href="pengiriman.php" class="btn">Batal</a>
          </form>
        </div>
      </div>
    </section>

    <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
  </body>
</html>
