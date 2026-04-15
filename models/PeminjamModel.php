<?php

class PeminjamModel {
    private $db;

    // Menginisialisasi koneksi database menggunakan Singleton PDO
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Menyimpan pengajuan peminjaman baru oleh pengguna
    public function tambahPengajuan($data) {
        $query = "INSERT INTO peminjaman 
                  (id_pengguna, id_alat, tanggal_pinjam, total_item, status)
                  VALUES (?, ?, ?, ?, 'Menunggu')";

        $stmt = $this->db->prepare($query);
        
        // Menggunakan array untuk execute agar lebih ringkas daripada bind berkali-kali
        return $stmt->execute([
            $_SESSION['id_pengguna'],
            $data['id_alat'],
            $data['tanggal_pinjam'],
            $data['total_item']
        ]);
    }

    // Mengambil riwayat peminjaman milik pengguna
    public function getRiwayatSaya($id) {
        $query = "SELECT p.*, a.nama_alat 
                  FROM peminjaman p
                  JOIN alat a ON p.id_alat = a.id_alat
                  WHERE p.id_pengguna = ?
                  ORDER BY p.id_peminjaman DESC";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        
        return $stmt->fetchAll();
    }
}