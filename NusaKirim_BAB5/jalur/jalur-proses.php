<?php
$root = '../';
include $root . 'includes/cek-login.php';

// File ini hanya boleh dibuka lewat submit form Tambah Jalur
if (!isset($_POST['simpan'])) {
    header('Location: jalur-entry.php');
    exit;
}

$nama = $_POST['nama'];
$tarif = $_POST['tarif'];
$deskripsi = $_POST['deskripsi'];
$foto = $_FILES['foto']['name'];
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../assets/icon.png" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>NusaKirim Admin | Data Jalur Diterima</title>
  </head>
  <body>
    <div class="sidebar">
      <div class="logo-details">
        <img src="../assets/icon.png" alt="" />
        <span class="logo_name">NusaKirim</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="../admin.php">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="jalur.php" class="active">
            <i class="bx bx-box"></i>
            <span class="links_name">Jalur Pengiriman</span>
          </a>
        </li>
        <li>
          <a href="../pengiriman/pengiriman.php">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Pengiriman</span>
          </a>
        </li>
        <li>
          <a href="../logout.php">
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
          <img src="../assets/avatar.png" alt="" />
          <span class="admin_name"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
      </nav>

      <div class="home-content">
        <h1>Data Jalur Diterima</h1>
        <p class="subtitle">
          Data berikut dikirim dari form Tambah Jalur (belum disimpan ke database)
        </p>

        <div class="panel">
          <table class="table-data">
            <tbody>
              <tr>
                <td class="strong">Nama Jalur</td>
                <td><?php echo htmlspecialchars($nama); ?></td>
              </tr>
              <tr>
                <td class="strong">Tarif</td>
                <td><?php echo htmlspecialchars($tarif); ?></td>
              </tr>
              <tr>
                <td class="strong">Deskripsi</td>
                <td><?php echo htmlspecialchars($deskripsi); ?></td>
              </tr>
              <tr>
                <td class="strong">Nama File Foto</td>
                <td><?php echo htmlspecialchars($foto); ?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <a href="jalur.php" class="btn btn-tambah">Kembali ke Jalur Pengiriman</a>
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
