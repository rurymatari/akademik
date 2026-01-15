<?php
session_start();
require 'koneksi.php'; // Pastikan file koneksi.php sudah ada di folder akademik

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mencari user berdasarkan username
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        // Memverifikasi password hash (karena saat register kita pakai password_hash)
        if (password_verify($password, $user['password'])) {
            // Menyimpan data ke session
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            
            // Perintah untuk pindah ke halaman Home (index.php)
            header("Location: index.php"); 
            exit();
        } else {
            echo "<script>alert('Password salah!'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location='login.php';</script>";
    }
}
?>