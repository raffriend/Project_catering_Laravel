@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran')
@section('page_title', 'Kelola Pembayaran Pesanan')

@section('content')
<div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1">Daftar Transaksi Pembayaran</h5>
            <small class="text-muted">Konfirmasi bukti transfer / QRIS dari pelanggan dan pantau pembayaran lunas / tertunda</small>
        </div>
        @if($pendingCount > 0)
            <span class="badge bg-danger fs-6 px-3 py-2">
                <i class="fa fa-bell me-1"></i> {{ $pendingCount }} Pembayaran Menunggu Konfirmasi
            </span>
        @endif
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.payments.index') }}" class="row g-2 border-top pt-3">
        <div class="col-md-3">
            <select name="status" class="form-select form-select-sm">
                <option value="">Semua Status Verifikasi</option>
                <option value="menunggu_konfirmasi" {{ request('status') == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima (Sah)</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="payment_method" class="form-select form-select-sm">
                <option value="">Semua Metode Pembayaran</option>
                <option value="transfer" {{ request('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                <option value="qris" {{ request('payment_method') == 'qris' ? 'selected' : '' }}>QRIS</option>
                <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash / Tunai</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-1">
            <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}" title="Dari Tanggal">
            <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}" title="Sampai Tanggal">
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-secondary btn-sm flex-fill">
                <i class="fa fa-filter me-1"></i> Filter
            </button>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
        </div>
    </form>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Pembayaran</th>
                    <th>No. Pesanan</th>
                    <th>Nominal</th>
                    <th>Metode & Tipe</th>
                    <th>Tanggal Bayar</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $pay)
                    <tr>
                        <td>
                            <strong class="text-primary">{{ $pay->payment_number }}</strong>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $pay->order_id) }}" class="fw-bold text-decoration-none">
                                {{ $pay->order->order_number ?? '-' }}
                            </a>
                            <small class="d-block text-muted">{{ $pay->order->customer_name ?? '-' }}</small>
                        </td>
                        <td>
                            <strong class="text-success fs-6">{{ $pay->formatted_amount }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-secondary text-uppercase">{{ $pay->payment_method }}</span>
                            <span class="badge bg-light text-dark border text-uppercase">{{ $pay->payment_type }}</span>
                        </td>
                        <td>
                            {{ $pay->payment_date->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            @if($pay->proof_image)
                                <a href="{{ asset($pay->proof_image) }}" target="_blank" class="btn btn-sm btn-outline-primary py-0 px-2">
                                    <i class="fa fa-image me-1"></i> Lihat Foto
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>{!! $pay->status_badge !!}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.payments.show', $pay->id) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-check-circle me-1"></i> Verifikasi
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fa fa-file-invoice-dollar fa-3x mb-2 text-secondary opacity-50"></i>
                            <p class="mb-0">Tidak ada data transaksi pembayaran yang sesuai filter.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $payments->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

