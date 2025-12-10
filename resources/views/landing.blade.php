<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raninsha Bakery</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    >
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f1f8e9 0%, #ffffff 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: white !important;
            box-shadow: 0 2px 15px rgba(76, 175, 80, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4caf50 !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand::before {
            content: "🧁";
            font-size: 1.8rem;
        }

        .btn-outline-secondary {
            border-color: #4caf50;
            color: #4caf50;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #4caf50;
            border-color: #4caf50;
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            border-color: #4caf50;
            color: #4caf50;
        }

        .btn-outline-primary:hover {
            background-color: #4caf50;
            border-color: #4caf50;
        }

        .btn-primary {
            background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
            border: none;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }

        .btn-danger {
            background-color: #ef5350;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            padding: 80px 0 60px;
            text-align: center;
            background: linear-gradient(135deg, rgba(129, 199, 132, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
            border-radius: 0 0 50px 50px;
            margin-bottom: 40px;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 800;
            color: #2e7d32;
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.8s ease;
        }

        .hero-section p {
            font-size: 1.2rem;
            color: #616161;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 12px;
            border-left: 4px solid;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border-left-color: #66bb6a;
        }

        .alert-danger {
            background-color: #ffebee;
            color: #c62828;
            border-left-color: #ef5350;
        }

        .alert-info {
            background-color: #e3f2fd;
            color: #1565c0;
            border-left-color: #42a5f5;
        }

        /* Section Title */
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2e7d32;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
            border-radius: 2px;
        }

        /* Product Card */
        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s ease;
            background: white;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.1);
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(76, 175, 80, 0.2);
        }

        .product-card img {
            object-fit: cover;
            height: 220px;
            width: 100%;
            transition: transform 0.4s ease;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-card .card-img-top {
            overflow: hidden;
        }

        .product-card .card-body {
            padding: 1.5rem;
        }

        .product-card .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2e7d32;
            margin-bottom: 0.8rem;
        }

        .product-card .price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #4caf50;
            margin-bottom: 0.5rem;
        }

        .stock-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: linear-gradient(135deg, #e8f5e9 0%, #f1f8e9 100%);
            color: #2e7d32;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .stock-badge.out-of-stock {
            background: linear-gradient(135deg, #ffebee 0%, #fce4ec 100%);
            color: #c62828;
        }

        /* Button in Card */
        .product-card .btn {
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .product-card .btn-primary {
            background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
        }

        .product-card .btn-secondary {
            background-color: #bdbdbd;
            border: none;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.1);
        }

        .empty-state-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        /* Footer */
        footer {
            margin-top: 80px;
            padding: 40px 0;
            background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
            color: white;
            text-align: center;
            border-radius: 50px 50px 0 0;
        }

        footer p {
            margin: 0;
            font-size: 1rem;
            opacity: 0.95;
        }

        /* User Info Badge */
        .user-badge {
            background: linear-gradient(135deg, #e8f5e9 0%, #f1f8e9 100%);
            color: #2e7d32;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section p {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .product-card img {
                height: 180px;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }
        }

        /* Loading Animation */
        .card-loading {
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        /* Navbar Mobile */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                margin-top: 1rem;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(76, 175, 80, 0.1);
            }

            .navbar-collapse .d-flex {
                flex-direction: column;
                gap: 0.5rem !important;
            }

            .navbar-collapse .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">
            Raninsha Bakery
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMain" aria-controls="navbarMain"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                {{-- Bisa ditambah menu lain kalau perlu --}}
            </ul>

            <div class="d-flex align-items-center gap-2">
                @if(session()->has('user_id'))
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-sm">
                        🛒 Keranjang
                    </a>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm">
                        📦 Pesanan Saya
                    </a>
                    <span class="user-badge d-none d-md-inline">
                        👤 {{ session('user_name') }}
                    </span>
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">
                        Logout
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                        Daftar
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>

{{-- KONTEN UTAMA --}}
<div class="container">

    {{-- HERO SECTION --}}
    <section class="hero-section">
        <h1>🎂 Temukan Kue Favoritmu</h1>
        <p>
            Pesan kue lezat dengan mudah, cukup pilih produk, masukkan ke keranjang, dan lakukan pemesanan.
        </p>
    </section>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>✓ Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>⚠ Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    {{-- LIST PRODUK --}}
    <div class="mb-4">
        <h2 class="section-title">Daftar Produk Kue</h2>
    </div>

    @if($products->isEmpty())
        <div class="empty-state">
            <div class="empty-state-icon">🧁</div>
            <h3 class="text-muted">Belum Ada Produk</h3>
            <p class="text-muted">Produk kue akan segera tersedia. Silakan cek kembali nanti!</p>
        </div>
    @else
        <div class="row g-4 mb-5 justify-content-center">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 product-card">
                        @if ($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 class="card-img-top"
                                 alt="{{ $product->name }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center"
                                 style="height:220px; background: linear-gradient(135deg, #e8f5e9 0%, #f1f8e9 100%);">
                                <span style="font-size: 4rem;">🧁</span>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="price mb-2">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <p class="mb-3">
                                <span class="stock-badge {{ $product->stock > 0 ? '' : 'out-of-stock' }}">
                                    {{ $product->stock > 0 ? "Stok: {$product->stock}" : "Stok Habis" }}
                                </span>
                            </p>

                            <div class="mt-auto">
                                @if(session()->has('user_id'))
                                    @if($product->stock > 0)
                                        <form action="{{ route('cart.add', $product->id) }}"
                                              method="POST" class="d-grid">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                🛒 Tambah ke Keranjang
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary w-100" disabled>
                                            Stok Habis
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                       class="btn btn-outline-primary w-100">
                                        Pesan
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- FOOTER --}}
<footer>
    <div class="container">
        <p>🧁 &copy; {{ date('Y') }} Toko Kue. Semua hak dilindungi.</p>
        <p class="mt-2 small">Dibuat dengan ❤ untuk pecinta kue</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
></script>

<script>
    // Smooth scroll untuk animasi
    document.addEventListener('DOMContentLoaded', function() {
        // Fade in animation untuk cards
        const cards = document.querySelectorAll('.product-card');
        cards.forEach((card, index) => {
            card.style.animation = fadeInUp 0.6s ease ${index * 0.1}s both;
        });
    });
</script>

</body>
</html>