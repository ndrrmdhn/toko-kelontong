@extends('admin.layout')

@section('title', 'Edit Layanan')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Edit Layanan</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.services.update', $service) }}">
        @csrf
        @method('PUT')

        @include('admin.services.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Perbarui Layanan</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
