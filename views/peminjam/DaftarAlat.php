<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<!-- Halaman daftar alat yang tersedia untuk dipinjam -->
<h3>📋 Daftar Alat Tersedia</h3>

<?php
// Menampilkan pesan error jika stok alat tidak mencukupi
if (isset($_GET['error']) && $_GET['error'] === 'stok') : ?>
    <p style="color:#b91c1c; font-weight:600; margin-bottom:10px;">
        Stok tidak mencukupi. Pilih alat lain.
    </p>
<?php endif; ?>

<!-- Tabel daftar alat -->
<table border="1" width="100%" cellpadding="8" cellspacing="0">
    <tr>
        <th>Nama Alat</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Kondisi</th>
        <th>Aksi</th>
    </tr>

    <?php
    // Menampilkan data alat dari database
    foreach($data['alat'] as $alat): ?>
    <tr>
        <td><?= htmlspecialchars($alat['nama_alat']); ?></td>
        <td><?= htmlspecialchars($alat['nama_kategori'] ?? 'Tidak ada kategori'); ?></td>
        <td><?= $alat['stok']; ?></td>
        <td><?= $alat['kondisi']; ?></td>
        <td>
            <?php if($alat['stok'] > 0): ?>
                <!-- Tombol ajukan peminjaman -->
                <a class="btn-modal" href="<?= BASEURL; ?>/peminjam/ajukan?id_alat=<?= $alat['id_alat']; ?>">
                    ➕ Pinjam
                </a>
            <?php else: ?>
                <!-- Status jika stok habis -->
                <span style="color:red;">Stok Habis</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

