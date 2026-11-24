// ===== Sidebar toggle =====
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function () {
  sidebar.classList.toggle("active");
  if (sidebar.classList.contains("active")) {
    sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
  } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
};

// ===== Jalankan jam dan ringkasan saat halaman selesai dimuat =====
// Nama pengguna dan sapaan sekarang ditulis oleh PHP (admin.php) dari session.
window.onload = function () {
  jalankanJam();
};

// ===== Jam berjalan (live clock) =====
function cekWaktu(i) {
  return i < 10 ? "0" + i : i;
}

function jalankanJam() {
  const bulanList = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember",
  ];
  const hariList = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
  const sekarang = new Date();
  const hari = hariList[sekarang.getDay()];
  const tanggal = sekarang.getDate();
  const bulan = bulanList[sekarang.getMonth()];
  const tahun = sekarang.getFullYear();
  const j = cekWaktu(sekarang.getHours());
  const m = cekWaktu(sekarang.getMinutes());
  const s = cekWaktu(sekarang.getSeconds());

  document.getElementById("date").textContent =
    `${hari}, ${tanggal} ${bulan} ${tahun} - ${j}:${m}:${s}`;

  requestAnimationFrame(jalankanJam);
}

