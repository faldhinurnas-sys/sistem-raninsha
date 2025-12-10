<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ======== TEMA WARNA ======== */
        body {
            background: linear-gradient(135deg, #f3f8f3 0%, #ebf5eb 100%);
        }

        .btn-primary {
            background-color: #4caf50 !important;
            border-color: #4caf50 !important;
        }
        .btn-primary:hover {
            background-color: #43a047 !important;
        }

        .table-header-green {
            background: #4caf50 !important;
            color: white !important;
        }

        .custom-card {
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.12);
        }

        /* Emoji floating */
        .float-anim {
            animation: float 2.6s infinite ease-in-out;
        }
        @keyframes float {
            50% { transform: translateY(-5px); }
        }
    </style>
</head>

<body>

<div class="container py-4">

    <!-- ===================== JUDUL KECIL KIRI ATAS ===================== -->
    <div class="d-flex align-items-center mb-1" style="margin-top: 5px;">
        <div class="float-anim" style="font-size: 1.8rem; margin-right: 8px;">🛒</div>

        <h2 class="fw-bold text-success mb-0" style="font-size: 1.35rem;">
            Keranjang Belanja
        </h2>
    </div>

    <p class="text-muted" style="font-size: 0.9rem; margin-left: 2.4rem; margin-top: -2px;">
        Tinjau kembali pesananmu sebelum lanjut ke checkout.
    </p>


    <!-- ===================== ALERT ===================== -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    @if(empty($cart))
        <div class="alert alert-info shadow-sm text-center">Keranjang masih kosong.</div>

    @else

        <!-- ===================== TABEL KERANJANG ===================== -->
        <div class="card custom-card mb-3">
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-header-green">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($cart as $item)
                            <tr>
                                <td class="align-middle">{{ $item['name'] }}</td>

                                <td class="align-middle">
                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </td>

                                <td class="align-middle">
                                    <form action="{{ route('cart.update', $item['product_id']) }}" 
                                          method="POST" class="d-flex">
                                        @csrf
                                        <input type="number" 
                                               name="quantity" 
                                               value="{{ $item['quantity'] }}" 
                                               min="1"
                                               class="form-control form-control-sm"
                                               style="width: 70px;">

                                        <button class="btn btn-sm btn-outline-primary ms-2">Update</button>
                                    </form>
                                </td>

                                <td class="align-middle">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </td>

                                <td class="text-center align-middle">
                                    <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus produk ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        <tr class="fw-bold bg-light">
                            <td colspan="3" class="text-end">Total:</td>
                            <td colspan="2">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- ===================== TOMBOL AKSI ===================== -->
        <div class="d-flex gap-2 mb-4">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger"
                        onclick="return confirm('Yakin ingin mengosongkan keranjang?')">
                    Kosongkan Keranjang
                </button>
            </form>

            <a href="{{ route('checkout.form') }}" class="btn btn-primary">
                Lanjut ke Checkout
            </a>
        </div>

    @endif


    <!-- ===================== KEMBALI ===================== -->
    <a href="{{ route('landing') }}" class="btn btn-outline-secondary">
        ← Kembali ke Halaman Produk
    </a>

</div>

</body>
</html>