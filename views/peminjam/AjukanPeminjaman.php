<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<!-- Judul halaman form pengajuan -->
<h3>➕ Form Pengajuan Peminjaman</h3>

<?php
// Menampilkan pesan error
if (isset($_GET['error'])) : 
    if ($_GET['error'] === 'stok') : ?>
        <p style="color:#b91c1c; font-weight:600; margin-bottom:10px;">
            ❌ Stok tidak mencukupi. Pilih jumlah lain.
        </p>
    <?php else : ?>
        <div style="background:#fee2e2; border-left:4px solid #dc2626; padding:15px; border-radius:8px; margin-bottom:20px;">
            <p style="color:#b91c1c; font-weight:600; margin:0;">
                ❌ <?= htmlspecialchars(urldecode($_GET['error'])); ?>
            </p>
        </div>
    <?php endif;
endif; ?>

<!-- Form pengajuan peminjaman -->
<form action="<?= BASEURL; ?>/peminjam/ajukan" method="POST">

    <!-- Alat otomatis dari pilihan di daftar alat -->
    <label>Alat</label><br>
    <?php 
    $selected = null;
    foreach($data['alat'] as $alat) {
        if($alat['id_alat'] == $data['selected_alat']) {
            $selected = $alat;
            break;
        }
    }
    ?>
    <input type="hidden" name="id_alat" value="<?= htmlspecialchars($data['selected_alat']); ?>">
    <input type="text" value="<?= $selected ? htmlspecialchars($selected['nama_alat']) . ' (Stok: ' . $selected['stok'] . ')' : '-'; ?>" disabled>
    <br><br>

    <!-- Tanggal mulai peminjaman -->
    <label>Tanggal Pinjam</label><br>
    <input type="date" name="tanggal_pinjam"
           value="<?= date('Y-m-d'); ?>" required>
    <br><br>

    <!-- Tanggal pengembalian (estimasi, default +7 hari) -->
    <label>Tanggal Kembali (Estimasi)</label><br>
    <input type="date" name="tanggal_kembali"
           value="<?= date('Y-m-d', strtotime('+7 days')); ?>" required>
    <br><br>

    <!-- Jumlah alat yang dipinjam -->
    <label>Jumlah</label><br>
    <input type="number" name="total_item" min="1" value="1" required>
    <br><br>

    <!-- Tombol submit dan batal -->
    <button type="submit">Kirim Pengajuan</button>
    <a class="btn-modal" href="<?= BASEURL; ?>/peminjam/daftar">Batal</a>
</form>

<script>
// Validasi tanggal kembali tidak boleh sebelum tanggal pinjam
document.querySelector('form').addEventListener('submit', function(e) {
    var tglPinjam = document.querySelector('[name="tanggal_pinjam"]').value;
    var tglKembali = document.querySelector('[name="tanggal_kembali"]').value;
    if (tglKembali <= tglPinjam) {
        e.preventDefault();
        alert('Tanggal kembali harus setelah tanggal pinjam.');
    }
});

// Set min tanggal kembali otomatis saat tanggal pinjam berubah
document.querySelector('[name="tanggal_pinjam"]').addEventListener('change', function() {
    var next = new Date(this.value);
    next.setDate(next.getDate() + 1);
    var minDate = next.toISOString().split('T')[0];
    document.querySelector('[name="tanggal_kembali"]').min = minDate;
});
</script>


