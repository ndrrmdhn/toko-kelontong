@extends('admin.layout')

@section('title', 'Tambah Layanan')

@section('content')
    @php $service = null; @endphp

    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Tambah Layanan Baru</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.services.store') }}">
        @csrf

        @include('admin.services.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan Layanan</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
