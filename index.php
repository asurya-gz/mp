<!DOCTYPE html>
<html>

<head>
    <title>Halaman Login</title>
    <!-- Tambahkan link ke Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full">
        <h2 class="text-2xl font-semibold mb-4">Silakan Login</h2>
        <form method="POST" action="proses-login.php">
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
    </div>
</body>

</html>