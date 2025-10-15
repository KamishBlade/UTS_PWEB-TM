<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h2 class="text-center mb-4">Data Mahasiswa</h2>

    <?php
    // CREATE
    if(isset($_POST['tambah'])){
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $jurusan = $_POST['jurusan'];
        $conn->query("INSERT INTO mahasiswa (nama, nim, jurusan) VALUES ('$nama', '$nim', '$jurusan')");
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
    }

    // DELETE
    if(isset($_GET['hapus'])){
        $id = $_GET['hapus'];
        $conn->query("DELETE FROM mahasiswa WHERE id=$id");
        echo "<script>alert('Data berhasil dihapus!');window.location='mahasiswa.php';</script>";
    }

    // UPDATE
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $jurusan = $_POST['jurusan'];
        $conn->query("UPDATE mahasiswa SET nama='$nama', nim='$nim', jurusan='$jurusan' WHERE id=$id");
        echo "<script>alert('Data berhasil diupdate!');window.location='mahasiswa.php';</script>";
    }
    ?>

    <!-- Form Input / Edit -->
    <form method="POST" class="card p-3 mb-4">
        <h5>Form Mahasiswa</h5>
        <?php
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];
            $data = $conn->query("SELECT * FROM mahasiswa WHERE id=$id")->fetch_assoc();
        }
        ?>
        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required value="<?= isset($data['nama']) ? $data['nama'] : '' ?>">
        <input type="text" name="nim" class="form-control mb-2" placeholder="NIM" required value="<?= isset($data['nim']) ? $data['nim'] : '' ?>">
        <input type="text" name="jurusan" class="form-control mb-2" placeholder="Jurusan" required value="<?= isset($data['jurusan']) ? $data['jurusan'] : '' ?>">
        <button class="btn btn-success" name="<?= isset($_GET['edit']) ? 'update' : 'tambah'; ?>">
            <?= isset($_GET['edit']) ? 'Update Data' : 'Tambah Data'; ?>
        </button>
    </form>

    <!-- Tabel Data -->
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th><th>Nama</th><th>NIM</th><th>Jurusan</th><th>Aksi</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM mahasiswa");
        while($row = $result->fetch_assoc()){
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['nim']}</td>
                <td>{$row['jurusan']}</td>
                <td>
                    <a href='?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <button class='btn btn-danger btn-sm' onclick='hapusData({$row['id']})'>Hapus</button>
                </td>
            </tr>";
        }
        ?>
    </table>

    <div class="mt-3">
        <a href="dosen.php" class="btn btn-primary">Ke Halaman Dosen</a>
    </div>
</div>

<script>
function hapusData(id){
    if(confirm("Yakin ingin menghapus data ini?")){
        window.location = '?hapus=' + id;
    }
}
</script>
</body>
</html>
