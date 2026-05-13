@extends('admin.layout')

@section('title', 'Tambah Kontrakan')

@section('content')
    @php $rental = null; @endphp

    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Tambah Kontrakan Baru</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.rentals.store') }}" enctype="multipart/form-data">
        @csrf

        @include('admin.rentals.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan Kontrakan</button>
            <a href="{{ route('admin.rentals.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
