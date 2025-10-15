<?php include 'database.php'; ?>
<?php
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM mahasiswa WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Mahasiswa</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Edit Mahasiswa</h1>
  <form method="POST">
    <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br>
    <input type="text" name="nim" value="<?= $data['nim'] ?>" required><br>
    <input type="text" name="jurusan" value="<?= $data['jurusan'] ?>" required><br>
    <button type="submit" name="update">Update</button>
  </form>

  <?php
  if (isset($_POST['update'])) {
      $nama = $_POST['nama'];
      $nim = $_POST['nim'];
      $jurusan = $_POST['jurusan'];
      $koneksi->query("UPDATE mahasiswa SET nama='$nama', nim='$nim', jurusan='$jurusan' WHERE id=$id");
      header("Location: mahasiswa.php");
  }
  ?>
</body>
</html>
