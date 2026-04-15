<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>
<!-- Memanggil file Header (navbar, head HTML, dll) -->

<div class="box">
    <!-- Container utama halaman -->

    <h3>📂 Kategori Alat</h3>
    <!-- Judul halaman -->

    <br><br>

    <!-- Tombol untuk menuju halaman tambah kategori -->
    <a class="btn-modal" href="<?= BASEURL; ?>/admin/tambahKategori">
        + Tambah Kategori
    </a>

    <br><br>

    <?php if (isset($_GET['error'])): ?>
        <div style="background:#fee2e2; border-left:4px solid #dc2626; padding:15px; border-radius:8px; margin-bottom:20px;">
            <p style="color:#b91c1c; font-weight:600; margin:0;">
                ❌ <?= htmlspecialchars(urldecode($_GET['error'])); ?>
            </p>
        </div>
    <?php endif; ?>

    <hr>

    <!-- Tabel data kategori -->
    <table>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>

        <!-- Looping data kategori dari controller -->
        <?php $no = 1; ?>
        <?php foreach ($data['kategori'] as $k) : ?>
        <tr>
            <!-- Menampilkan nomor urut -->
            <td><?= $no++; ?></td>

            <!-- Menampilkan nama kategori (diamankan dari XSS) -->
            <td><?= htmlspecialchars($k['nama_kategori']); ?></td>

            <!-- Tombol aksi Edit dan Hapus -->
            <td>
                <!-- Link edit kategori berdasarkan ID -->
                <a class="btn-modal"
                   href="<?= BASEURL ?>/admin/editKategori?id=<?= $k['id_kategori']; ?>">
                   Edit
                </a>

                <!-- Link hapus kategori dengan konfirmasi -->
                <a class="btn-modal"
                   href="<?= BASEURL ?>/admin/kategori?hapus=<?= $k['id_kategori']; ?>"
                   onclick="return confirm('Hapus kategori ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        <!-- Akhir looping kategori -->
    </table>

</div>


<!-- Memanggil file Footer -->
