<?php
include('../database/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = $_POST['isbn'];
    $judul = $_POST['judul'];
    // Lanjutkan dengan mengambil dan memproses data lain sesuai dengan spesifikasi

    // Simpan data ke database (misalnya dengan query INSERT)
    $query = "INSERT INTO buku (isbn, judul) VALUES ('$isbn', '$judul')";
    if ($koneksi->query($query) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
