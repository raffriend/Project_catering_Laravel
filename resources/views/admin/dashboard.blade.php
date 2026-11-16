@extends('layouts.admin')

@section('title', 'Dashboard Ringkasan')
@section('page_title', 'Ringkasan Dashboard')

@section('content')
<!-- Row 1: Stat Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Pesanan Hari Ini</span>
                    <h3 class="fw-bold mb-0 text-dark mt-1">{{ number_format($ordersToday) }}</h3>
                    <small class="text-success"><i class="fa fa-calendar-check me-1"></i>Hari ini</small>
                </div>
                <div class="rounded-circle p-3 bg-primary bg-opacity-10 text-primary">
                    <i class="fa fa-shopping-bag fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Pesanan Pending</span>
                    <h3 class="fw-bold mb-0 text-warning mt-1">{{ number_format($pendingOrders) }}</h3>
                    <small class="text-muted"><i class="fa fa-clock me-1"></i>Menunggu konfirmasi</small>
                </div>
                <div class="rounded-circle p-3 bg-warning bg-opacity-10 text-warning">
                    <i class="fa fa-hourglass-half fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Pembayaran Tertunda</span>
                    <h3 class="fw-bold mb-0 text-danger mt-1">{{ number_format($pendingPayments) }}</h3>
                    <small class="text-danger"><i class="fa fa-exclamation-circle me-1"></i>Perlu verifikasi</small>
                </div>
                <div class="rounded-circle p-3 bg-danger bg-opacity-10 text-danger">
                    <i class="fa fa-file-invoice-dollar fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-4">
            <div class="d-flex align-items-center justify-content-between">
                @if(Auth::user()->isOwner())
                    <div>
                        <span class="text-muted small fw-bold text-uppercase">Pendapatan Hari Ini</span>
                        <h3 class="fw-bold mb-0 text-success mt-1">Rp {{ number_format($revenueToday, 0, ',', '.') }}</h3>
                        <small class="text-muted"><i class="fa fa-wallet me-1"></i>Total: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</small>
                    </div>
                    <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success">
                        <i class="fa fa-coins fa-2x"></i>
                    </div>
                @else
                    <div>
                        <span class="text-muted small fw-bold text-uppercase">Menu Tersedia</span>
                        <h3 class="fw-bold mb-0 text-success mt-1">{{ number_format($totalMenus) }} Menu</h3>
                        <small class="text-muted"><i class="fa fa-utensils me-1"></i>Katalog masakan aktif</small>
                    </div>
                    <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success">
                        <i class="fa fa-utensils fa-2x"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Row 2: Charts -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">
                    <i class="fa fa-chart-bar text-primary me-2"></i>
                    {{ Auth::user()->isOwner() ? 'Tren Pesanan & Pendapatan (7 Hari)' : 'Tren Volume Pesanan (7 Hari)' }}
                </h5>
                <span class="badge bg-light text-dark border">Mingguan</span>
            </div>
            <canvas id="orderRevenueChart" height="130"></canvas>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0"><i class="fa fa-trophy text-warning me-2"></i>Menu Paling Laris</h5>
                @if(Auth::user()->isOwner())
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-link p-0 text-decoration-none">Lihat Laporan</a>
                @endif
            </div>
            @if($topMenus->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($topMenus as $index => $item)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-pill bg-primary me-3" style="width: 24px;">{{ $index + 1 }}</span>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $item->item_name }}</h6>
                                    <small class="text-muted">{{ number_format($item->total_qty) }} porsi terjual</small>
                                </div>
                            </div>
                            <span class="fw-bold text-success">Rp {{ number_format($item->total_sales, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4 text-muted">
                    <i class="fa fa-utensils fa-2x mb-2 text-secondary opacity-50"></i>
                    <p class="mb-0 small">Belum ada data pesanan selesai.</p>
                </div>
            @endif

            <hr class="my-3">
            <div class="row text-center">
                <div class="col-4 border-end">
                    <small class="text-muted d-block">Total Menu</small>
                    <strong class="text-primary fs-5">{{ $totalMenus }}</strong>
                </div>
                <div class="col-4 border-end">
                    <small class="text-muted d-block">Kategori</small>
                    <strong class="text-success fs-5">{{ $totalCategories }}</strong>
                </div>
                <div class="col-4">
                    <small class="text-muted d-block">Pelanggan</small>
                    <strong class="text-info fs-5">{{ $totalCustomers }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row 3: Recent Orders Table -->
<div class="card border-0 shadow-sm rounded-3 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1"><i class="fa fa-receipt text-primary me-2"></i>Pesanan Katering Terbaru</h5>
            <small class="text-muted">Daftar transaksi pesanan katering terkini yang masuk ke sistem</small>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm px-3">
            <i class="fa fa-list me-1"></i> Semua Pesanan
        </a>
    </div>

    @if($recentOrders->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Tgl Kirim</th>
                        <th>Total</th>
                        <th>Status Pesanan</th>
                        <th>Status Bayar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                        <tr>
                            <td>
                                <strong class="text-primary">{{ $order->order_number }}</strong>
                                <small class="d-block text-muted">{{ $order->created_at->diffForHumans() }}</small>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $order->customer_name }}</div>
                                <small class="text-muted"><i class="fa fa-phone me-1"></i>{{ $order->customer_phone }}</small>
                            </td>
                            <td>
                                <div>{{ $order->delivery_date->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ date('H:i', strtotime($order->delivery_time)) }} WIB</small>
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
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-5 text-muted">
            <i class="fa fa-inbox fa-3x mb-3 text-secondary opacity-50"></i>
            <p>Belum ada pesanan katering yang tercatat.</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const isOwner = {{ Auth::user()->isOwner() ? 'true' : 'false' }};
    const ctx = document.getElementById('orderRevenueChart').getContext('2d');
    
    const datasets = [
        {
            label: 'Jumlah Pesanan',
            data: {!! json_encode($chartOrders) !!},
            backgroundColor: 'rgba(254, 161, 22, 0.7)',
            borderColor: '#FEA116',
            borderWidth: 1,
            yAxisID: 'yOrders'
        }
    ];

    const scales = {
        yOrders: {
            type: 'linear',
            position: 'left',
            beginAtZero: true,
            ticks: { precision: 0 }
        }
    };

    if (isOwner) {
        datasets.push({
            label: 'Pendapatan (Rp)',
            data: {!! json_encode($chartRevenue) !!},
            type: 'line',
            borderColor: '#198754',
            backgroundColor: 'rgba(25, 135, 84, 0.1)',
            tension: 0.3,
            fill: true,
            yAxisID: 'yRevenue'
        });

        scales.yRevenue = {
            type: 'linear',
            position: 'right',
            beginAtZero: true,
            grid: { drawOnChartArea: false },
            ticks: {
                callback: function(value) {
                    return 'Rp ' + value.toLocaleString('id-ID');
                }
            }
        };
    }

    const orderRevenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartDates) !!},
            datasets: datasets
        },
        options: {
            responsive: true,
            scales: scales
        }
    });
</script>
@endpush

