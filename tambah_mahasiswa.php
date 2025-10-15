<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Mahasiswa</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Tambah Mahasiswa</h1>
  <form method="POST">
    <input type="text" name="nama" placeholder="Nama" required><br>
    <input type="text" name="nim" placeholder="NIM" required><br>
    <input type="text" name="jurusan" placeholder="Jurusan" required><br>
    <button type="submit" name="simpan">Simpan</button>
  </form>

  <?php
  if (isset($_POST['simpan'])) {
      $nama = $_POST['nama'];
      $nim = $_POST['nim'];
      $jurusan = $_POST['jurusan'];
      $koneksi->query("INSERT INTO mahasiswa (nama, nim, jurusan) VALUES ('$nama','$nim','$jurusan')");
      header("Location: mahasiswa.php");
  }
  ?>
</body>
</html>
