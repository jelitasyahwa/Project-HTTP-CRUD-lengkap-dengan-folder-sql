<?php
require "koneksi.php";

if (!isset($_GET['id'])) die("ID tidak ditemukan.");

$id = (int) $_GET['id'];
$result = $koneksi->query("SELECT * FROM pendaftar WHERE id = $id");

if ($result->num_rows == 0) {
    die("Data tidak ditemukan.");
}

$data = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .list-group-item {
            border: none;             
            padding: 8px 0;           
            background-color: transparent; 
        }
    </style>
</head>
<body>
<nav class="navbar bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand fw-bold">Kabar Kampus</a>
        <a class="btn btn-success" href="form.php" role="button">Form Registrasi</a>
    </div>
</nav>

<div class="container my-5">
    <div class="card p-3 mb-2 bg-secondary-subtle text-secondary-emphasis shadow-sm">
        <div class="card-body">
            <h5>Data Pendaftar</h5>
            <ul class="list-group">
                <li class="list-group-item">ID: <?= htmlspecialchars($data['id']) ?></li>
                <li class="list-group-item">Nama: <?= htmlspecialchars($data['nama']) ?></li>
                <li class="list-group-item">Email: <?= htmlspecialchars($data['email']) ?></li>
                <li class="list-group-item">Nomor Telepon: <?= htmlspecialchars($data['no_hp']) ?></li>
                <li class="list-group-item">Password: <?= htmlspecialchars($data['password']) ?></li>
                <li class="list-group-item">Jurusan: <?= htmlspecialchars($data['jurusan']) ?></li>

                
                <li class="list-group-item">
                    Minat Topik:
                    <?php
                    $minat = trim($data['minat_topik']);
                    if (empty($minat) || $minat === "-") {
                        echo "-";
                    } else {
                        
                        $minatList = array_map('trim', explode(",", $minat));
                        $minatFormatted = implode(", ", $minatList) . ".";
                        echo htmlspecialchars($minatFormatted);
                    }
                    ?>
                </li>

                <li class="list-group-item">Gender: <?= htmlspecialchars($data['gender']) ?></li>
                <li class="list-group-item">Alasan: <?= htmlspecialchars($data['alasan']) ?></li>
            </ul>
        </div>
    </div>
    <a href="index.php" class="btn btn-dark mt-3">Kembali ke Dashboard</a>
</div>
</body>
</html>
