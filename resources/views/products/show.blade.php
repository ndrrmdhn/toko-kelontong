@extends('layouts.app')

@section('title', $product->name . ' - ' . config('app.name'))

@section('content')
    <div class="container py-5">
        <div class="row gy-4">
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm">
                    @if ($productImage = image_url($product->image))
                        <img src="{{ $productImage }}" class="card-img-top img-fluid" alt="{{ $product->name }}" loading="lazy"
                            style="object-fit: cover; max-height: 420px;">
                    @else
                        <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 420px;">
                            <span class="text-white">Tidak ada gambar produk</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <a href="{{ route('products.index') }}" class="text-decoration-none text-muted">
                        ← Kembali ke Katalog
                    </a>
                </div>

                <h1 class="fw-bold">{{ $product->name }}</h1>
                <div class="d-flex align-items-center mb-3 flex-wrap gap-2">
                    <span class="badge bg-info">{{ optional($product->category)->name ?? 'Tanpa kategori' }}</span>
                    @if ($product->active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-secondary">Nonaktif</span>
                    @endif
                    @if ($product->stock > 0)
                        <span class="badge bg-primary">Stok: {{ $product->stock }}</span>
                    @else
                        <span class="badge bg-danger">Stok Habis</span>
                    @endif
                </div>
                <div class="mb-4">
                    <h3 class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                    @if ($product->expired_date)
                        <p class="text-danger mb-0">Kadaluarsa: {{ $product->expired_date->format('d M Y') }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <p class="text-muted">{{ $product->description ?: 'Deskripsi produk belum tersedia.' }}</p>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ whatsapp_link('Halo, saya ingin memesan produk: ' . $product->name) }}" target="_blank"
                        class="btn btn-success btn-lg">
                        <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">
                        Lihat Katalog Lainnya
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
