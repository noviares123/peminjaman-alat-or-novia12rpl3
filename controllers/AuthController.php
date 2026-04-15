<?php

class AuthController extends Controller {

    // Menampilkan halaman login
    public function index() {
        $this->view('auth/login');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASEURL . "/AuthController");
            exit;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        // Memanggil model Pengguna
        $user = $this->model('PenggunaModel')->getByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id_pengguna'] = $user['id_pengguna'];
            $_SESSION['nama'] = $user['nama'];
            
            // Bersihkan spasi dan kecilkan huruf role
            $role = strtolower(trim($user['role']));
            $_SESSION['role'] = $role;

            // Catat log
            $this->model('LogModel')->addLog($user['id_pengguna'], $user['nama'], "Login sebagai " . ucfirst($role));

            $this->redirectToDashboard($role);
        } else {
            echo "<script>
                alert('Username atau Password salah!');
                window.location='" . BASEURL . "/Auth';
            </script>";
        }
    }

    private function redirectToDashboard($role) {
        // Sesuaikan dengan nama file di folder controllers (Admin.php, Petugas.php, Peminjam.php)
        $routes = [
            'admin'    => BASEURL . "/Admin/dashboard",
            'petugas'  => BASEURL . "/Petugas/dashboard",
            'peminjam' => BASEURL . "/Peminjam/dashboard"
        ];

        $url = isset($routes[$role]) ? $routes[$role] : BASEURL . "/AuthController";
        
        header("Location: " . $url);
        exit;
    }

    public function logout() {
        if (isset($_SESSION['id_pengguna'])) {
            $this->model('LogModel')->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Logout dari sistem");
        }
        session_destroy();
        header("Location: " . BASEURL . "/AuthController");
        exit;
    }
}