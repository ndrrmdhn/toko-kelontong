@extends('admin.layout')

@section('title', 'Edit Kategori')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Edit Kategori</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.categories.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Perbarui Kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
