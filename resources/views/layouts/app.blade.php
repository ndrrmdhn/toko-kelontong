<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', setting('site_name', config('app.name', 'Website')))</title>
    <meta name="description" content="@yield('meta_description', setting('site_description', 'Website modern dengan layanan lengkap untuk kebutuhan sehari-hari Anda.'))">
    <meta property="og:title" content="@yield('og_title', setting('site_name', config('app.name', 'Website')))" />
    <meta property="og:description" content="@yield('og_description', setting('site_description', 'Website modern dengan layanan lengkap untuk kebutuhan sehari-hari Anda.'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <link rel="canonical" href="{{ url()->current() }}" />
    @if ($favicon = image_url(setting('favicon')))
        <link rel="icon" href="{{ $favicon }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ $favicon }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #00b140;
            --primary-dark: #00a838;
            --primary-light: #d4edda;
            --secondary-color: #ffcc00;
            --secondary-dark: #e6b800;
            --danger-color: #dc3545;
            --light-bg: #f5f5f5;
            --white-bg: #ffffff;
            --border-color: #e8e8e8;
            --text-dark: #424242;
            --text-muted: #999999;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
        }

        .navbar {
            background-color: var(--white-bg);
            border-bottom: 1px solid var(--border-color);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-warning {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--text-dark);
        }

        .btn-warning:hover {
            background-color: var(--secondary-dark);
            border-color: var(--secondary-dark);
        }

        .nav-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .nav-social a:hover {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--primary-color);
        }

        .whatsapp-float {
            position: fixed;
            right: 1rem;
            bottom: 1.25rem;
            z-index: 1050;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 1rem;
            background-color: var(--primary-color);
            color: var(--white-bg);
            border-radius: 999px;
            box-shadow: 0 4px 12px rgba(0, 177, 64, 0.25);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .whatsapp-float:hover {
            background-color: var(--primary-dark);
            box-shadow: 0 6px 16px rgba(0, 177, 64, 0.35);
            transform: translateY(-2px);
        }

        /* Hero Section Styles */
        .hero-slide {
            position: relative;
        }

        .hero-overlay {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%);
        }

        .hero-content {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #28a745 100%);
        }

        .min-vh-70 {
            min-height: 70vh;
        }

        /* Card Consistency */
        .card-modern {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background-color: var(--white-bg);
        }

        .card-modern:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .card-img-modern {
            border-radius: 12px 12px 0 0;
            height: 200px;
            object-fit: cover;
        }

        .badge-modern {
            border-radius: 16px;
            font-weight: 500;
            padding: 0.375rem 0.75rem;
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .table {
            background-color: var(--white-bg);
            border-collapse: collapse;
        }

        .table thead th {
            background-color: var(--light-bg);
            border-bottom: 1px solid var(--border-color);
            color: var(--text-dark);
            font-weight: 600;
        }

        .table tbody tr {
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background-color: var(--light-bg);
        }

        .form-control,
        .form-select {
            border: 1px solid var(--border-color);
            border-radius: 8px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 177, 64, 0.1);
        }

        .btn-modern {
            border-radius: 12px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }

        .btn-modern:hover {
            transform: translateY(-1px);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing') }}">
                @if ($logo = image_url(setting('logo')))
                    <img src="{{ $logo }}" alt="{{ setting('site_name', config('app.name', 'Website')) }}"
                        style="height: 34px; max-width: 160px; object-fit: contain;">
                @endif
                <span>{{ setting('site_name', config('app.name', 'Toko Kelontong')) }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav align-items-center ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rentals.index') }}">Kontrakan</a>
                    </li>
                    @php
                        $socialLinks = [
                            'facebook' => ['url' => setting('facebook'), 'icon' => 'bi-facebook'],
                            'instagram' => ['url' => setting('instagram'), 'icon' => 'bi-instagram'],
                            'youtube' => ['url' => setting('youtube'), 'icon' => 'bi-youtube'],
                            'tiktok' => ['url' => setting('tiktok'), 'icon' => 'bi-tiktok'],
                        ];
                    @endphp
                    <li class="nav-item d-flex align-items-center ms-3">
                        <div class="d-flex nav-social gap-2">
                            @foreach ($socialLinks as $social => $data)
                                @if ($data['url'])
                                    <a href="{{ $data['url'] }}" target="_blank" rel="noopener"
                                        class="text-muted nav-link p-0">
                                        <i class="{{ $data['icon'] }} fs-5"></i>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </li>
                    @auth
                        @if (auth()->user()->role !== 'kasir')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">
                                <span class="d-flex align-items-center gap-2">
                                    @if (auth()->user()->avatar && ($avatar = image_url(auth()->user()->avatar)))
                                        <img src="{{ $avatar }}" alt="Avatar {{ auth()->user()->name }}"
                                            class="rounded-circle" style="width:32px; height:32px; object-fit:cover;">
                                    @else
                                        <i class="bi bi-person-circle fs-4"></i>
                                    @endif
                                    <span>{{ auth()->user()->name }}</span>
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil Saya</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="bg-light border-top mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-md-0 mb-3">
                    <h5 class="mb-3">{{ setting('site_name', config('app.name')) }}</h5>
                    <p class="text-muted">
                        {{ setting('footer_text', setting('site_description', 'Website modern dengan layanan lengkap untuk kebutuhan sehari-hari Anda.')) }}
                    </p>
                    <div class="d-flex mt-3 flex-wrap gap-2">
                        @foreach (['facebook' => 'bi-facebook', 'instagram' => 'bi-instagram', 'youtube' => 'bi-youtube', 'tiktok' => 'bi-tiktok'] as $key => $icon)
                            @if (setting($key))
                                <a href="{{ setting($key) }}" class="text-muted" target="_blank" rel="noopener">
                                    <i class="{{ $icon }} fs-5"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('landing') }}" class="text-muted text-decoration-none">Home</a></li>
                        <li><a href="{{ route('products.index') }}"
                                class="text-muted text-decoration-none">Produk</a>
                        </li>
                        <li><a href="{{ route('rentals.index') }}"
                                class="text-muted text-decoration-none">Kontrakan</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Hubungi Kami</h5>
                    <p class="text-muted mb-2">
                        <i class="bi bi-telephone"></i> {{ setting('phone', '0812-3456-7890') }}
                    </p>
                    <p class="text-muted mb-2">
                        <i class="bi bi-envelope"></i> {{ setting('email', 'info@example.com') }}
                    </p>
                    <p class="text-muted mb-2">
                        <i class="bi bi-geo-alt"></i> {{ setting('address', 'Alamat belum diatur') }}
                    </p>
                    <p class="text-muted mb-2">
                        <i class="bi bi-clock"></i> {{ setting('operational_hours', 'Senin - Jumat: 09:00 - 18:00') }}
                    </p>
                    <p class="text-muted">
                        <i class="bi bi-whatsapp"></i>
                        <a href="{{ whatsapp_link('Halo, saya ingin menghubungi layanan ' . setting('site_name', config('app.name'))) }}"
                            target="_blank" class="text-success text-decoration-none">
                            WhatsApp
                        </a>
                    </p>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-muted small text-center">
                <p>&copy; {{ date('Y') }} {{ setting('site_name', config('app.name')) }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @if (setting('whatsapp'))
        <a href="{{ whatsapp_link('Halo, saya ingin menghubungi layanan ' . setting('site_name', config('app.name'))) }}"
            class="whatsapp-float" target="_blank" rel="noopener">
            <i class="bi bi-whatsapp fs-5"></i>
            <span>Chat WhatsApp</span>
        </a>
    @endif
</body>
