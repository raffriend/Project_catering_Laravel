<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin Dashboard') - CV. Kedai Agung</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary: #FEA116;
            --dark: #0F172B;
            --sidebar-bg: #0F172B;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9;
        }

        .admin-sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        .admin-sidebar .brand {
            padding: 20px;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-decoration: none;
            display: block;
        }

        .admin-sidebar .nav-link {
            color: #cbd5e1;
            padding: 12px 20px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            border-left: 4px solid transparent;
            transition: all 0.2s;
        }

        .admin-sidebar .nav-link i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 12px;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(254, 161, 22, 0.15);
            border-left-color: var(--primary);
        }

        .admin-content {
            margin-left: 260px;
            padding: 24px;
            min-height: 100vh;
        }

        .admin-header {
            background-color: #fff;
            border-radius: 12px;
            padding: 16px 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.82rem;
            font-weight: 600;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                margin-left: -260px;
            }
            .admin-sidebar.show {
                margin-left: 0;
            }
            .admin-content {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Sidebar Start -->
    <aside class="admin-sidebar" id="adminSidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <i class="fa fa-utensils text-primary me-2"></i> Kedai Agung
        </a>
        <div class="py-3">
            <small class="text-uppercase text-muted px-4 fw-bold" style="font-size: 0.75rem;">Menu Utama</small>
            <nav class="nav flex-column mt-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('admin.ampera.index') }}" class="nav-link {{ request()->routeIs('admin.ampera*') ? 'active' : '' }}">
                    <i class="fa fa-cash-register text-success"></i> Kasir Ampera
                </a>
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                    <i class="fa fa-tags"></i> Kategori Menu
                </a>
                <a href="{{ route('admin.menus.index') }}" class="nav-link {{ request()->routeIs('admin.menus*') ? 'active' : '' }}">
                    <i class="fa fa-hamburger"></i> Kelola Menu
                </a>
                <a href="{{ route('admin.daily-menus.index') }}" class="nav-link {{ request()->routeIs('admin.daily-menus*') ? 'active' : '' }}">
                    <i class="fa fa-calendar-day"></i> Menu Harian
                </a>
                <a href="{{ route('admin.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages*') ? 'active' : '' }}">
                    <i class="fa fa-box-open"></i> Paket Katering
                </a>
            </nav>

            <small class="text-uppercase text-muted px-4 fw-bold mt-4 d-block" style="font-size: 0.75rem;">Transaksi</small>
            <nav class="nav flex-column mt-2">
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                    <i class="fa fa-shopping-bag"></i> Pesanan (Katering & Ampera)
                </a>
                <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments*') ? 'active' : '' }}">
                    <i class="fa fa-money-check-alt"></i> Pembayaran
                </a>
                <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers*') ? 'active' : '' }}">
                    <i class="fa fa-users"></i> Pelanggan
                </a>
                <a href="{{ route('admin.promotions.index') }}" class="nav-link {{ request()->routeIs('admin.promotions*') ? 'active' : '' }}">
                    <i class="fa fa-gift"></i> Promo & Bonus
                </a>
            </nav>

            <small class="text-uppercase text-muted px-4 fw-bold mt-4 d-block" style="font-size: 0.75rem;">Laporan & Sistem</small>
            <nav class="nav flex-column mt-2">
                @if(Auth::user()->isOwner())
                    <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                        <i class="fa fa-chart-line text-warning"></i> Laporan Total Penjualan
                    </a>
                @endif
                <div class="dropdown-divider my-3 border-secondary"></div>
                <a href="{{ route('home') }}" class="nav-link" target="_blank">
                    <i class="fa fa-globe"></i> Lihat Web Publik
                </a>
                <form action="{{ route('logout') }}" method="POST" class="px-3 mt-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 btn-sm">
                        <i class="fa fa-sign-out-alt me-1"></i> Keluar
                    </button>
                </form>
            </nav>
        </div>
    </aside>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <main class="admin-content">
        <!-- Header Start -->
        <header class="admin-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary d-lg-none me-3" id="sidebarToggle">
                    <i class="fa fa-bars"></i>
                </button>
                <h4 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h4>
            </div>
            <div class="d-flex align-items-center">
                @if(Auth::user()->isOwner())
                    <span class="badge bg-warning text-dark me-3 px-3 py-2">
                        <i class="fa fa-crown me-1"></i> Pemilik
                    </span>
                @else
                    <span class="badge bg-info text-dark me-3 px-3 py-2">
                        <i class="fa fa-cash-register me-1"></i> Kasir
                    </span>
                @endif
                <span class="fw-semibold text-secondary">
                    <i class="fa fa-user-circle me-1"></i> {{ Auth::user()->name }}
                </span>
            </div>
        </header>
        <!-- Header End -->

        <!-- Flash Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fa fa-exclamation-circle me-2"></i> Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Main Body -->
        @yield('content')
    </main>
    <!-- Content End -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.toggle('show');
        });
    </script>
    @stack('scripts')
</body>

</html>

