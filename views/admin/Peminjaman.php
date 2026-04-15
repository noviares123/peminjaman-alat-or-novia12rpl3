<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>
<!-- Memanggil header layout -->

<div class="box">
    <!-- Container utama halaman -->

    <h3>📊 Data Peminjaman</h3>
    <!-- Judul halaman data peminjaman -->

    <br><br>

    <a class="btn-modal" href="<?= BASEURL; ?>/admin/tambahPeminjaman">+ Tambah Peminjaman</a>
    <!-- Tombol untuk menambah data peminjaman baru -->

    <br><br>
    <hr>

    <table>
        <!-- Tabel untuk menampilkan data peminjaman -->
        <tr>
            <th>No</th>
            <th>Peminjam</th>
            <th>Alat</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <!-- Looping data peminjaman dari controller -->
        <?php $no = 1; ?>
        <?php foreach ($data['pinjam'] as $p) : ?>
        <tr>
            <!-- Nomor urut -->
            <td><?= $no++; ?></td>

            <!-- Nama peminjam -->
            <td><?= htmlspecialchars($p['nama']); ?></td>

            <!-- Nama alat yang dipinjam -->
            <td><?= htmlspecialchars($p['nama_alat']); ?></td>

            <!-- Tanggal peminjaman -->
            <td><?= $p['tanggal_pinjam']; ?></td>

            <!-- Tanggal pengembalian (jika ada) -->
            <td><?= $p['tanggal_kembali'] ?? '-'; ?></td>

            <!-- Status peminjaman -->
            <td><?= $p['status']; ?></td>

            <!-- Aksi edit dan hapus peminjaman -->
            <td>
                <a class="btn-modal" href="<?= BASEURL ?>/admin/editPeminjaman?id=<?= $p['id_peminjaman']; ?>">Edit</a>
                <a class="btn-modal" href="<?= BASEURL ?>/admin/peminjaman?hapus=<?= $p['id_peminjaman']; ?>"
                   onclick="return confirm('Hapus data peminjaman ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <!-- Akhir looping data peminjaman -->
    </table>

</div>

<!-- Memanggil footer layout -->
