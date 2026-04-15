<?php include __DIR__ . '/../layout/header.php'; // Memanggil header layout ?>

<h3>🔑 Ubah Password</h3>

<?php if (isset($_GET['error'])): ?>
    <p style="color:#b91c1c; font-weight:600; margin-bottom:10px;">
        <?php
        $err = $_GET['error'];
        if ($err === 'salah') echo '✗ Password lama tidak sesuai.';
        elseif ($err === 'beda') echo '✗ Konfirmasi password tidak cocok.';
        elseif ($err === 'pendek') echo '✗ Password baru minimal 6 karakter.';
        ?>
    </p>
<?php endif; ?>

<form action="<?= BASEURL; ?>/auth/ubahPassword" method="POST">

    <label>Password Lama</label><br>
    <input type="password" name="password_lama" required><br><br>

    <label>Password Baru</label><br>
    <input type="password" name="password_baru" minlength="6" required><br><br>

    <label>Konfirmasi Password Baru</label><br>
    <input type="password" name="konfirmasi_password" minlength="6" required><br><br>

    <button type="submit">Simpan Password</button>
    <a class="btn-modal" href="javascript:history.back()">Batal</a>
</form>


