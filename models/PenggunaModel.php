<?php

class PenggunaModel {
    private $db;

    // Menginisialisasi koneksi database menggunakan Singleton PDO
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Mengambil seluruh data pengguna
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM pengguna");
        return $stmt->fetchAll();
    }

    // Mengambil data pengguna berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM pengguna WHERE id_pengguna = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Menambahkan pengguna baru ke database
    public function insert($data) {
        $sql = "INSERT INTO pengguna (nama, username, password, role) 
                VALUES (?, ?, ?, ?)";
        
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nama'],
            $data['username'],
            $passwordHash,
            $data['role']
        ]);
    }

    // Memperbarui data pengguna berdasarkan ID
    public function update($id, $data) {
        $sql = "UPDATE pengguna 
                SET nama = ?, username = ?, role = ? 
                WHERE id_pengguna = ?";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nama'],
            $data['username'],
            $data['role'],
            $id
        ]);
    }

    // Menghapus data pengguna berdasarkan ID
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM pengguna WHERE id_pengguna = ?");
        return $stmt->execute([$id]);
    }

    // Mengambil data pengguna berdasarkan username (untuk Login)
    public function getByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM pengguna WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    // Mengubah password pengguna berdasarkan ID
    public function updatePassword($id, $passwordBaru) {
        $hash = password_hash($passwordBaru, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE pengguna SET password = ? WHERE id_pengguna = ?");
        return $stmt->execute([$hash, $id]);
    }
}