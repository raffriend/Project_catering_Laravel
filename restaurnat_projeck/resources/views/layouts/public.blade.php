<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Sistem Pengelolaan & Pemesanan') - CV. Kedai Agung</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="CV. Kedai Agung, Rumah Makan, Katering, Pemesanan Nasi Kotak" name="keywords">
    <meta content="Sistem Informasi Pengelolaan dan Pemesanan Rumah Makan CV. Kedai Agung" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <style>
        .badge-promo {
            background-color: #FEA116;
            color: #0F172B;
            font-weight: 700;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Memuat...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="{{ route('home') }}" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Kedai Agung</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                        <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
                        <a href="{{ route('menu') }}" class="nav-item nav-link {{ request()->routeIs('menu') ? 'active' : '' }}">Menu</a>
                        <a href="{{ route('catering') }}" class="nav-item nav-link {{ request()->routeIs('catering') ? 'active' : '' }}">Katering</a>
                        <a href="{{ route('promo') }}" class="nav-item nav-link {{ request()->routeIs('promo') ? 'active' : '' }}">Promo</a>
                        <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a>

                        @auth
                            {{-- Menu khusus pengguna yang login --}}
                            @if(Auth::user()->isCustomer())
                                <a href="{{ route('customer.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('customer.dashboard*') ? 'active' : '' }}">
                                    <i class="fa fa-user-circle me-1 text-primary"></i> Dashboard Saya
                                </a>
                                <a href="{{ route('order.tracking') }}" class="nav-item nav-link {{ request()->routeIs('order.tracking*') ? 'active' : '' }}">
                                    <i class="fa fa-search me-1"></i> Lacak Pesanan
                                </a>
                            @endif

                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle text-primary fw-bold" data-bs-toggle="dropdown">
                                    <i class="fa fa-user me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu m-0 shadow">
                                    @if(Auth::user()->isManager())
                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                            <i class="fa fa-tachometer-alt me-2 text-warning"></i> Halaman Manager
                                            <span class="badge {{ Auth::user()->isOwner() ? 'bg-warning text-dark' : 'bg-info text-dark' }} ms-1">
                                                {{ Auth::user()->isOwner() ? 'Pemilik' : 'Kasir' }}
                                            </span>
                                        </a>
                                        <a href="{{ route('admin.ampera.index') }}" class="dropdown-item">
                                            <i class="fa fa-cash-register me-2 text-success"></i> Kasir Ampera
                                        </a>
                                        <div class="dropdown-divider"></div>
                                    @else
                                        <a href="{{ route('customer.dashboard') }}" class="dropdown-item">
                                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Pesanan Saya
                                        </a>
                                        <a href="{{ route('customer.dashboard') }}#testimoni" class="dropdown-item">
                                            <i class="fa fa-star me-2 text-warning"></i> Testimoni Saya
                                        </a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fa fa-sign-out-alt me-2"></i>Keluar</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="nav-item nav-link {{ request()->routeIs('login') ? 'active' : '' }}"><i class="fa fa-sign-in-alt me-1"></i> Masuk</a>
                        @endauth
                    </div>
                    <a href="{{ route('order.form') }}" class="btn btn-primary py-2 px-4">Pesan Katering</a>
                </div>
            </nav>

            @yield('hero')
        </div>
        <!-- Navbar & Hero End -->

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="container mt-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <!-- Main Content Start -->
        @yield('content')
        <!-- Main Content End -->

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">CV. Kedai Agung</h4>
                        <a class="btn btn-link" href="{{ route('about') }}">Tentang Kami</a>
                        <a class="btn btn-link" href="{{ route('menu') }}">Katalog Menu</a>
                        <a class="btn btn-link" href="{{ route('catering') }}">Layanan Katering</a>
                        <a class="btn btn-link" href="{{ route('order.form') }}">Form Pemesanan</a>
                        <a class="btn btn-link" href="{{ route('order.tracking') }}">Lacak Status Pesanan</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Kontak Kami</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Raya Kedai Agung No. 45, Indonesia</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0812-3456-7890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@kedaiagung.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-whatsapp"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Jam Operasional</h4>
                        <h6 class="text-light fw-normal mb-1">Ampera & Rumah Makan:</h6>
                        <p class="mb-2">Mulai Pukul 08.00 WIB</p>
                        <h6 class="text-light fw-normal mb-1">Layanan Katering:</h6>
                        <p class="mb-2">Mulai Pukul 07.30 WIB</p>
                        <h6 class="text-light fw-normal mb-1">Menu Lengkap Siap:</h6>
                        <p class="mb-2">Mulai Pukul 10.30 WIB</p>
                        <h6 class="text-light fw-normal mb-1">Jam Ramai:</h6>
                        <p class="mb-0">Pukul 11.30 – 13.00 WIB</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Metode Pembayaran</h4>
                        <p>Kami menerima pembayaran manual melalui:</p>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-money-bill-wave text-primary me-2"></i> <strong>Cash / Tunai</strong></li>
                            <li><i class="fa fa-university text-primary me-2"></i> <strong>Transfer Bank (BCA, Mandiri, BRI)</strong></li>
                            <li><i class="fa fa-qrcode text-primary me-2"></i> <strong>QRIS (Semua E-Wallet)</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; {{ date('Y') }} <a class="border-bottom" href="{{ route('home') }}">CV. Kedai Agung</a>. Hak Cipta Dilindungi.
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="{{ route('home') }}">Beranda</a>
                                <a href="{{ route('about') }}">Tentang</a>
                                <a href="{{ route('contact') }}">Kontak</a>
                                <a href="{{ route('order.tracking') }}">Lacak Pesanan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>

