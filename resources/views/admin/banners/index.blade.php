@extends('admin.layout')

@section('title', 'Banner')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h3 class="fw-bold">Manajemen Banner</h3>
            <p class="text-muted">Kelola banner promosi dan hero section website.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('admin.banners.create') }}" class="btn btn-success">
                <span><i class="bi bi-plus-circle"></i> Tambah Banner</span>
            </a>
        </div>
    </div>

    @if ($banners->count() > 0)
        <div class="d-none d-md-block">
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table-hover mb-0 table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Urutan</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Tombol</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>
                                        <span class="badge bg-info">{{ $banner->sort_order ?? '0' }}</span>
                                    </td>
                                    <td>
                                        @if ($image = image_url($banner->image))
                                            <img src="{{ $image }}" alt="{{ $banner->title }}" class="rounded"
                                                style="width: 80px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                                style="width: 80px; height: 50px;">
                                                <small class="text-muted">No Image</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $banner->title }}</strong>
                                        <div>
                                            <small
                                                class="text-muted">{{ Str::limit($banner->description, 50) ?: '-' }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($banner->button_text)
                                            <span class="badge bg-primary">{{ $banner->button_text }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($banner->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.banners.edit', $banner) }}"
                                            class="btn btn-sm btn-outline-primary mb-1">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}"
                                            style="display: inline;"
                                            onsubmit="return confirm('Yakin ingin menghapus banner ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-light">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                        <small class="text-muted">
                            Menampilkan {{ $banners->firstItem() }} - {{ $banners->lastItem() }} dari
                            {{ $banners->total() }} banner
                        </small>
                        {{ $banners->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="d-block d-md-none">
            <div class="row row-cols-1 gy-3">
                @foreach ($banners as $banner)
                    <div class="col">
                        <div class="card border-0 shadow-sm">
                            <div class="row g-0 align-items-center">
                                <div class="col-4">
                                    @if ($image = image_url($banner->image))
                                        <img src="{{ $image }}" alt="{{ $banner->title }}"
                                            class="img-fluid rounded-start w-100 h-100"
                                            style="object-fit: cover; min-height: 100px;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                            style="min-height: 100px;">
                                            <small class="text-muted">No Image</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold">{{ $banner->title }}</h6>
                                        <p class="card-text small text-muted mb-2">
                                            {{ Str::limit($banner->description, 50) ?: '-' }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center gap-1">
                                            <div>
                                                @if ($banner->is_active)
                                                    <span class="badge bg-success" style="font-size: 0.7rem;">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary"
                                                        style="font-size: 0.7rem;">Nonaktif</span>
                                                @endif
                                            </div>
                                            <div>
                                                <a href="{{ route('admin.banners.edit', $banner) }}"
                                                    class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                                <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Yakin ingin menghapus banner ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body py-5 text-center">
                <div class="mb-3">
                    <span style="font-size: 3rem;"><i class="bi bi-image"></i></span>
                </div>
                <h5 class="text-muted">Belum ada banner</h5>
                <p class="text-muted">Tambahkan banner pertama untuk mulai mempromosikan konten Anda.</p>
                <a href="{{ route('admin.banners.create') }}" class="btn btn-success">
                    <span><i class="bi bi-plus-circle"></i> Tambah Banner Pertama</span>
                </a>
            </div>
        </div>
    @endif
@endsection
