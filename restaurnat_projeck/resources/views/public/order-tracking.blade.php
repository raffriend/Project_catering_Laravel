@extends('layouts.public')

@section('title', 'Lacak Status Pesanan')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Lacak Pesanan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Pelacakan</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <!-- Search Box -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-3 p-4 text-center">
                    <h4 class="fw-bold mb-2"><i class="fa fa-search-location text-primary me-2"></i>Lacak Status Katering Anda</h4>
                    <p class="text-muted small mb-4">Masukkan Nomor Pesanan unik (contoh: <code>ORD-20261109-XXXXX</code>) yang Anda peroleh saat pemesanan</p>

                    <form action="{{ route('order.tracking') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="order_number" class="form-control form-control-lg border-primary text-uppercase" placeholder="Masukkan Nomor Pesanan..." value="{{ request('order_number') }}" required>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">
                            <i class="fa fa-search me-1"></i> Lacak
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if($order)
            <!-- Order Details Found -->
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <!-- Progress Step Bar -->
                    <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                            <div>
                                <small class="text-muted text-uppercase fw-bold">Pesanan Katering</small>
                                <h4 class="fw-bold mb-0 text-primary">{{ $order->order_number }}</h4>
                            </div>
                            <div>
                                Status Saat Ini: {!! $order->status_badge !!}
                                {!! $order->payment_status_badge !!}
                            </div>
                        </div>

                        <!-- Visual Progress Steps -->
                        @php
                            $steps = [
                                'masuk' => ['label' => 'Pesanan Masuk', 'icon' => 'fa-inbox', 'step' => 1],
                                'dikonfirmasi' => ['label' => 'Dikonfirmasi', 'icon' => 'fa-check', 'step' => 2],
                                'diproses' => ['label' => 'Dimasak / Diproses', 'icon' => 'fa-utensils', 'step' => 3],
                                'dikirim' => ['label' => 'Sedang Dikirim', 'icon' => 'fa-truck', 'step' => 4],
                                'selesai' => ['label' => 'Pesanan Selesai', 'icon' => 'fa-check-double', 'step' => 5],
                            ];
                            $currentStep = $steps[$order->status]['step'] ?? 1;
                        @endphp

                        <div class="row text-center position-relative py-3">
                            @foreach($steps as $key => $info)
                                <div class="col">
                                    <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center {{ $currentStep >= $info['step'] ? 'bg-primary text-white shadow' : 'bg-light text-muted border' }}" style="width: 50px; height: 50px;">
                                        <i class="fa {{ $info['icon'] }}"></i>
                                    </div>
                                    <small class="d-block fw-bold {{ $currentStep >= $info['step'] ? 'text-dark' : 'text-muted' }}">{{ $info['label'] }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Info & Item Details -->
                    <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2"><i class="fa fa-info-circle text-primary me-2"></i>Rincian Pengiriman</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <small class="text-muted d-block">Penerima:</small>
                                <strong>{{ $order->customer_name }} ({{ $order->customer_phone }})</strong>
                                <small class="text-muted d-block mt-1">{{ $order->delivery_address }}</small>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <small class="text-muted d-block">Waktu Pengantaran:</small>
                                <strong class="text-primary fs-5">{{ $order->delivery_date->format('d M Y') }}</strong>
                                <span class="d-block text-muted">Pukul {{ date('H:i', strtotime($order->delivery_time)) }} WIB</span>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Item Pesanan</th>
                                        <th class="text-center" style="width: 100px;">Porsi</th>
                                        <th class="text-end" style="width: 140px;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>
                                                <strong class="d-block">{{ $item->item_name }}</strong>
                                                <small class="text-muted">@ {{ $item->formatted_price }}</small>
                                            </td>
                                            <td class="text-center">{{ $item->quantity }} Box</td>
                                            <td class="text-end fw-bold">{{ $item->formatted_subtotal }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @if($order->discount_amount > 0)
                                        <tr>
                                            <th colspan="2" class="text-end text-success">Diskon:</th>
                                            <td class="text-end text-success fw-bold">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
                                        </tr>
                                    @endif
                                    <tr class="table-active">
                                        <th colspan="2" class="text-end">Total Tagihan:</th>
                                        <td class="text-end fw-bold text-primary fs-5">{{ $order->formatted_total }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        @if($order->bonus_info)
                            <div class="alert alert-warning border border-warning mt-3 mb-0">
                                <i class="fa fa-gift text-danger me-2"></i><strong>Bonus Pesanan:</strong> {{ $order->bonus_info }}
                            </div>
                        @endif
                    </div>

                    <!-- Payment Section: History & Upload Form -->
                    <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                            <h5 class="fw-bold mb-0"><i class="fa fa-money-check-alt text-primary me-2"></i>Status Pembayaran</h5>
                            <span class="fs-6">{!! $order->payment_status_badge !!}</span>
                        </div>

                        @if($order->payments->count() > 0)
                            <h6 class="fw-bold mt-2 mb-2">Riwayat Pembayaran yang Diunggah:</h6>
                            <div class="table-responsive mb-4">
                                <table class="table table-sm table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No. Pembayaran</th>
                                            <th>Metode</th>
                                            <th>Tipe</th>
                                            <th>Nominal</th>
                                            <th>Status</th>
                                            <th class="text-center">Bukti</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->payments as $payment)
                                            <tr>
                                                <td><code>{{ $payment->payment_number }}</code></td>
                                                <td><span class="badge bg-secondary text-uppercase">{{ $payment->payment_method }}</span></td>
                                                <td><span class="badge bg-light text-dark border text-uppercase">{{ $payment->payment_type }}</span></td>
                                                <td class="fw-bold text-success">{{ $payment->formatted_amount }}</td>
                                                <td>{!! $payment->status_badge !!}</td>
                                                <td class="text-center">
                                                    @if($payment->proof_image)
                                                        <a href="{{ asset($payment->proof_image) }}" target="_blank" class="btn btn-sm btn-outline-primary py-0 px-2">
                                                            <i class="fa fa-image"></i> Lihat
                                                        </a>
                                                    @else
                                                        <span class="text-muted small">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-light border text-center py-3 mb-4">
                                <i class="fa fa-info-circle text-primary me-1"></i> Belum ada pembayaran yang dicatat untuk pesanan ini.
                            </div>
                        @endif

                        <!-- Form Upload Bukti Transfer -->
                        @if($order->payment_status !== 'lunas')
                            <div class="bg-light p-4 rounded-3 border">
                                <h6 class="fw-bold mb-3"><i class="fa fa-upload text-primary me-2"></i>Konfirmasi / Upload Bukti Pembayaran</h6>
                                <form action="{{ route('order.payment.upload', $order->order_number) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold">Nominal Pembayaran (Rp) <span class="text-danger">*</span></label>
                                            <input type="number" name="amount" class="form-control form-control-sm" placeholder="Contoh: 500000" min="1" value="{{ old('amount', (int)$order->total_amount) }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold">Metode Pembayaran <span class="text-danger">*</span></label>
                                            <select name="payment_method" class="form-select form-select-sm" required>
                                                <option value="transfer">Transfer Bank (BCA / Mandiri / BRI)</option>
                                                <option value="qris">QRIS (GoPay/OVO/Dana/BCA)</option>
                                                <option value="cash">Tunai / COD Kasir</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold">Tipe Pembayaran <span class="text-danger">*</span></label>
                                            <select name="payment_type" class="form-select form-select-sm" required>
                                                <option value="full">Pelunasan Penuh (Full 100%)</option>
                                                <option value="dp">Uang Muka (DP 50%)</option>
                                                <option value="pelunasan">Pelunasan Sisa DP</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Foto Bukti Transfer / Struk <span class="text-danger">*</span></label>
                                            <input type="file" name="proof_image" class="form-control form-control-sm" accept="image/*" required>
                                            <small class="text-muted" style="font-size: 0.75rem;">Format gambar JPG, PNG, WEBP. Maks 3MB.</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Catatan Pembayaran (Opsional)</label>
                                            <input type="text" name="notes" class="form-control form-control-sm" placeholder="Contoh: Transfer atas nama Budi Santoso">
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                                <i class="fa fa-paper-plane me-1"></i> Kirim Bukti Pembayaran
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="alert alert-success border-success text-center mb-0">
                                <i class="fa fa-check-circle me-1"></i> Pesanan ini telah <strong>LUNAS</strong>. Terima kasih!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @elseif(request()->filled('order_number'))
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="alert alert-danger text-center p-4">
                        <i class="fa fa-exclamation-triangle fa-2x mb-2 text-danger"></i>
                        <h5>Nomor Pesanan Tidak Ditemukan</h5>
                        <p class="mb-0 text-muted">Nomor pesanan <strong>{{ request('order_number') }}</strong> tidak terdaftar dalam database kami. Silakan periksa kembali nomor pesanan Anda.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

