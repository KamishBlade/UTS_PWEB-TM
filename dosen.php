<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h2 class="text-center mb-4">Data Dosen</h2>

    <?php
    if(isset($_POST['tambah'])){
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $matkul = $_POST['matkul'];
        $conn->query("INSERT INTO dosen (nama, nip, mata_kuliah) VALUES ('$nama', '$nip', '$matkul')");
    }

    if(isset($_GET['hapus'])){
        $id = $_GET['hapus'];
        $conn->query("DELETE FROM dosen WHERE id=$id");
        echo "<script>alert('Data dihapus!');window.location='dosen.php';</script>";
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $matkul = $_POST['matkul'];
        $conn->query("UPDATE dosen SET nama='$nama', nip='$nip', mata_kuliah='$matkul' WHERE id=$id");
        echo "<script>alert('Data diupdate!');window.location='dosen.php';</script>";
    }
    ?>

    <form method="POST" class="card p-3 mb-4">
        <h5>Form Dosen</h5>
        <?php
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];
            $data = $conn->query("SELECT * FROM dosen WHERE id=$id")->fetch_assoc();
        }
        ?>
        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Dosen" required value="<?= isset($data['nama']) ? $data['nama'] : '' ?>">
        <input type="text" name="nip" class="form-control mb-2" placeholder="NIP" required value="<?= isset($data['nip']) ? $data['nip'] : '' ?>">
        <input type="text" name="matkul" class="form-control mb-2" placeholder="Mata Kuliah" required value="<?= isset($data['mata_kuliah']) ? $data['mata_kuliah'] : '' ?>">
        <button class="btn btn-success" name="<?= isset($_GET['edit']) ? 'update' : 'tambah'; ?>">
            <?= isset($_GET['edit']) ? 'Update Data' : 'Tambah Data'; ?>
        </button>
    </form>

    <table class="table table-bordered table-striped">
        <tr><th>ID</th><th>Nama</th><th>NIP</th><th>Mata Kuliah</th><th>Aksi</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM dosen");
        while($row = $result->fetch_assoc()){
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['nip']}</td>
                <td>{$row['mata_kuliah']}</td>
                <td>
                    <a href='?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <button class='btn btn-danger btn-sm' onclick='hapusData({$row['id']})'>Hapus</button>
                </td>
            </tr>";
        }
        ?>
    </table>

    <a href="matakuliah.php" class="btn btn-primary mt-3">Ke Halaman Matakuliah</a>
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
