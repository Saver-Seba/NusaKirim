<?php
$root = '../';
include $root . 'includes/cek-login.php';
include $root . 'koneksi.php';

$result = mysqli_query($koneksi, 'SELECT * FROM tb_jalur ORDER BY id');
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
    <title>NusaKirim Admin | Jalur Pengiriman</title>
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
        <h1>Jalur Pengiriman</h1>
        <p class="subtitle">Kelola jalur pengiriman yang tersedia di NusaKirim</p>

        <a href="jalur-entry.php" class="btn btn-tambah">+ Tambah Jalur</a>

        <div class="panel">
          <table class="table-data">
            <thead>
              <tr>
                <th style="width: 10%">Foto</th>
                <th>Jalur</th>
                <th style="width: 30%">Deskripsi</th>
                <th style="width: 15%">Tarif</th>
                <th style="width: 20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($result) === 0) { ?>
                <tr>
                  <td colspan="5" style="text-align: center">Data Kosong</td>
                </tr>
              <?php } ?>
              <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td>
                    <img
                      src="../img_jalur/<?php echo htmlspecialchars($data['foto']); ?>"
                      alt="<?php echo htmlspecialchars($data['nama_jalur']); ?>"
                    />
                  </td>
                  <td class="strong"><?php echo htmlspecialchars($data['nama_jalur']); ?></td>
                  <td><?php echo htmlspecialchars($data['deskripsi']); ?></td>
                  <td>Rp<?php echo number_format($data['tarif'], 0, ',', '.'); ?>/kg</td>
                  <td>
                    <a class="btn-edit" href="jalur-edit.php?id=<?php echo $data['id']; ?>">Edit</a>
                    <a class="btn-delete" href="jalur-hapus.php?id=<?php echo $data['id']; ?>">Hapus</a>
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
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
  </body>
</html>
