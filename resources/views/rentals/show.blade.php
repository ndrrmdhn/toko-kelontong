@extends('layouts.app')

@section('title', $rental->name . ' - ' . config('app.name'))

@section('content')
    <div class="container py-5">
        <div class="row gy-4">
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm">
                    @php
                        $rentalImages = is_array($rental->images)
                            ? $rental->images
                            : json_decode($rental->images, true);
                    @endphp
                    @if ($rentalImages && count($rentalImages) > 0)
                        <div id="rentalCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($rentalImages as $index => $image)
                                    @php $slideImage = image_url($image); @endphp
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        @if ($slideImage)
                                            <img src="{{ $slideImage }}" class="d-block w-100" alt="{{ $rental->name }}"
                                                loading="lazy" style="object-fit: cover; height: 420px;">
                                        @else
                                            <div class="bg-secondary d-flex align-items-center justify-content-center"
                                                style="height: 420px;">
                                                <span class="text-white">Tidak ada gambar</span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            @if (count($rentalImages) > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#rentalCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#rentalCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                        @if (count($rentalImages) > 1)
                            <div class="mt-3">
                                <div class="row g-2">
                                    @foreach ($rentalImages as $index => $image)
                                        @php $thumbnail = image_url($image); @endphp
                                        <div class="col-3">
                                            @if ($thumbnail)
                                                <img src="{{ $thumbnail }}" class="img-thumbnail cursor-pointer"
                                                    alt="Thumbnail {{ $index + 1 }}"
                                                    onclick="goToSlide({{ $index }})" loading="lazy"
                                                    style="height: 60px; object-fit: cover; cursor: pointer;">
                                            @else
                                                <div class="bg-secondary rounded" style="height: 60px;"></div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="bg-secondary rounded" style="height: 60px;"></div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @else
        <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 420px;">
            <span class="text-white">Tidak ada gambar kontrakan</span>
        </div>
        @endif
    </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="mb-3">
            <a href="{{ route('rentals.index') }}" class="text-decoration-none text-muted">
                ← Kembali ke Daftar Kontrakan
            </a>
        </div>

        <h1 class="fw-bold">{{ $rental->name }}</h1>
        <div class="d-flex align-items-center mb-3 flex-wrap gap-2">
            @if ($rental->status === 'available')
                <span class="badge bg-success">Tersedia</span>
            @else
                <span class="badge bg-danger">Disewa</span>
            @endif
            @if ($rentalImages && count($rentalImages) > 1)
                <span class="badge bg-info">{{ count($rentalImages) }} foto</span>
            @endif
        </div>

        <div class="mb-4">
            @if ($rental->price_monthly)
                <h3 class="text-primary">{{ $rental->formatted_price_monthly }}/bulan</h3>
            @endif
            @if ($rental->price_yearly)
                <h4 class="text-muted">{{ $rental->formatted_price_yearly }}/tahun</h4>
            @endif
            @if (!$rental->price_monthly && !$rental->price_yearly)
                <p class="text-muted">Harga sewa belum ditentukan</p>
            @endif
        </div>

        <div class="mb-4">
            <p class="text-muted">{{ $rental->description ?: 'Deskripsi kontrakan belum tersedia.' }}</p>
        </div>

        @if ($rental->facilities && count($rental->facilities) > 0)
            <div class="mb-4">
                <h5 class="fw-semibold">Fasilitas</h5>
                <div class="row g-2">
                    @foreach ($rental->facilities as $facility)
                        <div class="col-auto">
                            <span class="badge bg-light text-dark px-3 py-2">
                                <i class="bi bi-check-circle-fill text-success me-1"></i>{{ $facility }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="d-grid gap-2">
            <a href="{{ whatsapp_link('Halo, saya ingin menanyakan kontrakan: ' . $rental->name) }}" target="_blank"
                class="btn btn-success btn-lg">
                <i class="bi bi-whatsapp"></i> Tanya via WhatsApp
            </a>
            <a href="{{ route('rentals.index') }}" class="btn btn-outline-secondary btn-lg">
                Lihat Kontrakan Lainnya
            </a>
        </div>
    </div>
    </div>
    </div>

    <script>
        function goToSlide(index) {
            const carousel = new bootstrap.Carousel(document.getElementById('rentalCarousel'));
            carousel.to(index);
        }
    </script>
@endsection
