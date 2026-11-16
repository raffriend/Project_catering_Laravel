@extends('layouts.admin')

@section('title', 'Manajemen Menu')
@section('page_title', 'Kelola Menu Makanan')

@section('content')
<div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
    <div class="row g-3 align-items-center justify-content-between">
        <div class="col-md-4">
            <h5 class="fw-bold mb-1">Daftar Menu Rumah Makan & Katering</h5>
            <small class="text-muted">Kelola seluruh item menu, harga, ketersediaan & foto</small>
        </div>
        <div class="col-md-8 text-md-end">
            <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
                <i class="fa fa-plus-circle me-1"></i> Tambah Menu Baru
            </a>
        </div>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.menus.index') }}" class="row g-2 mt-3 pt-3 border-top">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama menu..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="category_id" class="form-select form-select-sm">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="is_popular" class="form-select form-select-sm">
                <option value="">Semua Popularitas</option>
                <option value="1" {{ request('is_popular') == '1' ? 'selected' : '' }}>Menu Populer</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-secondary btn-sm flex-fill">
                <i class="fa fa-filter me-1"></i> Filter
            </button>
            <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary btn-sm">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th class="text-center">Menu Harian</th>
                    <th class="text-center">Populer</th>
                    <th class="text-center">Status Stok</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $index => $menu)
                    <tr>
                        <td>{{ $menus->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($menu->image)
                                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="rounded me-3 bg-light d-flex align-items-center justify-content-center text-muted" style="width: 50px; height: 50px;">
                                        <i class="fa fa-utensils"></i>
                                    </div>
                                @endif
                                <div>
                                    <strong class="d-block">{{ $menu->name }}</strong>
                                    <small class="text-muted">{{ Str::limit($menu->description, 45) ?? '-' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $menu->category->name ?? '-' }}</span>
                        </td>
                        <td>
                            <strong class="text-success">{{ $menu->formatted_price }}</strong>
                        </td>
                        <td class="text-center">
                            @if($menu->is_daily)
                                <span class="badge bg-info text-dark"><i class="fa fa-check me-1"></i>Harian</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($menu->is_popular)
                                <span class="badge bg-warning text-dark"><i class="fa fa-star me-1"></i>Favorit</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($menu->is_available)
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Habis</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $menu->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fa fa-search fa-2x mb-2 text-secondary opacity-50"></i>
                            <p class="mb-0">Tidak ada menu yang sesuai kriteria pencarian.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $menus->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

