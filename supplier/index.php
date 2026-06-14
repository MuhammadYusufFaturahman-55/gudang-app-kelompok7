<?php 
include '../config/database.php';
include '../includes/header.php';

// Query disesuaikan dengan struktur tabel Anda
$sql = "SELECT s.*, COUNT(tm.id_masuk) as total_pasokan 
        FROM Supplier s
        LEFT JOIN Transaksi_Masuk tm ON s.id_supplier = tm.id_supplier
        GROUP BY s.id_supplier
        ORDER BY s.nama_supplier ASC";

$query = mysqli_query($conn, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Supplier / Mitra Gudang</h2>
    <a href="tambah.php" class="btn btn-primary">+ Tambah Supplier Baru</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Perusahaan / Supplier</th>
                    <th>Kontak / No. Telp</th>
                    <th>Alamat</th>
                    <th class="text-center">Total Transaksi Pasokan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                if(mysqli_num_rows($query) == 0): 
                ?>
                    <tr><td colspan="5" class="text-center text-muted p-4">Belum ada supplier yang terdaftar.</td></tr>
                <?php 
                endif; 
                while($row = mysqli_fetch_assoc($query)): 
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= $row['nama_supplier']; ?></strong></td>
                    <td><?= $row['kontak'] ? $row['kontak'] : '-'; ?></td>
                    <td><small class="text-muted"><?= $row['alamat'] ? $row['alamat'] : '-'; ?></small></td>
                    <td class="text-center">
                        <span class="badge bg-info text-dark fw-bold"><?= $row['total_pasokan']; ?> Kali</span>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>