@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Edit Produk</h3>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
                    Kembali
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $product->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="price" class="form-control"
                                       value="{{ old('price', $product->price) }}" min="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stock" class="form-control"
                                       value="{{ old('stock', $product->stock) }}" min="0" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar Produk (jpg/png)</label>
                            @if ($product->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$product->image) }}" class="img-thumbnail" style="max-width:100px;">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <div class="form-text">
                                Kosongkan jika tidak ingin mengubah gambar.
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                {{ $product->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Tampilkan di landing page
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update Produk
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
