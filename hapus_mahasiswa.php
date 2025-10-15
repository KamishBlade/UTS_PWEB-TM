<?php
include 'database.php';
$id = $_GET['id'];
$koneksi->query("DELETE FROM mahasiswa WHERE id=$id");
header("Location: mahasiswa.php");
?>
