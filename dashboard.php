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
                    <a href="#pinjam" id="peminjaman" class="text-white hover:bg-gray-600 px-4 py-2 block">Peminjaman</a>
                </li>
                <li class="mb-2">
                    <a href="#kembali" id="pengembalian" class="text-white hover:bg-gray-600 px-4 py-2 block">Pengembalian</a>
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
            <div class="verif min-h-screen w-full mb-4" id="verif">
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

            <!-- Peinjaman -->
            <div class="peminjaman min-h-screen flex flex-col items-center justify-center" id="pinjam">
                <h1 class="text-2xl font-bold mb-4">Peminjaman Buku</h1>
                <?php
                // Sambungkan ke database (gunakan koneksi yang telah ada)
                include "database/db.php";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $user = $_POST["users"];
                    $isbn = $_POST["buku"];

                    // Set nilai default "jumlah_pinjam" ke 1
                    $jumlah_pinjam = 1;

                    // Hitung tanggal peminjaman (hari ini)
                    $tanggal_pinjam = date('Y-m-d');

                    // Hitung tanggal pengembalian (14 hari setelah tanggal peminjaman)
                    $tanggal_pengembalian = date('Y-m-d', strtotime($tanggal_pinjam . ' + 14 days'));

                    // Lakukan validasi data sesuai kebutuhan Anda

                    // Hitung jumlah buku yang telah dipinjam oleh pengguna
                    $sqlJumlahPeminjaman = "SELECT COUNT(*) AS jumlah_peminjaman FROM peminjaman WHERE peminjam = '$user'";
                    $resultJumlahPeminjaman = mysqli_query($koneksi, $sqlJumlahPeminjaman);
                    $rowJumlahPeminjaman = mysqli_fetch_assoc($resultJumlahPeminjaman);
                    $jumlah_peminjaman = $rowJumlahPeminjaman['jumlah_peminjaman'];

                    if ($jumlah_peminjaman < 2) {
                        // Pengguna diperbolehkan meminjam buku
                        // Pastikan buku masih memiliki stok tersedia
                        $sqlCekStok = "SELECT stok_tersedia FROM buku WHERE isbn = '$isbn'";
                        $resultCekStok = mysqli_query($koneksi, $sqlCekStok);
                        $rowCekStok = mysqli_fetch_assoc($resultCekStok);
                        $stok_tersedia = $rowCekStok['stok_tersedia'];

                        if ($stok_tersedia > 0) {
                            // Simpan data peminjaman ke tabel "peminjaman"
                            $sqlPeminjaman = "INSERT INTO peminjaman (tgl_pinjam, tanggal_pengembalian, isbn, peminjam, jumlah_pinjam) VALUES ('$tanggal_pinjam', '$tanggal_pengembalian', '$isbn', '$user', $jumlah_pinjam)";
                            if (mysqli_query($koneksi, $sqlPeminjaman)) {
                                // Peminjaman berhasil disimpan

                                // Kurangi stok_tersedia di tabel "buku"
                                $sqlKurangiStok = "UPDATE buku SET stok_tersedia = stok_tersedia - $jumlah_pinjam WHERE isbn = '$isbn'";
                                if (mysqli_query($koneksi, $sqlKurangiStok)) {
                                    echo "Peminjaman berhasil! Stok buku telah diperbarui.";
                                } else {
                                    echo "Peminjaman berhasil, tetapi ada masalah dalam mengurangi stok buku: " . mysqli_error($koneksi);
                                }
                            } else {
                                echo "Peminjaman gagal: " . mysqli_error($koneksi);
                            }
                        } else {
                            echo "Peminjaman gagal: Stok buku habis.";
                        }
                    } else {
                        echo "Peminjaman gagal: Anda telah mencapai batas maksimum peminjaman (2 buku).";
                    }
                }
                ?>

                <form action="#" method="post">
                    <!-- Dropdown untuk User -->
                    <label for="users" class="mb-2 text-lg">Pilih User:</label>
                    <select id="users" name="users" class="p-2 border rounded w-64"> <!-- Gaya w-64 untuk membuat dropdown lebih lebar -->
                        <?php
                        // Query untuk mengambil data user dari database
                        $sql = "SELECT name FROM users WHERE status = 1";
                        $result = mysqli_query($koneksi, $sql);

                        // Loop untuk mengisi dropdown dengan data user
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                        }
                        ?>
                    </select>

                    <!-- Dropdown untuk Buku -->
                    <!-- Dropdown untuk Buku -->
                    <label for="buku" class="mt-4 mb-2 text-lg">Pilih Buku:</label>
                    <select id="buku" name="buku" class="p-2 border rounded">
                        <?php

                        // Query untuk mengambil data buku dari database
                        $sqlBuku = "SELECT judul, isbn FROM buku";
                        $resultBuku = mysqli_query($koneksi, $sqlBuku);

                        // Loop untuk mengisi dropdown dengan data buku
                        while ($rowBuku = mysqli_fetch_assoc($resultBuku)) {
                            echo '<option value="' . $rowBuku['isbn'] . '">' . $rowBuku['judul'] . ' - ' . $rowBuku['isbn'] . '</option>';
                        }
                        ?>
                    </select>

                    <!-- Tombol Submit -->
                    <button id="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </form>
                <!-- Monitor -->
                <div class="monitor-peminjam p-4">
                    <h1 class="text-2xl font-bold mb-4 mt-9">Pinjaman - Berlangsung</h1>

                    <?php
                    // Sambungkan ke database (gunakan koneksi yang telah ada)
                    include "database/db.php";

                    // Query untuk mengambil data peminjaman dengan informasi peminjam, ISBN, judul buku, dan tanggal_pengembalian
                    $sql = "SELECT peminjaman.peminjam, peminjaman.isbn, buku.judul, peminjaman.tanggal_pengembalian
            FROM peminjaman
            LEFT JOIN buku ON peminjaman.isbn = buku.isbn
            ORDER BY peminjaman.peminjam, peminjaman.isbn";

                    $result = mysqli_query($koneksi, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="overflow-x-auto">';
                        echo '<table class="min-w-full border rounded-lg">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th class="px-4 py-2">Peminjam</th>';
                        echo '<th class="px-4 py-2">ISBN</th>';
                        echo '<th class="px-4 py-2">Judul Buku</th>';
                        echo '<th class="px-4 py-2">Tanggal Pengembalian</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="border px-4 py-2">' . $row['peminjam'] . '</td>';
                            echo '<td class="border px-4 py-2">' . $row['isbn'] . '</td>';
                            echo '<td class="border px-4 py-2">' . $row['judul'] . '</td>';
                            echo '<td class="border px-4 py-2">' . $row['tanggal_pengembalian'] . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    } else {
                        echo 'Tidak ada data peminjaman yang berlangsung.';
                    }
                    ?>
                </div>
                <!-- Monitor end-->

                <!-- Terlambat -->
                <div class="terlambat">
                    <h1 class="text-2xl font-bold mb-4 mt-8">Pengembalian Terlambat</h1>

                    <?php

                    // Query untuk mengambil peminjaman yang terlambat
                    $sql = "SELECT peminjaman.peminjam, peminjaman.isbn, buku.judul, peminjaman.tanggal_pengembalian,
            DATEDIFF(NOW(), peminjaman.tanggal_pengembalian) AS keterlambatan,
            DATEDIFF(NOW(), peminjaman.tanggal_pengembalian) * 1000 AS denda
            FROM peminjaman
            LEFT JOIN buku ON peminjaman.isbn = buku.isbn
            WHERE peminjaman.tanggal_pengembalian < NOW()";

                    $result = mysqli_query($koneksi, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="overflow-x-auto">';
                        echo '<table class="min-w-full border rounded-lg">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th class="px-4 py-2">Peminjam</th>';
                        echo '<th class="px-4 py-2">ISBN</th>';
                        echo '<th class="px-4 py-2">Judul Buku</th>';
                        echo '<th class="px-4 py-2">Tanggal Pengembalian</th>';
                        echo '<th class="px-4 py-2">Keterlambatan (hari)</th>';
                        echo '<th class="px-4 py-2">Denda</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="border px-4 py-2">' . $row['peminjam'] . '</td>';
                            echo '<td class="border px-4 py-2">' . $row['isbn'] . '</td>';
                            echo '<td class="border px-4 py-2">' . $row['judul'] . '</td>';
                            echo '<td class="border px-4 py-2">' . $row['tanggal_pengembalian'] . '</td>';
                            echo '<td class="border px-4 py-2">' . $row['keterlambatan'] . '</td>';
                            echo '<td class="border px-4 py-2">' . $row['denda'] . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    } else {
                        echo 'Tidak ada peminjaman yang terlambat.';
                    }
                    ?>
                </div>


                <!-- Terlambat end -->
            </div>
            <!-- Peinjaman end -->

            <!-- Pengembalian -->
            <div class="kembali w-full min-h-screen" id="kembali">
                <h1 class="text-2xl font-bold mb-4">Pengembalian</h1>

                <?php

                // Query untuk mengambil seluruh data dari tabel peminjaman
                $sql = "SELECT * FROM peminjaman";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="overflow-x-auto">';
                    echo '<table class="min-w-full border rounded-lg">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th class="px-4 py-2">ID Transaksi</th>';
                    echo '<th class="px-4 py-2">Tanggal Pinjam</th>';
                    echo '<th class="px-4 py-2">ISBN</th>';
                    echo '<th class="px-4 py-2">Peminjam</th>';
                    echo '<th class="px-4 py-2">Jumlah Pinjam</th>';
                    echo '<th class="px-4 py-2">Tanggal Pengembalian</th>';
                    echo '<th class="px-4 py-2">Denda</th>';
                    echo '<th class="px-4 py-2">Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td class="border px-4 py-2">' . $row['idtransaksi'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['tgl_pinjam'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['isbn'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['peminjam'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['jumlah_pinjam'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['tanggal_pengembalian'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['denda'] . '</td>';
                        echo '<td class="border px-4 py-2"><button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="kembalikan(' . $row['idtransaksi'] . ')">Kembalikan</button></td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo 'Tidak ada data peminjaman.';
                }
                ?>
            </div>

            <!-- Pengembalian end -->
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
        // JavaScript untuk mengisi dropdown User dan Buku dari data yang sesuai
        document.addEventListener("DOMContentLoaded", function() {
            // Simulasi data User (gantilah dengan data yang sesuai dari database)
            const userData = [{
                    nama: "User 1",
                    status: 1
                },
                {
                    nama: "User 2",
                    status: 1
                },
                {
                    nama: "User 3",
                    status: 1
                },
            ];

            // Simulasi data buku (gantilah dengan data yang sesuai dari database)
            const bukuData = [{
                    judul: "Buku 1",
                    isbn: "ISBN-1"
                },
                {
                    judul: "Buku 2",
                    isbn: "ISBN-2"
                },
                {
                    judul: "Buku 3",
                    isbn: "ISBN-3"
                },
            ];

            const userDropdown = document.getElementById("user");
            const bukuDropdown = document.getElementById("buku");

            // Isi dropdown User dengan data yang memiliki status 1 (aktif)
            userData
                .filter((user) => user.status === 1)
                .forEach((user) => {
                    const option = document.createElement("option");
                    option.value = user.nama;
                    option.text = user.nama;
                    userDropdown.appendChild(option);
                });

            // Isi dropdown Buku dengan data buku
            bukuData.forEach((buku) => {
                const option = document.createElement("option");
                option.value = buku.isbn;
                option.text = buku.judul + " - " + buku.isbn;
                bukuDropdown.appendChild(option);
            });
        });

        // Event listener untuk tombol Submit
        const submitButton = document.getElementById("submit");
        submitButton.addEventListener("click", function() {
            // Lakukan tindakan saat tombol Submit ditekan
            // Misalnya, validasi input dan mengirim data ke server
        });
    </script>

</body>

</html>