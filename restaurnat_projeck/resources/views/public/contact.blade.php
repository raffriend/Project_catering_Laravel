@extends('layouts.public')

@section('title', 'Kontak Kami')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Hubungi Kami</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Kontak</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Kontak & Lokasi</h5>
            <h1 class="mb-5">Informasi Layanan & Pengaduan</h1>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="row gy-4">
                    <div class="col-md-4">
                        <div class="p-4 bg-light rounded text-center h-100">
                            <i class="fa fa-phone-alt fa-2x text-primary mb-3"></i>
                            <h5 class="fw-bold">Pemesanan Katering</h5>
                            <p class="mb-0 text-muted">0812-3456-7890 (WhatsApp/Telp)</p>
                            <small class="text-muted">Fast response 07.30 - 20.00 WIB</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-light rounded text-center h-100">
                            <i class="fa fa-envelope-open fa-2x text-primary mb-3"></i>
                            <h5 class="fw-bold">Email Bisnis & Instansi</h5>
                            <p class="mb-0 text-muted">info@kedaiagung.com</p>
                            <small class="text-muted">Untuk penawaran kerja sama instansi</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-light rounded text-center h-100">
                            <i class="fa fa-map-marker-alt fa-2x text-primary mb-3"></i>
                            <h5 class="fw-bold">Alamat Rumah Makan</h5>
                            <p class="mb-0 text-muted">Jl. Raya Kedai Agung No. 45, Indonesia</p>
                            <small class="text-muted">Buka setiap hari mulai jam 08.00</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="rounded overflow-hidden shadow-sm h-100" style="min-height: 380px;">
                    <iframe class="w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127672.29828552187!2d100.354254!3d-0.94924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b942e2b117ab%3A0x3039d80b220cc50!2sPadang!5e0!3m2!1sen!2sid!4v1600000000000!5m2!1sen!2sid"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3 p-4">
                    <h5 class="fw-bold mb-3">Kirim Pesan / Pertanyaan</h5>
                    <form onsubmit="alert('Terima kasih! Pesan Anda telah kami terima dan akan segera kami tindak lanjuti.'); return false;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Nama Anda" required>
                                    <label for="name">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email Anda" required>
                                    <label for="email">Alamat Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subjek" required>
                                    <label for="subject">Subjek / Topik Pertanyaan</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Tulis pesan Anda..." id="message" style="height: 140px" required></textarea>
                                    <label for="message">Pesan Anda</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">
                                    <i class="fa fa-paper-plane me-2"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

