// ===== Sidebar toggle =====
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function () {
  sidebar.classList.toggle("active");
  if (sidebar.classList.contains("active")) {
    sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
  } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
};

// ===== PopUp Box (Prompt) + Web Storage =====
// Nama admin hanya ditanyakan SEKALI lewat prompt(), lalu disimpan di
// localStorage supaya tidak ditanya ulang setiap halaman dibuka lagi.
const KEY_NAMA_ADMIN = "NUSAKIRIM_NAMA_ADMIN";

function sapaAdmin(nama) {
  const jamSapa = new Date().getHours();
  let sapaan;
  if (jamSapa >= 4 && jamSapa <= 10) {
    sapaan = "Selamat Pagi";
  } else if (jamSapa >= 11 && jamSapa <= 14) {
    sapaan = "Selamat Siang";
  } else if (jamSapa >= 15 && jamSapa <= 18) {
    sapaan = "Selamat Sore";
  } else {
    sapaan = "Selamat Malam";
  }
  document.getElementById("text").textContent = sapaan + ", " + nama;
}

window.onload = function () {
  let nama = localStorage.getItem(KEY_NAMA_ADMIN);
  if (!nama) {
    nama = prompt("Masukkan nama Anda:", "Admin");
    if (nama) {
      localStorage.setItem(KEY_NAMA_ADMIN, nama);
    }
  }
  sapaAdmin(nama || "Admin");
  jalankanJam();
  muatRingkasan();
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

// ===== Asynchronous + Promise =====
// ambilRingkasan() membungkus setTimeout dengan Promise untuk mensimulasikan
// proses memuat data dari server (asynchronous), tanpa benar-benar
// memanggil backend yang belum ada.
function ambilRingkasan() {
  return new Promise(function (resolve) {
    setTimeout(function () {
      resolve({ total: 128, dikirim: 24, selesai: 104 });
    }, 600);
  });
}

function muatRingkasan() {
  const statCards = document.getElementById("statCards");
  statCards.classList.add("loading");

  ambilRingkasan()
    .then(function (data) {
      document.getElementById("statTotal").textContent = data.total;
      document.getElementById("statDikirim").textContent = data.dikirim;
      document.getElementById("statSelesai").textContent = data.selesai;
      statCards.classList.remove("loading");
    })
    .catch(function () {
      alert("Gagal memuat ringkasan pengiriman.");
    });
}
