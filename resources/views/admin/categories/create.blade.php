@extends('admin.layout')

@section('title', 'Tambah Kategori')

@section('content')
    @php $category = null; @endphp

    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
        @csrf

        @include('admin.categories.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
