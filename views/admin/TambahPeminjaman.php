<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>
<!-- Memanggil header layout -->

<div class="box">
    <!-- Container form tambah peminjaman -->

    <h3>Tambah Peminjaman</h3>
    <!-- Judul halaman -->

    <?php if (isset($_GET['error'])): ?>
        <div style="background:#fee2e2; border-left:4px solid #dc2626; padding:15px; border-radius:8px; margin-bottom:20px;">
            <p style="color:#b91c1c; font-weight:600; margin:0;">
                ❌ <?= htmlspecialchars(urldecode($_GET['error'])); ?>
            </p>
        </div>
    <?php endif; ?>

    <form method="POST">
        <!-- Form untuk menambahkan data peminjaman -->

        <!-- Pilihan peminjam -->
        <select name="id_pengguna" required>
            <option value="">-- Pilih Peminjam --</option>
            <?php foreach ($data['pengguna'] as $u): ?>
                <option value="<?= $u['id_pengguna']; ?>"><?= htmlspecialchars($u['nama']); ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Pilihan alat -->
        <select name="id_alat" required>
            <option value="">-- Pilih Alat --</option>
            <?php foreach ($data['alat'] as $a): ?>
                <option value="<?= $a['id_alat']; ?>"><?= htmlspecialchars($a['nama_alat']); ?> (Stok: <?= $a['stok']; ?>)</option>
            <?php endforeach; ?>
        </select>

        <!-- Input tanggal pinjam -->
        <input type="date" name="tanggal_pinjam" placeholder="Tanggal Pinjam" required>

        <!-- Input tanggal kembali -->
        <input type="date" name="tanggal_kembali" placeholder="Tanggal Kembali">

        <!-- Input jumlah item -->
        <input type="number" name="total_item" placeholder="Jumlah Item" min="1" required>

        <!-- Pilihan status -->
        <select name="status" required>
            <option value="Menunggu">Menunggu</option>
            <option value="Di Setujui">Di Setujui</option>
            <option value="Di Tolak">Di Tolak</option>
            <option value="Kembali">Kembali</option>
        </select>

        <button name="simpan" class="button">Simpan</button>
        <!-- Tombol simpan data peminjaman -->

        <a class="btn-modal" href="<?= BASEURL; ?>/admin/peminjaman">Batal</a>
        <!-- Tombol batal dan kembali ke halaman peminjaman -->
    </form>
</div>
