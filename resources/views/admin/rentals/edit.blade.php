@extends('admin.layout')

@section('title', 'Edit Kontrakan')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Edit Kontrakan</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.rentals.update', $rental) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.rentals.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Perbarui Kontrakan</button>
            <a href="{{ route('admin.rentals.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
