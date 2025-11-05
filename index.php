<?php
require "koneksi.php";

$query = "SELECT * FROM pendaftar";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pendaftar - Kabar Kampus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<style>
  .card img {
    height: 200px;
    width: 100%;
    object-fit: cover;
  }
  .btn i {
    font-size: 1rem;
  }
</style>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container d-flex justify-content-between">
      <a class="navbar-brand fw-bold" href="index.php">Kabar Kampus</a>
      <a class="btn btn-success" href="form.php">Form Registrasi</a>
    </div>
  </nav>

  <section class="container my-3">
    <h2 class="mb-3">Dashboard Pendaftaran</h2>

    <table class="table text-center align-middle">
      <thead class="table">
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Jurusan</th>
          <th>Gender</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = $koneksi->query("SELECT * FROM pendaftar ORDER BY id DESC");
        if ($result->num_rows > 0):
          while ($row = $result->fetch_assoc()):
        ?>
          <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['nama']); ?></td>
            <td><?= htmlspecialchars($row['jurusan']); ?></td>
            <td><?= htmlspecialchars($row['gender']); ?></td>
            <td>
              
              <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary me-1" title="Detail">
                <i class="bi bi-eye"></i>
              </a>
              
              <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning me-1" title="Update">
                <i class="bi bi-pencil-square"></i>
              </a>
             
              <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger" title="Delete">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
        <?php
          endwhile;
        else:
        ?>
          <tr>
            <td colspan="5">Tidak ada data</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </section>
</body>
</html>
