<?php
$root = '../';
include $root . 'includes/cek-login.php';
include $root . 'koneksi.php';

$sql = "SELECT p.*, j.nama_jalur FROM tb_pengiriman p
        LEFT JOIN tb_jalur j ON p.id_jalur = j.id
        ORDER BY p.tanggal DESC";
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../assets/icon.png" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <title>NusaKirim Admin | Pengiriman</title>
  </head>
  <body>
    <div class="sidebar">
      <div class="logo-details">
        <img src="../assets/icon.png" alt="" /><span class="logo_name">NusaKirim</span>
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
        <h1>Pengiriman</h1>
        <p class="subtitle">Riwayat seluruh pengiriman yang tercatat di NusaKirim</p>
        <a href="pengiriman-entry.php" class="btn btn-tambah">+ Tambah Pengiriman</a>
        <a href="pengiriman-cetak.php" class="btn" style="background:#27ae60;margin-left:8px">&#128438; Cetak PDF</a>
        <div class="panel">
          <table class="table-data">
            <thead>
              <tr>
                <th>No. Resi</th><th>Pengirim</th><th>Tujuan</th>
                <th>Jalur</th><th>Status</th><th>Tanggal</th><th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($result) === 0) { ?>
                <tr><td colspan="7" style="text-align:center">Data Kosong</td></tr>
              <?php } ?>
              <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td class="strong"><?php echo htmlspecialchars($data['no_resi']); ?></td>
                  <td><?php echo htmlspecialchars($data['pengirim']); ?></td>
                  <td><?php echo htmlspecialchars($data['tujuan']); ?></td>
                  <td><?php echo htmlspecialchars($data['nama_jalur'] ?? '-'); ?></td>
                  <td><span class="pill <?php echo strtolower($data['status']); ?>"><?php echo htmlspecialchars($data['status']); ?></span></td>
                  <td><?php echo date('d M Y', strtotime($data['tanggal'])); ?></td>
                  <td>
                    <a class="btn-edit" href="pengiriman-edit.php?id=<?php echo $data['id']; ?>">Edit</a>
                    <a class="btn-delete" href="pengiriman-hapus.php?id=<?php echo $data['id']; ?>">Hapus</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) sidebarBtn.classList.replace("bx-menu","bx-menu-alt-right");
        else sidebarBtn.classList.replace("bx-menu-alt-right","bx-menu");
      };
    </script>
  </body>
</html>
