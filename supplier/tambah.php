<?php 
include '../config/database.php';
include '../includes/header.php';

if (isset($_POST['submit'])) {
    $nama_supplier  = $_POST['nama_supplier'];
    $kontak         = $_POST['kontak'];
    $alamat         = $_POST['alamat'];

    // PERBAIKAN: Query disesuaikan dengan 4 kolom yang ada di database Anda
    $insert = mysqli_query($conn, "INSERT INTO Supplier (nama_supplier, kontak, alamat) 
                                   VALUES ('$nama_supplier', '$kontak', '$alamat')");

    if ($insert) {
        echo "<script>alert('Supplier baru berhasil didaftarkan!'); window.location='index.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Gagal menambahkan supplier: " . mysqli_error($conn) . "</div>";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">🤝 Form Registrasi Supplier / Mitra Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Perusahaan / Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" placeholder="Contoh: PT. Sumber Makmur" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kontak (No. Telepon / WhatsApp)</label>
                        <input type="text" name="kontak" class="form-control" placeholder="Contoh: 08123456789" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Kantor / Gudang Supplier</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Tulis alamat lengkap..." required></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 py-2 fw-bold">Simpan & Daftarkan Mitra</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>