@extends('layouts.public')

@section('title', 'Layanan Katering')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Layanan Katering</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Katering</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<!-- Layanan Overview Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Jasa Boga & Katering</h5>
            <h1 class="mb-5">Layanan Katering CV. Kedai Agung</h1>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded pt-3 h-100">
                    <div class="p-4 text-center">
                        <i class="fa fa-3x fa-box text-primary mb-4"></i>
                        <h5>Katering Nasi Kotak</h5>
                        <p class="text-muted">Kemasan kotak bersih, higienis, rapi, lengkap dengan sendok, tisu, buah, dan air mineral. Sangat cocok untuk rapat kantor, seminar, workshop, pengajian, dan syukuran.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded pt-3 h-100">
                    <div class="p-4 text-center">
                        <i class="fa fa-3x fa-calendar-alt text-primary mb-4"></i>
                        <h5>Katering Langganan Harian</h5>
                        <p class="text-muted">Layanan makan siang rutin untuk kantor, pabrik, sekolah, dan instansi. Menu bervariasi setiap hari agar karyawan tidak bosan, diantar tepat waktu sebelum jam istirahat siang.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded pt-3 h-100">
                    <div class="p-4 text-center">
                        <i class="fa fa-3x fa-concierge-bell text-primary mb-4"></i>
                        <h5>Prasmanan Acara Besar</h5>
                        <p class="text-muted">Layanan prasmanan komplit dengan perlengkapan pemanas (chafing dish), piring, staf pelayan, dan aneka stall makanan penutup untuk pernikahan, khitanan, dan gathering akbar.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promo Banner -->
        <div class="bg-primary bg-opacity-10 rounded-3 p-4 p-md-5 mb-5 border border-warning text-center">
            <span class="badge bg-danger fs-6 px-3 py-2 mb-3">PROMO SPESIAL KATERING</span>
            <h2 class="fw-bold mb-3"><i class="fa fa-gift text-warning me-2"></i>Pesan 50 Box Gratis 1 Loyang Bolu Spesial!</h2>
            <p class="text-muted fs-5 mb-4 max-w-700 mx-auto">
                Setiap pemesanan katering dengan jumlah minimal 50 porsi/box akan langsung mendapatkan <strong>bonus gratis 1 loyang bolu panggang empuk</strong> khas CV. Kedai Agung secara otomatis di sistem!
            </p>
            <a href="{{ route('order.form') }}" class="btn btn-primary py-3 px-5 fs-5">
                <i class="fa fa-paper-plane me-2"></i>Pesan Sekarang & Dapatkan Bonus
            </a>
        </div>

        <!-- Paket Katering Grid -->
        <div class="text-center mb-5">
            <h3 class="fw-bold">Pilihan Paket Katering Terlaris</h3>
            <p class="text-muted">Pilih paket yang paling sesuai dengan kebutuhan acara Anda</p>
        </div>

        <div class="row g-4">
            @foreach($packages as $pkg)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow rounded-3 overflow-hidden">
                        <img src="{{ asset($pkg->image ?? 'img/menu-3.jpg') }}" class="card-img-top" alt="{{ $pkg->name }}" style="height: 240px; object-fit: cover;">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-secondary">Min. {{ $pkg->min_order }} Porsi</span>
                                <h4 class="text-primary fw-bold mb-0">{{ $pkg->formatted_price }} <small class="text-muted fs-6">/porsi</small></h4>
                            </div>
                            <h4 class="card-title fw-bold my-2">{{ $pkg->name }}</h4>
                            <p class="card-text text-muted small mb-3">{{ $pkg->description }}</p>
                            
                            <div class="bg-light p-3 rounded mb-4 flex-grow-1">
                                <small class="fw-bold d-block mb-2 text-dark border-bottom pb-1">Daftar Menu Paket:</small>
                                <pre class="text-dark small mb-0" style="font-family: inherit; white-space: pre-line; line-height: 1.6;">{{ $pkg->includes }}</pre>
                            </div>

                            <a href="{{ route('order.form', ['package_id' => $pkg->id]) }}" class="btn btn-primary w-100 py-3">
                                <i class="fa fa-shopping-cart me-2"></i> Pilih Paket Ini
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Layanan Overview End -->
@endsection

