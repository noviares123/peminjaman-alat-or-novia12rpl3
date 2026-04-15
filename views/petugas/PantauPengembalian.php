<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>
<!-- Memanggil header layout -->

<h3>👁 Pantau Pengembalian Alat</h3>
<!-- Judul halaman pantau pengembalian alat -->

<?php if (isset($_SESSION['debug_info'])) : ?>
<!-- Menampilkan informasi debug jika tersedia -->
    <div style="background:#dbeafe; border-left:4px solid #3b82f6; padding:15px; border-radius:8px; margin-bottom:20px;">
        <p style="color:#1e40af; font-weight:600; margin:0;">
            ℹ️ Debug Info: <?= htmlspecialchars($_SESSION['debug_info']); ?>
            <!-- Isi pesan debug -->
        </p>
    </div>
    <?php unset($_SESSION['debug_info']); ?>
<?php endif; ?>

<?php if (isset($_GET['success'])) : ?>
<!-- Menampilkan notifikasi jika proses pengembalian berhasil -->
    <div style="background:#dcfce7; border-left:4px solid #16a34a; padding:15px; border-radius:8px; margin-bottom:20px;">
        <p style="color:#15803d; font-weight:600; margin:0;">
            <?php if ($_GET['success'] == 1) : ?>
                ✓ Pengembalian berhasil disetujui. Stok telah dikembalikan.
                <!-- Pesan saat pengembalian disetujui -->
            <?php else : ?>
                ✓ Pengembalian berhasil ditolak. Keterangan telah dikirim ke peminjam.
                <!-- Pesan saat pengembalian ditolak -->
            <?php endif; ?>
        </p>
    </div>
<?php elseif (isset($_GET['error'])) : ?>
<!-- Menampilkan notifikasi jika proses pengembalian gagal -->
    <div style="background:#fee2e2; border-left:4px solid #dc2626; padding:15px; border-radius:8px; margin-bottom:20px;">
        <p style="color:#b91c1c; font-weight:600; margin:0 0 10px 0;">
            ✗ Gagal memproses pengembalian.
            <!-- Pesan gagal -->
        </p>

        <?php if (isset($_SESSION['debug_error'])) : ?>
        <!-- Menampilkan detail error (debug) -->
            <p style="color:#991b1b; font-size:13px; margin:0; background:#fef2f2; padding:10px; border-radius:5px;">
                <strong>Detail Error:</strong> <?= htmlspecialchars($_SESSION['debug_error']); ?>
            </p>
            <?php unset($_SESSION['debug_error']); ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if (empty($data['kembali'])): ?>
<!-- Kondisi jika tidak ada pengajuan pengembalian alat -->
    <div style="background:#fff3cd; border-left:4px solid #ffc107; padding:15px; border-radius:8px; margin-bottom:20px;">
        <p style="margin:0; color:#856404;">
            ℹ️ Tidak ada pengajuan pengembalian yang menunggu konfirmasi.
        </p>
    </div>

<?php else: ?>
<!-- Tabel data pengajuan pengembalian alat -->

    <table>
        <tr>
            <th>Nama Peminjam</th>
            <th>Alat</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Jumlah</th>
            <th>Kondisi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($data['kembali'] as $k) : ?>
        <!-- Menampilkan data pengembalian per peminjaman -->
        <tr>
            <td><?= htmlspecialchars($k['nama']); ?></td>
            <!-- Nama peminjam -->

            <td><?= htmlspecialchars($k['nama_alat']); ?></td>
            <!-- Nama alat -->

            <td><?= $k['tanggal_pinjam']; ?></td>
            <!-- Tanggal pinjam -->

            <td><?= $k['tanggal_kembali']; ?></td>
            <!-- Tanggal kembali -->

            <td><?= $k['total_item']; ?></td>
            <!-- Jumlah alat -->

            <td>
                <!-- Menampilkan kondisi alat dengan warna -->
                <span style="color:<?= $k['kondisi'] == 'Baik' ? 'green' : ($k['kondisi'] == 'Rusak' ? 'red' : 'orange'); ?>; font-weight:600;">
                    <?= htmlspecialchars($k['kondisi'] ?? '-'); ?>
                </span>
            </td>

            <td>
                <!-- Status menunggu konfirmasi -->
                <span class="badge" style="background:#ffc107; color:#000;">
                    ⏳ Menunggu
                </span>
            </td>

            <td>
                <!-- Tombol aksi setujui atau tolak pengembalian -->
                <a href="<?= BASEURL ?>/petugas/pantau?kembali=<?= $k['id_peminjaman']; ?>"
                   class="btn btn-success"
                   onclick="return confirm('Setujui pengembalian ini?')">✔ Setujui</a>

                <button onclick="showTolakPengembalianModal(<?= $k['id_peminjaman']; ?>, '<?= htmlspecialchars($k['nama']); ?>', '<?= htmlspecialchars($k['nama_alat']); ?>')" 
                        class="btn btn-danger">✖ Tolak</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php if (isset($data['debug_mode']) && $data['debug_mode']): ?>
<!-- Mode debug untuk menampilkan seluruh data peminjaman -->
    <div style="background:#f3f4f6; border:2px solid #9ca3af; padding:20px; border-radius:8px; margin-top:30px;">
        <h4>🔍 DEBUG MODE - Semua Data Peminjaman</h4>
    </div>
<?php endif; ?>

<!-- Modal untuk input keterangan penolakan pengembalian -->
<div id="tolakPengembalianModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000;">
    <div style="position:relative; top:50%; left:50%; transform:translate(-50%, -50%); background:white; padding:30px; border-radius:10px; max-width:500px; width:90%;">
        <h3 style="margin-top:0; color:#800020;">Tolak Pengembalian</h3>
        <p>Peminjam: <strong id="namaPeminjamPengembalian"></strong></p>
        <p>Alat: <strong id="namaAlatPengembalian"></strong></p>
        
        <form id="tolakPengembalianForm" method="POST" action="<?= BASEURL ?>/petugas/tolakPengembalian">
            <input type="hidden" name="id_peminjaman" id="idPeminjamanPengembalian">
            
            <label style="font-weight:600; color:#333;">Alasan Penolakan:</label><br>
            <textarea name="keterangan_pengembalian" rows="4" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; margin-top:5px; font-family:inherit;" required placeholder="Contoh: Barang rusak harus diperbaiki dulu, Barang tidak lengkap, Kondisi tidak sesuai, dll."></textarea>
            <br><br>
            
            <button type="submit" class="btn btn-danger">✖ Tolak Pengembalian</button>
            <button type="button" onclick="closeTolakPengembalianModal()" class="btn btn-secondary">Batal</button>
        </form>
    </div>
</div>

<script>
function showTolakPengembalianModal(id, nama, alat) {
    document.getElementById('idPeminjamanPengembalian').value = id;
    document.getElementById('namaPeminjamPengembalian').textContent = nama;
    document.getElementById('namaAlatPengembalian').textContent = alat;
    document.getElementById('tolakPengembalianModal').style.display = 'block';
}

function closeTolakPengembalianModal() {
    document.getElementById('tolakPengembalianModal').style.display = 'none';
    document.getElementById('tolakPengembalianForm').reset();
}

// Close modal when clicking outside
document.getElementById('tolakPengembalianModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeTolakPengembalianModal();
    }
});
</script>


<!-- Memanggil footer layout -->