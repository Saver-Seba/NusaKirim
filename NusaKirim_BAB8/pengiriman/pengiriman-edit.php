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
    <title>NusaKirim Admin | Ubah Pengiriman</title>
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
        <h1>Ubah Pengiriman</h1>
        <p class="subtitle">Ubah data pengiriman</p>

        <div class="form-entry">
          <form action="pengiriman-proses.php" method="post">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

            <label>No. Resi (tidak bisa diubah)</label>
            <input class="input" type="text" value="<?php echo htmlspecialchars($data['no_resi']); ?>" disabled />

            <label for="pengirim">Nama Pengirim</label>
            <input class="input" type="text" id="pengirim" name="pengirim" value="<?php echo htmlspecialchars($data['pengirim']); ?>" />

            <label for="tujuan">Tujuan</label>
            <input class="input" type="text" id="tujuan" name="tujuan" value="<?php echo htmlspecialchars($data['tujuan']); ?>" />

            <label for="id_jalur">Jalur Pengiriman</label>
            <select class="input" id="id_jalur" name="id_jalur">
              <?php while ($j = mysqli_fetch_assoc($jalurResult)) { ?>
                <option value="<?php echo $j['id']; ?>" <?php echo $j['id'] == $data['id_jalur'] ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($j['nama_jalur']); ?>
                </option>
              <?php } ?>
            </select>

            <label for="status">Status</label>
            <select class="input" id="status" name="status">
              <?php foreach (['Diproses','Dikirim','Selesai'] as $s) { ?>
                <option value="<?php echo $s; ?>" <?php echo $s === $data['status'] ? 'selected' : ''; ?>><?php echo $s; ?></option>
              <?php } ?>
            </select>

            <label for="tanggal">Tanggal</label>
            <input class="input" type="date" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" />

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
