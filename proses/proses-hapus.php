<?php
include('../database/db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idbuku = $_GET['id'];

    // Hapus data dari database (misalnya dengan query DELETE)
    $query = "DELETE FROM buku WHERE idbuku = $idbuku";
    if ($koneksi->query($query) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
