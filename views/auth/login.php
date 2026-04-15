<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Pengaturan dasar dokumen HTML dan metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Peminjaman Peralatan Olahraga</title>

    <style>
        /* Reset CSS dan pengaturan font global */
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Pengaturan dasar body */
        body{
            height:100vh;
            overflow:hidden;
        }

        /* Background utama halaman login */
        .bg{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg, #800020 0%, #5c0011 100%);
            position:relative;
        }

        /* Efek animasi background */
        .bg::before{
            content:'';
            position:absolute;
            width:200%;
            height:200%;
            background:
                radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(255,255,255,0.05) 0%, transparent 50%);
            animation:float 20s ease-in-out infinite;
        }

        /* Animasi background bergerak */
        @keyframes float{
            0%, 100%{transform:translate(0, 0) rotate(0deg);}
            33%{transform:translate(30px, -30px) rotate(120deg);}
            66%{transform:translate(-20px, 20px) rotate(240deg);}
        }

        /* Container login */
        .login-container{
            position:relative;
            z-index:1;
            animation:slideUp 0.6s ease-out;
        }

        /* Animasi masuk kartu login */
        @keyframes slideUp{
            from{
                opacity:0;
                transform:translateY(30px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        /* Kartu login */
        .login-card{
            width:380px;
            padding:40px 35px 35px;
            background:rgba(255,255,255,0.95);
            backdrop-filter:blur(10px);
            border-radius:20px;
            box-shadow:0 20px 60px rgba(0,0,0,0.3);
            text-align:center;
            position:relative;
        }

        /* Bagian logo dan judul */
        .logo-section{
            margin-bottom:30px;
        }

        /* Avatar/logo sistem */
        .avatar{
            width:80px;
            height:80px;
            background:linear-gradient(135deg, #800020 0%, #5c0011 100%);
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:0 auto 15px;
            color:white;
            font-size:36px;
            box-shadow:0 8px 20px rgba(128,0,32,0.4);
            animation:pulse 2s ease-in-out infinite;
            overflow:hidden;
            padding:5px;
        }

        /* Gambar logo */
        .avatar img{
            width:100%;
            height:100%;
            object-fit:cover;
            border-radius:50%;
        }

        /* Animasi denyut avatar */
        @keyframes pulse{
            0%, 100%{transform:scale(1);}
            50%{transform:scale(1.05);}
        }

        /* Judul aplikasi */
        .logo-section h1{
            color:#2c3e50;
            font-size:24px;
            font-weight:700;
            margin-bottom:5px;
        }

        /* Subjudul aplikasi */
        .logo-section p{
            color:#6c757d;
            font-size:14px;
        }

        /* Form login */
        form{
            margin-top:25px;
        }

        /* Grup input */
        .input-group{
            position:relative;
            margin-bottom:20px;
            text-align:left;
        }

        /* Label input */
        .input-group label{
            display:block;
            color:#495057;
            font-size:13px;
            font-weight:600;
            margin-bottom:8px;
            margin-left:5px;
        }

        /* Wrapper input dan ikon */
        .input-wrapper{
            position:relative;
            display:flex;
            align-items:center;
        }

        /* Ikon input */
        .input-wrapper span{
            position:absolute;
            left:15px;
            font-size:18px;
            color:#6c757d;
            transition:color 0.3s;
        }

        /* Input field */
        .input-group input{
            width:100%;
            padding:12px 15px 12px 45px;
            border:2px solid #e9ecef;
            border-radius:10px;
            background:white;
            outline:none;
            font-size:14px;
            color:#2c3e50;
            transition:all 0.3s;
        }

        /* Efek fokus input */
        .input-group input:focus{
            border-color:#800020;
            box-shadow:0 0 0 4px rgba(128,0,32,0.1);
        }

        /* Warna ikon saat fokus */
        .input-group input:focus + span{
            color:#800020;
        }

        /* Placeholder input */
        .input-group input::placeholder{
            color:#adb5bd;
        }

        /* Tombol login */
        button{
            width:100%;
            padding:14px;
            border:none;
            border-radius:10px;
            background:linear-gradient(135deg, #800020 0%, #5c0011 100%);
            color:white;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            margin-top:10px;
            transition:all 0.3s;
            box-shadow:0 4px 15px rgba(128,0,32,0.4);
        }

        /* Hover tombol */
        button:hover{
            transform:translateY(-2px);
            box-shadow:0 6px 20px rgba(128,0,32,0.5);
        }

        /* Efek klik tombol */
        button:active{
            transform:translateY(0);
        }

        /* Pesan error login */
        .error-message{
            background:#fee;
            color:#dc3545;
            padding:12px;
            border-radius:8px;
            margin-bottom:20px;
            font-size:13px;
            border-left:4px solid #dc3545;
            text-align:left;
            display:none;
        }

        /* Tampilkan pesan error */
        .error-message.show{
            display:block;
            animation:shake 0.5s;
        }

        /* Animasi getar error */
        @keyframes shake{
            0%, 100%{transform:translateX(0);}
            25%{transform:translateX(-10px);}
            75%{transform:translateX(10px);}
        }

        /* Footer teks */
        .footer-text{
            margin-top:25px;
            color:#6c757d;
            font-size:12px;
        }

        /* Tampilan responsif */
        @media (max-width: 480px){
            .login-card{
                width:90%;
                padding:30px 25px;
            }

            .logo-section h1{
                font-size:20px;
            }

            .avatar{
                width:70px;
                height:70px;
                font-size:32px;
            }
        }
    </style>
</head>

<body>
<div class="bg">
    <!-- Wrapper background halaman -->

    <div class="login-container">
        <!-- Container utama login -->

        <div class="login-card">
            <!-- Kartu login -->

            <div class="logo-section">
                <!-- Logo dan judul aplikasi -->
                <div class="avatar">
                    <img src="<?= BASEURL; ?>/assets/profil.png" alt="Logo">
                </div>
                <h1>Peminjaman Peralatan Olahraga</h1>
                <p>Sistem Manajemen Peminjaman</p>
            </div>

            <?php if(isset($_GET['error'])): ?>
            <!-- Pesan error jika login gagal -->
            <div class="error-message show">
                <strong>⚠️ Login Gagal!</strong><br>
                Username atau password salah. Silakan coba lagi.
            </div>
            <?php endif; ?>

            <form action="<?= BASEURL ?>/Auth/login" method="POST">
                <!-- Form login -->

                <div class="input-group">
                    <label>Username</label>
                    <div class="input-wrapper">
                        <input type="text" name="username" placeholder="Masukkan username" required autofocus>
                        <span>👤</span>
                    </div>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" placeholder="Masukkan password" required>
                        <span>🔒</span>
                    </div>
                </div>

                <button type="submit">LOGIN</button>
            </form>

            <div class="footer-text">
                <!-- Footer halaman -->
                © <?= date('Y'); ?> Sistem Peminjaman Peralatan Olahraga
            </div>

        </div>
    </div>
</div>
</body>
</html>
