@extends('layouts.public')

@section('title', 'Beranda')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <span class="badge bg-warning text-dark px-3 py-2 mb-3 fw-bold text-uppercase">CV. Kedai Agung</span>
                <h1 class="display-3 text-white animated slideInLeft">Cita Rasa Istimewa<br>& Katering Terpercaya</h1>
                <p class="text-white animated slideInLeft mb-4 pb-2">
                    Menyajikan aneka masakan nusantara autentik, sarapan pagi segar, masakan basah gurih, dan layanan katering profesional untuk acara kantor, pesta, hingga langganan harian.
                </p>
                <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-lg-start">
                    <a href="{{ route('order.form') }}" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">
                        <i class="fa fa-shopping-cart me-2"></i>Pesan Katering
                    </a>
                    <a href="{{ route('menu') }}" class="btn btn-outline-light py-sm-3 px-sm-5 animated slideInLeft">
                        <i class="fa fa-utensils me-2"></i>Lihat Menu
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="{{ asset('img/hero.png') }}" alt="Hidangan Lezat CV. Kedai Agung">
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Highlight Info & Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded pt-3">
                    <div class="p-4 text-center">
                        <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                        <h5>Masakan Autentik</h5>
                        <p class="text-muted small">Bumbu rempah pilihan tradisional dengan resep turun-temurun khas nusantara.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded pt-3">
                    <div class="p-4 text-center">
                        <i class="fa fa-3x fa-box-open text-primary mb-4"></i>
                        <h5>Katering Acara & Harian</h5>
                        <p class="text-muted small">Melayani nasi kotak, prasmanan acara besar, hingga rantangan langganan kantor.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded pt-3">
                    <div class="p-4 text-center">
                        <i class="fa fa-3x fa-truck text-primary mb-4"></i>
                        <h5>Tepat Waktu</h5>
                        <p class="text-muted small">Pengiriman cepat, hangat, dan higienis siap santap langsung ke lokasi Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item rounded pt-3">
                    <div class="p-4 text-center">
                        <i class="fa fa-3x fa-gift text-primary mb-4"></i>
                        <h5>Promo & Bonus Menarik</h5>
                        <p class="text-muted small">Pesan mulai 50 box langsung dapat bonus gratis 1 loyang bolu spesial!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Highlight Info End -->

<!-- About Preview Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="{{ asset('img/about-1.jpg') }}" alt="Tentang Kedai Agung">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s" src="{{ asset('img/about-2.jpg') }}" style="margin-top: 25%;" alt="Dapur Bersih">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s" src="{{ asset('img/about-3.jpg') }}" alt="Penyajian">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s" src="{{ asset('img/about-4.jpg') }}" alt="Katering">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Tentang Kami</h5>
                <h1 class="mb-4">Selamat Datang di <i class="fa fa-utensils text-primary me-2"></i>CV. Kedai Agung</h1>
                <p class="mb-4">
                    CV. Kedai Agung adalah badan usaha kuliner yang bergerak di bidang pengelolaan rumah makan dan jasa boga katering terpercaya. Kami berdedikasi menyajikan makanan lezat, bergizi, halal, dan higienis untuk masyarakat luas serta berbagai instansi swasta dan pemerintah.
                </p>
                <p class="mb-4">
                    Mulai dari sarapan pagi bergizi, masakan basah berkuah kaldu gurih, aneka lauk pauk padang & nusantara, hingga paket katering nasi kotak untuk rapat, seminar, dan pesta pernikahan.
                </p>
                <div class="row g-4 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">10</h1>
                            <div class="ps-4">
                                <p class="mb-0">Tahun Lebih</p>
                                <h6 class="text-uppercase mb-0">Pengalaman Kuliner</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">100</h1>
                            <div class="ps-4">
                                <p class="mb-0">Ribu+</p>
                                <h6 class="text-uppercase mb-0">Porsi Katering Terkirim</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="{{ route('about') }}">Selengkapnya</a>
            </div>
        </div>
    </div>
</div>
<!-- About Preview End -->

