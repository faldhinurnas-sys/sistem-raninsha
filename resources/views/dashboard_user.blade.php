<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User - Toko Kue</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* =======================================================
           OVERRIDE WARNA → HIJAU
        ======================================================= */
        .btn-primary,
        .bg-primary,
        .text-primary {
            background-color: #4caf50 !important;
            border-color: #4caf50 !important;
            color: #fff !important;
        }
        .btn-primary:hover {
            background-color: #43a047 !important;
            border-color: #43a047 !important;
        }

        .btn-outline-primary {
            color: #4caf50 !important;
            border-color: #4caf50 !important;
        }
        .btn-outline-primary:hover {
            background-color: #4caf50 !important;
            color: #fff !important;
        }

        .text-success { color: #4caf50 !important; }

        a { color: #4caf50; }
        a:hover { color: #388e3c; }

        .bg-success { background-color: #4caf50 !important; }
        .border-success { border-color: #4caf50 !important; }

        /* Checkbox hijau */
        .form-check-input:checked {
            background-color: #4caf50 !important;
            border-color: #4caf50 !important;
        }

        /* Card Hover */
        .hover-card {
            transition: .25s ease;
            border-radius: 12px;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 25px rgba(0,0,0,0.15);
        }

        /* Anim icon */
        .icon-anim {
            animation: float 2.6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, #81c784 0%, #4caf50 100%);
            border-radius: 14px;
        }

        /* =======================================================
           🔥 FIX: TOMBOL “KE HALAMAN PRODUK” WARNA PUTIH
        ======================================================= */
        #btn-produk {
            background: #ffffff !important;
            color: #4caf50 !important;
            border: 1px solid #4caf50 !important;
        }
        #btn-produk:hover {
            background: #4caf50 !important;
            color: #fff !important;
        }

    </style>
</head>

<body class="bg-light">
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">🍰 Dashboard User</h4>
        <div>
            <span class="me-2 text-muted small fw-semibold">
                {{ session('user_name') }} • {{ session('user_role') }}
            </span>
            <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger">
                Logout
            </a>
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="card shadow-sm border-0 welcome-card mb-4">
        <div class="card-body text-white p-4">
            <h5 class="card-title mb-2 fw-bold">Selamat Datang 🎂</h5>
            <p class="mb-0 opacity-75">
                Silakan mulai dengan melihat produk, menambah ke keranjang, dan membuat pesanan.
            </p>
        </div>
    </div>

    <!-- Menu Cards -->
    <div class="row g-4">

        <!-- Produk -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 hover-card h-100">
                <div class="card-body text-center">
                    <div class="icon-anim" style="font-size: 3rem;">🧁</div>
                    <h6 class="mt-3 mb-1 fw-bold text-success">Lihat Produk</h6>
                    <p class="small text-muted mb-3">Jelajahi semua produk kue yang tersedia.</p>

                    <!-- ❗ FIX TOMBOL WARNA PUTIH + HOVER HIJAU -->
                    <a id="btn-produk" href="{{ route('landing') }}" class="btn btn-sm menu-btn">
                        Ke Halaman Produk
                    </a>
                </div>
            </div>
        </div>

        <!-- Keranjang -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 hover-card h-100">
                <div class="card-body text-center">
                    <div class="icon-anim" style="font-size: 3rem;">🛒</div>
                    <h6 class="mt-3 mb-1 fw-bold text-success">Keranjang</h6>
                    <p class="small text-muted mb-3">Lihat dan kelola item yang akan kamu pesan.</p>
                    <a href="{{ route('cart.index') }}" class="btn btn-sm btn-outline-primary menu-btn">
                        Lihat Keranjang
                    </a>
                </div>
            </div>
        </div>

        <!-- Pesanan -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 hover-card h-100">
                <div class="card-body text-center">
                    <div class="icon-anim" style="font-size: 3rem;">📦</div>
                    <h6 class="mt-3 mb-1 fw-bold text-success">Pesanan Saya</h6>
                    <p class="small text-muted mb-3">Cek riwayat dan status pesananmu.</p>
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary menu-btn">
                        Lihat Pesanan
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
