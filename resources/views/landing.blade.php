@extends('layouts.app')

@section('title', 'Home - ' . config('app.name'))

@section('content')
    <!-- Hero Section -->
    <div class="bg-primary mb-5 py-5 text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold">Selamat Datang di {{ config('app.name') }}</h1>
                    <p class="lead">Toko kelontong modern dengan layanan lengkap untuk kebutuhan sehari-hari Anda</p>
                    <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg me-2">
                        <i class="bi bi-cart-fill"></i> Belanja Sekarang
                    </a>
                    <a href="#services" class="btn btn-light btn-lg">
                        Pelajari Layanan Kami
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Banners -->
    @if ($banners->count() > 0)
        <div class="container mb-5">
            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($banners as $index => $banner)
                        <div class="carousel-item @if ($index === 0) active @endif">
                            <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100 rounded"
                                style="max-height: 300px; object-fit: cover;">
                            @if ($banner->title)
                                <div class="carousel-caption">
                                    <h5>{{ $banner->title }}</h5>
                                    @if ($banner->description)
                                        <p>{{ $banner->description }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    @endif

    <!-- Services Section -->
    <div id="services" class="bg-light mb-5 py-5">
        <div class="container">
            <h2 class="fw-bold mb-5 text-center">Layanan Kami</h2>
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="h-100 rounded bg-white p-3 text-center shadow-sm">
                            @if ($service->icon)
                                <div class="fs-1 mb-3">{{ $service->icon }}</div>
                            @endif
                            <h5>{{ $service->name }}</h5>
                            <p class="text-muted small">{{ $service->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="container mb-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-4 gap-3">
            <div>
                <h2 class="fw-bold mb-1">Produk Unggulan</h2>
                <p class="text-muted mb-0">Produk terbaik pilihan kami untuk kebutuhan harian Anda.</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-primary align-self-center">Lihat Semua Produk</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
            @forelse($featured_products as $product)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        @if ($image = image_url($product->image))
                            <img src="{{ $image }}" class="card-img-top img-fluid" alt="{{ $product->name }}"
                                loading="lazy" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <span class="text-white">Tidak ada gambar</span>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="d-flex mb-2 flex-wrap gap-2">
                                <span class="badge bg-info">{{ optional($product->category)->name ?? 'Umum' }}</span>
                                <span
                                    class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">{{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Habis' }}</span>
                            </div>
                            <p class="card-text text-muted small mb-3">{{ Str::limit($product->description, 60) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto gap-2">
                                <strong class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                                <a href="{{ route('products.show', $product) }}"
                                    class="btn btn-outline-primary btn-sm">Detail</a>
                            </div>
                        </div>
                        <div class="card-footer border-top-0 bg-white">
                            <a href="{{ whatsapp_link('Halo, saya ingin memesan produk: ' . $product->name) }}"
                                target="_blank" class="btn btn-warning btn-sm w-100">
                                <i class="bi bi-whatsapp"></i> Pesan
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted text-center">Belum ada produk unggulan</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Latest Products Section -->
    <div class="container mb-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-4 gap-3">
            <div>
                <h2 class="fw-bold mb-1">Produk Terbaru</h2>
                <p class="text-muted mb-0">Produk terbaru yang baru saja ditambahkan ke katalog.</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary align-self-center">Lihat Semua
                Produk</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
            @forelse($latest_products as $product)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        @if ($image = image_url($product->image))
                            <img src="{{ $image }}" class="card-img-top img-fluid" alt="{{ $product->name }}"
                                loading="lazy" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <span class="text-white">Tidak ada gambar</span>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted small mb-3">{{ Str::limit($product->description, 60) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto gap-2">
                                <strong class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                                <a href="{{ route('products.show', $product) }}"
                                    class="btn btn-outline-primary btn-sm">Detail</a>
                            </div>
                        </div>
                        <div class="card-footer border-top-0 bg-white">
                            <a href="{{ whatsapp_link('Halo, saya ingin memesan produk: ' . $product->name) }}"
                                target="_blank" class="btn btn-warning btn-sm w-100">
                                <i class="bi bi-whatsapp"></i> Pesan
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted text-center">Belum ada produk terbaru</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Rentals Section -->
    @if ($rentals->count() > 0)
        <div class="bg-light mb-5 py-5">
            <div class="container">
                <h2 class="fw-bold mb-4">Kontrakan Tersedia</h2>
                <div class="row">
                    @forelse($rentals as $rental)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @php
                                    $images = is_array($rental->images)
                                        ? $rental->images
                                        : json_decode($rental->images, true);
                                @endphp
                                @if ($images && count($images) > 0)
                                    <img src="{{ asset('storage/' . $images[0]) }}" class="card-img-top"
                                        alt="{{ $rental->name }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary"
                                        style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                        <span class="text-white">Tidak ada gambar</span>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title">{{ $rental->name }}</h5>
                                        <span
                                            class="badge bg-{{ $rental->status === 'available' ? 'success' : 'danger' }}">
                                            {{ $rental->status === 'available' ? 'Tersedia' : 'Terisi' }}
                                        </span>
                                    </div>
                                    <p class="card-text text-muted small">{{ Str::limit($rental->description, 60) }}</p>
                                    <div class="mb-3">
                                        @if ($rental->price_monthly)
                                            <small class="d-block">Bulanan: <strong class="text-primary">Rp
                                                    {{ number_format($rental->price_monthly, 0, ',', '.') }}</strong></small>
                                        @endif
                                        @if ($rental->price_yearly)
                                            <small class="d-block">Tahunan: <strong class="text-primary">Rp
                                                    {{ number_format($rental->price_yearly, 0, ',', '.') }}</strong></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer border-top-0 bg-white">
                                    <a href="https://wa.me/{{ config('settings.whatsapp', '') }}?text=Halo, saya tertarik dengan kontrakan {{ $rental->name }}"
                                        target="_blank" class="btn btn-warning btn-sm w-100">
                                        <i class="bi bi-whatsapp"></i> Tanya Info
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted text-center">Belum ada kontrakan tersedia</p>
                        </div>
                    @endforelse
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('rentals.index') }}" class="btn btn-primary">Lihat Semua Kontrakan</a>
                </div>
            </div>
        </div>
    @endif

    <!-- CTA Section -->
    <div class="bg-primary py-5 text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Butuh Bantuan?</h2>
            <p class="lead mb-4">Hubungi kami melalui WhatsApp untuk pertanyaan atau pemesanan</p>
            <a href="https://wa.me/{{ config('settings.whatsapp', '') }}" target="_blank"
                class="btn btn-warning btn-lg">
                <i class="bi bi-whatsapp"></i> Chat via WhatsApp
            </a>
        </div>
    </div>
@endsection
