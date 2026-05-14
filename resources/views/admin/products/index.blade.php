@extends('admin.layout')

@section('title', 'Produk')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h3 class="fw-bold">Manajemen Produk</h3>
            <p class="text-muted">Kelola produk, stok, serta status produk dengan mudah.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                <span><i class="bi bi-plus-circle"></i> Tambah Produk</span>
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3 align-items-end">
                        <div class="col-sm-6 col-lg-5">
                            <label class="form-label">Cari Produk</label>
                            <input type="text" name="search" class="form-control" placeholder="Cari nama atau deskripsi"
                                value="{{ $search ?? '' }}">
                        </div>

                        <div class="col-sm-4 col-lg-4">
                            @include('admin.components.form-select', [
                                'name' => 'category',
                                'label' => 'Filter Kategori',
                                'options' => $categories,
                                'selected' => $categoryId,
                                'placeholder' => 'Semua kategori',
                            ])
                        </div>

                        <div class="col-sm-2 col-lg-3 d-grid gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Cari</button>
                            @if ($search || $categoryId)
                                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">↻ Reset</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($products->count() > 0)
        <div class="d-none d-md-block">
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table-hover mb-0 table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Gambar</th>
                                <th>Produk</th>
                                <th>Harga / Stok</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        @if ($image = image_url($product->image))
                                            <img src="{{ $image }}" alt="{{ $product->name }}" class="rounded"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                                style="width: 60px; height: 60px;">
                                                <small class="text-muted">No Image</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        <div>
                                            <small
                                                class="text-muted">{{ Str::limit($product->description, 60) ?: '-' }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">Rp {{ number_format($product->price, 2, ',', '.') }}</div>
                                        <div>
                                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                                Stok: {{ $product->stock }}
                                            </span>
                                        </div>
                                        <div>
                                            <small class="text-muted">Kadaluarsa:
                                                {{ $product->expired_date?->format('d M Y') ?? '-' }}</small>
                                        </div>
                                    </td>
                                    <td>{{ optional($product->category)->name ?? '-' }}</td>
                                    <td>
                                        @if ($product->active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="btn btn-sm btn-outline-primary mb-1">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                            style="display: inline;"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
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
                            Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari
                            {{ $products->total() }} produk
                        </small>
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="d-block d-md-none">
            <div class="row row-cols-1 gy-3">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card border-0 shadow-sm">
                            <div class="row g-0 align-items-center">
                                <div class="col-4">
                                    @if ($image = image_url($product->image))
                                        <img src="{{ $image }}" alt="{{ $product->name }}"
                                            class="img-fluid rounded-start w-100 h-100"
                                            style="object-fit: cover; min-height: 140px;">
                                    @else
                                        <div class="bg-light rounded-start d-flex align-items-center justify-content-center"
                                            style="min-height: 140px;">
                                            <small class="text-muted">No Image</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-8">
                                    <div class="card-body py-3">
                                        <h6 class="card-title mb-2">{{ $product->name }}</h6>
                                        <div class="mb-2">
                                            <span
                                                class="badge bg-info me-1">{{ optional($product->category)->name ?? '-' }}</span>
                                            <span
                                                class="badge bg-{{ $product->active ? 'success' : 'secondary' }}">{{ $product->active ? 'Aktif' : 'Nonaktif' }}</span>
                                        </div>
                                        <p class="text-muted small mb-2">Rp
                                            {{ number_format($product->price, 2, ',', '.') }}</p>
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">Stok:
                                                {{ $product->stock }}</span>
                                        </div>
                                        <div class="d-flex mt-3 gap-2">
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                class="btn btn-sm btn-outline-primary flex-fill">Edit</a>
                                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                                class="flex-fill"
                                                onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger w-100">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body py-5 text-center">
                <p class="text-muted mb-3"><i class="bi bi-box-seam"></i> Belum ada produk yang ditambahkan.</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
            </div>
        </div>
    @endif
@endsection
