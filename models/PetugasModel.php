<?php

class PetugasModel {

    private $db;

    // Menginisialisasi koneksi database menggunakan Singleton PDO
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Mengambil semua peminjaman dengan status menunggu persetujuan
    public function getPending() {
        $sql = "
            SELECT p.*, u.nama, a.nama_alat
            FROM peminjaman p
            JOIN pengguna u ON p.id_pengguna = u.id_pengguna
            JOIN alat a ON p.id_alat = a.id_alat
            WHERE p.status = 'Menunggu'
            ORDER BY p.id_peminjaman DESC
        ";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Menyetujui pengajuan peminjaman
    public function setujuiPeminjaman($id) {
        $stmt = $this->db->prepare(
            "UPDATE peminjaman SET status = 'Di Setujui' WHERE id_peminjaman = ?"
        );
        return $stmt->execute([$id]);
    }

    // Menolak peminjaman dan mengembalikan stok alat
    public function tolakPeminjaman($id, $keterangan = null) {
        try {
            $this->db->beginTransaction();

            // 1. Mengambil data peminjaman yang akan ditolak
            $stmt = $this->db->prepare(
                "SELECT id_alat, total_item FROM peminjaman WHERE id_peminjaman = ? FOR UPDATE"
            );
            $stmt->execute([$id]);
            $row = $stmt->fetch();

            if (!$row) {
                $_SESSION['error_detail'] = "Data peminjaman tidak ditemukan";
                $this->db->rollBack();
                return false;
            }

            // 2. Mengembalikan stok alat
            $stmt = $this->db->prepare("UPDATE alat SET stok = stok + ? WHERE id_alat = ?");
            $stmt->execute([$row['total_item'], $row['id_alat']]);

            // 3. Mengubah status peminjaman menjadi ditolak
            $stmt = $this->db->prepare(
                "UPDATE peminjaman SET status = 'Di Tolak', keterangan = ? WHERE id_peminjaman = ?"
            );
            $result = $stmt->execute([$keterangan, $id]);

            $this->db->commit();
            return $result;

        } catch (Exception $e) {
            $this->db->rollBack();
            $_SESSION['error_detail'] = "Gagal menolak: " . $e->getMessage();
            return false;
        }
    }

    // Mengambil peminjaman yang sedang diproses pengembalian
    public function getSedangDipinjam() {
        $sql = "
            SELECT p.*, u.nama, a.nama_alat
            FROM peminjaman p
            JOIN pengguna u ON p.id_pengguna = u.id_pengguna
            JOIN alat a ON p.id_alat = a.id_alat
            WHERE p.status = 'Di Setujui'
              AND p.kondisi IS NOT NULL
              AND p.kondisi != ''
            ORDER BY p.id_peminjaman DESC
        ";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Mengonfirmasi pengembalian dan menambah stok alat
    public function konfirmasiKembali($id) {
        try {
            $this->db->beginTransaction();

            // 1. Mengambil data peminjaman
            $stmt = $this->db->prepare(
                "SELECT id_alat, total_item FROM peminjaman WHERE id_peminjaman = ? FOR UPDATE"
            );
            $stmt->execute([$id]);
            $row = $stmt->fetch();

            if (!$row) {
                $_SESSION['debug_error'] = "Data peminjaman tidak ditemukan";
                $this->db->rollBack();
                return false;
            }

            // 2. Menambahkan kembali stok alat
            $stmt = $this->db->prepare("UPDATE alat SET stok = stok + ? WHERE id_alat = ?");
            $stmt->execute([$row['total_item'], $row['id_alat']]);

            // 3. Mengubah status peminjaman menjadi dikembalikan
            $stmt = $this->db->prepare("UPDATE peminjaman SET status = 'Kembali' WHERE id_peminjaman = ?");
            $result = $stmt->execute([$id]);

            $this->db->commit();
            return $result;

        } catch (Exception $e) {
            $this->db->rollBack();
            $_SESSION['debug_error'] = "Exception: " . $e->getMessage();
            return false;
        }
    }

    // Menolak pengajuan pengembalian (meminta user mengajukan ulang)
    public function tolakPengembalian($id, $keterangan = null) {
        $stmt = $this->db->prepare("
            UPDATE peminjaman 
            SET kondisi = NULL, keterangan = ?
            WHERE id_peminjaman = ?
        ");
        return $stmt->execute([$keterangan, $id]);
    }

    // Mengambil peminjaman yang menunggu konfirmasi pengembalian
    public function getMenungguKonfirmasi() {
        $sql = "SELECT p.*, u.nama, a.nama_alat
                FROM peminjaman p
                JOIN pengguna u ON p.id_pengguna = u.id_pengguna
                JOIN alat a ON p.id_alat = a.id_alat
                WHERE p.status = 'Di Setujui'
                  AND p.kondisi IS NOT NULL AND p.kondisi != ''
                ORDER BY p.id_peminjaman DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Menghitung peminjaman yang dikembalikan hari ini
    public function getDikembalikanHariIni() {
        $today = date('Y-m-d');
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) as total FROM peminjaman WHERE status = 'Kembali' AND DATE(tanggal_kembali) = ?"
        );
        $stmt->execute([$today]);
        $row = $stmt->fetch();
        return $row['total'] ?? 0;
    }

    // Menghitung peminjaman yang terlambat
    public function getTerlambat() {
        $today = date('Y-m-d');
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) as total FROM peminjaman WHERE status = 'Di Setujui' AND tanggal_kembali < ?"
        );
        $stmt->execute([$today]);
        $row = $stmt->fetch();
        return $row['total'] ?? 0;
    }

    // Menghitung peminjaman berdasarkan status
    public function countByStatus($status) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM peminjaman WHERE status = ?");
        $stmt->execute([$status]);
        $row = $stmt->fetch();
        return $row['total'] ?? 0;
    }

    // Mengambil seluruh riwayat peminjaman untuk laporan
    public function getSemuaRiwayat() {
        $sql = "
            SELECT p.*, u.nama, a.nama_alat
            FROM peminjaman p
            JOIN pengguna u ON p.id_pengguna = u.id_pengguna
            JOIN alat a ON p.id_alat = a.id_alat
            ORDER BY p.id_peminjaman DESC
        ";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}