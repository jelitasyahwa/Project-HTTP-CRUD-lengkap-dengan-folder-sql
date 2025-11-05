<?php
require "koneksi.php";

if (!isset($_GET['id'])) die("ID tidak ditemukan.");
$id = (int) $_GET['id'];
if ($koneksi->query("DELETE FROM pendaftar WHERE id=$id")) {
    echo "<script>alert('Data berhasil dihapus!')</script>";
    header("location:index.php");
}

$cek = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah from pendaftar");
$data = mysqli_fetch_assoc($cek);

if($data['jumlah'] == 0){
    mysqli_query($koneksi, "ALTER table pendaftar AUTO_INCREMENT = 1");
}
?>