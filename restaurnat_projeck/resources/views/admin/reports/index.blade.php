@extends('layouts.admin')

@section('title', 'Laporan Penjualan & Katering')
@section('page_title', 'Laporan Penjualan & Katering')

@section('content')
<!-- Filter Period Card -->
<div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h5 class="fw-bold mb-1">Periode Laporan: {{ $startDate->format('d/m/Y') }} – {{ $endDate->format('d/m/Y') }}</h5>
            <small class="text-muted">Pilih periode laporan harian, mingguan, bulanan, atau rentang tanggal tertentu</small>
        </div>
        <div>
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-print me-1"></i> Cetak Laporan
            </button>
        </div>
    </div>

    <!-- Quick Period Buttons -->
    <div class="d-flex flex-wrap gap-2 mb-3">
        <a href="{{ route('admin.reports.index', ['period' => 'daily']) }}" class="btn btn-sm {{ $period === 'daily' ? 'btn-primary' : 'btn-outline-primary' }}">
            <i class="fa fa-calendar-day me-1"></i> Hari Ini
        </a>
        <a href="{{ route('admin.reports.index', ['period' => 'weekly']) }}" class="btn btn-sm {{ $period === 'weekly' ? 'btn-primary' : 'btn-outline-primary' }}">
            <i class="fa fa-calendar-week me-1"></i> Minggu Ini
        </a>
        <a href="{{ route('admin.reports.index', ['period' => 'monthly']) }}" class="btn btn-sm {{ $period === 'monthly' ? 'btn-primary' : 'btn-outline-primary' }}">
            <i class="fa fa-calendar-alt me-1"></i> Bulan Ini
        </a>
    </div>

    <!-- Custom Date Range Form -->
    <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-2 border-top pt-3">
        <input type="hidden" name="period" value="custom">
        <div class="col-md-4">
            <div class="input-group input-group-sm">
                <span class="input-group-text">Dari Tanggal:</span>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate->format('Y-m-d') }}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-sm">
                <span class="input-group-text">Sampai:</span>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate->format('Y-m-d') }}" required>
            </div>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-secondary btn-sm w-100">
                <i class="fa fa-filter me-1"></i> Terapkan Filter Tanggal
            </button>
        </div>
    </form>
</div>

<!-- Stats Summary Row -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-4">
            <span class="text-muted small fw-bold text-uppercase">Total Pesanan</span>
            <h3 class="fw-bold mb-0 text-dark mt-1">{{ number_format($totalOrdersCount) }} Transaksi</h3>
            <small class="text-success">{{ number_format($completedOrdersCount) }} pesanan selesai</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-4">
            <span class="text-muted small fw-bold text-uppercase">Nilai Omzet Penjualan</span>
            <h3 class="fw-bold mb-0 text-primary mt-1">Rp {{ number_format($totalSalesAmount, 0, ',', '.') }}</h3>
            <small class="text-muted">Total nilai seluruh pesanan</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-4">
            <span class="text-muted small fw-bold text-uppercase">Kas Masuk (Tervalidasi)</span>
            <h3 class="fw-bold mb-0 text-success mt-1">Rp {{ number_format($totalRevenueCollected, 0, ',', '.') }}</h3>
            <small class="text-success"><i class="fa fa-check-circle me-1"></i>Dana real diterima</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-4">
            <span class="text-muted small fw-bold text-uppercase">Piutang / Belum Lunas</span>
            <h3 class="fw-bold mb-0 text-danger mt-1">Rp {{ number_format($unpaidOrdersAmount, 0, ',', '.') }}</h3>
            <small class="text-danger">{{ $pendingPaymentsCount }} bukti perlu dicek</small>
        </div>
    </div>
</div>

<!-- Top Selling Menu in Period -->
<div class="row g-4 mb-4">
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
            <h5 class="fw-bold mb-3"><i class="fa fa-trophy text-warning me-2"></i>10 Menu Terlaris di Periode Ini</h5>
            @if($topSellingMenus->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Menu</th>
                                <th class="text-center">Porsi</th>
                                <th class="text-end">Total (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topSellingMenus as $idx => $menu)
                                <tr>
                                    <td><strong>{{ $idx + 1 }}</strong></td>
                                    <td>{{ $menu->item_name }}</td>
                                    <td class="text-center fw-bold">{{ number_format($menu->total_qty) }}</td>
                                    <td class="text-end fw-bold text-success">{{ number_format($menu->total_sales, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-muted">
                    <p class="mb-0">Tidak ada data penjualan pada periode ini.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
            <h5 class="fw-bold mb-3"><i class="fa fa-chart-pie text-primary me-2"></i>Komposisi Status Pesanan</h5>
            <div class="row g-3 text-center my-auto">
                <div class="col-4">
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted d-block">Masuk / Baru</small>
                        <h4 class="fw-bold text-secondary mb-0">{{ $orders->where('status', 'masuk')->count() }}</h4>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted d-block">Dikonfirmasi / Proses</small>
                        <h4 class="fw-bold text-primary mb-0">{{ $orders->whereIn('status', ['dikonfirmasi', 'diproses'])->count() }}</h4>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted d-block">Selesai / Terkirim</small>
                        <h4 class="fw-bold text-success mb-0">{{ $orders->whereIn('status', ['dikirim', 'selesai'])->count() }}</h4>
                    </div>
                </div>
            </div>

            <hr class="my-3">

            <div class="row g-3 text-center">
                <div class="col-4">
                    <small class="text-muted d-block">Belum Bayar</small>
                    <span class="badge bg-danger fs-6">{{ $orders->where('payment_status', 'belum_bayar')->count() }} Pesanan</span>
                </div>
                <div class="col-4">
                    <small class="text-muted d-block">Uang Muka (DP)</small>
                    <span class="badge bg-warning text-dark fs-6">{{ $orders->where('payment_status', 'dp')->count() }} Pesanan</span>
                </div>
                <div class="col-4">
                    <small class="text-muted d-block">Lunas</small>
                    <span class="badge bg-success fs-6">{{ $orders->where('payment_status', 'lunas')->count() }} Pesanan</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Orders Table in Period -->
<div class="card border-0 shadow-sm rounded-3 p-4">
    <h5 class="fw-bold mb-3"><i class="fa fa-list-alt text-primary me-2"></i>Rincian Seluruh Pesanan Periode Ini</h5>
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Pesanan</th>
                    <th>Pemesan</th>
                    <th>Tgl Kirim</th>
                    <th>Item & Porsi</th>
                    <th>Total</th>
                    <th>Status Pesanan</th>
                    <th>Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="fw-bold text-decoration-none">
                                {{ $order->order_number }}
                            </a>
                        </td>
                        <td>
                            <div>{{ $order->customer_name }}</div>
                            <small class="text-muted">{{ $order->customer_phone }}</small>
                        </td>
                        <td>{{ $order->delivery_date->format('d/m/Y') }}</td>
                        <td>
                            @foreach($order->items as $it)
                                <small class="d-block">• {{ $it->item_name }} ({{ $it->quantity }}x)</small>
                            @endforeach
                        </td>
                        <td class="fw-bold text-dark">{{ $order->formatted_total }}</td>
                        <td>{!! $order->status_badge !!}</td>
                        <td>{!! $order->payment_status_badge !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Tidak ada data pesanan pada periode tanggal ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

