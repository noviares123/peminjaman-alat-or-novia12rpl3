<?php
// Controller ini menangani seluruh aktivitas peminjam (dashboard, peminjaman, pengembalian, dan riwayat)

class PeminjamController extends Controller {

    // Constructor ini memastikan hanya pengguna dengan role peminjam yang bisa mengakses halaman ini
    public function __construct() {
        if (!isset($_SESSION['login']) || strtolower(trim($_SESSION['role'] ?? '')) !== 'peminjam') {
            header("Location: " . BASEURL . "/auth");
            exit;
        }
    }

    // Menampilkan dashboard peminjam beserta statistik peminjaman
    public function index() {
        $model = $this->model('PeminjamanModel');
        $data['judul'] = "Dashboard Peminjam";

        // Mengambil riwayat peminjaman berdasarkan pengguna yang login
        $riwayat = $model->getRiwayatByUser($_SESSION['id_pengguna']);

        // Menghitung statistik status peminjaman
        $total = count($riwayat);
        $dipinjam = 0;
        $pending = 0;
        $disetujui = 0;
        $ditolak = 0;
        $dikembalikan = 0;

        foreach ($riwayat as $item) {
            $status = $item['status'] ?? '';
            if ($status == 'Di Setujui') {
                $dipinjam++;
                $disetujui++;
            } elseif ($status == 'Menunggu') {
                $pending++;
            } elseif ($status == 'Di Tolak') {
                $ditolak++;
            } elseif ($status == 'Kembali') {
                $dikembalikan++;
            }
        }

        // Menyimpan data statistik untuk ditampilkan di dashboard
        $data['stats'] = [
            'total' => $total,
            'dipinjam' => $dipinjam,
            'pending' => $pending,
            'disetujui' => $disetujui,
            'ditolak' => $ditolak,
            'dikembalikan' => $dikembalikan,
            'disetujui_baru' => 0,
            'ditolak_baru' => 0
        ];

        $this->view('peminjam/dashboard', $data);
    }

    // Alias method dashboard yang memanggil fungsi index
    public function dashboard() {
        $this->index();
    }

    // Menangani proses pengajuan peminjaman alat oleh peminjam
    public function ajukan() {
        $model = $this->model('PeminjamanModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Menyiapkan data pengajuan peminjaman
            $payload = [
                'id_alat' => $_POST['id_alat'] ?? null,
                'tanggal_pinjam' => $_POST['tanggal_pinjam'] ?? date('Y-m-d'),
                'tanggal_kembali' => $_POST['tanggal_kembali'] ?? date('Y-m-d', strtotime('+7 days')),
                'total_item' => $_POST['total_item'] ?? 1
            ];

            if ($model->buatPengajuan($_SESSION['id_pengguna'], $payload)) {

                // Mencatat aktivitas pengajuan peminjaman ke log
                $alatModel = $this->model('AlatModel');
                $alat = $alatModel->getById($payload['id_alat']);
                $logModel = $this->model('LogModel');
                $logModel->addLog(
                    $_SESSION['id_pengguna'],
                    $_SESSION['nama'],
                    "Mengajukan peminjaman: " . $alat['nama_alat'] . " (" . $payload['total_item'] . " unit)"
                );

                header('Location: ' . BASEURL . '/peminjam/riwayat?success=pinjam');
                exit;
            }

            // Jika ada error message dari model, tampilkan
            if (isset($_SESSION['error_message'])) {
                $error = urlencode($_SESSION['error_message']);
                unset($_SESSION['error_message']);
                header('Location: ' . BASEURL . '/peminjam/ajukan?error=' . $error);
            } else {
                header('Location: ' . BASEURL . '/peminjam/ajukan?error=stok');
            }
            exit;
        }

        // Menampilkan halaman pengajuan peminjaman
        $data['alat'] = $this->model('AlatModel')->getAll();
        
        // Ambil id_alat dari URL jika ada (dari tombol Pinjam di DaftarAlat)
        $data['selected_alat'] = isset($_GET['id_alat']) ? (int)$_GET['id_alat'] : null;
        
        $this->view('peminjam/AjukanPeminjaman', $data);
    }

    // Mengarahkan pengguna ke halaman riwayat untuk proses pengembalian
    public function pengembalian() {
        header('Location: ' . BASEURL . '/peminjam/riwayat');
        exit;
    }

    // Menampilkan riwayat peminjaman dan menangani pengajuan pengembalian
    public function riwayat() {
        $model = $this->model('PeminjamanModel');

        // Menangani aksi pengajuan pengembalian langsung dari riwayat
        if (isset($_GET['ajukan'])) {
            $id = (int)$_GET['ajukan'];
            $result = $model->requestPengembalian(
                $_SESSION['id_pengguna'],
                $id,
                date('Y-m-d'),
                'Baik'
            );

            if ($result) {

                // Mencatat aktivitas pengajuan pengembalian ke log
                $logModel = $this->model('LogModel');
                $logModel->addLog($_SESSION['id_pengguna'], $_SESSION['nama'], "Mengajukan pengembalian ID: " . $id);

                header('Location: ' . BASEURL . '/peminjam/riwayat?success=kembali');
            } else {
                header('Location: ' . BASEURL . '/peminjam/riwayat?error=1');
            }
            exit;
        }

        // Mengambil seluruh riwayat peminjaman pengguna
        $data['pinjam'] = $model->getRiwayatByUser($_SESSION['id_pengguna']);
        $this->view('peminjam/RiwayatPeminjaman', $data);
    }

    // Menampilkan daftar alat yang tersedia untuk dipinjam
    public function daftar() {
        $data['alat'] = $this->model('AlatModel')->getAll();
        $this->view('peminjam/DaftarAlat', $data);
    }
}
