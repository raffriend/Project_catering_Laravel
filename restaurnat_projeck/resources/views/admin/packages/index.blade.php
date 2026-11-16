@extends('layouts.admin')

@section('title', 'Paket Katering')
@section('page_title', 'Kelola Paket Katering')

@section('content')
<div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1">Daftar Paket Katering</h5>
            <small class="text-muted">Kelola paket nasi kotak, prasmanan, harga per porsi, dan daftar menu isi paket</small>
        </div>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle me-1"></i> Tambah Paket Katering
        </a>
    </div>
</div>

<div class="row g-4">
    @forelse($packages as $pkg)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                <img src="{{ asset($pkg->image ?? 'img/menu-3.jpg') }}" alt="{{ $pkg->name }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-secondary">Min. {{ $pkg->min_order }} Porsi</span>
                        <h5 class="text-primary fw-bold mb-0">{{ $pkg->formatted_price }} <small class="text-muted fs-6">/pax</small></h5>
                    </div>
                    <h5 class="card-title fw-bold">{{ $pkg->name }}</h5>
                    <p class="card-text text-muted small mb-3">{{ $pkg->description }}</p>

                    <div class="bg-light p-3 rounded mb-4 flex-grow-1">
                        <small class="fw-bold text-dark d-block mb-1">Menu Paket:</small>
                        <pre class="small text-muted mb-0" style="font-family: inherit; white-space: pre-line;">{{ $pkg->includes }}</pre>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        @if($pkg->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif

                        <div>
                            <a href="{{ route('admin.packages.edit', $pkg->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.packages.destroy', $pkg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus paket {{ $pkg->name }}?');">
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
        </div>
    @empty
        <div class="col-12 text-center py-5 text-muted">
            <p>Belum ada paket katering. Silakan tambahkan paket katering baru.</p>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $packages->links('pagination::bootstrap-5') }}
</div>
@endsection

