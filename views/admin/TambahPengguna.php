<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>
<!-- Memanggil header layout -->

<div class="box">
    <!-- Container form tambah pengguna -->

    <h3>Tambah Pengguna</h3>
    <!-- Judul halaman -->

    <?php if (isset($_GET['error'])): ?>
        <div style="background:#fee2e2; border-left:4px solid #dc2626; padding:15px; border-radius:8px; margin-bottom:20px;">
            <p style="color:#b91c1c; font-weight:600; margin:0;">
                ❌ <?= htmlspecialchars(urldecode($_GET['error'])); ?>
            </p>
        </div>
    <?php endif; ?>

    <form method="POST">
        <!-- Form untuk menambahkan data pengguna -->

        <input name="nama" placeholder="Nama" required>
        <!-- Input nama pengguna -->

        <input name="username" placeholder="Username" required>
        <!-- Input username -->

        <input name="password" type="password" placeholder="Password" required>
        <!-- Input password pengguna -->

        <input name="email" type="email" placeholder="Email" required>
        <!-- Input email pengguna -->

        <select name="role" required>
            <!-- Pilihan role pengguna -->
            <option value="">-- Pilih Role --</option>
            <option value="Admin">Admin</option>
            <option value="Petugas">Petugas</option>
            <option value="Peminjam">Peminjam</option>
        </select>

        <input name="hp" placeholder="No HP">
        <!-- Input nomor handphone -->

        <textarea name="alamat" placeholder="Alamat"></textarea>
        <!-- Input alamat pengguna -->

        <button name="simpan" class="button">Simpan</button>
        <!-- Tombol simpan data pengguna -->

        <a class="btn-modal" href="<?= BASEURL; ?>/admin/pengguna">Batal</a>
        <!-- Tombol batal dan kembali ke halaman pengguna -->
    </form>
</div>


<!-- Memanggil footer layout -->
