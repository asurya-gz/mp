<?php
include('../database/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idbuku = $_POST['idbuku'];
    $isbn = $_POST['isbn'];
    $judul = $_POST['judul'];
    // Lanjutkan dengan mengambil dan memproses data lain sesuai dengan spesifikasi

    // Simpan data ke database (misalnya dengan query UPDATE)
    $query = "UPDATE buku SET isbn = '$isbn', judul = '$judul' WHERE idbuku = $idbuku";
    if ($koneksi->query($query) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
