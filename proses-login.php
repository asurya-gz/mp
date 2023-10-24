<?php
// Membuat koneksi ke database
include 'database/db.php'; // Pastikan pathnya benar

// Mendapatkan data dari formulir login
$email = $_POST['email']; // Ganti 'username' dengan 'email'
$password = $_POST['password'];

// Melakukan query ke tabel petugas dengan menggunakan kolom 'email'
$query = "SELECT * FROM petugas WHERE email='$email' AND password='$password'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 1) {
    // Login berhasil, alihkan ke halaman lain atau berikan akses
    session_start();
    $_SESSION['email'] = $email; // Simpan email dalam sesi
    header("Location: dashboard.php"); // Ganti dengan halaman setelah login berhasil
} else {
    // Login gagal, tampilkan pesan kesalahan
    echo "Login gagal. Silakan coba lagi atau hubungi administrator.";
}
