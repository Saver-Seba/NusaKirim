// ===== Toast / Snackbar (dipakai oleh register.php) =====
function showToast(message) {
  const toast = document.getElementById("toast");
  toast.textContent = message;
  toast.classList.add("show");

  setTimeout(function () {
    toast.classList.remove("show");
  }, 3000);
}

// ===== Event submit: form register belum tersambung ke backend =====
const form = document.querySelector("form");
form.addEventListener("submit", function (e) {
  e.preventDefault();
  showToast("Form belum terhubung ke server, ini baru tampilan front-end.");
});
