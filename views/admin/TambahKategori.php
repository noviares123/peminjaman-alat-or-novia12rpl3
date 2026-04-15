<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>
<!-- Memanggil header layout -->

<div class="box">
    <!-- Container form tambah kategori -->

    <h3>Tambah Kategori</h3>
    <!-- Judul halaman -->

    <form method="POST">
        <!-- Form untuk menambahkan kategori -->

        <input name="nama_kategori" placeholder="Nama Kategori" required>
        <!-- Input nama kategori -->

        <button name="simpan" class="button">Tambah</button>
        <!-- Tombol simpan kategori -->

        <a class="btn-modal" href="<?= BASEURL; ?>/admin/kategori">Batal</a>
        <!-- Tombol batal dan kembali ke halaman kategori -->
    </form>
</div>


<!-- Memanggil footer layout -->
