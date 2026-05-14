@extends('layouts.app')

@section('title', 'Home - ' . setting('site_name', config('app.name')))
@section('meta_description',
    setting(
    'site_description',
    'Website modern dengan layanan lengkap untuk kebutuhan
    sehari-hari Anda.',
    ))
@section('og_title', setting('site_name', config('app.name', 'Website')))
@section('og_description',
    setting(
    'site_description',
    'Website modern dengan layanan lengkap untuk kebutuhan
    sehari-hari Anda.',
    ))

@section('content')
    <!-- Hero Banner Carousel -->
    <div class="mb-5">
        @if ($banners->count() > 0)
            <div id="heroCarousel" class="carousel slide overflow-hidden rounded shadow-sm" data-bs-ride="carousel">
                @if ($banners->count() > 1)
                    <div class="carousel-indicators">
                        @foreach ($banners as $index => $banner)
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}"
                                class="{{ $index === 0 ? 'active' : '' }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                @endif

                <div class="carousel-inner">
                    @foreach ($banners as $index => $banner)
                        @php
                            $heroButtonText = $banner->button_text ?: 'Belanja Sekarang';
                            $heroButtonLink = $banner->button_link ?: route('products.index');
                        @endphp
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            @if ($image = image_url($banner->image))
                                <div class="hero-slide position-relative"
                                    style="background-image: url('{{ $image }}'); background-size: cover; background-position: center; min-height: 70vh;">
                                    <div
                                        class="hero-overlay position-absolute w-100 h-100 d-flex align-items-center start-0 top-0">
                                        <div class="container text-white">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-8 col-xl-6">
                                                    <div class="hero-content rounded-3 p-4 text-center"
                                                        style="background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(8px);">
                                                        <h1 class="display-4 fw-bold text-shadow mb-4">
                                                            {{ $banner->title ?: setting('hero_title', 'Solusi Toko dan Rental Terpercaya') }}
                                                        </h1>
                                                        <p class="lead text-shadow fs-5 mb-5">
                                                            {{ $banner->description ?: setting('hero_subtitle', setting('site_description', 'Website modern dengan layanan lengkap untuk kebutuhan sehari-hari Anda.')) }}
                                                        </p>
                                                        <div
                                                            class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                                                            <a href="{{ $heroButtonLink }}"
                                                                class="btn btn-success btn-lg fw-semibold px-4 py-3 shadow">
                                                                <i class="bi bi-cart-fill me-2"></i> {{ $heroButtonText }}
                                                            </a>
                                                            <a href="#services"
                                                                class="btn btn-outline-light btn-lg fw-semibold px-4 py-3">
                                                                <i class="bi bi-info-circle-fill me-2"></i> Lihat Layanan
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="hero-slide position-relative bg-gradient-primary min-vh-70 d-flex align-items-center">
                                    <div class="container text-white">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8 col-xl-6">
                                                <div class="hero-content rounded-3 p-4 text-center"
                                                    style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(8px);">
                                                    <h1 class="display-4 fw-bold text-shadow mb-4">
                                                        {{ setting('hero_title', 'Solusi Toko dan Rental Terpercaya') }}
                                                    </h1>
                                                    <p class="lead text-shadow fs-5 mb-5">
                                                        {{ setting('hero_subtitle', setting('site_description', 'Website modern dengan layanan lengkap untuk kebutuhan sehari-hari Anda.')) }}
                                                    </p>
                                                    <div
                                                        class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                                                        <a href="{{ route('products.index') }}"
                                                            class="btn btn-success btn-lg fw-semibold px-4 py-3 shadow">
                                                            <i class="bi bi-cart-fill me-2"></i> Belanja Sekarang
                                                        </a>
                                                        <a href="#services"
                                                            class="btn btn-outline-light btn-lg fw-semibold px-4 py-3">
                                                            <i class="bi bi-info-circle-fill me-2"></i> Lihat Layanan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                @if ($banners->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        @else
            <div
                class="hero-slide position-relative bg-gradient-primary min-vh-70 d-flex align-items-center mb-5 rounded shadow-lg">
                <div class="container text-white">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <div class="hero-content rounded-3 p-4 text-center"
                                style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(8px);">
                                <h1 class="display-4 fw-bold text-shadow mb-4">
                                    {{ setting('hero_title', 'Selamat Datang di ' . setting('site_name', config('app.name'))) }}
                                </h1>
                                <p class="lead text-shadow fs-5 mb-5">
                                    {{ setting('hero_subtitle', setting('site_description', 'Website modern dengan layanan lengkap untuk kebutuhan sehari-hari Anda.')) }}
                                </p>
                                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                                    <a href="{{ route('products.index') }}"
                                        class="btn btn-outline-light btn-lg fw-semibold px-4 py-3 shadow">
                                        <i class="bi bi-cart-fill me-2"></i> Belanja Sekarang
                                    </a>
                                    <a href="#services" class="btn btn-outline-light btn-lg fw-semibold px-4 py-3">
                                        <i class="bi bi-info-circle-fill me-2"></i> Pelajari Layanan Kami
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="container mb-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="card card-modern h-100">
                    <div class="card-body p-4">
                        <span class="badge badge-modern bg-secondary mb-3 text-white">Tentang Kami</span>
                        <h2 class="fw-bold mb-3">{{ setting('hero_title', 'Solusi Toko dan Rental Terpercaya') }}</h2>
                        <p class="text-muted lead mb-4">
                            {{ setting('hero_subtitle', setting('site_description', 'Website modern dengan layanan lengkap untuk kebutuhan sehari-hari Anda.')) }}
                        </p>

                        <div class="d-grid gap-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-success mt-1">
                                    <i class="bi bi-check-circle-fill fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Layanan Lengkap</h6>
                                    <p class="text-muted small mb-0">Produk, kontrakan, dan info bisnis dalam satu website
                                        yang rapi.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-success mt-1">
                                    <i class="bi bi-clock-history fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Cepat dan Responsif</h6>
                                    <p class="text-muted small mb-0">Desain mobile-first yang mendukung pelanggan di semua
                                        perangkat.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-success mt-1">
                                    <i class="bi bi-whatsapp fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Mudah Dihubungi</h6>
                                    <p class="text-muted small mb-0">Kontak dan WhatsApp aktif langsung dari situs untuk
                                        pesanan cepat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="card card-modern h-100">
                            <div class="card-body p-4 text-center">
                                <i class="bi bi-clock-history fs-2 text-success mb-3"></i>
                                <h6 class="fw-semibold mb-2">Jam Operasional</h6>
                                <p class="text-muted small mb-0">
                                    {{ setting('operational_hours', 'Senin - Jumat: 09:00 - 18:00') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-modern h-100">
                            <div class="card-body p-4 text-center">
                                <i class="bi bi-telephone fs-2 text-success mb-3"></i>
                                <h6 class="fw-semibold mb-2">Kontak</h6>
                                <p class="text-muted small mb-1">
                                    <i class="bi bi-telephone me-1"></i>{{ setting('phone', '0812-3456-7890') }}
                                </p>
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-envelope me-1"></i>{{ setting('email', 'info@example.com') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-modern h-100">
                            <div class="card-body p-4 text-center">
                                <i class="bi bi-geo-alt fs-2 text-success mb-3"></i>
                                <h6 class="fw-semibold mb-2">Alamat</h6>
                                <p class="text-muted small mb-0">{{ setting('address', 'Alamat belum diatur') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-modern h-100">
                            <div class="card-body p-4 text-center">
                                <i class="bi bi-share fs-2 text-success mb-3"></i>
                                <h6 class="fw-semibold mb-2">Social Media</h6>
                                <div class="d-flex justify-content-center mt-2 flex-wrap gap-2">
                                    @foreach (['facebook' => 'bi-facebook', 'instagram' => 'bi-instagram', 'youtube' => 'bi-youtube', 'tiktok' => 'bi-tiktok'] as $key => $icon)
                                        @if (setting($key))
                                            <a href="{{ setting($key) }}" class="text-muted fs-5" target="_blank"
                                                rel="noopener">
                                                <i class="{{ $icon }}"></i>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card card-modern">
                    <div class="card-body p-4">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-4 gap-3">
                            <div>
                                <h3 class="fw-bold mb-2">Lokasi Usaha</h3>
                                <p class="text-muted mb-0">Lihat lokasi bisnis Anda secara langsung dengan peta yang
                                    ditampilkan dari pengaturan website.</p>
                            </div>
                            <div class="text-md-end">
                                <span class="badge badge-modern bg-secondary mb-2 text-white">Alamat</span>
                                <p class="text-muted small mb-0">{{ setting('address', 'Alamat belum diatur') }}</p>
                            </div>
                        </div>

                        @if (setting('maps_embed'))
                            <div class="ratio ratio-16x9 rounded-3 overflow-hidden border">
                                {!! setting('maps_embed') !!}
                            </div>
                        @else
                            <div class="bg-light text-muted rounded-3 border p-5 text-center">
                                <i class="bi bi-geo-alt fs-1 mb-3"></i>
                                <h5 class="mb-2">Peta Lokasi Belum Diatur</h5>
                                <p class="mb-0">Silakan tambah embed Google Maps di halaman Pengaturan untuk menampilkan
                                    lokasi bisnis Anda.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div id="services" class="bg-light mb-5 py-5">
        <div class="container">
            <h2 class="fw-bold mb-5 text-center">Layanan Kami</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @forelse($services as $service)
                    <div class="col">
                        <div class="card card-modern h-100 text-center">
                            <div class="card-body d-flex flex-column p-4">
                                @if ($service->icon)
                                    <div class="mb-3">
                                        <i class="bi {{ $service->icon }} fs-1 text-primary"></i>
                                    </div>
                                @endif
                                <h5 class="card-title fw-semibold mb-3">{{ $service->name }}</h5>
                                <p class="card-text text-muted flex-grow-1">
                                    {{ $service->description ?: 'Layanan unggulan kami untuk memenuhi kebutuhan Anda.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-muted py-5 text-center">
                            <i class="bi bi-info-circle fs-1 mb-3"></i>
                            <p>Belum ada layanan yang tersedia</p>
                        </div>
                    </div>
                @endforelse
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
            <a href="{{ route('products.index') }}" class="btn btn-success align-self-center">Lihat Semua Produk</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
            @forelse($featured_products as $product)
                <div class="col">
                    <div class="card card-modern h-100">
                        @if ($image = image_url($product->image))
                            <img src="{{ $image }}" class="card-img-modern img-fluid" alt="{{ $product->name }}"
                                loading="lazy">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center card-img-modern">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title fw-semibold mb-2">{{ $product->name }}</h5>
                            <div class="d-flex mb-3 flex-wrap gap-2">
                                <span
                                    class="badge badge-modern bg-dark text-white">{{ optional($product->category)->name ?? 'Umum' }}</span>
                                <span
                                    class="badge badge-modern bg-text-white{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                    {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Habis' }}
                                </span>
                            </div>
                            <p class="card-text text-muted small flex-grow-1 mb-3">
                                {{ Str::limit($product->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <strong class="text-dark fs-5">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</strong>
                                <a href="{{ route('products.show', $product) }}"
                                    class="btn btn-outline-dark btn-modern">Detail</a>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-transparent p-4 pt-0">
                            <a href="{{ whatsapp_link('Halo, saya ingin memesan produk: ' . $product->name) }}"
                                target="_blank" class="btn btn-success btn-modern w-100">
                                <i class="bi bi-whatsapp me-2"></i> Pesan
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-muted py-5 text-center">
                        <i class="bi bi-cart-x fs-1 mb-3"></i>
                        <p>Belum ada produk unggulan</p>
                    </div>
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
            <a href="{{ route('products.index') }}" class="btn btn-success align-self-center">Lihat Semua
                Produk</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
            @forelse($latest_products as $product)
                <div class="col">
                    <div class="card card-modern h-100">
                        @if ($image = image_url($product->image))
                            <img src="{{ $image }}" class="card-img-modern img-fluid" alt="{{ $product->name }}"
                                loading="lazy">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center card-img-modern">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title fw-semibold mb-2">{{ $product->name }}</h5>
                            <p class="card-text text-muted small flex-grow-1 mb-3">
                                {{ Str::limit($product->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <strong class="text-dark fs-5">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</strong>
                                <a href="{{ route('products.show', $product) }}"
                                    class="btn btn-outline-dark btn-modern">Detail</a>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-transparent p-4 pt-0">
                            <a href="{{ whatsapp_link('Halo, saya ingin memesan produk: ' . $product->name) }}"
                                target="_blank" class="btn btn-success btn-modern w-100">
                                <i class="bi bi-whatsapp me-2"></i> Pesan
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-muted py-5 text-center">
                        <i class="bi bi-clock-history fs-1 mb-3"></i>
                        <p>Belum ada produk terbaru</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Rentals Section -->
    @if ($rentals->count() > 0)
        <div class="bg-light mb-5 py-5">
            <div class="container">
                <h2 class="fw-bold mb-4">Kontrakan Tersedia</h2>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse($rentals as $rental)
                        <div class="col">
                            <div class="card card-modern h-100">
                                @php
                                    $images = is_array($rental->images)
                                        ? $rental->images
                                        : json_decode($rental->images, true);
                                    $rentalImage = $images && count($images) ? image_url($images[0]) : null;
                                @endphp
                                @if ($rentalImage)
                                    <img src="{{ $rentalImage }}" class="card-img-modern img-fluid"
                                        alt="{{ $rental->name }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center card-img-modern">
                                        <i class="bi bi-house text-muted fs-1"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="card-title fw-semibold mb-2">{{ $rental->name }}</h5>
                                        <span
                                            class="badge badge-modern bg-{{ $rental->status === 'available' ? 'success' : 'danger' }} text-white">
                                            {{ $rental->status === 'available' ? 'Tersedia' : 'Terisi' }}
                                        </span>
                                    </div>
                                    <p class="card-text text-muted small flex-grow-1 mb-3">
                                        {{ Str::limit($rental->description, 80) }}</p>
                                    <div class="mb-3">
                                        @if ($rental->price_monthly)
                                            <div class="d-flex justify-content-between">
                                                <small class="text-muted">Bulanan:</small>
                                                <strong class="text-dark">Rp
                                                    {{ number_format($rental->price_monthly, 0, ',', '.') }}</strong>
                                            </div>
                                        @endif
                                        @if ($rental->price_yearly)
                                            <div class="d-flex justify-content-between">
                                                <small class="text-muted">Tahunan:</small>
                                                <strong class="text-dark">Rp
                                                    {{ number_format($rental->price_yearly, 0, ',', '.') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer border-0 bg-transparent p-4 pt-0">
                                    <a href="{{ whatsapp_link('Halo, saya tertarik dengan kontrakan ' . $rental->name) }}"
                                        target="_blank" class="btn btn-success btn-modern w-100">
                                        <i class="bi bi-whatsapp me-2"></i> Tanya Info
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-muted py-5 text-center">
                                <i class="bi bi-house-x fs-1 mb-3"></i>
                                <p>Belum ada kontrakan tersedia</p>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('rentals.index') }}" class="btn btn-success">Lihat Semua Kontrakan</a>
                </div>
            </div>
        </div>
    @endif

    <!-- CTA Section -->
    <div class="bg-success py-5 text-white">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-xl-6">
                    <h2 class="fw-bold display-5 mb-4">Butuh Bantuan?</h2>
                    <p class="lead fs-5 mb-4">
                        Hubungi kami melalui WhatsApp untuk pertanyaan atau pemesanan
                        <strong>{{ setting('site_name', config('app.name')) }}</strong>
                    </p>
                    <a href="{{ whatsapp_link('Halo, saya ingin bertanya tentang layanan ' . setting('site_name', config('app.name'))) }}"
                        target="_blank" class="btn btn-success btn-lg fw-semibold px-5 py-3 shadow border-white">
                        <i class="bi bi-whatsapp fs-5 me-2"></i> Chat via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
