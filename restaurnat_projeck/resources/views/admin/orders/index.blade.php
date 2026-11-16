@extends('layouts.admin')

@section('title', 'Daftar Pesanan')
@section('page_title', 'Kelola Pesanan (Katering & Ampera)')

@section('content')
<div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1">Daftar Seluruh Pesanan & Transaksi</h5>
            <small class="text-muted">Pantau status pesanan, ubah pesanan jika ada koreksi, jadwal pengiriman, dan pembayaran</small>
        </div>
        <div>
            <a href="{{ route('admin.ampera.index') }}" class="btn btn-success btn-sm">
                <i class="fa fa-cash-register me-1"></i> Transaksi Kasir Ampera
            </a>
        </div>
    </div>

    <!-- Filter Bar -->
    <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2 border-top pt-3">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="No. Pesanan / Nama / No. HP" value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="order_type" class="form-select form-select-sm">
                <option value="">Semua Tipe Pesanan</option>
                <option value="catering" {{ request('order_type') == 'catering' ? 'selected' : '' }}>📦 Katering</option>
                <option value="ampera" {{ request('order_type') == 'ampera' ? 'selected' : '' }}>🍽️ Ampera (Kasir)</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select form-select-sm">
                <option value="">Semua Status Pesanan</option>
                <option value="masuk" {{ request('status') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="payment_status" class="form-select form-select-sm">
                <option value="">Semua Status Bayar</option>
                <option value="belum_bayar" {{ request('payment_status') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                <option value="dp" {{ request('payment_status') == 'dp' ? 'selected' : '' }}>DP</option>
                <option value="lunas" {{ request('payment_status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-secondary btn-sm flex-fill">
                <i class="fa fa-filter me-1"></i> Filter
            </button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
        </div>
    </form>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Pesanan</th>
                    <th>Tipe</th>
                    <th>Pemesan</th>
                    <th>Jadwal Kirim / Waktu</th>
                    <th>Total Belanja</th>
                    <th>Status Pesanan</th>
                    <th>Pembayaran</th>
                    <th class="text-center" style="width: 170px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            <strong class="text-primary">{{ $order->order_number }}</strong>
                            <small class="d-block text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                        </td>
                        <td>
                            {!! $order->order_type_badge !!}
                        </td>
                        <td>
                            <strong>{{ $order->customer_name }}</strong>
                            @if($order->customer_phone && $order->customer_phone !== '-')
                                <small class="d-block text-muted"><i class="fa fa-phone me-1"></i>{{ $order->customer_phone }}</small>
                            @endif
                        </td>
                        <td>
                            @if($order->delivery_date)
                                <strong>{{ $order->delivery_date->format('d/m/Y') }}</strong>
                                <small class="d-block text-muted">{{ date('H:i', strtotime($order->delivery_time)) }} WIB</small>
                            @else
                                <span class="text-muted small">Langsung di Kasir</span>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark">{{ $order->formatted_total }}</strong>
                            @if($order->bonus_info)
                                <small class="d-block text-success"><i class="fa fa-gift me-1"></i>{{ $order->bonus_info }}</small>
                            @endif
                        </td>
                        <td>{!! $order->status_badge !!}</td>
                        <td>{!! $order->payment_status_badge !!}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-primary" title="Detail Pesanan">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-outline-warning text-dark" title="Ubah / Koreksi Pesanan">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn btn-outline-secondary" title="Cetak Invoice">
                                    <i class="fa fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fa fa-inbox fa-3x mb-2 text-secondary"></i>
                            <p class="mb-0">Tidak ada data pesanan yang sesuai filter.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
