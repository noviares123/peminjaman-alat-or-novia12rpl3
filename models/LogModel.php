<?php

// Model untuk mencatat dan mengambil log aktivitas pengguna
class LogModel {

    // Menyimpan koneksi database
    private $db;

    // Menginisialisasi koneksi database menggunakan Singleton PDO
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Mengambil seluruh log aktivitas untuk laporan atau export
    public function getLogs() {
        $sql = "SELECT * FROM log_aktivitas ORDER BY waktu DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Mengambil log aktivitas terbaru dengan batas jumlah tertentu
    public function getLogsLimit($limit = 50) {
        $stmt = $this->db->prepare(
            "SELECT * FROM log_aktivitas ORDER BY waktu DESC LIMIT ?"
        );
        
        // Pada PDO, untuk LIMIT kita harus bindValue dengan tipe PARAM_INT 
        // agar tidak dianggap sebagai string (yang bisa menyebabkan error pada beberapa versi SQL)
        $stmt->bindValue(1, (int) $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    
    // Menyimpan aktivitas pengguna ke dalam tabel log
    public function addLog($id_pengguna, $nama_pengguna, $aktivitas) {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO log_aktivitas (id_pengguna, nama_pengguna, aktivitas, waktu)
                 VALUES (?, ?, ?, NOW())"
            );
            
            return $stmt->execute([
                $id_pengguna, 
                $nama_pengguna, 
                $aktivitas
            ]);

        } catch (PDOException $e) {
            error_log("Log Exception: " . $e->getMessage());
            return false;
        }
    }
}