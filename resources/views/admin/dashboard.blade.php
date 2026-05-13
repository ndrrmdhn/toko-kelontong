@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Dashboard Admin</h3>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted d-block">Total Produk</small>
                            <h3 class="fw-bold text-primary">{{ $total_products }}</h3>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10">
                            📦
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted d-block">Total Kategori</small>
                            <h3 class="fw-bold text-success">{{ $total_categories }}</h3>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10">
                            🏷️
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted d-block">Total Kontrakan</small>
                            <h3 class="fw-bold text-warning">{{ $total_rentals }}</h3>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10">
                            🏠
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted d-block">Kontrakan Tersedia</small>
                            <h3 class="fw-bold text-info">{{ $available_rentals }}</h3>
                        </div>
                        <div class="stat-icon bg-info bg-opacity-10">
                            ✓
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light fw-bold">
                    ⚡ Aksi Cepat
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 mb-2">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary w-100">
                                <span>➕ Tambah Kategori</span>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-2">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-outline-success w-100">
                                <span>➕ Tambah Produk</span>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-2">
                            <a href="{{ route('admin.rentals.create') }}" class="btn btn-outline-warning w-100">
                                <span>➕ Tambah Kontrakan</span>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-2">
                            <a href="{{ route('admin.banners.create') }}" class="btn btn-outline-info w-100">
                                <span>➕ Tambah Banner</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">👋 Selamat Datang, {{ auth()->user()->name }}!</h5>
                    <p class="card-text mb-0">
                        Anda login sebagai <strong>{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</strong>.
                        Kelola website {{ config('app.name') }} dengan mudah dan efisien.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
