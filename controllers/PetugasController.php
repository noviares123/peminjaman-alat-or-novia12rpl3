<?php

// Controller untuk fitur petugas (dashboard, persetujuan, pemantauan, dan laporan)
class PetugasController extends Controller {

    // Constructor untuk membatasi akses hanya bagi user dengan role petugas
    public function __construct() {
        if (!isset($_SESSION['login']) || strtolower(trim($_SESSION['role'] ?? '')) !== 'petugas') {
            header("Location: " . BASEURL . "/auth");
            exit;
        }
    }

    // Menampilkan dashboard petugas beserta statistik peminjaman
    public function index() {
        $model = $this->model('PetugasModel');
        
        $data['judul'] = "Dashboard Petugas";
        
        // Mengambil data statistik untuk ditampilkan di dashboard
        $data['stats'] = [
            'pending' => count($model->getPending()),
            'dipinjam' => count($model->getSedangDipinjam()),
            'menunggu_kembali' => count($model->getMenungguKonfirmasi()),
            'dikembalikan_hari_ini' => $model->getDikembalikanHariIni(),
            'terlambat' => $model->getTerlambat(),
            'total' => count($model->getSemuaRiwayat()),
            'disetujui' => $model->countByStatus('Di Setujui'),
            'ditolak' => $model->countByStatus('Di Tolak'),
            'dikembalikan' => $model->countByStatus('Kembali')
        ];
        
        $this->view('petugas/dashboard', $data);
    }

    // Alias dashboard agar bisa diakses melalui route /dashboard
    public function dashboard() {
        $this->index();
    }

    // Menangani proses persetujuan atau penolakan peminjaman
    public function setujui() {
        $model = $this->model('PetugasModel');

        if (isset($_GET['aksi'], $_GET['id'])) {
            $id = (int)$_GET['id'];
            $logModel = $this->model('LogModel');
            
            // Setujui peminjaman
            if ($_GET['aksi'] === 'setuju') {
                $model->setujuiPeminjaman($id);
                $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menyetujui peminjaman ID: " . $id);
                header('Location: ' . BASEURL . '/petugas/setujui?success=setuju');
                exit;
            }

            header('Location: ' . BASEURL . '/petugas/setujui');
            exit;
        }

        // Mengambil daftar peminjaman yang menunggu persetujuan
        $data['pinjam'] = $model->getPending();
        $this->view('petugas/SetujuiPeminjaman', $data);
    }

    // Method khusus untuk menolak peminjaman dengan keterangan
    public function tolakPeminjaman() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = $this->model('PetugasModel');
            $logModel = $this->model('LogModel');
            
            $id = (int)$_POST['id_peminjaman'];
            $keterangan = $_POST['keterangan'] ?? 'Tidak ada keterangan';
            
