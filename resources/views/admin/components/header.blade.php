<header class="admin-header">
    <div>
        <button class="btn btn-sm btn-light toggle-sidebar-btn" style="display: none;">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <div class="user-menu">
        <div class="user-info">
            <span>{{ auth()->user()->name }}</span>
            <small class="text-muted"
                style="display: block;">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</small>
        </div>

        <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                👤
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                <li><a class="dropdown-item" href="/admin/settings">Pengaturan</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</header>
