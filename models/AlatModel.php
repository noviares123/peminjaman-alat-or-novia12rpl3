<?php

// Model untuk mengelola data alat olahraga
class AlatModel {

    // Menyimpan koneksi database
    private $db;

    // Menginisialisasi koneksi database menggunakan Singleton PDO
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Mengambil semua data alat beserta nama kategorinya
    public function getAll() {
        $sql = "SELECT a.*, k.nama_kategori 
                FROM alat a 
                LEFT JOIN kategori k ON a.id_kategori = k.id_kategori
                ORDER BY a.nama_alat";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Menambahkan data alat baru ke database
    public function insert($data) {
        $sql = "INSERT INTO alat (nama_alat, kondisi, stok, id_kategori) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nama_alat'],
            $data['kondisi'],
            $data['stok'],
            $data['id_kategori'] // Ditambahkan agar kategori tersimpan
        ]);
    }

    // Memperbarui data alat berdasarkan ID
    public function update($id, $data) {
        $sql = "UPDATE alat 
                SET nama_alat = ?, kondisi = ?, stok = ?, id_kategori = ? 
                WHERE id_alat = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nama_alat'],
            $data['kondisi'],
            $data['stok'],
            $data['id_kategori'], // Ditambahkan agar kategori terupdate
            $id
        ]);
    }

    // Menghapus data alat berdasarkan ID
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM alat WHERE id_alat = ?");
        return $stmt->execute([$id]);
    }

    // Mengambil satu data alat berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM alat WHERE id_alat = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}