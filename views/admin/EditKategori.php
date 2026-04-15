<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<!-- Container form edit kategori -->
<div class="box">
    <h3>Edit Kategori</h3>

    <!-- Form untuk memperbarui data kategori -->
    <form method="POST">

        <!-- ID kategori yang diedit -->
        <input type="hidden" name="id_kategori" value="<?= $data['kategori']['id_kategori']; ?>">

        <!-- Input nama kategori -->
        <input name="nama_kategori" placeholder="Nama Kategori" required
               value="<?= htmlspecialchars($data['kategori']['nama_kategori']); ?>">

        <!-- Tombol simpan dan batal -->
        <button name="update_kategori" class="button">Simpan</button>
        <a class="btn-modal" href="<?= BASEURL; ?>/admin/kategori">Batal</a>
    </form>
</div>


