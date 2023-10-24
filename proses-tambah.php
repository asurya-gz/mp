<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="js/dashboard.js"></script>
</head>

<?php
include('database/db.php');

$judul = $isbn = $idkategori = $pengarang = $penerbit = $kota_terbit = $editor = $file_gambar = $tgl_insert = $tgl_update = $stok = $stok_tersedia = null;

// Memeriksa apakah user belum menekan tombol submit
if (isset($_POST['submit'])) {
    $valid = TRUE;
    $judul = $_POST['judul'];
    $isbn = $_POST['isbn'];
    $idkategori = $_POST['idkategori'];
    $pengarang = $_POST['pengarang'];
    $kota_terbit = $_POST['kota_terbit'];
    $editor = $_POST['editor'];
    $file_gambar = $_POST['file_gambar'];
    $tgl_insert = $_POST['tgl_insert'];
    $tgl_update = $tgl_insert;
    $stok = $_POST['stok'];
    $stok_tersedia = $stok;

    // Update data into database
    if ($valid) {
        // Escape inputs data
        $judul = $koneksi->real_escape_string($judul);
        $isbn = $koneksi->real_escape_string($isbn);

        // Assign a query
        $query = "INSERT INTO buku (isbn, judul, idkategori, pengarang, penerbit, kota_terbit, editor, file_gambar, tgl_insert, tgl_update, stok, stok_tersedia ) VALUES ('$isbn', '$judul', '$idkategori', '$pengarang', '$penerbit', '$kota_terbit', '$editor', '$file_gambar', '$tgl_insert', '$tgl_update', '$stok', '$stok_tersedia')";

        // Execute the query
        $result = $koneksi->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $koneksi->error . "<br>Query: " . $query);
        } else {
            $koneksi->close();
            header('Location: dashboard.php');
        }
    }
}
?>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded p-4">
            <h5 class="text-white bg-darkblue p-2 rounded">Tambahkan Buku</h5>
            <div class="p-4">
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" autocomplete="on">
                    <div class="mb-4">
                        <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN:</label>
                        <input type="text" id="isbn" name="isbn" value="<?php echo $isbn; ?>" class="border border-gray-300 rounded p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700">Judul:</label>
                        <input type="text" id="judul" name="judul" value="<?php echo $judul; ?>" class="border border-gray-300 rounded p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="idkategori" class="block text-sm font-medium text-gray-700">ID Kategori:</label>
                        <input type="text" id="idkategori" name="idkategori" value="<?= $idkategori ?>" class="border border-gray-300 rounded p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="pengarang" class="block text-sm font-medium text-gray-700">Pengarang:</label>
                        <input type="text" id="pengarang" name="pengarang" value="<?= $pengarang ?>" class="border border-gray-300 rounded p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="kota_terbit" class="block text-sm font-medium text-gray-700">Kota Terbit:</label>
                        <input type="text" id="kota_terbit" name="kota_terbit" value="<?= $kota_terbit ?>" class="border border-gray-300 rounded p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="editor" class="block text-sm font-medium text-gray-700">Editor:</label>
                        <input type="text" id="editor" name="editor" value="<?= $editor ?>" class="border border-gray-300 rounded p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="tgl_insert" class="block text-sm font-medium text-gray-700">Tanggal Input:</label>
                        <input type="text" id="tgl_insert" name="tgl_insert" value="<?= $tgl_insert ?>" class="border border-gray-300 rounded p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="stok" class="block text-sm font-medium text-gray-700">Stok:</label>
                        <input type="text" id="stok" name="stok" value="<?= $stok ?>" class="border border-gray-300 rounded p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="file_gambar" class="block text-sm font-medium text-gray-700">Path Gambar Test:</label>
                        <input type="text" id="file_gambar" name="file_gambar" value="<?= $stok ?>" class="border border-gray-300 rounded p-2 w-full">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded" name="submit" value="submit">Submit</button>
                        <a href="dashboard.php" class="bg-gray-400 text-white p-2 rounded ml-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?php
$koneksi->close();
?>

</html>