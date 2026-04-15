<!DOCTYPE html>
<html>
<head>
    <!-- Judul halaman laporan -->
    <title>Laporan Peminjaman Peralatan Olahraga</title>

    <style>
        /* Style dasar halaman laporan */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        /* Header laporan */
        .header-laporan {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
        }

        /* Judul utama laporan */
        .header-laporan h2 {
            margin: 5px 0;
            font-size: 20px;
        }

        /* Subjudul laporan */
        .header-laporan h3 {
            margin: 5px 0;
            font-size: 16px;
            font-weight: normal;
        }

        /* Informasi tambahan laporan */
        .info-laporan {
            margin-bottom: 20px;
        }

        /* Style tabel laporan */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        /* Header kolom tabel */
        table th {
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #333;
            font-weight: bold;
            text-align: left;
        }

        /* Isi tabel */
        table td {
            padding: 8px;
            border: 1px solid #333;
        }

        /* Footer laporan */
        .footer-laporan {
            margin-top: 50px;
            text-align: right;
        }

        /* Area tanda tangan */
        .ttd {
            margin-top: 80px;
            text-decoration: underline;
        }

        /* Area yang tidak ikut tercetak */
        .no-print {
            margin-bottom: 20px;
        }

        /* Style button */
        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            border: none;
            text-align: center;
        }

        .btn-primary,
        .btn-secondary {
            background: linear-gradient(135deg, #800020 0%, #5c0011 100%);
            color: white;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background: linear-gradient(135deg, #a0002a 0%, #700018 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(128,0,32,0.3);
        }

        /* Pengaturan khusus saat halaman dicetak */
        @media print {
            .no-print {
                display: none;
            }
            body {
                margin: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<!-- Tombol cetak dan kembali (tidak ikut tercetak) -->
<div class="no-print">
    <button onclick="window.print()" class="btn btn-primary">
        🖨 Cetak / Print
    </button>

    <a href="<?= BASEURL; ?>/petugas/dashboard" class="btn btn-secondary" style="margin-left:10px;">
        ← Kembali
    </a>
</div>

<!-- Header judul laporan -->
<div class="header-laporan">
    <h2>LAPORAN PEMINJAMAN PERALATAN OLAHRAGA</h2>
    <h3>Sistem Peminjaman Peralatan Olahraga</h3>
</div>

<!-- Informasi detail laporan -->
<div class="info-laporan">
    <table style="border: none; width: auto;">
        <tr>
            <td style="border: none;"><strong>Tanggal Cetak</strong></td>
            <td style="border: none;">: <?= date('d F Y'); ?></td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Dicetak Oleh</strong></td>
            <td style="border: none;">
                : <?= $_SESSION['nama']; ?> (<?= ucfirst($_SESSION['role']); ?>)
            </td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Total Data</strong></td>
            <td style="border: none;">
                : <?= count($data['laporan']); ?> peminjaman
            </td>
        </tr>
    </table>
</div>

<!-- Tabel utama data laporan peminjaman -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Alat</th>
            <th>Jumlah</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <!-- Menampilkan pesan jika data laporan kosong -->
        <?php if (empty($data['laporan'])) : ?>
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">
                    Tidak ada data peminjaman
                </td>
            </tr>
        <?php else : ?>

        <!-- Menampilkan data laporan satu per satu -->
        <?php $no = 1; foreach ($data['laporan'] as $l) : ?>
            <tr>
                <td style="text-align: center;"><?= $no++; ?></td>
                <td><?= htmlspecialchars($l['nama']); ?></td>
                <td><?= htmlspecialchars($l['nama_alat']); ?></td>
                <td style="text-align: center;"><?= $l['total_item']; ?> unit</td>
                <td style="text-align: center;"><?= date('d/m/Y', strtotime($l['tanggal_pinjam'])); ?></td>
                <td style="text-align: center;">
                    <?= $l['tanggal_kembali'] ? date('d/m/Y', strtotime($l['tanggal_kembali'])) : '-'; ?>
                </td>
                <td style="text-align: center;"><?= $l['status']; ?></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<!-- Bagian tanda tangan petugas -->
<div class="footer-laporan">
    <p>Mengetahui,<br>Petugas</p>
    <p class="ttd"><?= $_SESSION['nama']; ?></p>
</div>

</body>
</html>
