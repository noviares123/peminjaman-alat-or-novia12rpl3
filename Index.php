<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Load Config & Database (Hapus /app/ karena file ini sudah di dalam app)
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/Database.php';

// 2. Autoload Controllers & Models
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . "/controllers/$class.php",
        __DIR__ . "/models/$class.php"
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// 3. Load Core MVC
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/App.php';

$app = new App();