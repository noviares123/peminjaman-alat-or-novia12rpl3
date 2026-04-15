<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<h3>✅ Setujui / Tolak Peminjaman</h3>

<?php if (isset($_GET['success'])) : ?>
    <div style="background:#dcfce7; border-left:4px solid #16a34a; padding:15px; border-radius:8px; margin-bottom:20px;">
        <p style="color:#15803d; font-weight:600; margin:0;">
            <?php if ($_GET['success'] === 'setuju') : ?>
                ✓ Peminjaman berhasil disetujui.
            <?php elseif ($_GET['success'] === 'tolak') : ?>
                ✓ Peminjaman berhasil ditolak. Keterangan telah dikirim ke peminjam.
            <?php endif; ?>
        </p>
    </div>
<?php elseif (isset($_GET['error'])) : ?>
    <div style="background:#fee2e2; border-left:4px solid #dc2626; padding:15px; border-radius:8px; margin-bottom:20px;">
        <p style="color:#b91c1c; font-weight:600; margin:0 0 10px 0;">
            ✗ Gagal memproses peminjaman.
        </p>
        <?php if (isset($_SESSION['error_detail'])) : ?>
            <p style="color:#991b1b; font-size:13px; margin:0; background:#fef2f2; padding:10px; border-radius:5px;">
                <strong>Detail Error:</strong> <?= htmlspecialchars($_SESSION['error_detail']); ?>
            </p>
            <?php unset($_SESSION['error_detail']); ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if (empty($data['pinjam'])) : ?>
    <div style="background:#fff3cd; border-left:4px solid #ffc107; padding:15px; border-radius:8px; margin-bottom:20px;">
        <p style="margin:0; color:#856404;">
            ℹ️ Tidak ada pengajuan peminjaman yang menunggu persetujuan.
        </p>
    </div>

<?php else : ?>
    <table>
        <tr>
            <th>Nama Peminjam</th>
            <th>Alat</th>
            <th>Jumlah</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($data['pinjam'] as $p) : ?>
        <tr>
            <td><?= htmlspecialchars($p['nama']); ?></td>
            <td><?= htmlspecialchars($p['nama_alat']); ?></td>
            <td><?= $p['total_item']; ?></td>
            <td><?= $p['tanggal_pinjam']; ?></td>
            <td><?= $p['tanggal_kembali']; ?></td>
            <td>
                <span class="badge petugas"><?= $p['status']; ?></span>
            </td>
            <td>
                <a href="<?= BASEURL ?>/petugas/setujui?aksi=setuju&id=<?= $p['id_peminjaman']; ?>"
                   onclick="return confirm('Setujui peminjaman ini?')"
                   class="btn btn-success">✔ Setujui</a>

                <button onclick="showTolakModal(<?= $p['id_peminjaman']; ?>, '<?= htmlspecialchars($p['nama']); ?>')"
                        class="btn btn-danger">✖ Tolak</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<!-- Modal untuk input keterangan penolakan -->
<div id="tolakModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000;">
    <div style="position:relative; top:50%; left:50%; transform:translate(-50%, -50%); background:white; padding:30px; border-radius:10px; max-width:500px; width:90%;">
        <h3 style="margin-top:0; color:#800020;">Tolak Peminjaman</h3>
        <p>Peminjam: <strong id="namaPeminjam"></strong></p>

        <form id="tolakForm" method="POST" action="<?= BASEURL ?>/petugas/tolakPeminjaman">
            <input type="hidden" name="id_peminjaman" id="idPeminjaman">

            <label style="font-weight:600; color:#333;">Alasan Penolakan:</label><br>
            <textarea name="keterangan" rows="4" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; margin-top:5px; font-family:inherit;" required placeholder="Contoh: Stok tidak mencukupi, Peminjam masih memiliki tanggungan, dll."></textarea>
            <br><br>

            <button type="submit" class="btn btn-danger">✖ Tolak Peminjaman</button>
            <button type="button" onclick="closeTolakModal()" class="btn btn-secondary">Batal</button>
        </form>
    </div>
</div>

<script>
function showTolakModal(id, nama) {
    document.getElementById('idPeminjaman').value = id;
    document.getElementById('namaPeminjam').textContent = nama;
    document.getElementById('tolakModal').style.display = 'block';
}

function closeTolakModal() {
    document.getElementById('tolakModal').style.display = 'none';
    document.getElementById('tolakForm').reset();
}

document.getElementById('tolakModal').addEventListener('click', function(e) {
    if (e.target === this) closeTolakModal();
});
</script>

