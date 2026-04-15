<?php
// Controller ini menangani seluruh fitur manajemen admin (dashboard, pengguna, alat, kategori, peminjaman, dan log)

class AdminController extends Controller {

    // Constructor ini memastikan hanya admin yang sudah login yang bisa mengakses halaman admin
    public function __construct() {
        // SESSION SUDAH DIMULAI DI Init.php
        if (!isset($_SESSION['login']) || strtolower(trim($_SESSION['role'] ?? '')) !== 'admin') {
            header("Location: " . BASEURL . "/auth");
            exit;
        }
    }

    // Menampilkan dashboard admin beserta data statistik
    public function index() {
        $model = $this->model('AdminModel');
        $data['judul'] = "Dashboard Admin";
        $data['stats'] = $model->getStats();
        $this->view('admin/dashboard', $data);
    }

    // Alias method dashboard yang memanggil fungsi index
    public function dashboard() {
        $this->index();
    }

    // Mengelola data pengguna (tampil dan hapus pengguna)
    public function pengguna() {
        $model = $this->model('AdminModel');

        if (isset($_GET['hapus'])) {
            $user = $model->getPenggunaById($_GET['hapus']);
            $model->hapusData('pengguna', 'id_pengguna', $_GET['hapus']);

            // Mencatat aktivitas penghapusan pengguna ke log
            $logModel = $this->model('LogModel');
            $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menghapus pengguna: " . $user['nama']);

            header('Location: ' . BASEURL . '/admin/pengguna');
            exit;
        }

        $data['judul'] = "Manajemen Pengguna";
        $data['user']  = $model->getAllPengguna();
        $this->view('admin/pengguna', $data);
    }

    // Menangani proses penambahan pengguna baru
    public function tambahPengguna() {
        $model = $this->model('AdminModel');
        if (isset($_POST['simpan'])) {
            if ($model->tambahPengguna($_POST)) {
                // Mencatat aktivitas penambahan pengguna ke log
                $logModel = $this->model('LogModel');
                $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menambah pengguna baru: " . $_POST['nama']);

                header('Location: ' . BASEURL . '/admin/pengguna');
                exit;
            } else {
                // Jika gagal, redirect dengan error message
                if (isset($_SESSION['error_message'])) {
                    $error = urlencode($_SESSION['error_message']);
                    unset($_SESSION['error_message']);
                    header('Location: ' . BASEURL . '/admin/tambahPengguna?error=' . $error);
                } else {
                    header('Location: ' . BASEURL . '/admin/tambahPengguna?error=Gagal menambah pengguna');
                }
                exit;
            }
        }
        $data['judul'] = "Tambah Pengguna";
        $this->view('admin/TambahPengguna', $data);
    }

    // Menangani proses edit data pengguna
    public function editPengguna() {
        $model = $this->model('AdminModel');
        if (!isset($_GET['id'])) {
            header('Location: ' . BASEURL . '/admin/pengguna');
            exit;
        }

        if (isset($_POST['update_pengguna'])) {
            if ($model->updatePengguna($_POST['id_pengguna'], $_POST)) {
                // Mencatat aktivitas update pengguna ke log
                $logModel = $this->model('LogModel');
                $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Mengupdate data pengguna: " . $_POST['nama']);

                header('Location: ' . BASEURL . '/admin/pengguna');
                exit;
            } else {
                // Jika gagal, redirect dengan error message
                if (isset($_SESSION['error_message'])) {
                    $error = urlencode($_SESSION['error_message']);
                    unset($_SESSION['error_message']);
                    header('Location: ' . BASEURL . '/admin/editPengguna?id=' . $_POST['id_pengguna'] . '&error=' . $error);
                } else {
                    header('Location: ' . BASEURL . '/admin/editPengguna?id=' . $_POST['id_pengguna'] . '&error=Gagal update pengguna');
                }
                exit;
            }
        }

        $data['judul'] = "Edit Pengguna";
        $data['user'] = $model->getPenggunaById($_GET['id']);
        $this->view('admin/EditPengguna', $data);
    }