            if ($model->tolakPeminjaman($id, $keterangan)) {
                $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menolak peminjaman ID: " . $id);
                header('Location: ' . BASEURL . '/petugas/setujui?success=tolak');
            } else {
                header('Location: ' . BASEURL . '/petugas/setujui?error=tolak');
            }
            exit;
        }
        
        // Jika bukan POST, redirect ke halaman setujui
        header('Location: ' . BASEURL . '/petugas/setujui');
        exit;
    }

    // Memantau dan mengelola proses pengembalian barang
    public function pantau() {
        $model = $this->model('PetugasModel');
        $logModel = $this->model('LogModel');

        // Debug mode - tampilkan semua peminjaman
        if (isset($_GET['debug'])) {
            $adminModel = $this->model('AdminModel');
            $data['all_peminjaman'] = $adminModel->getAllPeminjaman();
            $data['debug_mode'] = true;
            $data['kembali'] = $model->getSedangDipinjam();
            $this->view('petugas/PantauPengembalian', $data);
            exit;
        }

        // Menyetujui pengembalian barang
        if (isset($_GET['kembali'])) {
            $id = (int)$_GET['kembali'];
            
            // Debug: cek data peminjaman
            $peminjamanModel = $this->model('AdminModel');
            $dataPinjam = $peminjamanModel->getPeminjamanById($id);
            
            if (!$dataPinjam) {
                $_SESSION['debug_error'] = "Data peminjaman ID $id tidak ditemukan di database";
                header('Location: ' . BASEURL . '/petugas/pantau?error=1');
                exit;
            }
            
            $_SESSION['debug_info'] = "Data ditemukan: Status=" . $dataPinjam['status'] . ", Kondisi=" . ($dataPinjam['kondisi'] ?? 'NULL');
            
            try {
                $result = $model->konfirmasiKembali($id);
                if ($result) {
                    unset($_SESSION['debug_info']);
                    $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menyetujui pengembalian ID: " . $id);
                    header('Location: ' . BASEURL . '/petugas/pantau?success=1');
                } else {
                    if (!isset($_SESSION['debug_error'])) {
                        $_SESSION['debug_error'] = "konfirmasiKembali() returned false tanpa pesan error";
                    }
                    header('Location: ' . BASEURL . '/petugas/pantau?error=1');
                }
            } catch (Exception $e) {
                $_SESSION['debug_error'] = "Exception: " . $e->getMessage();
                header('Location: ' . BASEURL . '/petugas/pantau?error=1');
            }
            exit;
        }

        // Menolak pengembalian barang
        if (isset($_GET['tolak'])) {
            $id = (int)$_GET['tolak'];
            
            try {
                $result = $model->tolakPengembalian($id);
                if ($result) {
                    $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menolak pengembalian ID: " . $id);
                    header('Location: ' . BASEURL . '/petugas/pantau?success=2');
                } else {
                    $_SESSION['debug_error'] = "tolakPengembalian() returned false - Gagal mengosongkan kondisi";
                    header('Location: ' . BASEURL . '/petugas/pantau?error=2');
                }
            } catch (Exception $e) {
                $_SESSION['debug_error'] = "Exception tolak: " . $e->getMessage();
                header('Location: ' . BASEURL . '/petugas/pantau?error=2');
            }
            exit;
        }

        // Mengambil data barang yang sedang dipinjam
        $data['kembali'] = $model->getSedangDipinjam();
        
        // Debug: tampilkan jumlah data
        $data['debug_count'] = count($data['kembali']);
        
        $this->view('petugas/PantauPengembalian', $data);
    }

    // Menampilkan laporan seluruh riwayat peminjaman
    public function cetak() {
        $model = $this->model('PetugasModel');
        $data['laporan'] = $model->getSemuaRiwayat();
        $this->view('petugas/CetakLaporan', $data);
    }

    // Menampilkan riwayat peminjaman untuk petugas
    public function riwayat() {
        $model = $this->model('PetugasModel');
        $data['judul'] = "Riwayat Peminjaman";
        $data['riwayat'] = $model->getSemuaRiwayat();
        $this->view('petugas/RiwayatPeminjaman', $data);
    }

    // Menampilkan daftar alat untuk petugas
    public function daftarAlat() {
        $alatModel = $this->model('AlatModel');
        $data['judul'] = "Daftar Alat";
        $data['alat'] = $alatModel->getAll();
        $this->view('petugas/DaftarAlat', $data);
    }

    // Method khusus untuk menolak pengembalian dengan keterangan
    public function tolakPengembalian() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = $this->model('PetugasModel');
            $logModel = $this->model('LogModel');
            
            $id = (int)$_POST['id_peminjaman'];
            $keterangan = $_POST['keterangan_pengembalian'] ?? 'Tidak ada keterangan';
            
            if ($model->tolakPengembalian($id, $keterangan)) {
                $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menolak pengembalian ID: " . $id);
                header('Location: ' . BASEURL . '/petugas/pantau?success=2');
            } else {
                $_SESSION['debug_error'] = "Gagal menolak pengembalian";
                header('Location: ' . BASEURL . '/petugas/pantau?error=2');
            }
            exit;
        }
        
        // Jika bukan POST, redirect ke halaman pantau
        header('Location: ' . BASEURL . '/petugas/pantau');
        exit;
    }
}
