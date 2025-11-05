<?php
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $no_hp = $_POST['no_hp'];
  $password = $_POST['password'];
  $jurusan = $_POST['jurusan'];
  $gender = $_POST['gender'];
  $alasan = $_POST['alasan'];
  $minat = isset($_POST['minat']) ? implode(", ", $_POST['minat']) : '-';

  $query = "INSERT INTO pendaftar (nama, email, no_hp, password, jurusan, gender, alasan, minat_topik)
            VALUES ('$nama','$email','$no_hp','$password','$jurusan','$gender','$alasan','$minat')";

  if ($koneksi->query($query)) {
    header("Location: index.php");
    exit;
  } else {
    echo "Gagal menambahkan data: " . $koneksi->error;
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Registrasi</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container d-flex justify-content-between">
      <a class="navbar-brand font-weight-bold" href="index.php">Kabar Kampus</a>
      <a class="btn btn-danger" href="index.php">Kembali</a>
    </div>
  </nav>

  <!-- Form -->
  <div class="d-flex justify-content-center mt-5">
    <div class="w-50 bg-light p-4 rounded shadow">
      <h2 class="text-center mb-4">Formulir Pendaftaran Akun</h2>
      <hr>

      <form method="POST">
        <!-- Nama & Email -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
          </div>
        </div>

        <!-- Telepon & Password -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Nomor HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>

        <!-- Jurusan -->
        <div class="mb-3">
          <label>Jurusan</label>
          <select name="jurusan" class="form-control" required>
            <option selected disabled>Pilih Jurusan ...</option>
            <option>Informatika</option>
            <option>Sistem Informasi</option>
            <option>Ilmu Komunikasi</option>
            <option>Teknik Elektro</option>
            <option>Manajemen</option>
          </select>
        </div>

        <!-- Minat -->
        <div class="mb-3">
          <label class="d-block mb-2">Minat Topik (Bisa pilih lebih dari satu)</label>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="minat[]" value="Event Kampus"> Event Kampus</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="minat[]" value="Teknologi"> Teknologi</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="minat[]" value="Politik"> Politik</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="minat[]" value="Musik"> Musik</div>
        </div>

        <!-- Gender -->
        <div class="mb-3">
          <label class="d-block mb-2">Gender</label>
          <div class="form-check"><input class="form-check-input" type="radio" name="gender" value="Laki-laki"> Laki-laki</div>
          <div class="form-check"><input class="form-check-input" type="radio" name="gender" value="Perempuan"> Perempuan</div>
          <div class="form-check"><input class="form-check-input" type="radio" name="gender" value="Lainnya"> Lainnya</div>
        </div>

        <!-- Alasan -->
        <div class="mb-3">
          <label>Alasan Bergabung</label>
          <textarea name="alasan" class="form-control" rows="3" required></textarea>
        </div>

        <!-- Tombol -->
        <div class="d-flex mb-3 mt-2">
          <button type="submit" class="btn btn-primary w-75">Daftar Sekarang</button>
          <button type="reset" class="btn btn-danger w-25 ml-2">Reset</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>