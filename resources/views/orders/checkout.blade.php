<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Background lembut seperti halaman keranjang */
        body {
            background: linear-gradient(135deg, #f3f8f3 0%, #ebf5eb 100%);
        }

        /* Tombol hijau */
        .btn-primary {
            background-color: #4caf50 !important;
            border-color: #4caf50 !important;
        }
        .btn-primary:hover {
            background-color: #43a047 !important;
        }

        .custom-card {
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.12);
        }

        .table-header-green {
            background: #4caf50 !important;
            color: white !important;
        }

        /* animasi ikon */
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
    <div class="d-flex align-items-center mb-2">
        <div class="float-anim" style="font-size: 1.8rem; margin-right: 8px;">🧾</div>

        <h2 class="fw-bold text-success mb-0" style="font-size: 1.35rem;">
            Checkout
        </h2>
    </div>

    <p class="text-muted" style="font-size: 0.9rem; margin-left: 2.4rem; margin-top: -2px;">
        Isi data pesananmu dengan benar sebelum melanjutkan.
    </p>


    <!-- ===================== PESAN ERROR ===================== -->
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- ===================== RINGKASAN KERANJANG ===================== -->
    <div class="card custom-card mb-4">
        <div class="card-header table-header-green">
            <strong>Ringkasan Keranjang</strong>
        </div>
        <div class="card-body">

            <ul class="list-group mb-3">
                @foreach ($cart as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                        <strong>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</strong>
                    </li>
                @endforeach
            </ul>

            <h5 class="text-success fw-bold">
                Total: Rp {{ number_format($total, 0, ',', '.') }}
            </h5>
        </div>
    </div>


    <!-- ===================== FORM CHECKOUT ===================== -->
    <div class="card custom-card mb-4">
        <div class="card-body">

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Penerima</label>
                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">No HP</label>
                    <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Lengkap</label>
                    <textarea name="customer_address" class="form-control" rows="3" required>{{ old('customer_address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan (opsional)</label>
                    <textarea name="note" class="form-control" rows="2">{{ old('note') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    Buat Pesanan
                </button>
            </form>

        </div>
    </div>


    <!-- ===================== KEMBALI ===================== -->
    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
        ← Kembali ke Keranjang
    </a>

</div>

</body>
</html>