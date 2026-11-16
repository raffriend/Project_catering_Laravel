@extends('layouts.public')

@section('title', 'Form Pemesanan Katering')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Pemesanan Katering</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('catering') }}">Katering</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Formulir Pesanan</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Formulir Pemesanan</h5>
            <h1 class="mb-5">Pesan Katering CV. Kedai Agung</h1>
        </div>

        <div class="row g-5">
            <!-- Left Column: Order Form -->
            <div class="col-lg-8">
                <div class="bg-dark p-4 p-sm-5 rounded-3 shadow">
                    <form action="{{ route('order.submit') }}" method="POST" id="cateringOrderForm">
                        @csrf
                        <h4 class="text-white mb-4"><i class="fa fa-user-edit text-primary me-2"></i>1. Data Pemesan & Pengiriman</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name', Auth::check() ? Auth::user()->name : '') }}" placeholder="Nama Lengkap" required>
                                    <label for="customer_name">Nama Lengkap Pemesan <span class="text-danger">*</span></label>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', Auth::check() ? Auth::user()->phone : '') }}" placeholder="08xxxxxxxxxx" required>
                                    <label for="customer_phone">Nomor HP / WhatsApp <span class="text-danger">*</span></label>
                                    @error('customer_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email', Auth::check() ? Auth::user()->email : '') }}" placeholder="Email (opsional)">
                                    <label for="customer_email">Alamat Email (Opsional)</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control @error('delivery_address') is-invalid @enderror" placeholder="Alamat Pengiriman Lengkap" id="delivery_address" name="delivery_address" style="height: 100px" required>{{ old('delivery_address', Auth::check() ? Auth::user()->address : '') }}</textarea>
                                    <label for="delivery_address">Alamat Pengiriman (Nama Gedung / Jalan / No. Rumah) <span class="text-danger">*</span></label>
                                    @error('delivery_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" id="delivery_date" name="delivery_date" value="{{ old('delivery_date', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d') }}" required>
                                    <label for="delivery_date">Tanggal Pengiriman <span class="text-danger">*</span></label>
                                    @error('delivery_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="time" class="form-control @error('delivery_time') is-invalid @enderror" id="delivery_time" name="delivery_time" value="{{ old('delivery_time', '11:00') }}" required>
                                    <label for="delivery_time">Jam Pengiriman (Mulai 07.30) <span class="text-danger">*</span></label>
                                    @error('delivery_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="border-secondary my-4">

                        <h4 class="text-white mb-4"><i class="fa fa-utensils text-primary me-2"></i>2. Pilihan Menu & Paket Katering</h4>

                        <!-- Mode Pemilihan: Paket Katering vs Menu Custom -->
                        <div class="mb-4">
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="order_type" id="type_paket" value="catering_paket" checked autocomplete="off">
                                <label class="btn btn-outline-primary py-3 fw-bold" for="type_paket">
                                    <i class="fa fa-box-open me-2"></i> Paket Katering Komplit
                                </label>

                                <input type="radio" class="btn-check" name="order_type" id="type_custom" value="catering_custom" autocomplete="off">
                                <label class="btn btn-outline-primary py-3 fw-bold" for="type_custom">
                                    <i class="fa fa-list-ul me-2"></i> Pilih Aneka Menu Sendiri
                                </label>
                            </div>
                        </div>

                        <!-- SECTION: PAKET KATERING -->
                        <div id="section_paket">
                            <div class="row g-3">
                                <div class="col-md-7">
                                    <div class="form-floating">
                                        <select class="form-select @error('package_id') is-invalid @enderror" id="package_id" name="package_id">
                                            <option value="" data-price="0" data-min="1">-- Pilih Paket Katering --</option>
                                            @foreach($packages as $pkg)
                                                <option value="{{ $pkg->id }}" data-price="{{ $pkg->price_per_package }}" data-min="{{ $pkg->min_order }}" {{ (old('package_id') == $pkg->id || $selectedPackageId == $pkg->id) ? 'selected' : '' }}>
                                                    {{ $pkg->name }} - Rp {{ number_format($pkg->price_per_package, 0, ',', '.') }} /porsi (Min {{ $pkg->min_order }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="package_id">Paket Katering Pilihan</label>
                                        @error('package_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-floating">
                                        <input type="number" class="form-control @error('package_quantity') is-invalid @enderror" id="package_quantity" name="package_quantity" value="{{ old('package_quantity', 20) }}" min="1" placeholder="Porsi">
                                        <label for="package_quantity">Jumlah Porsi (Box)</label>
                                        @error('package_quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION: CUSTOM MENU -->
                        <div id="section_custom" style="display: none;">
                            <p class="text-white small mb-3">Tentukan jumlah porsi untuk setiap menu yang ingin Anda pesan:</p>
                            <div class="bg-dark border border-secondary p-3 rounded" style="max-height: 300px; overflow-y: auto;">
                                @foreach($menus as $menu)
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
                                        <div class="text-white">
                                            <strong class="d-block">{{ $menu->name }}</strong>
                                            <small class="text-primary">{{ $menu->formatted_price }}</small>
                                        </div>
                                        <div style="width: 120px;">
                                            <input type="hidden" name="menu_ids[]" value="{{ $menu->id }}">
                                            <div class="input-group input-group-sm">
                                                <input type="number" name="menu_quantities[{{ $menu->id }}]" class="form-control custom-menu-qty" data-price="{{ $menu->price }}" min="0" value="0" placeholder="0">
                                                <span class="input-group-text">pax</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Catatan khusus pemesanan" id="notes" name="notes" style="height: 90px">{{ old('notes') }}</textarea>
                                <label for="notes">Catatan Khusus (Misal: request pedas sedang, jam tiba sebelum zuhur, dll)</label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary w-100 py-3 fs-5 fw-bold" type="submit" id="submitOrderBtn">
                                <i class="fa fa-check-circle me-2"></i> Konfirmasi & Kirim Pesanan Katering
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Real-time Order Summary Card -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 p-4 sticky-top" style="top: 100px;">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">
                        <i class="fa fa-calculator text-primary me-2"></i>Ringkasan Perhitungan
                    </h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total Porsi:</span>
                        <strong id="displayTotalQty">0 Box</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal:</span>
                        <strong id="displaySubtotal">Rp 0</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-2" id="rowDiscount" style="display: none !important;">
                        <span class="text-success">Diskon Promo:</span>
                        <strong class="text-success" id="displayDiscount">- Rp 0</strong>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fs-5 fw-bold text-dark">Estimasi Total:</span>
                        <h4 class="text-primary fw-bold mb-0" id="displayFinalTotal">Rp 0</h4>
                    </div>

                    <!-- Auto-bonus Alert Box -->
                    <div id="bonusAlertBox" class="alert alert-warning border border-warning p-3 rounded mb-3" style="display: none;">
                        <h6 class="fw-bold text-dark mb-1"><i class="fa fa-gift text-danger me-1"></i> Selamat! Anda Dapat Bonus:</h6>
                        <small class="text-dark fw-semibold" id="bonusAlertText">Gratis 1 Loyang Bolu Spesial Kedai Agung!</small>
                    </div>

                    <div class="alert alert-light border p-3 small mb-0">
                        <h6 class="fw-bold mb-1"><i class="fa fa-info-circle text-primary me-1"></i> Ketentuan Promo:</h6>
                        <p class="mb-0 text-muted">Pemesanan katering minimal <strong>50 box</strong> otomatis mendapatkan bonus <strong>1 loyang bolu spesial</strong> gratis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        function calculateTotal() {
            let orderType = $('input[name="order_type"]:checked').val();
            let totalQty = 0;
            let subtotal = 0;

            if (orderType === 'catering_paket') {
                let selectedOption = $('#package_id option:selected');
                let price = parseFloat(selectedOption.data('price')) || 0;
                let qty = parseInt($('#package_quantity').val()) || 0;
                totalQty = qty;
                subtotal = price * qty;
            } else {
                $('.custom-menu-qty').each(function() {
                    let qty = parseInt($(this).val()) || 0;
                    let price = parseFloat($(this).data('price')) || 0;
                    if (qty > 0) {
                        totalQty += qty;
                        subtotal += (price * qty);
                    }
                });
            }

            $('#displayTotalQty').text(totalQty + ' Box');
            $('#displaySubtotal').text('Rp ' + subtotal.toLocaleString('id-ID'));
            $('#displayFinalTotal').text('Rp ' + subtotal.toLocaleString('id-ID'));

            // Check auto bonus if totalQty >= 50
            if (totalQty >= 50) {
                $('#bonusAlertBox').slideDown();
                $('#bonusAlertText').text('Gratis 1 Loyang Bolu Panggang Spesial (Pesan ' + totalQty + ' Box)!');
            } else {
                $('#bonusAlertBox').slideUp();
            }
        }

        $('input[name="order_type"]').change(function() {
            if ($(this).val() === 'catering_paket') {
                $('#section_paket').slideDown();
                $('#section_custom').slideUp();
            } else {
                $('#section_paket').slideUp();
                $('#section_custom').slideDown();
            }
            calculateTotal();
        });

        $('#package_id, #package_quantity').on('input change', calculateTotal);
        $('.custom-menu-qty').on('input change', calculateTotal);

        // Run once on load
        calculateTotal();
    });
</script>
@endpush

