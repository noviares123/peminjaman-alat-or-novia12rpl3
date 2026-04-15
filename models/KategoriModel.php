<?php

// Model untuk mengelola data kategori alat
class KategoriModel {

    // Menyimpan koneksi database
    private $db;

    // Menginisialisasi koneksi database menggunakan Singleton PDO
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Mengambil semua data kategori
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM kategori");
        return $stmt->fetchAll();
    }

    // Mengambil satu kategori berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kategori WHERE id_kategori = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Menambahkan kategori baru ke database
    public function insert($nama_kategori) {
        $stmt = $this->db->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
        return $stmt->execute([$nama_kategori]);
    }

    // Memperbarui nama kategori berdasarkan ID
    public function update($id, $nama_kategori) {
        $stmt = $this->db->prepare("UPDATE kategori SET nama_kategori = ? WHERE id_kategori = ?");
        return $stmt->execute([$nama_kategori, $id]);
    }

    // Menghapus kategori berdasarkan ID
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM kategori WHERE id_kategori = ?");
        return $stmt->execute([$id]);
    }
}