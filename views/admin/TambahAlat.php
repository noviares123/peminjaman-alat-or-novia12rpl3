<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>
<!-- Memanggil header layout -->

<div class="box">
    <!-- Container form tambah alat -->

    <h3>Tambah Alat</h3>
    <!-- Judul halaman -->

    <?php if (isset($_GET['error'])): ?>
        <div style="background:#fee2e2; border-left:4px solid #dc2626; padding:15px; border-radius:8px; margin-bottom:20px;">
            <p style="color:#b91c1c; font-weight:600; margin:0;">
                ❌ <?= htmlspecialchars(urldecode($_GET['error'])); ?>
            </p>
        </div>
    <?php endif; ?>

    <form method="POST">
        <!-- Form untuk menambahkan data alat -->

        <input name="nama_alat" placeholder="Nama Alat" required>
        <!-- Input nama alat -->

        <select name="id_kategori" required>
            <!-- Dropdown pilihan kategori alat -->
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($data['kategori'] as $k) : ?>
                <option value="<?= $k['id_kategori']; ?>">
                    <?= htmlspecialchars($k['nama_kategori']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="kondisi" required>
            <!-- Dropdown kondisi ketersediaan alat -->
            <option value="Tersedia">Tersedia</option>
            <option value="Tidak Tersedia">Tidak Tersedia</option>
        </select>

        <input name="stok" type="number" placeholder="Stok" min="1" required>
        <!-- Input jumlah stok alat -->

        <br><br>

        <button name="simpan" class="button">Simpan</button>
        <!-- Tombol simpan data alat -->

        <a class="btn-modal" href="<?= BASEURL; ?>/admin/alat">Batal</a>
        <!-- Tombol kembali ke halaman alat -->
    </form>
</div>


<!-- Memanggil footer layout -->
