@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Tentang Kami</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<!-- Profil Usaha & Sejarah Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="{{ asset('img/about-1.jpg') }}" alt="Tentang Kedai Agung">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s" src="{{ asset('img/about-2.jpg') }}" style="margin-top: 25%;" alt="Dapur Masak">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s" src="{{ asset('img/about-3.jpg') }}" alt="Katering Pesta">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s" src="{{ asset('img/about-4.jpg') }}" alt="Penyajian Makanan">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Profil Usaha</h5>
                <h1 class="mb-4">CV. Kedai Agung</h1>
                <p class="mb-4">
                    <strong>CV. Kedai Agung</strong> adalah badan usaha kuliner dan jasa boga yang telah berkiprah melayani kebutuhan makan harian masyarakat dan pemesanan katering berskala kecil hingga besar. Dimulai dari warung makan sederhana berkonsep ampera padang dan masakan nusantara, kini CV. Kedai Agung telah berkembang menjadi penyedia katering terpercaya bagi berbagai instansi, perusahaan, sekolah, hingga acara keluarga.
                </p>
                <h5 class="fw-bold text-dark mb-2">Sejarah Singkat</h5>
                <p class="mb-4 text-muted">
                    Didirikan dengan semangat melestarikan cita rasa masakan nusantara yang kaya rempah, CV. Kedai Agung mengutamakan kebersihan bahan baku, kehalalan olahan, dan harga yang terjangkau bagi semua kalangan. Komitmen kami terhadap ketepatan waktu pengiriman katering dan konsistensi rasa telah mengantarkan kami dipercaya ratusan pelanggan tetap dan instansi.
                </p>
                <div class="row g-4 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">15</h1>
                            <div class="ps-4">
                                <p class="mb-0">Pilihan</p>
                                <h6 class="text-uppercase mb-0">Menu Lauk Harian</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">50</h1>
                            <div class="ps-4">
                                <p class="mb-0">Pelanggan</p>
                                <h6 class="text-uppercase mb-0">Instansi Tetap</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Profil Usaha & Sejarah End -->

<!-- Visi dan Misi Start -->
<div class="container-xxl py-5 bg-light">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Arah Usaha</h5>
            <h1 class="mb-5">Visi dan Misi CV. Kedai Agung</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4 p-md-5">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle p-3 bg-primary bg-opacity-10 text-primary me-3">
                            <i class="fa fa-eye fa-2x"></i>
                        </div>
                        <h3 class="fw-bold mb-0">Visi Kami</h3>
                    </div>
                    <p class="text-muted fs-5 leading-relaxed">
                        Menjadi badan usaha kuliner dan jasa boga terdepan di Indonesia yang dikenal akan kelezatan rasa autentik nusantara, higienitas prima, ketepatan waktu pelayanan, dan kepuasan pelanggan yang berkelanjutan.
                    </p>
                </div>
            </div>

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.4s">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4 p-md-5">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success me-3">
                            <i class="fa fa-bullseye fa-2x"></i>
                        </div>
                        <h3 class="fw-bold mb-0">Misi Kami</h3>
                    </div>
                    <ul class="list-unstyled text-muted mb-0">
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i> Menggunakan bahan baku segar berkualitas tinggi dengan jaminan halal 100%.</li>
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i> Menjaga standar kebersihan dan higienitas proses memasak dan pengemasan.</li>
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i> Memberikan layanan pemesanan katering yang praktis, cepat, dan transparan melalui sistem website.</li>
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i> Menghadirkan paket katering fleksibel dan kompetitif yang ramah anggaran.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Visi dan Misi End -->

<!-- Master Chefs / Tim Start -->
<div class="container-xxl pt-5 pb-3">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Keahlian Masak</h5>
            <h1 class="mb-5">Tim Dapur & Koki Kami</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item text-center rounded overflow-hidden shadow-sm bg-white pb-4">
                    <div class="rounded-circle overflow-hidden m-4 mx-auto" style="width: 150px; height: 150px;">
                        <img class="img-fluid" src="{{ asset('img/team-1.jpg') }}" alt="Kepala Koki">
                    </div>
                    <h5 class="mb-1">Agung Prasetyo</h5>
                    <small class="text-muted">Pendiri & Kepala Koki</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item text-center rounded overflow-hidden shadow-sm bg-white pb-4">
                    <div class="rounded-circle overflow-hidden m-4 mx-auto" style="width: 150px; height: 150px;">
                        <img class="img-fluid" src="{{ asset('img/team-2.jpg') }}" alt="Koki Olahan Daging">
                    </div>
                    <h5 class="mb-1">Siti Rahma</h5>
                    <small class="text-muted">Spesialis Masakan Rendang & Lauk</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item text-center rounded overflow-hidden shadow-sm bg-white pb-4">
                    <div class="rounded-circle overflow-hidden m-4 mx-auto" style="width: 150px; height: 150px;">
                        <img class="img-fluid" src="{{ asset('img/team-3.jpg') }}" alt="Koki Sarapan & Sup">
                    </div>
                    <h5 class="mb-1">Hendra Wijaya</h5>
                    <small class="text-muted">Spesialis Sarapan & Masakan Basah</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item text-center rounded overflow-hidden shadow-sm bg-white pb-4">
                    <div class="rounded-circle overflow-hidden m-4 mx-auto" style="width: 150px; height: 150px;">
                        <img class="img-fluid" src="{{ asset('img/team-4.jpg') }}" alt="Koordinator Katering">
                    </div>
                    <h5 class="mb-1">Dewi Lestari</h5>
                    <small class="text-muted">Koordinator Katering & Pengiriman</small>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Master Chefs End -->

<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Ulasan Pelanggan</h5>
            <h1 class="mb-5">Kepercayaan Pelanggan Kami</h1>
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
                <div class="text-center py-4 text-muted">Belum ada ulasan pelanggan.</div>
            @endforelse
        </div>
    </div>
</div>
<!-- Testimonial End -->
@endsection

