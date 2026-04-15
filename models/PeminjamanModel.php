<?php

class PeminjamanModel {
    private $db;

    // Menginisialisasi koneksi database menggunakan Singleton PDO
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Membuat pengajuan peminjaman dan mengurangi stok alat
    public function buatPengajuan($id_user, $data) {
        try {
            // Mulai Transaksi Database
            $this->db->beginTransaction();

            // 1. Cek apakah user sudah punya peminjaman aktif untuk alat yang sama
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as total FROM peminjaman
                WHERE id_pengguna = ? AND id_alat = ? AND status IN ('Menunggu', 'Di Setujui')
            ");
            $stmt->execute([$id_user, $data['id_alat']]);
            $cek = $stmt->fetch();

            if ($cek['total'] > 0) {
                $_SESSION['error_message'] = "Kamu sudah memiliki peminjaman aktif untuk alat ini.";
                $this->db->rollBack(); // Batalkan transaksi
                return false;
            }

            // 2. Ambil stok alat (Gunakan FOR UPDATE agar stok tidak berubah saat proses berlangsung)
            $stmt = $this->db->prepare("SELECT stok FROM alat WHERE id_alat = ? FOR UPDATE");
            $stmt->execute([$data['id_alat']]);
            $alat = $stmt->fetch();

            if (!$alat) {
                $_SESSION['error_message'] = "Alat tidak ditemukan";
                $this->db->rollBack();
                return false;
            }

            $stok = (int)$alat['stok'];
            $jumlah = (int)$data['total_item'];

            // 3. Cek stok mencukupi
            if ($stok < $jumlah) {
                $_SESSION['error_message'] = "Stok tidak mencukupi. Tersedia: $stok, Diminta: $jumlah";
                $this->db->rollBack();
                return false;
            }

            // 4. Kurangi stok alat
            $stmt = $this->db->prepare("UPDATE alat SET stok = stok - ? WHERE id_alat = ?");
            $stmt->execute([$jumlah, $data['id_alat']]);

            // 5. Simpan data peminjaman
            $stmt = $this->db->prepare("
                INSERT INTO peminjaman (id_pengguna, id_alat, tanggal_pinjam, tanggal_kembali, total_item, status)
                VALUES (?, ?, ?, ?, ?, 'Menunggu')
            ");
            
            $result = $stmt->execute([
                $id_user, 
                $data['id_alat'], 
                $data['tanggal_pinjam'], 
                $data['tanggal_kembali'], 
                $jumlah
            ]);

            // Jika semua berhasil, simpan permanen
            $this->db->commit();
            return true;

        } catch (Exception $e) {
            // Jika ada error apapun, batalkan semua perubahan di database
            $this->db->rollBack();
            $_SESSION['error_message'] = "Error: " . $e->getMessage();
            return false;
        }
    }

    // Mengubah status peminjaman oleh admin atau petugas
    public function updateStatus($id_pinjam, $status) {
        $stmt = $this->db->prepare("UPDATE peminjaman SET status = ? WHERE id_peminjaman = ?");
        return $stmt->execute([$status, $id_pinjam]);
    }

    // Mengambil riwayat peminjaman berdasarkan user
    public function getRiwayatByUser($id_user) {
        $stmt = $this->db->prepare("
            SELECT p.*, a.nama_alat
            FROM peminjaman p
            JOIN alat a ON p.id_alat = a.id_alat
            WHERE p.id_pengguna = ?
            ORDER BY p.id_peminjaman DESC
        ");
        $stmt->execute([$id_user]);
        return $stmt->fetchAll();
    }

    // Mengambil peminjaman yang disetujui dan belum dikembalikan
    public function getDisetujuiByUser($id_user) {
        $stmt = $this->db->prepare("
            SELECT p.*, a.nama_alat
            FROM peminjaman p
            JOIN alat a ON p.id_alat = a.id_alat
            WHERE p.id_pengguna = ? 
              AND p.status = 'Di Setujui'
              AND (p.kondisi IS NULL OR p.kondisi = '')
              AND p.status != 'Kembali'
            ORDER BY p.id_peminjaman DESC
        ");
        $stmt->execute([$id_user]);
        return $stmt->fetchAll();
    }

    // Mengajukan pengembalian alat oleh user
    public function requestPengembalian($id_user, $id_peminjaman, $tanggal_kembali, $kondisi) {
        $stmt = $this->db->prepare("
            UPDATE peminjaman
            SET tanggal_kembali = ?, kondisi = ?
            WHERE id_peminjaman = ? AND id_pengguna = ? AND status = 'Di Setujui'
        ");
        return $stmt->execute([$tanggal_kembali, $kondisi, $id_peminjaman, $id_user]);
    }
}