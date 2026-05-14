@extends('admin.layout')

@section('title', 'Edit Banner')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Edit Banner</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.banners.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Perbarui Banner</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
