<?php
session_start();
require '../koneksi.php';

// Pastikan sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit();
}

$id_user = $_SESSION['id_user'];

// Ambil data user yang sedang login
$query = $koneksi->query("SELECT * FROM users WHERE id_user = '$id_user'");
$data = $query->fetch_assoc();

// Proses Update
if (isset($_POST['update'])) {
    $nama_baru = $_POST['nama_lengkap'];
    $user_baru = $_POST['username'];

    $sql = "UPDATE users SET nama_lengkap = '$nama_baru', username = '$user_baru' WHERE id_user = '$id_user'";
    
    if ($koneksi->query($sql)) {
        $_SESSION['nama_lengkap'] = $nama_baru; // Update session agar nama di navbar berubah
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='../index.php';</script>";
    } else {
        echo "Gagal memperbarui: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil - UAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Profil Pengguna</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $data['username']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?= $data['nama_lengkap']; ?>" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                        <a href="../index.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>