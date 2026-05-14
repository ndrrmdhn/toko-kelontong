@extends('layouts.app')

@section('title', 'Produk - ' . config('app.name'))

@section('content')
    <div class="container py-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-4 gap-3">
            <div>
                <h2 class="fw-bold mb-1">Katalog Produk</h2>
                <p class="text-muted mb-0">Temukan produk terbaik untuk kebutuhan harian Anda.</p>
            </div>
        </div>

        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header border-bottom bg-white">
                        <h5 class="mb-0">Filter</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('products.index') }}" class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Kategori</label>
                                <select name="category" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($categoryId == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Cari Produk</label>
                                <input type="text" name="search" class="form-control" placeholder="Cari nama produk..."
                                    value="{{ $search ?? '' }}">
                            </div>

                            <div class="col-12 d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Cari</button>
                                @if ($search || $categoryId)
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                @if ($products->count() > 0)
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach ($products as $product)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm">
                                    @if ($image = image_url($product->image))
                                        <img src="{{ $image }}" class="card-img-top img-fluid"
                                            alt="{{ $product->name }}" loading="lazy"
                                            style="height: 220px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary d-flex align-items-center justify-content-center"
                                            style="height: 220px;">
                                            <span class="text-white">Tidak ada gambar</span>
                                        </div>
                                    @endif

                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex mb-2 flex-wrap gap-2">
                                            <span
                                                class="badge badge-modern bg-dark text-white">{{ optional($product->category)->name ?? '-' }}</span>
                                            @if ($product->stock > 0)
                                                <span class="badge badge-modern bg-text-white">Stok: {{ $product->stock }}</span>
                                            @else
                                                <span class="badge badge-modern bg-danger text-white">Stok Habis</span>
                                            @endif
                                        </div>

                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-muted small mb-3">
                                            {{ Str::limit($product->description, 70) }}</p>

                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-dark fs-5 fw-bold">Rp
                                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                                                @if ($product->expired_date)
                                                    <small
                                                        class="text-danger fw-bold">{{ $product->expired_date->format('d/m/Y') }}</small>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column gap-2">
                                                <a href="{{ route('products.show', $product) }}"
                                                    class="btn btn-outline-success btn-sm w-100">Lihat Detail</a>
                                                <a href="{{ whatsapp_link('Halo, saya ingin memesan produk: ' . $product->name) }}"
                                                    target="_blank" class="btn btn-success btn-sm w-100">
                                                    <i class="bi bi-whatsapp"></i> Pesan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <p class="mb-2">Produk tidak ditemukan.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Tampilkan Semua</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
