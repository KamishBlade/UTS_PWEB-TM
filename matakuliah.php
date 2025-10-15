<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Matakuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h2 class="text-center mb-4">Data Matakuliah</h2>

    <?php
    if(isset($_POST['tambah'])){
        $nama = $_POST['nama'];
        $sks = $_POST['sks'];
        $dosen = $_POST['dosen'];
        $conn->query("INSERT INTO matakuliah (nama_matakuliah, sks, dosen_pengampu) VALUES ('$nama', '$sks', '$dosen')");
    }

    if(isset($_GET['hapus'])){
        $id = $_GET['hapus'];
        $conn->query("DELETE FROM matakuliah WHERE id=$id");
        echo "<script>alert('Data dihapus!');window.location='matakuliah.php';</script>";
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $sks = $_POST['sks'];
        $dosen = $_POST['dosen'];
        $conn->query("UPDATE matakuliah SET nama_matakuliah='$nama', sks='$sks', dosen_pengampu='$dosen' WHERE id=$id");
        echo "<script>alert('Data diupdate!');window.location='matakuliah.php';</script>";
    }
    ?>

    <form method="POST" class="card p-3 mb-4">
        <h5>Form Matakuliah</h5>
        <?php
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];
            $data = $conn->query("SELECT * FROM matakuliah WHERE id=$id")->fetch_assoc();
        }
        ?>
        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Matakuliah" required value="<?= isset($data['nama_matakuliah']) ? $data['nama_matakuliah'] : '' ?>">
        <input type="number" name="sks" class="form-control mb-2" placeholder="Jumlah SKS" required value="<?= isset($data['sks']) ? $data['sks'] : '' ?>">
        <input type="text" name="dosen" class="form-control mb-2" placeholder="Dosen Pengampu" required value="<?= isset($data['dosen_pengampu']) ? $data['dosen_pengampu'] : '' ?>">
        <button class="btn btn-success" name="<?= isset($_GET['edit']) ? 'update' : 'tambah'; ?>">
            <?= isset($_GET['edit']) ? 'Update Data' : 'Tambah Data'; ?>
        </button>
    </form>

    <table class="table table-bordered table-striped">
        <tr><th>ID</th><th>Nama</th><th>SKS</th><th>Dosen Pengampu</th><th>Aksi</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM matakuliah");
        while($row = $result->fetch_assoc()){
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nama_matakuliah']}</td>
                <td>{$row['sks']}</td>
                <td>{$row['dosen_pengampu']}</td>
                <td>
                    <a href='?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <button class='btn btn-danger btn-sm' onclick='hapusData({$row['id']})'>Hapus</button>
                </td>
            </tr>";
        }
        ?>
    </table>

    <a href="mahasiswa.php" class="btn btn-primary mt-3">Ke Halaman Mahasiswa</a>
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
