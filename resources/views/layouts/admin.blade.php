<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Aorta Malang')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo%20AORTA%20(2).png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('img/Logo%20AORTA%20(2).png') }}" alt="AORTA Logo">
        </div>
        
        <div class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" style="text-decoration:none;">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.articles.index') }}" class="nav-item {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}" style="text-decoration:none;">
                <i class="fas fa-newspaper"></i>
                <span>Artikel</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" style="text-decoration:none;">
                <i class="fas fa-project-diagram"></i>
                <span>Proyek</span>
            </a>
            <a href="{{ route('admin.profile.index') }}" class="nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" style="text-decoration:none;">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
            <!-- Removed Pengurus, Mitra -->
        </div>
        
        <div class="user-section">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-details">
                    <h3>Admin AORTA</h3>
                    <p>Super Admin</p>
                </div>
            </div>
            <div class="user-actions">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout" style="background:none; border:none; color:inherit; cursor:pointer; width:100%; text-align:left; padding:10px;">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
