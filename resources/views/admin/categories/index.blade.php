@extends('admin.layout')

@section('title', 'Kategori Produk')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h3 class="fw-bold">Manajemen Kategori</h3>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <span>➕ Tambah Kategori</span>
            </a>
        </div>
    </div>

    <!-- Search Form -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.categories.index') }}" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari kategori..."
                            value="{{ $search ?? '' }}">
                        <button type="submit" class="btn btn-primary">
                            🔍 Cari
                        </button>
                        @if ($search)
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                ↻ Reset
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if ($categories->count() > 0)
                    <div class="table-responsive">
                        <table class="table-hover mb-0 table">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            @if ($category->image)
                                                <img src="{{ asset('storage/' . $category->image) }}"
                                                    alt="{{ $category->name }}"
                                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 0.5rem;">
                                            @else
                                                <div
                                                    style="width: 50px; height: 50px; background-color: #e9ecef; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; color: #999;">
                                                    No Image
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $category->name }}</strong>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ Str::limit($category->description, 50) ?? '-' }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                                class="btn btn-sm btn-outline-primary" title="Edit">
                                                ✏️ Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                                style="display: inline;"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Menampilkan {{ $categories->firstItem() }} - {{ $categories->lastItem() }}
                                dari {{ $categories->total() }} kategori
                            </small>
                            {{ $categories->links() }}
                        </div>
                    </div>
                @else
                    <div class="card-body">
                        <div class="py-5 text-center">
                            <p class="text-muted mb-3">📭 Belum ada kategori</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                ➕ Buat Kategori Pertama
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
