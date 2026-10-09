// ===== DOM 1: Sapaan dinamis sesuai jam saat halaman dibuka =====
const jam = new Date().getHours();
let sapaan;

if (jam < 10) {
  sapaan = "Selamat Pagi";
} else if (jam < 15) {
  sapaan = "Selamat Siang";
} else if (jam < 18) {
  sapaan = "Selamat Sore";
} else {
  sapaan = "Selamat Malam";
}

document.getElementById("sapaan").textContent =
  sapaan + ", mau kirim barang ke mana hari ini?";

// ===== DOM 2: Tahun di footer mengikuti tahun berjalan =====
document.getElementById("tahun").textContent = new Date().getFullYear();

// ===== DOM 3: Jumlah jalur pengiriman dihitung otomatis dari jumlah .card =====
const jumlahJalur = document.querySelectorAll(".card").length;
document.getElementById("jumlah-jalur").textContent =
  jumlahJalur + " Pilihan Jalur Tersedia";

// ===== Toast / Snackbar =====
function showToast(message) {
  const toast = document.getElementById("toast");
  toast.textContent = message;
  toast.classList.add("show");

  setTimeout(function () {
    toast.classList.remove("show");
  }, 3000);
}

document.getElementById("btnMulai").addEventListener("click", function () {
  showToast("Fitur pemesanan akan segera hadir. Terima kasih sudah mencoba NusaKirim!");
});
