<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/icon type">
    <title>DOMPETKU - Atur Keuanganmu dengan Mudah</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <nav>
            <a href="#" class="logo">DOMPETKU</a>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-links">
                <a href="#features">Fitur</a>
                <a href="#demo">Demo</a>
                <a href="#pricing">Harga</a>
                <a href="https://www.instagram.com/ramaboy_13/">Kontak</a>
            </div>
        </nav>
    </header>


    <section class="hero">
        <div class="hero-content">
            <h1>Kelola Keuanganmu dengan Mudah</h1>
            <p>DOMPETKU membantu Anda melacak pengeluaran dan pemasukan dengan mudah dan efisien. Mulai atur keuangan
                Anda hari ini!</p>
            <a class="cta-button" id="startButton">Mulai Sekarang - Gratis!</a>
        </div>
    </section>
    <div id="authModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Welcome to DOMPETKU</h2>
            <p>Choose an option to continue</p>
            <div class="modal-buttons">
                <a href="app/register" class="modal-btn signup-btn">Sign
                    Up</a>
                <a href="app/login" class="modal-btn login-btn">Login</a>
                <a href="{{ route('auth.redirect') }}" class="modal-btn google-btn">
                    <img src="{{ asset('img/google-icon.png') }}" alt="Google Icon" class="google-icon">
                    Continue with Google
                </a>
            </div>
        </div>
    </div>

    <section class="features" id="features">
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-wallet"></i>
                <h3>Catat Transaksi</h3>
                <p>Catat setiap pengeluaran dan pemasukan dengan mudah dan cepat. Kategorisasi otomatis membantu Anda
                    melacak aliran uang.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-chart-pie"></i>
                <h3>Analisis Keuangan</h3>
                <p>Lihat laporan detail tentang pengeluaran dan pemasukan Anda dalam bentuk grafik yang mudah dipahami.
                </p>
            </div>
            <div class="feature-card">
                <i class="fas fa-tags"></i>
                <h3>Kategori Kustom</h3>
                <p>Buat dan atur kategori sesuai kebutuhan Anda. Pantau pengeluaran berdasarkan kategori yang Anda
                    tentukan.</p>
            </div>
        </div>
    </section>

    <section class="demo" id="demo">
        <div class="demo-content">
            <div class="demo-text">
                <h2>Fitur Lengkap untuk Kebutuhan Keuangan Anda</h2>
                <p>DOMPETKU menyediakan berbagai fitur yang memudahkan Anda mengelola keuangan:</p>
                <ul style="margin-top: 1rem; margin-left: 1.5rem;">
                    <li>Pencatatan transaksi harian</li>
                    <li>Kategorisasi pengeluaran dan pemasukan</li>
                    <li>Grafik Statistik keuangan detail</li>
                </ul>
            </div>
            <div class="demo-image">
                <img src="{{ asset('img/demo.png') }}" alt="DOMPETKU Demo">

            </div>
        </div>
    </section>


    <div class="footer">
        <p style="color: #2d2d2c">&copy; 2024 DOMPETKU. All rights reserved. Build by <a
                href="https://ramaboy13.github.io/ramaboy.github.io/"
                style="text-decoration:none; color: #2d2d2c">Barito Surya Ramadhani</a></p>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
