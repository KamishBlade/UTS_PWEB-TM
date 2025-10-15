// Efek animasi fade-in halaman
document.addEventListener("DOMContentLoaded", () => {
  document.body.style.opacity = 0;
  document.body.style.transition = "opacity 0.6s";
  setTimeout(() => {
    document.body.style.opacity = 1;
  }, 100);
});

// Konfirmasi hapus data
document.querySelectorAll("a[href*='hapus']").forEach(link => {
  link.addEventListener("click", e => {
    if (!confirm("Apakah kamu yakin ingin menghapus data ini?")) {
      e.preventDefault();
    }
  });
});
