<?php
$root = '../';
include $root . 'includes/cek-login.php';
include $root . 'koneksi.php';
include $root . 'includes/fungsi.php';

$id = (int) ($_GET['id'] ?? 0);
$jalur = ambilJalur($koneksi, $id);
if ($jalur === null) {
    pesanDanPindah('Data jalur tidak ditemukan', 'jalur.php');
}
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
    <title>NusaKirim Admin | Ubah Jalur</title>
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
        <h1>Ubah Jalur Pengiriman</h1>
        <p class="subtitle">Ubah data jalur pengiriman</p>

        <div class="form-entry">
          <form action="jalur-proses.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $jalur['id']; ?>" />

            <label for="nama">Nama Jalur</label>
            <input
              class="input"
              type="text"
              id="nama"
              name="nama"
              placeholder="Contoh: Darat"
              value="<?php echo htmlspecialchars($jalur['nama_jalur']); ?>"
            />

            <label for="tarif">Tarif (per kg)</label>
            <input
              class="input"
              type="text"
              id="tarif"
              name="tarif"
              placeholder="Contoh: 15000"
              value="<?php echo $jalur['tarif']; ?>"
            />

            <label for="deskripsi">Deskripsi</label>
            <input
              class="input"
              type="text"
              id="deskripsi"
              name="deskripsi"
              placeholder="Deskripsi singkat jalur pengiriman"
              value="<?php echo htmlspecialchars($jalur['deskripsi']); ?>"
            />

            <label for="foto">Foto (kosongkan jika tidak ingin diganti)</label>
            <img
              class="foto-saat-ini"
              src="../img_jalur/<?php echo htmlspecialchars($jalur['foto']); ?>"
              alt="Foto saat ini"
            />
            <input class="input" type="file" id="foto" name="foto" />

            <button type="submit" name="edit" class="btn btn-simpan">Ubah</button>
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