    // Mengelola data alat olahraga (tampil dan hapus alat)
    public function alat() {
        $model = $this->model('AdminModel');

        if (isset($_GET['hapus'])) {
            $alat = $model->getAlatById($_GET['hapus']);
            $model->hapusData('alat', 'id_alat', $_GET['hapus']);

            // Mencatat aktivitas penghapusan alat ke log
            $logModel = $this->model('LogModel');
            $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menghapus alat: " . $alat['nama_alat']);

            header('Location: ' . BASEURL . '/admin/alat');
            exit;
        }

        $data['judul'] = "Manajemen Alat";
        $data['alat']  = $model->getAllAlat();
        $this->view('admin/alat', $data);
    }

    // Menangani proses penambahan alat baru
    public function tambahAlat() {
        $model = $this->model('AdminModel');
        if (isset($_POST['simpan'])) {
            if (empty($_POST['id_kategori'])) {
                header('Location: ' . BASEURL . '/admin/tambahAlat?error=pilih_kategori');
                exit;
            }
            if ((int)$_POST['stok'] < 1) {
                header('Location: ' . BASEURL . '/admin/tambahAlat?error=' . urlencode('Stok tidak boleh 0 atau kurang'));
                exit;
            }
            $model->tambahAlat($_POST);

            // Mencatat aktivitas penambahan alat ke log
            $logModel = $this->model('LogModel');
            $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menambah alat baru: " . $_POST['nama_alat']);

            header('Location: ' . BASEURL . '/admin/alat');
            exit;
        }
        $data['judul'] = "Tambah Alat";
        $data['kategori'] = $this->model('KategoriModel')->getAll();
        $this->view('admin/TambahAlat', $data);
    }

    // Menangani proses edit data alat
    public function editAlat() {
        $model = $this->model('AdminModel');
        if (!isset($_GET['id'])) {
            header('Location: ' . BASEURL . '/admin/alat');
            exit;
        }

        if (isset($_POST['update_alat'])) {
            if ((int)$_POST['stok'] < 1) {
                header('Location: ' . BASEURL . '/admin/editAlat?id=' . $_POST['id_alat'] . '&error=' . urlencode('Stok tidak boleh 0 atau kurang'));
                exit;
            }
            $model->updateAlat($_POST['id_alat'], $_POST);

            // Mencatat aktivitas update alat ke log
            $logModel = $this->model('LogModel');
            $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Mengupdate data alat: " . $_POST['nama_alat']);

            header('Location: ' . BASEURL . '/admin/alat');
            exit;
        }

        $data['judul'] = "Edit Alat";
        $data['alat'] = $model->getAlatById($_GET['id']);
        $data['kategori'] = $this->model('KategoriModel')->getAll();
        $this->view('admin/EditAlat', $data);
    }

    // Mengelola kategori alat
    public function kategori() {
        $model = $this->model('AdminModel');

        if (isset($_GET['hapus'])) {
            // Cek apakah kategori masih dipakai oleh alat
            if ($model->isKategoriDipakai($_GET['hapus'])) {
                header('Location: ' . BASEURL . '/admin/kategori?error=' . urlencode('Kategori tidak dapat dihapus karena masih digunakan oleh data alat.'));
                exit;
            }

            $kategori = $model->getKategoriById($_GET['hapus']);
            $model->hapusData('kategori', 'id_kategori', $_GET['hapus']);

            // Mencatat aktivitas penghapusan kategori ke log
            $logModel = $this->model('LogModel');
            $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menghapus kategori: " . $kategori['nama_kategori']);

            header('Location: ' . BASEURL . '/admin/kategori');
            exit;
        }

        $data['judul']    = "Kategori Alat";
        $data['kategori'] = $model->getAllKategori();
        $this->view('admin/kategori', $data);
    }

