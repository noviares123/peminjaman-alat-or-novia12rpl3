<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<!-- Dashboard peminjam untuk menampilkan ringkasan dan status peminjaman -->
<div class="dashboard-container">

    <?php if (isset($_GET['success']) && $_GET['success'] === 'password'): ?>
    <p style="color:#16a34a; font-weight:600; margin-bottom:10px;">✓ Password berhasil diubah.</p>
    <?php endif; ?>

    <h2>👋 Selamat Datang, <?= htmlspecialchars($_SESSION['nama']); ?>!</h2>
    <p>Kelola peminjaman alat olahraga Anda dengan mudah</p>

    <!-- Kartu ringkasan statistik peminjaman -->
    <div class="cards">
        <div class="card card-blue">
            <div class="card-icon">📊</div>
            <div class="card-body">
                <h4>Total Peminjaman Saya</h4>
                <h1><?= $data['stats']['total'] ?? 0; ?></h1>
                <a href="<?= BASEURL; ?>/peminjam/riwayat" class="card-link">Lihat Riwayat →</a>
            </div>
        </div>

        <div class="card card-green">
            <div class="card-icon">📦</div>
            <div class="card-body">
                <h4>Sedang Dipinjam</h4>
                <h1><?= $data['stats']['dipinjam'] ?? 0; ?></h1>
                <a href="<?= BASEURL; ?>/peminjam/riwayat" class="card-link">Lihat Detail →</a>
            </div>
        </div>

        <div class="card card-orange">
            <div class="card-icon">⏳</div>
            <div class="card-body">
                <h4>Menunggu Approval</h4>
                <h1><?= $data['stats']['pending'] ?? 0; ?></h1>
                <a href="<?= BASEURL; ?>/peminjam/riwayat" class="card-link">Cek Status →</a>
            </div>
        </div>
    </div>

    <!-- Notifikasi peminjaman yang baru disetujui -->
    <?php if (($data['stats']['disetujui_baru'] ?? 0) > 0): ?>
    <div class="alert alert-success">
        <span class="alert-icon">✅</span>
        <div class="alert-content">
            <strong>Selamat!</strong> Ada <strong><?= $data['stats']['disetujui_baru']; ?></strong> peminjaman Anda yang baru disetujui. 
            <a href="<?= BASEURL; ?>/peminjam/riwayat" class="alert-link">Lihat Detail →</a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Notifikasi peminjaman yang ditolak -->
    <?php if (($data['stats']['ditolak_baru'] ?? 0) > 0): ?>
    <div class="alert alert-danger">
        <span class="alert-icon">❌</span>
        <div class="alert-content">
            <strong>Perhatian!</strong> Ada <strong><?= $data['stats']['ditolak_baru']; ?></strong> peminjaman Anda yang ditolak. 
            <a href="<?= BASEURL; ?>/peminjam/riwayat" class="alert-link">Lihat Alasan →</a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Aksi cepat dan ringkasan status peminjaman -->
    <div class="info-section">
        <div class="info-box">
            <h3>⚡ Aksi Cepat</h3>
            <div class="quick-actions">
                <a href="<?= BASEURL; ?>/peminjam/daftar" class="btn btn-primary btn-large">
                    ➕ Pinjam Alat Baru
                </a>
                <a href="<?= BASEURL; ?>/peminjam/riwayat" class="btn btn-success">
                    🔁 Riwayat Peminjaman
                </a>
                <a href="<?= BASEURL; ?>/peminjam/daftar" class="btn btn-info">
                    📋 Lihat Alat Tersedia
                </a>
            </div>
        </div>

        <div class="info-box">
            <h3>📊 Status Peminjaman</h3>
            <ul class="info-list">
                <li>
                    <span class="info-label">Disetujui:</span>
                    <span class="info-value badge badge-success"><?= $data['stats']['disetujui'] ?? 0; ?></span>
                </li>
                <li>
                    <span class="info-label">Pending:</span>
                    <span class="info-value badge badge-warning"><?= $data['stats']['pending'] ?? 0; ?></span>
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

    <!-- Tips penggunaan sistem -->
    <div class="tips-section">
        <div class="tip-box">
            <span class="tip-icon">💡</span>
            <div class="tip-content">
                <strong>Tips:</strong> Kembalikan alat tepat waktu untuk menjaga reputasi peminjaman Anda dan memudahkan peminjaman berikutnya.
            </div>
        </div>
    </div>
</div>


