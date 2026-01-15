<?php
session_start();
// CEK LOGIN
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit();
}

require('../koneksi.php');

// ================= CREATE =================
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $prodi_id = $_POST['prodi_id'];

    $sql = "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat, prodi_id)
            VALUES ('$nim','$nama_mhs','$tgl_lahir','$alamat','$prodi_id')";

    $koneksi->query($sql);
    header("Location: index.php");
    exit();
}

// ================= UPDATE =================
if (isset($_POST['update'])) {
    $nim = intval($_POST['nim']);
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $prodi_id = $_POST['prodi_id'];

    $sql = "UPDATE mahasiswa SET
                nama_mhs='$nama_mhs',
                tgl_lahir='$tgl_lahir',
                alamat='$alamat',
                prodi_id='$prodi_id'
            WHERE nim=$nim";

    if ($koneksi->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Maaf, data gagal diubah: " . $koneksi->error;
    }
}

// ================= DELETE =================
if (isset($_GET['nim'])) {
    $nim = intval($_GET['nim']);
    $sql = "DELETE FROM mahasiswa WHERE nim=$nim";

    if ($koneksi->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data";
    }
}
