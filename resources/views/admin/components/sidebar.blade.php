<aside class="admin-sidebar">
    <div class="brand">
        <span>📦</span>
        <h5>{{ config('app.name') }}</h5>
    </div>

    <nav class="nav flex-column">
        <div class="nav-label">Menu</div>

        <a class="nav-link @if (Route::is('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
            <span>📊</span>
            <span>Dashboard</span>
        </a>

        @if (auth()->user()->role !== 'kasir')
            <div class="nav-label" style="margin-top: 1.5rem;">Manajemen Toko</div>

            <a class="nav-link @if (Route::is('admin.categories.*')) active @endif"
                href="{{ route('admin.categories.index') }}">
                <span>🏷️</span>
                <span>Kategori</span>
            </a>

            <a class="nav-link @if (Route::is('admin.products.*')) active @endif"
                href="{{ route('admin.products.index') }}">
                <span>📦</span>
                <span>Produk</span>
            </a>

            <a class="nav-link @if (Route::is('admin.banners.*')) active @endif"
                href="{{ route('admin.banners.index') }}">
                <span>🎨</span>
                <span>Banner</span>
            </a>

            <a class="nav-link @if (Route::is('admin.services.*')) active @endif"
                href="{{ route('admin.services.index') }}">
                <span>⚙️</span>
                <span>Layanan</span>
            </a>
        @endif

        @if (auth()->user()->role === 'super_admin' || auth()->user()->role === 'admin_kontrakan')
            <div class="nav-label" style="margin-top: 1.5rem;">Manajemen Kontrakan</div>

            <a class="nav-link @if (Route::is('admin.rentals.*')) active @endif"
                href="{{ route('admin.rentals.index') }}">
                <span>🏠</span>
                <span>Kontrakan</span>
            </a>
        @endif

        @if (auth()->user()->role === 'super_admin')
            <div class="nav-label" style="margin-top: 1.5rem;">Pengaturan</div>

            <a class="nav-link @if (Route::is('admin.settings.*')) active @endif"
                href="{{ route('admin.settings.index') }}">
                <span>⚡</span>
                <span>Pengaturan</span>
            </a>
        @endif
    </nav>
</aside>
