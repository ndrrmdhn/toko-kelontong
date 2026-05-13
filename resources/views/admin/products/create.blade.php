@extends('admin.layout')

@section('title', 'Tambah Produk')

@section('content')
    @php $product = null; @endphp

    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Tambah Produk Baru</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        @include('admin.products.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan Produk</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
