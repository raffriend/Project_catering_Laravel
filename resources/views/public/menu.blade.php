@extends('layouts.public')

@section('title', 'Katalog Menu')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Katalog Menu</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Menu</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<!-- Menu Section Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Daftar Hidangan</h5>
            <h1 class="mb-5">Koleksi Masakan CV. Kedai Agung</h1>
        </div>

        <!-- Filter & Search Bar -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <form action="{{ route('menu') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control form-control-lg border-primary" placeholder="Cari nama menu (contoh: Ayam Geprek, Sarden, Rendang)..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-search me-1"></i> Cari
                    </button>
                    @if(request()->has('search') || request()->has('category'))
                        <a href="{{ route('menu') }}" class="btn btn-outline-secondary px-3 d-flex align-items-center">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Category Pills / Tabs -->
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 {{ !request('category') ? 'active' : '' }}" href="{{ route('menu') }}">
                        <i class="fa fa-utensils fa-2x text-primary"></i>
                        <div class="ps-3">
                            <small class="text-body">Semua</small>
                            <h6 class="mt-n1 mb-0">Semua Menu</h6>
                        </div>
                    </a>
                </li>
                @foreach($categories as $cat)
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 pb-3 {{ request('category') == $cat->slug ? 'active' : '' }}" href="{{ route('menu', ['category' => $cat->slug]) }}">
                            <i class="fa fa-hamburger fa-2x text-primary"></i>
                            <div class="ps-3">
                                <small class="text-body">{{ $cat->menus->count() }} Pilihan</small>
                                <h6 class="mt-n1 mb-0">{{ $cat->name }}</h6>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

            <!-- Menu Grid -->
            <div class="row g-4 text-start">
                @forelse($menus as $menu)
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center bg-white p-3 rounded shadow-sm h-100 border">
                            <img class="flex-shrink-0 img-fluid rounded" src="{{ asset($menu->image ?? 'img/menu-1.jpg') }}" alt="{{ $menu->name }}" style="width: 90px; height: 90px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column text-start ps-4">
                                <h5 class="d-flex justify-content-between border-bottom pb-2">
                                    <span>{{ $menu->name }}</span>
                                    <span class="text-primary">{{ $menu->formatted_price }}</span>
                                </h5>
                                <small class="text-muted mb-2">{{ $menu->description ?? 'Olahan bumbu rempah autentik khas CV. Kedai Agung.' }}</small>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge bg-light text-dark border">{{ $menu->category->name }}</span>
                                        @if($menu->is_daily)
                                            <span class="badge bg-info text-dark">Menu Harian</span>
                                        @endif
                                        @if($menu->is_popular)
                                            <span class="badge bg-warning text-dark"><i class="fa fa-star me-1"></i>Favorit</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('order.form') }}" class="btn btn-sm btn-outline-primary py-1 px-3">
                                        Pesan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fa fa-search fa-3x text-muted mb-3"></i>
                        <h5>Menu tidak ditemukan</h5>
                        <p class="text-muted">Coba gunakan kata kunci pencarian yang lain.</p>
                        <a href="{{ route('menu') }}" class="btn btn-primary">Lihat Seluruh Menu</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $menus->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
<!-- Menu Section End -->

<!-- Daily Menu Highlight Section -->
@if($dailyMenus->count() > 0)
<div class="container-xxl py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 text-uppercase mb-2">Selalu Tersedia</span>
            <h2 class="fw-bold">Menu Ampera Harian</h2>
            <p class="text-muted">Menu siap saji yang selalu tersedia setiap hari mulai pukul 08.00 pagi</p>
        </div>
        <div class="row g-3">
            @foreach($dailyMenus as $daily)
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 border-0 shadow-sm rounded-3 text-center p-3">
                        <img src="{{ asset($daily->image ?? 'img/menu-1.jpg') }}" class="rounded mx-auto mb-3" style="width: 80px; height: 80px; object-fit: cover;" alt="{{ $daily->name }}">
                        <h6 class="fw-bold mb-1">{{ $daily->name }}</h6>
                        <strong class="text-primary mb-2 d-block">{{ $daily->formatted_price }}</strong>
                        <span class="badge bg-success bg-opacity-10 text-success small">Tersedia Setiap Hari</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection

