@extends('layouts.admin')

@section('title', 'Manajemen Pelanggan')
@section('page_title', 'Kelola Pelanggan')

@section('content')
<div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1">Daftar Pelanggan CV. Kedai Agung</h5>
            <small class="text-muted">Kelola data kontak pelanggan, instansi rekanan, dan pelanggan katering tetap</small>
        </div>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
            <i class="fa fa-user-plus me-1"></i> Tambah Pelanggan
        </a>
    </div>

    <!-- Filter -->
    <form method="GET" action="{{ route('admin.customers.index') }}" class="row g-2 border-top pt-3">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama / nomor HP / email pelanggan..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="customer_type" class="form-select form-select-sm">
                <option value="">Semua Tipe Pelanggan</option>
                <option value="individual" {{ request('customer_type') == 'individual' ? 'selected' : '' }}>Perorangan / Pribadi</option>
                <option value="institution" {{ request('customer_type') == 'institution' ? 'selected' : '' }}>Instansi / Perusahaan</option>
                <option value="catering_langganan" {{ request('customer_type') == 'catering_langganan' ? 'selected' : '' }}>Langganan Katering Rutin</option>
            </select>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch pt-1">
                <input class="form-check-input" type="checkbox" name="is_regular" id="is_regular" value="1" {{ request('is_regular') ? 'checked' : '' }} onchange="this.form.submit()">
                <label class="form-check-label small fw-bold" for="is_regular">Pelanggan Tetap</label>
            </div>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-secondary btn-sm flex-fill">
                <i class="fa fa-filter me-1"></i> Filter
            </button>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
        </div>
    </form>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Pelanggan</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>Tipe Pelanggan</th>
                    <th class="text-center">Total Pesanan</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $index => $customer)
                    <tr>
                        <td>{{ $customers->firstItem() + $index }}</td>
                        <td>
                            <strong class="d-block">{{ $customer->name }}</strong>
                            @if($customer->is_regular)
                                <span class="badge bg-warning text-dark"><i class="fa fa-star me-1"></i>Langganan Tetap</span>
                            @endif
                        </td>
                        <td>
                            <div><i class="fa fa-phone text-muted me-1"></i>{{ $customer->phone }}</div>
                            @if($customer->email)
                                <small class="text-muted"><i class="fa fa-envelope text-muted me-1"></i>{{ $customer->email }}</small>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ Str::limit($customer->address, 45) }}</small></td>
                        <td>
                            @if($customer->customer_type === 'institution')
                                <span class="badge bg-primary">Instansi / Kantor</span>
                            @elseif($customer->customer_type === 'catering_langganan')
                                <span class="badge bg-success">Langganan Katering</span>
                            @else
                                <span class="badge bg-secondary">Perorangan</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border">{{ $customer->orders_count }} Pesanan</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Riwayat & Detail">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pelanggan {{ $customer->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fa fa-users fa-3x mb-2 text-secondary opacity-50"></i>
                            <p class="mb-0">Belum ada data pelanggan yang cocok dengan pencarian.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $customers->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

