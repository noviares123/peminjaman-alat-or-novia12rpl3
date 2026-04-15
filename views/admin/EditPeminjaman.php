<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<!-- Container form edit peminjaman -->
<div class="box">
    <h3>Edit Peminjaman</h3>

    <!-- Form untuk memperbarui data peminjaman -->
    <form method="POST">

        <!-- ID peminjaman yang diedit -->
        <input type="hidden" name="id_peminjaman" value="<?= $data['pinjam']['id_peminjaman']; ?>">

        <!-- Pilihan status peminjaman -->
        <label>Status</label>
        <select name="status" required>
            <option value="Menunggu" <?= $data['pinjam']['status'] === 'Menunggu' ? 'selected' : ''; ?>>Menunggu</option>
            <option value="Di Setujui" <?= $data['pinjam']['status'] === 'Di Setujui' ? 'selected' : ''; ?>>Di Setujui</option>
            <option value="Di Tolak" <?= $data['pinjam']['status'] === 'Di Tolak' ? 'selected' : ''; ?>>Di Tolak</option>
            <option value="Kembali" <?= $data['pinjam']['status'] === 'Kembali' ? 'selected' : ''; ?>>Kembali</option>
        </select>

        <!-- Input tanggal pengembalian -->
        <label>Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali"
               value="<?= htmlspecialchars($data['pinjam']['tanggal_kembali']); ?>">

        <!-- Input jumlah item yang dipinjam -->
        <label>Total Item</label>
        <input type="number" name="total_item" min="1"
               value="<?= $data['pinjam']['total_item']; ?>">

        <!-- Tombol simpan dan batal -->
        <button name="update_peminjaman" class="button">Simpan</button>
        <a class="btn-modal" href="<?= BASEURL; ?>/admin/peminjaman">Batal</a>
    </form>
</div>


