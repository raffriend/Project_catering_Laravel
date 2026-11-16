@extends('layouts.admin')

@section('title', 'Promo & Bonus')
@section('page_title', 'Kelola Promo & Bonus')

@section('content')
<div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1">Daftar Program Promo & Bonus</h5>
            <small class="text-muted">Kelola promo bonus otomatis (contoh: bonus 1 loyang bolu), diskon, dan masa berlaku promo</small>
        </div>
        <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle me-1"></i> Buat Promo Baru
        </a>
    </div>
</div>

<div class="row g-4">
    @forelse($promotions as $promo)
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm rounded-3 p-4 border-start border-5 border-warning">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <span class="badge bg-danger text-uppercase mb-1">{{ $promo->promo_type }}</span>
                        <h5 class="fw-bold mb-1">{{ $promo->title }}</h5>
                        <span class="badge bg-light text-dark border">Kode: <strong>{{ $promo->code ?? '-' }}</strong></span>
                    </div>
                    <div class="rounded-circle p-2 bg-warning bg-opacity-10 text-warning">
                        <i class="fa fa-gift fa-2x"></i>
                    </div>
                </div>

                <p class="text-muted small mb-3">{{ $promo->description }}</p>

                <div class="bg-light p-3 rounded mb-3 small">
                    @if($promo->min_order_qty > 0)
                        <div><i class="fa fa-check text-success me-1"></i> Min. Pesan: <strong>{{ $promo->min_order_qty }} Box</strong></div>
                    @endif
                    @if($promo->bonus_description)
                        <div><i class="fa fa-gift text-primary me-1"></i> Hadiah Bonus: <strong>{{ $promo->bonus_description }}</strong></div>
                    @endif
                    @if($promo->discount_percent)
                        <div><i class="fa fa-percent text-danger me-1"></i> Diskon: <strong>{{ $promo->discount_percent }}%</strong></div>
                    @endif
                    <div class="mt-1 text-muted"><i class="fa fa-calendar-alt me-1"></i> Periode: {{ $promo->start_date->format('d/m/Y') }} s/d {{ $promo->end_date->format('d/m/Y') }}</div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                    <div>
                        @if($promo->isCurrentlyValid())
                            <span class="badge bg-success">Sedang Aktif</span>
                        @else
                            <span class="badge bg-secondary">Kadaluarsa / Nonaktif</span>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('admin.promotions.edit', $promo->id) }}" class="btn btn-sm btn-outline-warning me-1">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.promotions.destroy', $promo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus promo ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 text-muted">
            <p>Belum ada promo yang dibuat.</p>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $promotions->links('pagination::bootstrap-5') }}
</div>
@endsection

