@extends('layouts.app')

@section('title', 'Profil Saya - ' . setting('site_name', config('app.name')))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-8">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="fw-bold mb-2">Profil Saya</h2>
                        <p class="text-muted mb-4">Perbarui informasi profil dan akun Anda dengan aman.</p>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="d-flex align-items-center mb-4 gap-3">
                                <div class="rounded-circle bg-secondary overflow-hidden" style="width:80px; height:80px;">
                                    @if ($user->avatar && ($avatar = image_url($user->avatar)))
                                        <img src="{{ $avatar }}" alt="Avatar {{ $user->name }}" class="img-fluid">
                                    @else
                                        <div
                                            class="d-flex align-items-center justify-content-center h-100 w-100 text-white">
                                            <i class="bi bi-person-circle fs-1"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="fw-semibold mb-1">Avatar Saat Ini</p>
                                    <p class="text-muted small mb-0">Unggah avatar baru untuk membuat profil Anda lebih
                                        personal.</p>
                                </div>
                            </div>

                            @include('admin.components.form-file', [
                                'name' => 'avatar',
                                'label' => 'Avatar Profil',
                                'value' => old('avatar', $user->avatar),
                            ])

                            @include('admin.components.form-text', [
                                'name' => 'name',
                                'label' => 'Nama Lengkap',
                                'value' => old('name', $user->name),
                                'required' => true,
                            ])

                            @include('admin.components.form-text', [
                                'name' => 'email',
                                'label' => 'Email',
                                'type' => 'email',
                                'value' => old('email', $user->email),
                                'required' => true,
                            ])

                            <div class="d-grid mt-3 gap-2">
                                <button type="submit" class="btn btn-primary">Simpan Profil</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="fw-bold mb-2">Ubah Password</h2>
                        <p class="text-muted mb-4">Gunakan password baru agar akun Anda lebih aman.</p>

                        <form method="POST" action="{{ route('profile.password.update') }}">
                            @csrf
                            @method('PUT')

                            @include('admin.components.form-text', [
                                'name' => 'current_password',
                                'label' => 'Password Saat Ini',
                                'type' => 'password',
                                'required' => true,
                            ])

                            @include('admin.components.form-text', [
                                'name' => 'password',
                                'label' => 'Password Baru',
                                'type' => 'password',
                                'required' => true,
                            ])
                            <small class="text-muted">Gunakan minimal 8 karakter dengan kombinasi angka dan huruf.</small>

                            @include('admin.components.form-text', [
                                'name' => 'password_confirmation',
                                'label' => 'Konfirmasi Password',
                                'type' => 'password',
                                'required' => true,
                            ])

                            <div class="d-grid mt-3 gap-2">
                                <button type="submit" class="btn btn-warning">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
