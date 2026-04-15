<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<!-- Container utama dashboard admin -->
<div class="dashboard-container">

    <?php if (isset($_GET['success']) && $_GET['success'] === 'password'): ?>
    <p style="color:#16a34a; font-weight:600; margin-bottom:10px;">✓ Password berhasil diubah.</p>
    <?php endif; ?>

    <!-- Sapaan nama admin yang sedang login -->
    <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['nama']); ?>! 👋</h2>
    <p>Ringkasan sistem peminjaman peralatan olahraga hari ini</p>

    <!-- Kartu ringkasan statistik -->
    <div class="cards">

        <!-- Total alat -->
        <div class="card card-blue">
            <div class="card-icon">🛠</div>
            <div class="card-body">
                <h4>Total Alat</h4>
                <h1><?= $data['stats']['total_alat'] ?? 0; ?></h1>
                <a href="<?= BASEURL; ?>/admin/alat" class="card-link">Kelola Alat →</a>
            </div>
        </div>

        <!-- Total pengguna -->
        <div class="card card-green">
            <div class="card-icon">👤</div>
            <div class="card-body">
                <h4>Total Pengguna</h4>
                <h1><?= $data['stats']['total_pengguna'] ?? 0; ?></h1>
                <a href="<?= BASEURL; ?>/admin/pengguna" class="card-link">Kelola User →</a>
            </div>
        </div>

        <!-- Total kategori -->
        <div class="card card-purple">
            <div class="card-icon">📂</div>
            <div class="card-body">
                <h4>Total Kategori</h4>
                <h1><?= $data['stats']['total_kategori'] ?? 0; ?></h1>
                <a href="<?= BASEURL; ?>/admin/kategori" class="card-link">Kelola Kategori →</a>
            </div>
        </div>

        <!-- Total peminjaman aktif -->
        <div class="card card-orange">
            <div class="card-icon">📊</div>
            <div class="card-body">
                <h4>Peminjaman Aktif</h4>
                <h1><?= $data['stats']['total_pinjam'] ?? 0; ?></h1>
                <a href="<?= BASEURL; ?>/admin/peminjaman" class="card-link">Lihat Detail →</a>
            </div>
        </div>
    </div>

    <!-- Informasi dan aksi cepat -->
    <div class="info-section">

        <!-- Informasi singkat status peminjaman -->
        <div class="info-box">
            <h3>📋 Informasi Cepat</h3>
            <ul class="info-list">
                <li>
                    <span class="info-label">Peminjaman Pending:</span>
                    <span class="info-value"><?= $data['stats']['pending'] ?? 0; ?></span>
                </li>
                <li>
                    <span class="info-label">Peminjaman Disetujui:</span>
                    <span class="info-value"><?= $data['stats']['disetujui'] ?? 0; ?></span>
                </li>
                <li>
                    <span class="info-label">Peminjaman Ditolak:</span>
                    <span class="info-value"><?= $data['stats']['ditolak'] ?? 0; ?></span>
                </li>
                <li>
                    <span class="info-label">Sudah Dikembalikan:</span>
                    <span class="info-value"><?= $data['stats']['dikembalikan'] ?? 0; ?></span>
                </li>
            </ul>
        </div>

        <!-- Tombol aksi cepat admin -->
        <div class="info-box">
            <h3>⚡ Aksi Cepat</h3>
            <div class="quick-actions">
                <a href="<?= BASEURL; ?>/admin/tambahAlat" class="btn btn-primary">➕ Tambah Alat</a>
                <a href="<?= BASEURL; ?>/admin/tambahPengguna" class="btn btn-success">👤 Tambah Pengguna</a>
                <a href="<?= BASEURL; ?>/admin/tambahKategori" class="btn btn-info">📂 Tambah Kategori</a>
                <a href="<?= BASEURL; ?>/admin/logAktivitas" class="btn btn-secondary">📝 Lihat Log</a>
            </div>
        </div>
    </div>

    <!-- Tips singkat untuk admin -->
    <div class="tips-section">
        <div class="tip-box">
            <span class="tip-icon">💡</span>
            <div class="tip-content">
                <strong>Tips:</strong> Periksa peminjaman pending secara berkala untuk memastikan sistem berjalan lancar.
            </div>
        </div>
    </div>

</div>

