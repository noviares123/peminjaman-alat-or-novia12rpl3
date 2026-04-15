<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>
<!-- Memanggil tampilan header -->

<div class="box">
    <!-- Container utama halaman -->

    <h3>📝 Log Aktivitas</h3>
    <!-- Judul halaman log aktivitas -->

    <table>
        <!-- Tabel untuk menampilkan data log -->
        <tr>
            <th>No</th>
            <th>Nama Pengguna</th>
            <th>Aktivitas</th>
            <th>Waktu</th>
        </tr>

        <!-- Looping data log dari controller -->
        <?php $no = 1; ?>
        <?php foreach ($data['logs'] as $log) : ?>
        <tr>
            <!-- Menampilkan nomor urut -->
            <td><?= $no++; ?></td>

            <!-- Menampilkan nama pengguna -->
            <td><?= htmlspecialchars($log['nama_pengguna']); ?></td>

            <!-- Menampilkan aktivitas pengguna -->
            <td><?= htmlspecialchars($log['aktivitas']); ?></td>

            <!-- Menampilkan waktu aktivitas -->
            <td><?= $log['waktu']; ?></td>
        </tr>
        <?php endforeach; ?>
        <!-- Akhir looping log -->
    </table>
</div>


<!-- Memanggil tampilan footer -->
