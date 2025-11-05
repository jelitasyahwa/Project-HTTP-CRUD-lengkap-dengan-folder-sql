<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_pendaftar";

$koneksi = new mysqli($hostname, $username, $password, $database);

if($koneksi->connect_error){
    die("Koneksi gagal:".$koneksi->connect_error);
}
?>