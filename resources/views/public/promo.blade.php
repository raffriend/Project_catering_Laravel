@extends('layouts.public')

@section('title', 'Promo & Bonus')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Promo & Bonus</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Promo</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Keuntungan Pelanggan</h5>
            <h1 class="mb-5">Promo & Program Bonus Spesial</h1>
        </div>

        <div class="row g-4">
            @forelse($promos as $promo)
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-3 p-4 h-100 position-relative border-start border-5 border-warning">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge bg-danger mb-2">{{ strtoupper($promo->promo_type) }}</span>
                                <h4 class="fw-bold mb-1">{{ $promo->title }}</h4>
                                <span class="badge bg-light text-dark border">Kode: <strong>{{ $promo->code ?? '-' }}</strong></span>
                            </div>
                            <div class="rounded-circle p-3 bg-warning bg-opacity-10 text-warning">
                                <i class="fa fa-gift fa-2x"></i>
                            </div>
                        </div>

                        <p class="text-muted mb-4">{{ $promo->description }}</p>

                        <div class="bg-light p-3 rounded mb-4">
                            <h6 class="fw-bold mb-2">Syarat & Ketentuan:</h6>
                            <ul class="list-unstyled text-muted small mb-0">
                                @if($promo->min_order_qty > 0)
                                    <li class="mb-1"><i class="fa fa-check-circle text-success me-2"></i> Minimal pesanan: <strong>{{ $promo->min_order_qty }} Box / Porsi</strong></li>
                                @endif
                                @if($promo->min_order_amount > 0)
                                    <li class="mb-1"><i class="fa fa-check-circle text-success me-2"></i> Minimal total belanja: <strong>Rp {{ number_format($promo->min_order_amount, 0, ',', '.') }}</strong></li>
                                @endif
                                @if($promo->bonus_description)
                                    <li class="mb-1"><i class="fa fa-gift text-primary me-2"></i> <strong>Bonus Otomatis:</strong> {{ $promo->bonus_description }}</li>
                                @endif
                                @if($promo->discount_percent)
                                    <li class="mb-1"><i class="fa fa-percentage text-danger me-2"></i> Diskon: <strong>{{ $promo->discount_percent }}%</strong></li>
                                @endif
                                <li><i class="fa fa-calendar-alt text-secondary me-2"></i> Berlaku hingga: <strong>{{ $promo->end_date->format('d F Y') }}</strong></li>
                            </ul>
                        </div>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            @if($promo->isCurrentlyValid())
                                <span class="badge bg-success py-2 px-3"><i class="fa fa-check me-1"></i> Sedang Aktif</span>
                            @else
                                <span class="badge bg-secondary py-2 px-3">Sudah Berakhir</span>
                            @endif
                            <a href="{{ route('order.form') }}" class="btn btn-primary">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fa fa-tag fa-3x mb-3 text-secondary opacity-50"></i>
                    <p>Saat ini belum ada promo aktif. Pantau terus halaman ini!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

