<?php
$root = '../';
include $root . 'includes/cek-login.php';
include $root . 'koneksi.php';

// Ambil daftar jalur untuk dropdown
$jalurResult = mysqli_query($koneksi, 'SELECT id, nama_jalur FROM tb_jalur ORDER BY nama_jalur');
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../assets/icon.png" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <title>NusaKirim Admin | Tambah Pengiriman</title>
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
        <h1>Tambah Pengiriman</h1>
        <p class="subtitle">Isi data pengiriman baru</p>

        <div class="form-entry">
          <form action="pengiriman-proses.php" method="post">
            <label for="no_resi">No. Resi</label>
            <input class="input" type="text" id="no_resi" name="no_resi" placeholder="Contoh: NK-2026-010" />

            <label for="pengirim">Nama Pengirim</label>
            <input class="input" type="text" id="pengirim" name="pengirim" placeholder="Nama lengkap pengirim" />

            <label for="tujuan">Tujuan</label>
            <input class="input" type="text" id="tujuan" name="tujuan" placeholder="Contoh: Surabaya → Medan" />

            <label for="id_jalur">Jalur Pengiriman</label>
            <select class="input" id="id_jalur" name="id_jalur">
              <option value="">-- Pilih Jalur --</option>
              <?php while ($j = mysqli_fetch_assoc($jalurResult)) { ?>
                <option value="<?php echo $j['id']; ?>"><?php echo htmlspecialchars($j['nama_jalur']); ?></option>
              <?php } ?>
            </select>

            <label for="status">Status</label>
            <select class="input" id="status" name="status">
              <option value="Diproses">Diproses</option>
              <option value="Dikirim">Dikirim</option>
              <option value="Selesai">Selesai</option>
            </select>

            <label for="tanggal">Tanggal</label>
            <input class="input" type="date" id="tanggal" name="tanggal" />

            <button type="submit" name="simpan" class="btn btn-simpan">Simpan</button>
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
