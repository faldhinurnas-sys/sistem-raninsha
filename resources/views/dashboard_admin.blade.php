@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-12 mb-4">
        <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);">
            <div class="card-body p-4 text-white">
                <div class="d-flex align-items-center">
                    <div class="welcome-icon me-3" style="font-size: 3rem;">👋</div>
                    <div>
                        <h3 class="mb-1">Selamat Datang, {{ session('user_name') }}!</h3>
                        <p class="mb-0 opacity-75">Role: <strong>{{ session('user_role') }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Card Produk -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm hover-card">
            <div class="card-body text-center p-4">
                <div class="icon-wrapper mb-3" style="font-size: 3rem;">📦</div>
                <h5 class="card-title text-success fw-bold mb-2">Kelola Produk</h5>
                <p class="card-text text-muted mb-3">Tambah, edit, dan hapus produk kue Anda</p>
                <a href="{{ route('admin.products.index') }}" class="btn btn-success btn-sm">
                    Lihat Produk
                </a>
            </div>
        </div>
    </div>

    <!-- Card Pesanan -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm hover-card">
            <div class="card-body text-center p-4">
                <div class="icon-wrapper mb-3" style="font-size: 3rem;">🛒</div>
                <h5 class="card-title text-success fw-bold mb-2">Kelola Pesanan</h5>
                <p class="card-text text-muted mb-3">Pantau dan kelola pesanan pelanggan</p>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-success btn-sm">
                    Lihat Pesanan
                </a>
            </div>
        </div>
    </div>

    <!-- Card Info -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm hover-card">
            <div class="card-body text-center p-4">
                <div class="icon-wrapper mb-3" style="font-size: 3rem;">📊</div>
                <h5 class="card-title text-success fw-bold mb-2">Statistik</h5>
                <p class="card-text text-muted mb-3">Lihat performa toko kue Anda</p>
                <button class="btn btn-success btn-sm" disabled>
                    Segera Hadir
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0 text-success fw-bold">📋 Informasi Sistem</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 rounded" style="background-color: #f1f8e9;">
                            <span class="me-3" style="font-size: 2rem;">👤</span>
                            <div>
                                <small class="text-muted d-block">Pengguna Aktif</small>
                                <strong class="text-success">{{ session('user_name') }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 rounded" style="background-color: #f1f8e9;">
                            <span class="me-3" style="font-size: 2rem;">🔐</span>
                            <div>
                                <small class="text-muted d-block">Level Akses</small>
                                <strong class="text-success">{{ session('user_role') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .hover-card {
        transition: all 0.3s ease;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(76, 175, 80, 0.2) !important;
    }
    
    .icon-wrapper {
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
</style>
@endpush
@endsection
