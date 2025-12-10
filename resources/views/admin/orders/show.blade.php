@extends('layouts.admin')

@section('title', 'Detail Pesanan #'.$order->id)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Detail Pesanan #{{ $order->id }}</h3>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">
            Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <!-- Data Pemesan -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Data Pemesan
                </div>
                <div class="card-body">
                    <p class="mb-1">
                        <strong>Nama:</strong> {{ $order->customer_name }}
                    </p>
                    <p class="mb-1">
                        <strong>Username:</strong> {{ $order->user->username ?? '-' }}
                    </p>
                    <p class="mb-1">
                        <strong>No HP:</strong> {{ $order->customer_phone }}
                    </p>
                    <p class="mb-1">
                        <strong>Alamat:</strong><br>
                        {{ $order->customer_address }}
                    </p>

                    @if($order->note)
                        <p class="mb-0">
                            <strong>Catatan:</strong><br>
                            {{ $order->note }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Ringkasan & Status -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Ringkasan & Status
                </div>
                <div class="card-body">
                    <p class="mb-1">
                        <strong>Tanggal Pesan:</strong>
                        {{ $order->created_at->format('d-m-Y H:i') }}
                    </p>
                    <p class="mb-3">
                        <strong>Total:</strong>
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </p>

                    @php
                        $statusClass = [
                            'pending' => 'warning',
                            'processing' => 'primary',
                            'completed' => 'success',
                            'cancelled' => 'danger',
                        ][$order->status] ?? 'secondary';
                    @endphp

                    <p>
                        <strong>Status Saat Ini:</strong>
                        <span class="badge bg-{{ $statusClass }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>

                    <hr>

                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="row g-2">
                        @csrf
                        <div class="col-8">
                            <label class="form-label">Ubah Status Pesanan</label>
                            <select name="status" class="form-select">
                                <option value="pending"    {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed"  {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled"  {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Item Pesanan -->
    <div class="card mt-3">
        <div class="card-header">
            Item Pesanan
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'Produk terhapus' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
