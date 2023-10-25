function showNotification() {
  // Buat elemen div untuk notifikasi
  var notification = document.createElement("div");
  notification.className =
    "bg-green-500 text-white p-2 fixed bottom-0 right-0 m-4 rounded";
  notification.innerText = "Selamat Datang Kembali";

  // Tambahkan elemen notifikasi ke dalam body dokumen
  document.body.appendChild(notification);

  // Hilangkan notifikasi setelah beberapa detik
  setTimeout(function () {
    notification.style.display = "none";
  }, 3000); // Notifikasi akan hilang setelah 3 detik
}
