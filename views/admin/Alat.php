<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<div class="box">

    <h3>🛠 Manajemen Alat</h3>

    <br><br>

    <!-- Tombol untuk menambah alat baru -->
    <a class="btn-modal" href="<?= BASEURL; ?>/admin/tambahAlat">+ Tambah Alat</a>

    <br><br>
    <hr>

    <!-- Tabel daftar alat -->
    <table>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Kondisi</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <!-- Menampilkan data alat dari controller -->
        <?php $no = 1; ?>
        <?php foreach ($data['alat'] as $a) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($a['nama_kategori'] ?? '-'); ?></td>
            <td><?= htmlspecialchars($a['nama_alat']); ?></td>
            <td><?= $a['kondisi']; ?></td>
            <td><?= $a['stok']; ?></td>
            <td>
                <!-- Tombol untuk edit data alat -->
                <a class="btn-modal" href="<?= BASEURL ?>/admin/editAlat?id=<?= $a['id_alat']; ?>">Edit</a>

                <!-- Tombol untuk menghapus data alat -->
                <a class="btn-modal" 
                   href="<?= BASEURL ?>/admin/alat?hapus=<?= $a['id_alat']; ?>"
                   onclick="return confirm('Hapus alat ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</div>
