<?php

// Class dasar controller untuk memanggil model dan view
class Controller {

    // Memuat model dan mengembalikan objek model
    public function model($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        // Sekarang tidak perlu mengirimkan $GLOBALS['conn']
        // Karena model sudah mengambil koneksi sendiri via Database::getInstance()
        return new $model();
    }

    // Memuat view dan mengirimkan data ke dalamnya
    public function view($view, $data = []) {
        // Mengubah array associative menjadi variabel individual
        extract($data);
        
        // Memeriksa apakah file view ada sebelum dimuat
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View $view tidak ditemukan!");
        }
    }
}