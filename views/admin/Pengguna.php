<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>
<!-- Memanggil file header layout -->

<div class="box">
    <!-- Container utama halaman -->

    <h3>👤 Manajemen Pengguna</h3>
    <!-- Judul halaman manajemen pengguna -->

    <br><br>

    <a class="btn-modal" href="<?= BASEURL; ?>/admin/tambahPengguna">+ Tambah Pengguna</a>
    <!-- Tombol untuk menambah data pengguna baru -->

    <br><br>
    <hr>

    <table>
        <!-- Tabel untuk menampilkan daftar pengguna -->
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <!-- Looping data pengguna yang dikirim dari controller -->
        <?php $no = 1; ?>
        <?php foreach ($data['user'] as $u) : ?>
        <tr>
            <!-- Nomor urut -->
            <td><?= $no++; ?></td>

            <!-- Nama lengkap pengguna -->
            <td><?= htmlspecialchars($u['nama']); ?></td>

            <!-- Username pengguna -->
            <td><?= htmlspecialchars($u['username']); ?></td>

            <!-- Email pengguna -->
            <td><?= htmlspecialchars($u['email']); ?></td>

            <!-- Role pengguna (Admin / Petugas / Peminjam) -->
            <td>
                <span class="badge <?= $u['role']; ?>">
                    <?= $u['role']; ?>
                </span>
            </td>

            <!-- Nomor handphone pengguna -->
            <td><?= htmlspecialchars($u['no_handphone']); ?></td>

            <!-- Alamat pengguna -->
            <td><?= htmlspecialchars($u['alamat']); ?></td>

            <!-- Aksi edit dan hapus pengguna -->
            <td>
                <a class="btn-modal" href="<?= BASEURL ?>/admin/editPengguna?id=<?= $u['id_pengguna']; ?>">Edit</a>
                <a class="btn-modal" href="<?= BASEURL ?>/admin/pengguna?hapus=<?= $u['id_pengguna']; ?>"
                   onclick="return confirm('Hapus pengguna ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <!-- Akhir looping data pengguna -->
    </table>

</div>


<!-- Memanggil file footer layout -->
