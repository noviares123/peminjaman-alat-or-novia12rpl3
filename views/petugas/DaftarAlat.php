<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<div class="box">
    <h3>🛠 Daftar Alat Olahraga</h3>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Alat</th>
            <th>Kategori</th>
            <th>Kondisi</th>
            <th>Stok</th>
        </tr>

        <?php $no = 1; ?>
        <?php foreach ($data['alat'] as $a) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($a['nama_alat']); ?></td>
            <td><?= htmlspecialchars($a['nama_kategori'] ?? '-'); ?></td>
            <td><?= htmlspecialchars($a['kondisi']); ?></td>
            <td><?= $a['stok']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

