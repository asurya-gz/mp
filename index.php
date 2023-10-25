<!DOCTYPE html>
<html>

<head>
    <title>Halaman Login</title>
    <!-- Tambahkan link ke Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full">
        <h2 class="text-2xl font-semibold mb-4">Login</h2>
        <form method="POST" action="index.php">
            <div class="mb-4">
                <label for="email" class="block text-gray-600">email:</label>
                <input type="text" name="email" id="email" required class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-600">Password:</label>
                <input type="password" name="password" id="password" required class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Login</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Membuat koneksi ke database
            include 'database/db.php'; // Pastikan pathnya benar

            // Mendapatkan data dari formulir login
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
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
                    echo "Login gagal. Mohon input password dan email yang benar";
                }
            }
        }
        ?>
    </div>
</body>

</html>