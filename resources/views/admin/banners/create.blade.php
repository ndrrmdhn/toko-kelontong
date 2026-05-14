@extends('admin.layout')

@section('title', 'Tambah Banner')

@section('content')
    @php $banner = null; @endphp

    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Tambah Banner Baru</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
        @csrf

        @include('admin.banners.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan Banner</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
