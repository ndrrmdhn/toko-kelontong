<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Toko Kelontong'))</title>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #28a745;
            --secondary-color: #ff9800;
            --light-bg: #f8f9fa;
            --border-color: #e9ecef;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
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
            background-color: #218838;
        }

        .btn-warning {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                {{ config('app.name', 'Toko Kelontong') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rentals.index') }}">Kontrakan</a>
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
                                {{ auth()->user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
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
                    <h5 class="mb-3">{{ config('app.name') }}</h5>
                    <p class="text-muted">
                        Toko kelontong modern dengan layanan lengkap untuk kebutuhan sehari-hari.
                    </p>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('landing') }}" class="text-muted text-decoration-none">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-muted text-decoration-none">Produk</a>
                        </li>
                        <li><a href="{{ route('rentals.index') }}"
                                class="text-muted text-decoration-none">Kontrakan</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Hubungi Kami</h5>
                    <p class="text-muted mb-2">
                        <i class="bi bi-telephone"></i> {{ config('settings.phone', '0812-3456-7890') }}
                    </p>
                    <p class="text-muted">
                        <i class="bi bi-whatsapp"></i>
                        <a href="https://wa.me/{{ config('settings.whatsapp', '') }}" target="_blank"
                            class="text-decoration-none">
                            WhatsApp
                        </a>
                    </p>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-muted small text-center">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>