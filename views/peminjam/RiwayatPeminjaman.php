<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<h3>🔁 Riwayat Peminjaman Saya</h3>

<?php
// Menampilkan pesan sukses sesuai jenis aksi
if (isset($_GET['success'])) :
    if ($_GET['success'] === 'kembali') : ?>
    <p style="color:#16a34a; font-weight:600; margin-bottom:10px;">
        ✓ Pengembalian berhasil diajukan. Silakan tunggu konfirmasi petugas.
    </p>
    <?php else : ?>
    <p style="color:#16a34a; font-weight:600; margin-bottom:10px;">
        ✓ Peminjaman berhasil diajukan. Silakan tunggu konfirmasi petugas.
    </p>
    <?php endif;
?>
<?php
// Menampilkan pesan error jika pengajuan peminjaman gagal
elseif (isset($_GET['error'])) :
?>
    <p style="color:#b91c1c; font-weight:600; margin-bottom:10px;">
        ✗ Gagal mengajukan pengembalian. Coba lagi.
    </p>
<?php endif; ?>

<!-- Tabel untuk menampilkan riwayat peminjaman -->
<table border="1" width="100%" cellpadding="8" cellspacing="0">
    <tr>
        <th>Alat</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </tr>

    <?php
    // Menampilkan pesan jika tidak ada data peminjaman
    if (empty($data['pinjam'])):
    ?>
        <tr>
            <td colspan="7" style="text-align:center; color:red;">
                Tidak ada data peminjaman
            </td>
        </tr>
    <?php endif; ?>

    <?php
    // Menampilkan data riwayat peminjaman satu per satu
    foreach($data['pinjam'] as $row):
    ?>
    <tr>
        <td><?= htmlspecialchars($row['nama_alat']); ?></td>
        <td><?= $row['tanggal_pinjam']; ?></td>
        <td><?= $row['tanggal_kembali']; ?></td>
        <td><?= $row['total_item']; ?></td>

        <td>
            <?php
            // Menentukan warna status peminjaman
            $warna = $row['status'] == 'Menunggu' ? 'orange' :
                     ($row['status'] == 'Di Setujui' ? 'green' :
                     ($row['status'] == 'Di Tolak' ? 'red' : 'gray'));
            ?>
            <b style="color:<?= $warna; ?>">
                <?= strtoupper($row['status']); ?>
            </b>
        </td>

        <td>
            <?php 
            // Tampilkan keterangan jika:
            // 1. Status Di Tolak (peminjaman ditolak)
            // 2. Status Di Setujui tapi ada keterangan (pengembalian ditolak)
            if (!empty($row['keterangan'])): 
            ?>
                <span style="color: #b91c1c; font-weight: 500; display: block; padding: 5px; background: #fee2e2; border-radius: 4px;">
                    <?= htmlspecialchars($row['keterangan']); ?>
                </span>
            <?php else: ?>
                <span style="color: gray;">-</span>
            <?php endif; ?>
        </td>

        <td>
            <?php
            // Menampilkan tombol pengajuan pengembalian jika status disetujui
            if ($row['status'] == 'Di Setujui'):
                // Cek apakah sudah mengajukan pengembalian (kondisi sudah diisi)
                if (!empty($row['kondisi'])):
            ?>
                    <span style="color: orange; font-weight: 600;">⏳ Menunggu Konfirmasi</span>
                <?php else: ?>
                    <?php if (!empty($row['keterangan'])): ?>
                        <!-- Pengembalian ditolak, tampilkan pesan -->
                        <div style="margin-bottom: 8px;">
                            <span style="color: red; font-weight: 600;">✗ Pengembalian Ditolak</span>
                        </div>
                    <?php endif; ?>
                    <a href="<?= BASEURL; ?>/peminjam/riwayat?ajukan=<?= $row['id_peminjaman']; ?>"
                       class="btn btn-primary"
                       onclick="return confirm('Ajukan pengembalian untuk alat ini?')">
                       ↩ Ajukan Pengembalian
                    </a>
                <?php endif; ?>
            <?php elseif ($row['status'] == 'Kembali'): ?>
                <span style="color: green; font-weight: 600;">✓ Sudah Dikembalikan</span>
            <?php elseif ($row['status'] == 'Menunggu'): ?>
                <span style="color: orange; font-weight: 600;">⏳ Menunggu Persetujuan</span>
            <?php elseif ($row['status'] == 'Di Tolak'): ?>
                <span style="color: red; font-weight: 600;">✗ Ditolak</span>
            <?php else: ?>
                <span style="color: gray;">-</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>




