<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title') - Admin | {{ config('app.name') }}</title>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #28a745;
            --secondary-color: #ff9800;
            --danger-color: #dc3545;
            --light-bg: #f8f9fa;
            --border-color: #e9ecef;
            --sidebar-width: 250px;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--light-bg);
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid var(--border-color);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1020;
        }

        .admin-sidebar .brand {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .admin-sidebar .brand h5 {
            margin: 0;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .admin-sidebar .nav {
            padding: 1rem 0;
        }

        .admin-sidebar .nav-item {
            margin: 0;
        }

        .admin-sidebar .nav-link {
            padding: 0.75rem 1.5rem;
            color: #666;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-sidebar .nav-link:hover {
            background-color: var(--light-bg);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .admin-sidebar .nav-link.active {
            color: var(--primary-color);
            background-color: var(--light-bg);
            border-left-color: var(--primary-color);
            font-weight: 600;
        }

        .admin-sidebar .nav-label {
            padding: 0.75rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #999;
            font-weight: 600;
            margin-top: 1rem;
        }

        /* Main Content */
        .admin-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .admin-header .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-header .user-menu .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .admin-header .user-menu .user-info span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .admin-main {
            flex: 1;
            padding: 2rem 1.5rem;
            overflow-y: auto;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 0;
                transition: width 0.3s ease;
            }

            .admin-sidebar.show {
                width: var(--sidebar-width);
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }

            .admin-content {
                margin-left: 0;
            }

            .admin-header {
                justify-content: space-between;
            }

            .admin-main {
                padding: 1rem;
            }

            .toggle-sidebar-btn {
                display: block;
            }
        }

        @media (min-width: 769px) {
            .toggle-sidebar-btn {
                display: none;
            }
        }

        /* Cards */
        .stat-card {
            background: white;
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .stat-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Forms */
        .form-control,
        .form-select {
            border-color: var(--border-color);
            padding: 0.625rem 0.875rem;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.1);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #218838;
        }

        /* Tables */
        .table {
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color: var(--light-bg);
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: var(--border-color);
        }

        .table tbody tr:hover {
            background-color: var(--light-bg);
        }

        /* Breadcrumb */
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .breadcrumb-item.active {
            color: #666;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="admin-wrapper">
        @include('admin.components.sidebar')

        <div class="admin-content">
            @include('admin.components.header')

            <main class="admin-main">
                @include('admin.components.breadcrumb')
                @include('admin.components.alerts')

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.querySelector('.toggle-sidebar-btn');
            const sidebar = document.querySelector('.admin-sidebar');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }

            // Close sidebar on mobile when clicking a link
            const navLinks = document.querySelectorAll('.admin-sidebar .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('show');
                    }
                });
            });
        });
    </script>
</body>

</html>
