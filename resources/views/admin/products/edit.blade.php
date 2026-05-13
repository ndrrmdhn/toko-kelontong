@extends('admin.layout')

@section('title', 'Edit Produk')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Edit Produk</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.products.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Perbarui Produk</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
