<?php
include('database/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idbuku = $_POST['idbuku'];
    $isbn = $_POST['isbn'];
    $judul = $_POST['judul'];
    $idkategori = $_POST['idkategori'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $kota_terbit = $_POST['kota_terbit'];
    $editor = $_POST['editor'];
    $file_gambar = $_POST['file_gambar'];
    $tgl_update = date("Y-m-d", time());
    $stok = $_POST['stok'];
    $stok_tersedia = $_POST['stok_tersedia'];

    // Validasi input sesuai kebutuhan

    // Simpan data ke database (misalnya dengan query UPDATE)
    $query = "UPDATE buku SET isbn = '$isbn', judul = '$judul', idkategori = '$idkategori', pengarang = '$pengarang', penerbit = '$penerbit', kota_terbit = '$kota_terbit', editor = '$editor', file_gambar = '$file_gambar', tgl_update = '$tgl_update', stok = '$stok', stok_tersedia = '$stok_tersedia' WHERE idbuku = $idbuku";

    if ($koneksi->query($query) === TRUE) {
        // Redirect kembali ke halaman ini setelah pembaruan berhasil
        header("Location: dashboard.php?id=$idbuku");
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}

// Ambil data buku yang akan diedit dari database
if (isset($_GET['id'])) {
    $idbuku = $_GET['id'];
    $sql = "SELECT * FROM buku WHERE idbuku = $idbuku";
    $result = $koneksi->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $isbn = $row['isbn'];
        $judul = $row['judul'];
        $idkategori = $row['idkategori'];
        $pengarang = $row['pengarang'];
        $penerbit = $row['penerbit'];
        $kota_terbit = $row['kota_terbit'];
        $editor = $row['editor'];
        $file_gambar = $row['file_gambar'];
        $tgl_update = $row['tgl_update'];
        $stok = $row['stok'];
        $stok_tersedia = $row['stok_tersedia'];
    } else {
        echo "Data buku tidak ditemukan.";
        exit;
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4">Edit Buku</h1>
    <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <input type="hidden" name="idbuku" value="<?php echo $idbuku; ?>">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="isbn">ISBN:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="isbn" value="<?php echo $isbn; ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="judul">Judul:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="judul" value="<?php echo $judul; ?>">
        </div>
        <!-- Tambahkan input untuk bidang lainnya sesuai kebutuhan -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="idkategori">ID Kategori:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="idkategori" value="<?php echo $idkategori; ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="pengarang">Pengarang:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="pengarang" value="<?php echo $pengarang; ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="penerbit">Penerbit:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="penerbit" value="<?php echo $penerbit; ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="kota_terbit">Kota Terbit:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="kota_terbit" value="<?php echo $kota_terbit; ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="editor">Editor:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="editor" value="<?php echo $editor; ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="file_gambar">File Gambar:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="file_gambar" value="<?php echo $file_gambar; ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="stok">Stok:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="stok" value="<?php echo $stok; ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="stok_tersedia">Stok Tersedia:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="stok_tersedia" value="<?php echo $stok_tersedia; ?>">
        </div>
        <div class="flex items-center justify-between">
            <input type="submit" value="Simpan" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </div>
    </form>
</body>

</html>