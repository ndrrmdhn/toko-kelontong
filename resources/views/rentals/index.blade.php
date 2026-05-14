@extends('layouts.app')

@section('title', 'Kontrakan - ' . config('app.name'))

@section('content')
    <div class="container">
        <h2 class="fw-bold mb-4">Daftar Kontrakan</h2>

        <div class="row">
            @forelse($rentals as $rental)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        @php
                            $images = is_array($rental->images) ? $rental->images : json_decode($rental->images, true);
                            $imageUrl = $images && count($images) ? image_url($images[0]) : null;
                        @endphp
                        @if ($imageUrl)
                            <img src="{{ $imageUrl }}" class="card-img-top" alt="{{ $rental->name }}" loading="lazy"
                                style="height: 250px; object-fit: cover;">
                        @else
                            <div class="bg-secondary"
                                style="height: 250px; display: flex; align-items: center; justify-content: center;">
                                <span class="text-white">Tidak ada gambar</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title">{{ $rental->name }}</h5>
                                <span class="badge bg-{{ $rental->status === 'available' ? 'success' : 'danger' }}">
                                    {{ $rental->status === 'available' ? 'Tersedia' : 'Terisi' }}
                                </span>
                            </div>

                            <p class="card-text text-muted">{{ Str::limit($rental->description, 80) }}</p>

                            @if ($rental->price_monthly || $rental->price_yearly)
                                <div class="mb-3">
                                    @if ($rental->price_monthly)
                                        <div class="mb-2">
                                            <small class="text-muted">Sewa Bulanan:</small>
                                            <strong class="d-block text-primary">Rp
                                                {{ number_format($rental->price_monthly, 0, ',', '.') }}</strong>
                                        </div>
                                    @endif
                                    @if ($rental->price_yearly)
                                        <div>
                                            <small class="text-muted">Sewa Tahunan:</small>
                                            <strong class="d-block text-primary">Rp
                                                {{ number_format($rental->price_yearly, 0, ',', '.') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @php
                                $facilities = is_array($rental->facilities)
                                    ? $rental->facilities
                                    : json_decode($rental->facilities, true);
                            @endphp
                            @if ($facilities && count($facilities) > 0)
                                <div class="mb-3">
                                    <strong class="d-block mb-2">Fasilitas:</strong>
                                    <ul class="list-unstyled">
                                        @foreach (array_slice($facilities, 0, 3) as $facility)
                                            <li><small class="text-muted">✓ {{ $facility }}</small></li>
                                        @endforeach
                                        @if (count($facilities) > 3)
                                            <li><small class="text-muted">+ {{ count($facilities) - 3 }} lainnya</small>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer border-top-0 bg-white">
                            <a href="{{ whatsapp_link('Halo, saya ingin menanyakan kontrakan: ' . $rental->name) }}"
                                target="_blank" class="btn btn-warning btn-sm w-100">
                                <i class="bi bi-whatsapp"></i> Tanya Info
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <p>Belum ada kontrakan yang tersedia</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($rentals->hasPages())
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    {{ $rentals->links() }}
                </ul>
            </nav>
        @endif
    </div>
@endsection
