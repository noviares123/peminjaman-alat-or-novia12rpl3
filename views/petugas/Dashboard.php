<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>
<!-- Memanggil header layout -->

<div class="dashboard-container">
    <!-- Container utama dashboard petugas -->

    <?php if (isset($_GET['success']) && $_GET['success'] === 'password'): ?>
    <p style="color:#16a34a; font-weight:600; margin-bottom:10px;">✓ Password berhasil diubah.</p>
    <?php endif; ?>

    <h2>Halo, <?= htmlspecialchars($_SESSION['nama']); ?>! 👋</h2>
    <!-- Menampilkan sapaan nama petugas -->

    <p>Kelola peminjaman dan pengembalian alat olahraga hari ini</p>
    <!-- Deskripsi singkat dashboard -->

    <div class="cards">
        <!-- Kumpulan kartu ringkasan data -->

        <div class="card card-orange">
            <!-- Kartu jumlah peminjaman pending -->
            <div class="card-icon">⏳</div>
            <div class="card-body">
                <h4>Peminjaman Pending</h4>
                <h1><?= $data['stats']['pending'] ?? 0; ?></h1>
                <a href="<?= BASEURL ?>/petugas/setujui" class="card-link">Lihat & Setujui →</a>
            </div>
        </div>

        <div class="card card-blue">
            <!-- Kartu jumlah alat yang sedang dipinjam -->
            <div class="card-icon">📦</div>
            <div class="card-body">
                <h4>Sedang Dipinjam</h4>
                <h1><?= $data['stats']['dipinjam'] ?? 0; ?></h1>
                <a href="<?= BASEURL ?>/petugas/pantau" class="card-link">Pantau Status →</a>
            </div>
        </div>

        <div class="card card-yellow">
            <!-- Kartu peminjaman yang menunggu konfirmasi pengembalian -->
            <div class="card-icon">↩️</div>
            <div class="card-body">
                <h4>Menunggu Konfirmasi</h4>
                <h1><?= $data['stats']['menunggu_kembali'] ?? 0; ?></h1>
                <a href="<?= BASEURL ?>/petugas/pantau" class="card-link">Konfirmasi →</a>
            </div>
        </div>

        <div class="card card-green">
            <!-- Kartu jumlah pengembalian hari ini -->
            <div class="card-icon">✅</div>
            <div class="card-body">
                <h4>Dikembalikan Hari Ini</h4>
                <h1><?= $data['stats']['dikembalikan_hari_ini'] ?? 0; ?></h1>
                <a href="<?= BASEURL ?>/petugas/cetak" class="card-link">Lihat Laporan →</a>
            </div>
        </div>
    </div>

    <?php if (($data['stats']['terlambat'] ?? 0) > 0): ?>
    <!-- Menampilkan peringatan jika ada peminjaman terlambat -->
    <div class="alert alert-danger">
        <span class="alert-icon">🚨</span>
        <div class="alert-content">
            <strong>Perhatian!</strong> Ada <strong><?= $data['stats']['terlambat']; ?></strong> peminjaman yang terlambat dikembalikan. 
            <a href="<?= BASEURL ?>/petugas/pantau" class="alert-link">Lihat Detail →</a>
        </div>
    </div>
    <?php endif; ?>

    <div class="info-section">
        <!-- Section informasi tambahan -->

        <div class="info-box">
            <!-- Box aksi cepat petugas -->
            <h3>⚡ Aksi Cepat</h3>
            <div class="quick-actions">
                <a href="<?= BASEURL ?>/petugas/setujui" class="btn btn-primary">✅ Setujui Peminjaman</a>
                <a href="<?= BASEURL ?>/petugas/pantau" class="btn btn-success">👁 Pantau Pengembalian</a>
                <a href="<?= BASEURL ?>/petugas/riwayat" class="btn btn-info">📋 Riwayat Peminjaman</a>
                <a href="<?= BASEURL ?>/petugas/daftarAlat" class="btn btn-secondary">🛠 Daftar Alat</a>
                <a href="<?= BASEURL ?>/petugas/cetak" class="btn btn-primary">🖨 Cetak Laporan</a>
            </div>
        </div>

        <div class="info-box">
            <!-- Box ringkasan status peminjaman -->
            <h3>📊 Ringkasan Status</h3>
            <ul class="info-list">
                <li>
                    <span class="info-label">Total Peminjaman:</span>
                    <span class="info-value"><?= $data['stats']['total'] ?? 0; ?></span>
                </li>
                <li>
                    <span class="info-label">Disetujui:</span>
                    <span class="info-value badge badge-success"><?= $data['stats']['disetujui'] ?? 0; ?></span>
                </li>
                <li>
                    <span class="info-label">Ditolak:</span>
                    <span class="info-value badge badge-danger"><?= $data['stats']['ditolak'] ?? 0; ?></span>
                </li>
                <li>
                    <span class="info-label">Dikembalikan:</span>
                    <span class="info-value badge badge-info"><?= $data['stats']['dikembalikan'] ?? 0; ?></span>
                </li>
            </ul>
        </div>
    </div>

    <div class="tips-section">
        <!-- Section tips penggunaan sistem -->
        <div class="tip-box">
            <span class="tip-icon">💡</span>
            <div class="tip-content">
                <strong>Tips:</strong> Prioritaskan peminjaman pending dan konfirmasi pengembalian untuk menjaga kelancaran sistem.
            </div>
        </div>
    </div>
</div>


<!-- Memanggil footer layout -->
