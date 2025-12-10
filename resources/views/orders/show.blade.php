<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f3f8f3 0%, #ebf5eb 100%);
        }

        /* Judul */
        .page-title {
            font-size: 1.55rem;
            font-weight: 700;
            color: #2e7d32;
        }

        /* Animasi ikon */
        .float-anim {
            animation: float 2.6s ease-in-out infinite;
            display: inline-block;
        }
        @keyframes float {
            50% { transform: translateY(-5px); }
        }

        /* Card styling */
        .custom-card {
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.12);
        }

        .table-header-green {
            background: #4caf50 !important;
            color: white !important;
        }

        /* Tombol hijau */
        .btn-success {
            background-color: #4caf50 !important;
            border-color: #4caf50 !important;
        }
        .btn-success:hover {
            background-color: #43a047 !important;
        }
    </style>
</head>

<body>

<div class="container py-4">

    <!-- JUDUL DENGAN ANIMASI -->
    <h3 class="page-title mb-3">
        <span class="float-anim" style="font-size: 1.8rem; margin-right: 6px;">📄</span>
        Detail Pesanan #{{ $order->id }}
    </h3>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <!-- CARD UTAMA -->
    <div class="card custom-card mb-4">
        <div class="card-body">

            <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
            <p><strong>No HP:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Alamat:</strong> {{ $order->customer_address }}</p>

            <p>
                <strong>Status:</strong> 
                <span class="badge 
                    @if($order->status == 'success') bg-success
                    @elseif($order->status == 'pending') bg-warning text-dark
                    @else bg-secondary
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>

            <p><strong>Total:</strong> 
                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
            </p>

            @if($order->note)
                <p><strong>Catatan:</strong> {{ $order->note }}</p>
            @endif
        </div>
    </div>

    <!-- ITEM PESANAN -->
    <div class="card custom-card">
        <div class="card-body p-0">

            <table class="table table-bordered mb-0">
                <thead class="table-header-green">
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'Produk terhapus' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
            ← Kembali ke daftar pesanan
        </a>
    </div>

</div>

</body>
</html>