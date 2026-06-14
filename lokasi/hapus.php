<?php
include '../config/database.php';

$id_lokasi = $_GET['id'];

// 1. Cek apakah ada barang yang masih tersimpan di dalam rak ini (jumlah_stok > 0)
$cek_stok = mysqli_query($conn, "SELECT SUM(jumlah_stok) as total_stok FROM Stok_Lokasi WHERE id_lokasi = '$id_lokasi'");
$data_stok = mysqli_fetch_assoc($cek_stok);
$total_stok = (int)$data_stok['total_stok'];

// 2. JIKA RAK MASIH ADA ISINYA, TOLAK PROSES PENGHAPUSAN
if ($total_stok > 0) {
    echo "<script>
            alert('Gagal Menghapus! Rak ini tidak boleh dihapus karena masih menampung $total_stok item barang. Kosongkan isi rak terlebih dahulu melalui transaksi barang keluar atau pindah rak.');
            window.location='index.php';
          </script>";
    exit;
}

// 3. JIKA RAK BENAR-BENAR KOSONG, PROSES HAPUS DIIZINKAN
// Hapus baris relasi di Stok_Lokasi yang jumlah_stok-nya sudah 0 (jika ada sisa riwayat)
mysqli_query($conn, "DELETE FROM Stok_Lokasi WHERE id_lokasi = '$id_lokasi'");

// Hapus data utama Lokasi
$delete = mysqli_query($conn, "DELETE FROM Lokasi WHERE id_lokasi = '$id_lokasi'");

if ($delete) {
    echo "<script>
            alert('Lokasi rak berhasil dihapus dari sistem.');
            window.location='index.php';
          </script>";
} else {
    echo "Gagal menghapus lokasi: " . mysqli_error($conn);
}
?>