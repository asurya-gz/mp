<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="js/dashboard.js"></script>
</head>

<body>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-4">
            <h1 class="text-2xl font-bold mb-4">Operator</h1>
            <ul>
                <li class="mb-2">
                    <a href="#" id="beranda" class="text-white hover:bg-gray-600 px-4 py-2 block">Beranda</a>
                </li>
                <li class="mb-2">
                    <a href="#" id="profil" class="text-white hover:bg-gray-600 px-4 py-2 block">Profil</a>
                </li>
                <li class="mb-2">
                    <a href="#" id="pengaturan" class="text-white hover:bg-gray-600 px-4 py-2 block">Pengaturan</a>
                </li>
                <li>
                    <a href="#" id="logout" class="text-white hover:bg-gray-600 px-4 py-2 block">Logout</a>
                </li>
            </ul>
        </aside>


        <!-- Content -->
        <main class="flex-1 p-4">
            <h1 class="text-2xl font-bold mb-4">Daftar Buku</h1>
            <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Tambah Buku</a>
            <table class="w-full border mt-8">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID Buku</th>
                        <th class="border px-4 py-2">ISBN</th>
                        <th class="border px-4 py-2">Judul</th>
                        <!-- Tambahkan kolom lain sesuai dengan spesifikasi -->
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('database/db.php');
                    $query = "SELECT * FROM buku";
                    $result = $koneksi->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='border px-4 py-2'>" . $row['idbuku'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row['isbn'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row['judul'] . "</td>";
                            // Tampilkan kolom lain sesuai dengan spesifikasi
                            echo "<td class='border px-4 py-2'>";
                            echo "<a href='edit.php?id=" . $row['idbuku'] . "' class='bg-yellow-500 text-white px-2 py-1 rounded mr-2'>Edit</a>";
                            echo "<a href='proses_hapus.php?id=" . $row['idbuku'] . "' class='bg-red-500 text-white px-2 py-1 rounded'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td class='border px-4 py-2' colspan='4'>Tidak ada buku yang tersedia.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>


    </div>

    <!-- Panggil fungsi showNotification saat halaman dimuat -->
    <script>
        window.onload = showNotification;
        const sidebarItems = document.querySelectorAll("aside a");

        // Fungsi untuk mengatur item yang aktif
        function setActiveItem(activeId) {
            sidebarItems.forEach((item) => {
                item.classList.remove("bg-green-600"); // Hapus warna latar belakang aktif
                item.classList.remove("text-gray-100"); // Hapus warna teks aktif
            });

            const activeItem = document.getElementById(activeId);
            if (activeItem) {
                activeItem.classList.add("bg-green-600"); // Atur warna latar belakang aktif
                activeItem.classList.add("text-gray-100"); // Atur warna teks aktif
            }
        }

        // Tambahkan event listener untuk setiap item sidebar
        sidebarItems.forEach((item) => {
            item.addEventListener("click", (e) => {
                const activeId = e.target.id;
                setActiveItem(activeId);
            });
        });

        // Atur item pertama sebagai aktif saat halaman dimuat
        setActiveItem("beranda");
    </script>

</body>

</html>