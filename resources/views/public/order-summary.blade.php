@extends('layouts.public')

@section('title', 'Ringkasan Pesanan - ' . $order->order_number)

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Pesanan Berhasil</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('order.form') }}">Pemesanan</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">{{ $order->order_number }}</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Header Card -->
                <div class="card border-0 shadow-sm rounded-3 p-4 p-md-5 mb-4 text-center">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success p-3 mx-auto mb-3" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa fa-check-circle fa-3x"></i>
                    </div>
                    <h3 class="fw-bold mb-2">Terima Kasih, Pesanan Anda Telah Kami Terima!</h3>
                    <p class="text-muted">Simpan dan catat Nomor Pesanan di bawah ini untuk melacak proses memasak & pengantaran katering Anda.</p>
                    <div class="p-3 bg-light border border-primary border-2 rounded-3 d-inline-block mx-auto mb-3">
                        <small class="text-muted text-uppercase fw-bold d-block">Nomor Pesanan Unik (Order ID)</small>
                        <h2 class="text-primary fw-bold mb-0 tracking-wider">{{ $order->order_number }}</h2>
                    </div>
                    <div>
                        <a href="{{ route('order.tracking', ['order_number' => $order->order_number]) }}" class="btn btn-outline-primary px-4 me-2">
                            <i class="fa fa-search-location me-1"></i> Lacak Status Pesanan
                        </a>
                        <button onclick="window.print()" class="btn btn-secondary px-4">
                            <i class="fa fa-print me-1"></i> Cetak Tagihan
                        </button>
                    </div>
                </div>

                <!-- Invoice Details Card -->
                <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-2"><i class="fa fa-file-invoice text-primary me-2"></i>Rincian Tagihan Katering</h5>

                    <div class="row mb-4">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <h6 class="text-muted small text-uppercase">Informasi Pemesan:</h6>
                            <strong class="d-block">{{ $order->customer_name }}</strong>
                            <span class="text-muted d-block"><i class="fa fa-phone me-1"></i>{{ $order->customer_phone }}</span>
                            <small class="text-muted d-block mt-1"><i class="fa fa-map-marker-alt me-1"></i>{{ $order->delivery_address }}</small>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <h6 class="text-muted small text-uppercase">Jadwal Pengiriman:</h6>
                            <strong class="d-block text-primary fs-5"><i class="fa fa-calendar-alt me-1"></i>{{ $order->delivery_date->format('d F Y') }}</strong>
                            <span class="text-muted d-block"><i class="fa fa-clock me-1"></i>Pukul {{ date('H:i', strtotime($order->delivery_time)) }} WIB</span>
                            <div class="mt-2">
                                Status: {!! $order->status_badge !!}
                                {!! $order->payment_status_badge !!}
                            </div>
                        </div>
                    </div>

                    <!-- Item Table -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Menu / Paket</th>
                                    <th class="text-center" style="width: 100px;">Harga</th>
                                    <th class="text-center" style="width: 80px;">Qty</th>
                                    <th class="text-end" style="width: 130px;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <strong class="d-block">{{ $item->item_name }}</strong>
                                            @if($item->notes)
                                                <small class="text-muted">{{ $item->notes }}</small>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $item->formatted_price }}</td>
                                        <td class="text-center">{{ $item->quantity }} Box</td>
                                        <td class="text-end fw-bold">{{ $item->formatted_subtotal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Subtotal:</th>
                                    <td class="text-end fw-bold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @if($order->discount_amount > 0)
                                    <tr>
                                        <th colspan="3" class="text-end text-success">Potongan Diskon Promo:</th>
                                        <td class="text-end fw-bold text-success">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
                                    </tr>
                                @endif
                                <tr class="table-active">
                                    <th colspan="3" class="text-end fs-5">Total Pembayaran:</th>
                                    <td class="text-end fw-bold text-primary fs-5">{{ $order->formatted_total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if($order->bonus_info)
                        <div class="alert alert-warning border border-warning d-flex align-items-center mb-4">
                            <i class="fa fa-gift fa-2x text-danger me-3"></i>
                            <div>
                                <strong class="d-block text-dark">Bonus Spesial Pemesanan:</strong>
                                <span>{{ $order->bonus_info }}</span>
                            </div>
                        </div>
                    @endif

                    @if($order->notes)
                        <div class="p-3 bg-light rounded mb-4">
                            <strong class="d-block text-muted small">Catatan Khusus:</strong>
                            <p class="mb-0">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>

                <!-- Payment Instructions Card -->
                <div class="card border-0 shadow-sm rounded-3 p-4">
                    <h5 class="fw-bold mb-3"><i class="fa fa-wallet text-primary me-2"></i>Panduan Pembayaran Manual</h5>
                    <p class="text-muted small">Silakan pilih salah satu rekening tujuan transfer di bawah ini:</p>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="p-3 border rounded text-center h-100">
                                <h6 class="fw-bold mb-1 text-primary">Bank BCA</h6>
                                <strong class="fs-5 d-block text-dark">123-456-7890</strong>
                                <small class="text-muted">a.n CV. Kedai Agung</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded text-center h-100">
                                <h6 class="fw-bold mb-1 text-primary">Bank Mandiri</h6>
                                <strong class="fs-5 d-block text-dark">140-00-1234567-8</strong>
                                <small class="text-muted">a.n CV. Kedai Agung</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded text-center h-100">
                                <h6 class="fw-bold mb-1 text-primary">Bank BRI</h6>
                                <strong class="fs-5 d-block text-dark">0123-01-001234-53-0</strong>
                                <small class="text-muted">a.n CV. Kedai Agung</small>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-muted small mb-2">Setelah transfer atau pembayaran DP, unggah foto bukti transfer Anda pada halaman pelacakan pesanan.</p>
                        <a href="{{ route('order.tracking', ['order_number' => $order->order_number]) }}" class="btn btn-primary py-2 px-4">
                            <i class="fa fa-upload me-1"></i> Unggah Bukti Pembayaran Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