<!-- Active Promos Banner Start -->
@if($activePromos->count() > 0)
<div class="container-xxl py-4">
    <div class="container">
        <div class="bg-primary bg-opacity-10 rounded-3 p-4 border border-warning">
            <div class="row align-items-center g-3">
                <div class="col-md-8">
                    <span class="badge bg-danger mb-2">PROMO SPESIAL BERJALAN</span>
                    @foreach($activePromos as $promo)
                        <h4 class="fw-bold mb-1"><i class="fa fa-gift text-warning me-2"></i>{{ $promo->title }}</h4>
                        <p class="text-muted mb-2">{{ $promo->description }}</p>
                    @endforeach
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('order.form') }}" class="btn btn-primary py-2 px-4">
                        <i class="fa fa-shopping-bag me-1"></i> Klaim Promo Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Active Promos Banner End -->

<!-- Popular Menus Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Menu Pilihan</h5>
            <h1 class="mb-5">Menu Terfavorit & Paling Laris</h1>
        </div>
        <div class="row g-4">
            @foreach($popularMenus as $item)
                <div class="col-lg-6">
                    <div class="d-flex align-items-center bg-white p-3 rounded shadow-sm">
                        <img class="flex-shrink-0 img-fluid rounded" src="{{ asset($item->image ?? 'img/menu-1.jpg') }}" alt="{{ $item->name }}" style="width: 85px; height: 85px; object-fit: cover;">
                        <div class="w-100 d-flex flex-column text-start ps-4">
                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                <span>{{ $item->name }}</span>
                                <span class="text-primary">{{ $item->formatted_price }}</span>
                            </h5>
                            <small class="text-muted">{{ $item->description ?? 'Olahan khas bumbu rempah nusantara lezat dan mantap.' }}</small>
                            <div class="mt-2">
                                <span class="badge bg-light text-dark border">{{ $item->category->name ?? 'Menu' }}</span>
                                @if($item->is_popular)
                                    <span class="badge bg-warning text-dark"><i class="fa fa-star me-1"></i>Favorit</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('menu') }}" class="btn btn-outline-primary py-3 px-5">
                <i class="fa fa-book-open me-2"></i>Lihat Seluruh Menu Lengkap
            </a>
        </div>
    </div>
</div>
<!-- Popular Menus End -->

<!-- Catering Packages Highlight Start -->
<div class="container-xxl py-5 bg-light">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Layanan Jasa Boga</h5>
            <h1 class="mb-5">Pilihan Paket Katering</h1>
        </div>
        <div class="row g-4">
            @foreach($cateringPackages as $pkg)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                        <img src="{{ asset($pkg->image ?? 'img/menu-3.jpg') }}" class="card-img-top" alt="{{ $pkg->name }}" style="height: 220px; object-fit: cover;">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary">Min. {{ $pkg->min_order }} Porsi</span>
                                <h4 class="text-primary fw-bold mb-0">{{ $pkg->formatted_price }} <small class="text-muted fs-6">/pax</small></h4>
                            </div>
                            <h5 class="card-title fw-bold">{{ $pkg->name }}</h5>
                            <p class="card-text text-muted small mb-3">{{ $pkg->description }}</p>
                            
                            <div class="bg-light p-3 rounded mb-4 flex-grow-1">
                                <small class="fw-bold d-block mb-1 text-dark">Menu Termasuk:</small>
                                <pre class="text-muted small mb-0" style="font-family: inherit; white-space: pre-line;">{{ $pkg->includes }}</pre>
                            </div>

                            <a href="{{ route('order.form', ['package_id' => $pkg->id]) }}" class="btn btn-primary w-100 py-2">
                                <i class="fa fa-shopping-cart me-1"></i> Pesan Paket Ini
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Catering Packages Highlight End -->

