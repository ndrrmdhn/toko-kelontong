@extends('admin.layout')

@section('title', 'Kontrakan')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h3 class="fw-bold">Manajemen Kontrakan</h3>
            <p class="text-muted">Kelola kontrakan, harga sewa, fasilitas, serta status ketersediaan.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('admin.rentals.create') }}" class="btn btn-success">
                <span><i class="bi bi-plus-circle"></i> Tambah Kontrakan</span>
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.rentals.index') }}" class="row g-3 align-items-end">
                        <div class="col-sm-6 col-lg-5">
                            <label class="form-label">Cari Kontrakan</label>
                            <input type="text" name="search" class="form-control" placeholder="Cari nama atau deskripsi"
                                value="{{ $search ?? '' }}">
                        </div>

                        <div class="col-sm-4 col-lg-4">
                            @include('admin.components.form-select', [
                                'name' => 'status',
                                'label' => 'Filter Status',
                                'options' => ['available' => 'Tersedia', 'rented' => 'Disewa'],
                                'selected' => $status,
                                'placeholder' => 'Semua status',
                            ])
                        </div>

                        <div class="col-sm-2 col-lg-3 d-grid gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Cari</button>
                            @if ($search || $status)
                                <a href="{{ route('admin.rentals.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i> Reset</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($rentals->count() > 0)
        <div class="d-none d-md-block">
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table-hover mb-0 table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Gambar</th>
                                <th>Kontrakan</th>
                                <th>Harga Sewa</th>
                                <th>Fasilitas</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentals as $rental)
                                <tr>
                                    <td>
                                        @php $imageUrl = $rental->main_image ? image_url($rental->main_image) : null; @endphp
                                        @if ($imageUrl)
                                            <img src="{{ $imageUrl }}" alt="{{ $rental->name }}" class="rounded"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                                style="width: 60px; height: 60px;">
                                                <small class="text-muted">No Image</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $rental->name }}</strong>
                                        <div>
                                            <small
                                                class="text-muted">{{ Str::limit($rental->description, 60) ?: '-' }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($rental->price_monthly)
                                            <div class="fw-semibold">{{ $rental->formatted_price_monthly }}/bulan</div>
                                        @endif
                                        @if ($rental->price_yearly)
                                            <div class="text-muted small">{{ $rental->formatted_price_yearly }}/tahun</div>
                                        @endif
                                        @if (!$rental->price_monthly && !$rental->price_yearly)
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($rental->facilities && count($rental->facilities) > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach (array_slice($rental->facilities, 0, 3) as $facility)
                                                    <span class="badge bg-light text-dark">{{ $facility }}</span>
                                                @endforeach
                                                @if (count($rental->facilities) > 3)
                                                    <span
                                                        class="badge bg-secondary">+{{ count($rental->facilities) - 3 }}</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($rental->status === 'available')
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger">Disewa</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.rentals.edit', $rental) }}"
                                            class="btn btn-sm btn-outline-primary mb-1">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.rentals.destroy', $rental) }}"
                                            style="display: inline;"
                                            onsubmit="return confirm('Yakin ingin menghapus kontrakan ini?');">
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
                            Menampilkan {{ $rentals->firstItem() }} - {{ $rentals->lastItem() }} dari
                            {{ $rentals->total() }} kontrakan
                        </small>
                        {{ $rentals->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="d-block d-md-none">
            <div class="row row-cols-1 gy-3">
                @foreach ($rentals as $rental)
                    <div class="col">
                        <div class="card border-0 shadow-sm">
                            <div class="row g-0 align-items-center">
                                <div class="col-4">
                                    @php $imageUrl = $rental->main_image ? image_url($rental->main_image) : null; @endphp
                                    @if ($imageUrl)
                                        <img src="{{ $imageUrl }}" alt="{{ $rental->name }}"
                                            class="img-fluid rounded-start w-100 h-100" loading="lazy"
                                            style="object-fit: cover; min-height: 140px;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                            style="min-height: 140px;">
                                            <small class="text-muted">No Image</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold">{{ $rental->name }}</h6>
                                        <p class="card-text small text-muted mb-2">
                                            {{ Str::limit($rental->description, 80) ?: '-' }}
                                        </p>
                                        <div class="mb-2">
                                            @if ($rental->price_monthly)
                                                <div class="fw-semibold text-primary">
                                                    {{ $rental->formatted_price_monthly }}/bulan</div>
                                            @endif
                                            @if ($rental->price_yearly)
                                                <div class="text-muted small">{{ $rental->formatted_price_yearly }}/tahun
                                                </div>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            @if ($rental->status === 'available')
                                                <span class="badge bg-success">Tersedia</span>
                                            @else
                                                <span class="badge bg-danger">Disewa</span>
                                            @endif
                                            <div>
                                                <a href="{{ route('admin.rentals.edit', $rental) }}"
                                                    class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                                <form method="POST" action="{{ route('admin.rentals.destroy', $rental) }}"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Yakin ingin menghapus kontrakan ini?');">
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
                    <span style="font-size: 3rem;">🏠</span>
                </div>
                <h5 class="text-muted">Belum ada kontrakan</h5>
                <p class="text-muted">Tambahkan kontrakan pertama untuk memulai manajemen properti.</p>
                <a href="{{ route('admin.rentals.create') }}" class="btn btn-success">
                    <span>➕ Tambah Kontrakan Pertama</span>
                </a>
            </div>
        </div>
    @endif
@endsection
