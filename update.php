<?php
require "koneksi.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $koneksi->query("SELECT * FROM pendaftar WHERE id=$id");
    $data = $result->fetch_assoc();

    if (!$data) {
        die("Data tidak ditemukan!");
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = $_POST['password'];
    $jurusan = $_POST['jurusan'];
    $gender = $_POST['gender'];
    $alasan = $_POST['alasan'];
    $minat = isset($_POST['minat']) ? implode(", ", $_POST['minat']) : '-';

    $query = "UPDATE pendaftar SET 
              nama='$nama',
              email='$email',
              no_hp='$no_hp',
              password='$password',
              jurusan='$jurusan',
              gender='$gender',
              alasan='$alasan',
              minat_topik='$minat'
            WHERE id=$id";

    if ($koneksi->query($query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal update data: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand font-weight-bold" href="index.php">Kabar Kampus</a>
            <a class="btn btn-danger" href="index.php">Kembali</a>
        </div>
    </nav>

    <!-- Form Update -->
    <div class="d-flex justify-content-center mt-5">
        <div class="w-50 bg-light p-4 rounded shadow">
            <h2 class="text-center mb-4">Update Data</h2>
            <hr>
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Alamat Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']); ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nomor Telepon</label>
                        <input type="text" name="no_hp" class="form-control" value="<?= htmlspecialchars($data['no_hp']); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Password Akun</label>
                        <input type="password" name="password" class="form-control" value="<?= htmlspecialchars($data['password']); ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Jurusan</label>
                    <select name="jurusan" class="form-control">
                        <?php
                        $jurusanList = ['Informatika', 'Sistem Informasi', 'Ilmu Komunikasi', 'Teknik Elektro', 'Manajemen'];
                        foreach ($jurusanList as $j) {
                            $selected = ($data['jurusan'] == $j) ? 'selected' : '';
                            echo "<option $selected>$j</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Minat Topik -->
                <div class="mb-3">
                    <label class="d-block mb-2">Minat Topik (Bisa pilih lebih dari satu)</label>
                    <?php
                    $minatSimpan = explode(", ", $data['minat_topik']);
                    $topikList = ['Event Kampus', 'Teknologi', 'Politik', 'Musik'];
                    foreach ($topikList as $t) {
                        $checked = in_array($t, $minatSimpan) ? 'checked' : '';
                        echo "
              <div class='form-check'>
                <input class='form-check-input' type='checkbox' name='minat[]' value='$t' $checked>
                <label class='form-check-label'>$t</label>
              </div>
            ";
                    }
                    ?>
                </div>


                <div class="mb-3">
                    <label class="d-block mb-2">Gender</label>
                    <?php
                    $gender = $data['gender'];
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Laki-laki" <?= ($gender == 'Laki-laki') ? 'checked' : ''; ?>>
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Perempuan" <?= ($gender == 'Perempuan') ? 'checked' : ''; ?>>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Lainnya" <?= ($gender == 'Lainnya') ? 'checked' : ''; ?>>
                        <label class="form-check-label">Lainnya</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Alasan Bergabung</label>
                    <textarea name="alasan" class="form-control" rows="3"><?= htmlspecialchars($data['alasan']); ?></textarea>
                </div>

                <div class="d-flex mb-3 mt-2">
                    <button type="submit" class="btn btn-primary w-75">Update Data</button>
                    <button type="reset" class="btn btn-danger w-25 ml-2">Reset</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>