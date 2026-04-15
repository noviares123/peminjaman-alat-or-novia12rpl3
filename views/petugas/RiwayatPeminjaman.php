<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<div class="box">
    <h3>📋 Riwayat Peminjaman</h3>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Alat</th>
            <th>Jumlah</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Kondisi</th>
        </tr>

        <?php $no = 1; ?>
        <?php foreach ($data['riwayat'] as $r) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($r['nama']); ?></td>
            <td><?= htmlspecialchars($r['nama_alat']); ?></td>
            <td><?= $r['total_item']; ?></td>
            <td><?= $r['tanggal_pinjam']; ?></td>
            <td><?= $r['tanggal_kembali']; ?></td>
            <td>
                <?php if ($r['status'] === 'Menunggu'): ?>
                    <span class="badge petugas"><?= $r['status']; ?></span>
                <?php elseif ($r['status'] === 'Di Setujui'): ?>
                    <span class="badge badge-success"><?= $r['status']; ?></span>
                <?php elseif ($r['status'] === 'Di Tolak'): ?>
                    <span class="badge badge-danger"><?= $r['status']; ?></span>
                <?php elseif ($r['status'] === 'Kembali'): ?>
                    <span class="badge badge-info"><?= $r['status']; ?></span>
                <?php else: ?>
                    <span class="badge"><?= $r['status']; ?></span>
                <?php endif; ?>
            </td>
            <td><?= $r['kondisi'] ? htmlspecialchars($r['kondisi']) : '-'; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>


