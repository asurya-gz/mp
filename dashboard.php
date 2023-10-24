<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="js/dashboard.js"></script>
    <script>
        function verifikasi(userId) {
            if (confirm('Apakah Anda yakin ingin memverifikasi pengguna ini?')) {
                // Jika pengguna mengonfirmasi, kirim permintaan AJAX ke server
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'verifikasi.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Respon dari server
                        if (xhr.responseText === 'success') {
                            // Status berhasil diubah, refresh halaman
                            location.reload();
                        } else {
                            alert('Gagal memverifikasi pengguna.');
                        }
                    }
                };
                xhr.send('user_id=' + userId);
            }
        }

        function nonAktifkan(userId) {
            if (confirm('Apakah Anda yakin ingin menonaktifkan pengguna ini?')) {
                // Jika pengguna mengonfirmasi, kirim permintaan AJAX ke server
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'nonaktifkan.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Respon dari server
                        if (xhr.responseText === 'success') {
                            // Status berhasil diubah, refresh halaman
                            location.reload();
                        } else {
                            alert('Gagal menonaktifkan pengguna.');
                        }
                    }
                };
                xhr.send('user_id=' + userId);
            }
        }
    </script>
    <style>
        /* Ganti warna latar belakang dan lebar sidebar sesuai kebutuhan */
        .fixed-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            /* Atur ke "right: 0;" jika ingin di kanan */
            width: 250px;
            /* Sesuaikan lebar sesuai keinginan */
            height: 100%;
            /* Ganti warna latar belakang sesuai keinginan */
            color: white;
            padding: 20px;
        }

        /* Tambahkan padding untuk konten utama agar tidak tertutupi oleh sidebar */
        .main-content {
            margin-left: 270px;
            /* Sesuaikan margin sesuai lebar sidebar */
            padding: 20px;
        }
    </style>

</head>

<body>
    <?php
    session_start();

    // Periksa apakah sesi login telah diinisialisasi
    if (!isset($_SESSION['email'])) {
        // Jika belum login, alihkan ke halaman login
        header("Location: index.php");
        exit;
    }
    ?>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="fixed-sidebar w-64 h-auto bg-gray-800 text-white p-4">
            <h1 class="text-2xl font-bold mb-4">Operator</h1>
            <ul>
                <li class="mb-2">
                    <a href="#" id="beranda" class="text-white hover:bg-gray-600 px-4 py-2 block">Beranda</a>
                </li>
                <li class="mb-2">
                    <a href="#verif" id="verifikasi" class="text-white hover:bg-gray-600 px-4 py-2 block">Verifikasi</a>
                </li>
                <li class="mb-2">
                    <a href="#" id="peminjaman" class="text-white hover:bg-gray-600 px-4 py-2 block">Peminjaman</a>
                </li>
                <li class="mb-2">
                    <a href="#" id="pengembalian" class="text-white hover:bg-gray-600 px-4 py-2 block">Pengembalian</a>
                </li>
                <li>
                    <a href="#" id="riwayat" class="text-white hover:bg-gray-600 px-4 py-2 block">Riwayat</a>
                </li>
            </ul>
        </aside>


        <!-- Content -->
        <main class="main-content flex-1 p-4">
            <!-- CRUD -->
            <div class="crud w-full min-h-screen" id="crud">
                <h1 class="text-2xl font-bold mb-4">Daftar Buku</h1>
                <a href="proses-tambah.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Tambah Buku</a>
                <div class="table-wrapper overflow-x-auto">
                    <table class="w-full border mt-8">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ISBN</th>
                                <th class="border px-4 py-2">Judul</th>
                                <th class="border px-4 py-2">ID Kategori</th>
                                <th class="border px-4 py-2">Pengarang</th>
                                <th class="border px-4 py-2">Penerbit</th>
                                <th class="border px-4 py-2">Kota Terbit</th>
                                <th class="border px-4 py-2">Editor</th>
                                <th class="border px-4 py-2">File Gambar</th>
                                <th class="border px-4 py-2">Tanggal Insert</th>
                                <th class="border px-4 py-2">Tanggal Update</th>
                                <th class="border px-4 py-2">Stok</th>
                                <th class="border px-4 py-2">Stok Tersedia</th>
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
                                    echo "<td class='border px-4 py-2'>" . $row['isbn'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['judul'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['idkategori'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['pengarang'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['penerbit'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['kota_terbit'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['editor'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['file_gambar'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['tgl_insert'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['tgl_update'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['stok'] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row['stok_tersedia'] . "</td>";
                                    echo "<td class='border px-4 py-2'>";
                                    echo "<a href='proses-edit.php?id=" . $row['idbuku'] . "' class='bg-yellow-500 text-white px-2 py-1 rounded mr-2'>Edit</a>";
                                    echo "<a href='proses-hapus.php?id=" . $row['idbuku'] . "' class='bg-red-500 text-white px-2 py-1 rounded'>Hapus</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td class='border px-4 py-2' colspan='14'>Tidak ada buku yang tersedia.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- End CRUD -->

            <!-- Verifikasi mahasiswa -->
            <div class="verif min-h-screen w-full" id="verif">
                <h1 class="text-2xl font-bold mb-4">Verifikasi</h1>

                <table class="w-full border">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Action</th> <!-- Tambahkan kolom Action -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('database/db.php');
                        $query = "SELECT * FROM users WHERE status = 0"; // Hanya anggota dengan status 0
                        $result = $koneksi->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='border px-4 py-2'>" . $row['id'] . "</td>";
                                echo "<td class='border px-4 py-2'>" . $row['name'] . "</td>";
                                echo "<td class='border px-4 py-2'>" . $row['email'] . "</td>";
                                // Tambahkan kolom Action dengan tombol "Verifikasi"
                                echo "<td class='border px-4 py-2'>";
                                echo "<button class='bg-blue-500 text-white px-4 py-2 rounded' onclick='verifikasi(" . $row['id'] . ")'>Verifikasi</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td class='border px-4 py-2' colspan='4'>Tidak ada anggota dengan status 0.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Sudah verifkasi -->
                <h1 class="text-2xl font-bold mb-4 mt-4">Anggota (terverifikasi)</h1>

                <table class="w-full border">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Action</th> <!-- Tambahkan kolom Action -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('database/db.php');
                        $query = "SELECT * FROM users WHERE status = 1"; // Hanya anggota dengan status 1
                        $result = $koneksi->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='border px-4 py-2'>" . $row['id'] . "</td>";
                                echo "<td class='border px-4 py-2'>" . $row['name'] . "</td>";
                                echo "<td class='border px-4 py-2'>" . $row['email'] . "</td>";
                                // Tambahkan kolom Action dengan tombol "Non-Aktifkan"
                                echo "<td class='border px-4 py-2'>";
                                echo "<button class='bg-red-500 text-white px-4 py-2 rounded' onclick='nonAktifkan(" . $row['id'] . ")'>Non-Aktifkan</button>";
                                // Anda dapat menambahkan tombol-tombol aksi lain di sini
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td class='border px-4 py-2' colspan='4'>Tidak ada anggota dengan status 1.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Verifikasi mahasiswa END -->

            <div class="anggota min-h-screen" id="anggota">

            </div>

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