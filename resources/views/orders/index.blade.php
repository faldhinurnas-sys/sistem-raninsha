<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f3f8f3 0%, #ebf5eb 100%);
        }

        /* Judul */
        .page-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #2e7d32;
        }

        /* Animasi Float */
        .float-anim {
            display: inline-block;
            animation: float 2.6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        /* Card tabel */
        .custom-card {
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.12);
        }

        .table-header-green {
            background: #4caf50 !important;
            color: white !important;
        }

        /* Tombol hijau */
        .btn-primary {
            background-color: #4caf50 !important;
            border-color: #4caf50 !important;
        }
        .btn-primary:hover {
            background-color: #43a047 !important;
        }
    </style>
</head>

<body>

<div class="container py-4">

    <!-- Judul + Animasi -->
    <h3 class="page-title mb-3">
        <span class="float-anim" style="font-size: 1.8rem; margin-right: 6px;">📦</span>
        Pesanan Saya
    </h3>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info shadow-sm text-center">
            Belum ada pesanan.
        </div>

    @else

        <div class="card custom-card p-0">
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-header-green">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>

                                <td class="align-middle fw-bold text-success">
                                    #{{ $order->id }}
                                </td>

                                <td class="align-middle">
                                    {{ $order->created_at->format('d-m-Y H:i') }}
                                </td>

                                <td class="align-middle fw-bold">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>

                                <td class="align-middle">
                                    <span class="badge 
                                        @if($order->status == 'success') bg-success 
                                        @elseif($order->status == 'pending') bg-warning text-dark 
                                        @else bg-secondary 
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td class="text-center align-middle">
                                    <a href="{{ route('orders.show', $order->id) }}" 
                                       class="btn btn-sm btn-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif

    <div class="mt-3">
        <a href="{{ route('landing') }}" class="btn btn-outline-secondary">
            ← Kembali ke Landing
        </a>
    </div>

</div>

</body>
</html>