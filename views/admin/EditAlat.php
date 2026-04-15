<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<!-- Container form edit alat -->
<div class="box">
    <h3>Edit Alat</h3>

    <?php if (isset($_GET['error'])): ?>
        <div style="background:#fee2e2; border-left:4px solid #dc2626; padding:15px; border-radius:8px; margin-bottom:20px;">
            <p style="color:#b91c1c; font-weight:600; margin:0;">
                ❌ <?= htmlspecialchars(urldecode($_GET['error'])); ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Form untuk memperbarui data alat -->
    <form method="POST">

        <!-- ID alat yang diedit -->
        <input type="hidden" name="id_alat" value="<?= $data['alat']['id_alat']; ?>">

        <!-- Pilihan kategori alat -->
        <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($data['kategori'] as $k) : ?>
                <option value="<?= $k['id_kategori']; ?>"
                    <?= $data['alat']['id_kategori'] == $k['id_kategori'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($k['nama_kategori']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Input nama alat -->
        <input name="nama_alat" placeholder="Nama Alat" required
               value="<?= htmlspecialchars($data['alat']['nama_alat']); ?>">

        <!-- Pilihan kondisi alat -->
        <select name="kondisi" required>
            <option value="Tersedia"
                <?= $data['alat']['kondisi'] === 'Tersedia' ? 'selected' : ''; ?>>
                Tersedia
            </option>
            <option value="Tidak Tersedia"
                <?= $data['alat']['kondisi'] === 'Tidak Tersedia' ? 'selected' : ''; ?>>
                Tidak Tersedia
            </option>
        </select>

        <!-- Input stok alat -->
        <input name="stok" type="number" placeholder="Stok" min="1" required
               value="<?= $data['alat']['stok']; ?>">

        <!-- Tombol simpan dan batal -->
        <button name="update_alat" class="button">Simpan</button>
        <a class="btn-modal" href="<?= BASEURL; ?>/admin/alat">Batal</a>
    </form>
</div>

