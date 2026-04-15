<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<!-- Halaman form edit data pengguna -->
<div class="box">
    <h3>Edit Pengguna</h3>

    <?php if (isset($_GET['error'])): ?>
        <div style="background:#fee2e2; border-left:4px solid #dc2626; padding:15px; border-radius:8px; margin-bottom:20px;">
            <p style="color:#b91c1c; font-weight:600; margin:0;">
                ❌ <?= htmlspecialchars(urldecode($_GET['error'])); ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Form untuk memperbarui data pengguna -->
    <form method="POST">

        <!-- ID pengguna yang sedang diedit -->
        <input type="hidden" name="id_pengguna" value="<?= $data['user']['id_pengguna']; ?>">

        <!-- Input nama pengguna -->
        <input name="nama" placeholder="Nama" required
               value="<?= htmlspecialchars($data['user']['nama']); ?>">

        <!-- Input username pengguna -->
        <input name="username" placeholder="Username" required
               value="<?= htmlspecialchars($data['user']['username']); ?>">

        <!-- Input password (opsional jika ingin diubah) -->
        <input name="password" type="password"
               placeholder="Password (kosongkan jika tidak diubah)">

        <!-- Input email pengguna -->
        <input name="email" type="email" placeholder="Email" required
               value="<?= htmlspecialchars($data['user']['email']); ?>">

        <!-- Pilihan role pengguna -->
        <select name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="Admin" <?= $data['user']['role'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="Petugas" <?= $data['user']['role'] === 'Petugas' ? 'selected' : ''; ?>>Petugas</option>
            <option value="Peminjam" <?= $data['user']['role'] === 'Peminjam' ? 'selected' : ''; ?>>Peminjam</option>
        </select>

        <!-- Input nomor handphone -->
        <input name="hp" placeholder="No HP"
               value="<?= htmlspecialchars($data['user']['no_handphone']); ?>">

        <!-- Input alamat pengguna -->
        <textarea name="alamat" placeholder="Alamat"><?= htmlspecialchars($data['user']['alamat']); ?></textarea>

        <!-- Tombol simpan dan batal -->
        <button name="update_pengguna" class="button">Simpan</button>
        <a class="btn-modal" href="<?= BASEURL; ?>/admin/pengguna">Batal</a>
    </form>
</div>