    // Menangani proses penambahan kategori alat
    public function tambahKategori() {
        $model = $this->model('AdminModel');
        if (isset($_POST['simpan'])) {
            $model->tambahKategori($_POST['nama_kategori']);
            
            // Mencatat aktivitas penambahan kategori ke log
            $logModel = $this->model('LogModel');
            $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menambah kategori baru: " . $_POST['nama_kategori']);
            
            header('Location: ' . BASEURL . '/admin/kategori');
            exit;
        }
        $data['judul'] = "Tambah Kategori";
        $this->view('admin/TambahKategori', $data);
    }

    // Menangani proses edit kategori alat
    public function editKategori() {
        $model = $this->model('AdminModel');
        if (!isset($_GET['id'])) {
            header('Location: ' . BASEURL . '/admin/kategori');
            exit;
        }

        if (isset($_POST['update_kategori'])) {
            $model->updateKategori($_POST['id_kategori'], $_POST['nama_kategori']);
            
            // Mencatat aktivitas update kategori ke log
            $logModel = $this->model('LogModel');
            $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Mengupdate kategori: " . $_POST['nama_kategori']);
            
            header('Location: ' . BASEURL . '/admin/kategori');
            exit;
        }

        $data['judul'] = "Edit Kategori";
        $data['kategori'] = $model->getKategoriById($_GET['id']);
        $this->view('admin/EditKategori', $data);
    }

    // Menampilkan dan mengelola data peminjaman
    public function peminjaman() {
        $model = $this->model('AdminModel');

        if (isset($_GET['hapus'])) {
            $pinjam = $model->getPeminjamanById($_GET['hapus']);
            $model->hapusData('peminjaman', 'id_peminjaman', $_GET['hapus']);

            // Mencatat aktivitas penghapusan peminjaman ke log
            $logModel = $this->model('LogModel');
            $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menghapus peminjaman ID: " . $_GET['hapus']);

            header('Location: ' . BASEURL . '/admin/peminjaman');
            exit;
        }

        $data['judul']  = "Data Peminjaman";
        $data['pinjam'] = $model->getAllPeminjaman();
        $this->view('admin/peminjaman', $data);
    }

    // Menangani proses penambahan peminjaman baru
    public function tambahPeminjaman() {
        $model = $this->model('AdminModel');
        if (isset($_POST['simpan'])) {
            if ($model->tambahPeminjaman($_POST)) {
                // Mencatat aktivitas penambahan peminjaman ke log
                $logModel = $this->model('LogModel');
                $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Menambah data peminjaman baru");

                header('Location: ' . BASEURL . '/admin/peminjaman');
                exit;
            } else {
                header('Location: ' . BASEURL . '/admin/tambahPeminjaman?error=Gagal menambah peminjaman');
                exit;
            }
        }
        $data['judul']   = "Tambah Peminjaman";
        $data['pengguna'] = $model->getAllPengguna();
        $data['alat']    = $model->getAllAlat();
        $this->view('admin/TambahPeminjaman', $data);
    }

    // Menampilkan log aktivitas admin
    public function logAktivitas() {
        $model = $this->model('LogModel');
        $data['judul'] = "Log Aktivitas";
        $data['logs'] = $model->getLogs();
        $this->view('admin/LogAktivitas', $data);
    }

    // Menangani proses edit data peminjaman
    public function editPeminjaman() {
        $model = $this->model('AdminModel');
        if (!isset($_GET['id'])) {
            header('Location: ' . BASEURL . '/admin/peminjaman');
            exit;
        }

        if (isset($_POST['update_peminjaman'])) {
            $model->updatePeminjaman($_POST['id_peminjaman'], $_POST);
            
            // Mencatat aktivitas update peminjaman ke log
            $logModel = $this->model('LogModel');
            $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Mengupdate peminjaman ID: " . $_POST['id_peminjaman']);
            
            header('Location: ' . BASEURL . '/admin/peminjaman');
            exit;
        }

        $data['judul'] = "Edit Peminjaman";
        $data['pinjam'] = $model->getPeminjamanById($_GET['id']);
        $this->view('admin/EditPeminjaman', $data);
    }

}
