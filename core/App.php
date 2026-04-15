<?php

// Class utama untuk mengatur routing URL ke controller, method, dan parameter
class App {
    protected $controller = 'AuthController'; // Controller default
    protected $method = 'index'; // Method default
    protected $params = []; // Parameter URL

    // Constructor untuk memproses URL dan menjalankan controller yang sesuai
    public function __construct() {
        $url = $this->parseURL();

        // 1. Menentukan controller berdasarkan URL
        if (!empty($url[0])) {
            $controllerName = ucfirst($url[0]);
            
            // Cek apakah ada file dengan akhiran 'Controller' (Contoh: AuthController.php)
            if (file_exists(__DIR__ . '/../controllers/' . $controllerName . 'Controller.php')) {
                $this->controller = $controllerName . 'Controller';
                unset($url[0]);
            } 
            // Cek apakah ada file tanpa akhiran 'Controller' (Contoh: Admin.php)
            elseif (file_exists(__DIR__ . '/../controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        // 2. Memanggil file controller dan membuat objeknya
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 3. Menentukan method berdasarkan URL
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // 4. Menyimpan parameter URL
        $this->params = $url ? array_values($url) : [];

        // 5. Menjalankan method controller dengan parameter
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Memecah URL menjadi array controller, method, dan parameter
    // Memecah URL menjadi array controller, method, dan parameter
    public function parseURL() {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = ltrim($url, '/'); // HAPUS SLASH DI DEPAN (Penting untuk Nginx)
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
        
    
}