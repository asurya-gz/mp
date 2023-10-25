<?php
if (isset($_POST['user_id'])) {
    include('database/db.php');
    $userId = $_POST['user_id'];

    $query = "UPDATE users SET status = 1 WHERE id = $userId";
    $result = $koneksi->query($query);

    if ($result) {
        echo 'success'; // Jika berhasil
    } else {
        echo 'error'; // Jika gagal
    }
}
