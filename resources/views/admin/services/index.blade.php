@extends('admin.layout')

@section('title', 'Layanan')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h3 class="fw-bold">Manajemen Layanan</h3>
            <p class="text-muted">Kelola layanan/fitur yang ditawarkan di website.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('admin.services.create') }}" class="btn btn-success">
                <span>➕ Tambah Layanan</span>
            </a>
        </div>
    </div>

    @if ($services->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gy-4">
            @foreach ($services as $service)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <i class="bi {{ $service->icon }}" style="font-size: 2rem; color: #0d6efd;"></i>
                                </div>
                                <div>
                                    @if ($service->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </div>
                            </div>
                            <h5 class="card-title fw-bold">{{ $service->name }}</h5>
                            <p class="card-text text-muted small">{{ $service->description ?: '-' }}</p>
                            <small class="text-muted">Icon: {{ $service->icon }}</small>
                        </div>
                        <div class="card-footer border-top bg-white">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}"
                                    class="btn btn-sm btn-outline-primary">✏️ Edit</a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($services->hasPages())
            <div class="mt-4">
                {{ $services->links() }}
            </div>
        @endif
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body py-5 text-center">
                <div class="mb-3">
                    <span style="font-size: 3rem;">🎯</span>
                </div>
                <h5 class="text-muted">Belum ada layanan</h5>
                <p class="text-muted">Tambahkan layanan pertama untuk menampilkan fitur bisnis Anda.</p>
                <a href="{{ route('admin.services.create') }}" class="btn btn-success">
                    <span>➕ Tambah Layanan Pertama</span>
                </a>
            </div>
        </div>
    @endif
@endsection
