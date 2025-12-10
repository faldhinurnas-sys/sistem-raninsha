@extends('layouts.admin')

@section('title', 'Daftar Pesanan')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Daftar Pesanan</h3>
    </div>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada pesanan yang tercatat.
        </div>
    @else

        @php
            // Urutkan: processing → pending → success → completed → cancelled
            $sortedOrders = $orders->sortBy(function ($order) {
                return [
                    'processing' => 1,
                    'pending'    => 2,
                    'success'    => 3,
                    'completed'  => 4,
                    'cancelled'  => 5,
                ][$order->status] ?? 99;
            });
        @endphp

        <div class="card shadow-sm">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">

                        <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Pemesan</th>
                            <th>Tgl Pesan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($sortedOrders as $index => $order)
                            <tr>
                                <td class="align-middle">{{ $index + 1 }}</td>

                                <td class="align-middle fw-bold">
                                    #{{ $order->id }}
                                </td>

                                <td class="align-middle">
                                    {{ $order->customer_name }} <br>
                                    <small class="text-muted">
                                        {{ $order->user->username ?? '-' }}
                                    </small>
                                </td>

                                <td class="align-middle">
                                    {{ $order->created_at->format('d-m-Y H:i') }}
                                </td>

                                <td class="align-middle fw-bold">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>

                                <td class="align-middle">
                                    @php
                                        $statusMap = [
                                            'pending'    => ['warning',   'Pending'],
                                            'processing' => ['primary',   'Processing'],
                                            'success'    => ['info',      'Success'],
                                            'completed'  => ['success',   'Completed'],
                                            'cancelled'  => ['danger',    'Cancelled'],
                                        ];

                                        $badge = $statusMap[$order->status][0] ?? 'secondary';
                                        $label = $statusMap[$order->status][1] ?? ucfirst($order->status);
                                    @endphp

                                    <span class="badge bg-{{ $badge }}">
                                        {{ $label }}
                                    </span>
                                </td>

                                <td class="text-end align-middle">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    @endif

@endsection
