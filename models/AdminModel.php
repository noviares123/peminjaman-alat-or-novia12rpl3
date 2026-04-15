<?php

// Model untuk mengelola seluruh data admin (pengguna, alat, kategori, peminjaman)
class AdminModel {

    // Menyimpan koneksi database
    private $db;

    // Menginisialisasi koneksi database menggunakan Singleton PDO
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // ================= PENGGUNA =================

    // Mengambil semua data pengguna
    public function getAllPengguna() {
        $stmt = $this->db->query("SELECT * FROM pengguna");
        return $stmt->fetchAll();
    }

    // Mengambil satu data pengguna berdasarkan ID
    public function getPenggunaById($id) {
        $stmt = $this->db->prepare("SELECT * FROM pengguna WHERE id_pengguna = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Cek apakah username sudah ada
    public function isUsernameExists($username, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT id_pengguna FROM pengguna WHERE username = ? AND id_pengguna != ?");
            $stmt->execute([$username, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT id_pengguna FROM pengguna WHERE username = ?");
            $stmt->execute([$username]);
        }
        return $stmt->rowCount() > 0;
    }

    public function tambahPengguna($data) {
        if ($this->isUsernameExists($data['username'])) {
            $_SESSION['error_message'] = "Username '{$data['username']}' sudah digunakan.";
            return false;
        }

        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = $this->db->prepare(
            "INSERT INTO pengguna (nama, username, password, email, role, no_handphone, alamat) 
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        return $stmt->execute([
            $data['nama'],
            $data['username'],
            $password,
            $data['email'],
            $data['role'],
            $data['hp'],
            $data['alamat']
        ]);
    }

    public function updatePengguna($id, $data) {
        if ($this->isUsernameExists($data['username'], $id)) {
            $_SESSION['error_message'] = "Username '{$data['username']}' sudah digunakan.";
            return false;
        }

        if (!empty($data['password'])) {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $stmt = $this->db->prepare(
                "UPDATE pengguna SET nama=?, username=?, password=?, email=?, role=?, no_handphone=?, alamat=? WHERE id_pengguna=?"
            );
            $params = [$data['nama'], $data['username'], $password, $data['email'], $data['role'], $data['hp'], $data['alamat'], $id];
        } else {
            $stmt = $this->db->prepare(
                "UPDATE pengguna SET nama=?, username=?, email=?, role=?, no_handphone=?, alamat=? WHERE id_pengguna=?"
            );
            $params = [$data['nama'], $data['username'], $data['email'], $data['role'], $data['hp'], $data['alamat'], $id];
        }

        return $stmt->execute($params);
    }

    // ================= ALAT =================

    public function getAllAlat() {
        $sql = "SELECT a.*, k.nama_kategori FROM alat a 
                LEFT JOIN kategori k ON a.id_kategori = k.id_kategori 
                ORDER BY a.id_alat DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function getAlatById($id) {
        $stmt = $this->db->prepare("SELECT * FROM alat WHERE id_alat = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function tambahAlat($data) {
        $stmt = $this->db->prepare("INSERT INTO alat (id_kategori, nama_alat, kondisi, stok) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['id_kategori'], $data['nama_alat'], $data['kondisi'], $data['stok']]);
    }

    public function updateAlat($id, $data) {
        $stmt = $this->db->prepare("UPDATE alat SET id_kategori=?, nama_alat=?, kondisi=?, stok=? WHERE id_alat=?");
        return $stmt->execute([$data['id_kategori'], $data['nama_alat'], $data['kondisi'], $data['stok'], $id]);
    }

    public function deleteAlat($id) {
        $stmt = $this->db->prepare("DELETE FROM alat WHERE id_alat=?");
        return $stmt->execute([$id]);
    }

    // ================= KATEGORI =================

    public function getAllKategori() {
        return $this->db->query("SELECT * FROM kategori")->fetchAll();
    }

    public function getKategoriById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kategori WHERE id_kategori = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function tambahKategori($nama) {
        $stmt = $this->db->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
        return $stmt->execute([$nama]);
    }

    public function updateKategori($id, $nama) {
        $stmt = $this->db->prepare("UPDATE kategori SET nama_kategori = ? WHERE id_kategori = ?");
        return $stmt->execute([$nama, $id]);
    }

    // Cek apakah kategori masih dipakai oleh alat
    public function isKategoriDipakai($id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM alat WHERE id_kategori = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }

    // ================= PEMINJAMAN =================

    public function getAllPeminjaman() {
        $sql = "SELECT p.*, u.nama, a.nama_alat 
                FROM peminjaman p 
                LEFT JOIN pengguna u ON p.id_pengguna = u.id_pengguna 
                LEFT JOIN alat a ON p.id_alat = a.id_alat 
                ORDER BY p.id_peminjaman DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function getPeminjamanById($id) {
        $stmt = $this->db->prepare("SELECT * FROM peminjaman WHERE id_peminjaman = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function tambahPeminjaman($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO peminjaman (id_pengguna, id_alat, tanggal_pinjam, tanggal_kembali, total_item, status)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['id_pengguna'],
            $data['id_alat'],
            $data['tanggal_pinjam'],
            $data['tanggal_kembali'] ?: null,
            $data['total_item'],
            $data['status']
        ]);
    }

    public function updatePeminjaman($id, $data) {
        $stmt = $this->db->prepare("UPDATE peminjaman SET status = ?, tanggal_kembali = ?, total_item = ? WHERE id_peminjaman = ?");
        return $stmt->execute([$data['status'], $data['tanggal_kembali'], $data['total_item'], $id]);
    }

    public function deletePeminjaman($id) {
        $stmt = $this->db->prepare("DELETE FROM peminjaman WHERE id_peminjaman=?");
        return $stmt->execute([$id]);
    }

    // ================= GLOBAL & STATS =================

    public function hapusData($tabel, $primaryKey, $id) {
        if ($tabel === 'pengguna') return $this->hapusPengguna($id);
        if ($tabel === 'alat') return $this->deleteAlat($id);
        if ($tabel === 'peminjaman') return $this->deletePeminjaman($id);

        $stmt = $this->db->prepare("DELETE FROM $tabel WHERE $primaryKey=?");
        return $stmt->execute([$id]);
    }

    private function hapusPengguna($id) {
        try {
            $this->db->beginTransaction();
            
            $stmt1 = $this->db->prepare("DELETE FROM peminjaman WHERE id_pengguna = ?");
            $stmt1->execute([$id]);

            $stmt2 = $this->db->prepare("DELETE FROM pengguna WHERE id_pengguna = ?");
            $stmt2->execute([$id]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    public function getStats() {
        return [
            'total_alat'     => $this->db->query("SELECT COUNT(*) FROM alat")->fetchColumn(),
            'total_pengguna' => $this->db->query("SELECT COUNT(*) FROM pengguna")->fetchColumn(),
            'total_kategori' => $this->db->query("SELECT COUNT(*) FROM kategori")->fetchColumn(),
            'pending'        => $this->db->query("SELECT COUNT(*) FROM peminjaman WHERE status='Menunggu'")->fetchColumn(),
            'disetujui'      => $this->db->query("SELECT COUNT(*) FROM peminjaman WHERE status='Di Setujui'")->fetchColumn(),
            'ditolak'        => $this->db->query("SELECT COUNT(*) FROM peminjaman WHERE status='Di Tolak'")->fetchColumn(),
            'dikembalikan'   => $this->db->query("SELECT COUNT(*) FROM peminjaman WHERE status='Kembali'")->fetchColumn(),
        ];
    }
}