<!-- Jam Operasional & Pembayaran Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="p-4 p-md-5 bg-dark text-white rounded-3 shadow">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Waktu Layanan</h5>
                    <h2 class="text-white mb-4">Jam Operasional CV. Kedai Agung</h2>
                    <ul class="list-group list-group-flush bg-transparent">
                        <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0 py-3">
                            <div>
                                <strong class="d-block text-warning"><i class="fa fa-coffee me-2"></i>Ampera & Sarapan Pagi</strong>
                                <small class="text-muted">Lontong sayur, nasi gurih, aneka lauk pagi</small>
                            </div>
                            <span class="badge bg-primary fs-6">08.00 WIB</span>
                        </li>
                        <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0 py-3">
                            <div>
                                <strong class="d-block text-warning"><i class="fa fa-truck me-2"></i>Layanan Katering Mulai Kirim</strong>
                                <small class="text-muted">Pengiriman awal untuk kantor dan instansi</small>
                            </div>
                            <span class="badge bg-info text-dark fs-6">07.30 WIB</span>
                        </li>
                        <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0 py-3">
                            <div>
                                <strong class="d-block text-warning"><i class="fa fa-utensils me-2"></i>Menu Masakan Lengkap Siap</strong>
                                <small class="text-muted">Seluruh masakan basah, sayur, sop, rendang siap santap</small>
                            </div>
                            <span class="badge bg-success fs-6">10.30 WIB</span>
                        </li>
                        <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0 py-3">
                            <div>
                                <strong class="d-block text-warning"><i class="fa fa-users me-2"></i>Jam Ramai Makan Siang</strong>
                                <small class="text-muted">Puncak pengunjung makan di tempat</small>
                            </div>
                            <span class="badge bg-danger fs-6">11.30 – 13.00 WIB</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Metode Pembayaran</h5>
                <h2 class="mb-4">Kemudahan Transaksi & Pembayaran</h2>
                <p class="text-muted mb-4">
                    Untuk memudahkan seluruh pelanggan kami, CV. Kedai Agung menyediakan opsi pembayaran fleksibel baik secara tunai maupun nontunai:
                </p>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center bg-white border p-3 rounded-3 shadow-sm">
                            <i class="fa fa-2x fa-money-bill-wave text-primary me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Cash / Tunai</h6>
                                <small class="text-muted">Pembayaran langsung di kasir rumah makan atau saat pesanan katering diterima (COD terkonfirmasi).</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center bg-white border p-3 rounded-3 shadow-sm">
                            <i class="fa fa-2x fa-university text-primary me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Transfer Bank Manual (BCA, Mandiri, BRI)</h6>
                                <small class="text-muted">Transfer ke rekening resmi CV. Kedai Agung. Upload bukti transfer untuk verifikasi otomatis oleh admin.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center bg-white border p-3 rounded-3 shadow-sm">
                            <i class="fa fa-2x fa-qrcode text-primary me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">QRIS (Semua E-Wallet & Mobile Banking)</h6>
                                <small class="text-muted">Scan kode QRIS yang tersedia pada invoice pesanan Anda melalui GoPay, OVO, Dana, ShopeePay, atau BCA Mobile.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jam Operasional & Pembayaran End -->

<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Testimoni Pelanggan</h5>
            <h1 class="mb-5">Apa Kata Pelanggan Kami?</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
            @forelse($testimonials as $testi)
                <div class="testimonial-item bg-transparent border rounded p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <i class="fa fa-quote-left fa-2x text-primary"></i>
                            <div>{!! $testi->stars_html !!}</div>
                        </div>
                        <p class="mb-4 fst-italic">"{{ $testi->comment }}"</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset($testi->photo ?? 'img/testimonial-1.jpg') }}" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $testi->customer_name }}">
                        <div class="ps-3">
                            <h5 class="mb-1">{{ $testi->customer_name }}</h5>
                            <small class="text-muted">{{ $testi->customer_title ?? 'Pelanggan CV. Kedai Agung' }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-muted">Belum ada testimoni.</div>
            @endforelse
        </div>
        @auth
            @if(Auth::user()->isCustomer())
                <div class="text-center mt-4">
                    <a href="{{ route('customer.dashboard') }}#testimoni" class="btn btn-outline-primary py-2 px-4">
                        <i class="fa fa-pen me-2"></i>Tulis Testimoni Pengalaman Anda
                    </a>
                </div>
            @endif
        @endauth
    </div>
</div>
<!-- Testimonial End -->
@endsection

