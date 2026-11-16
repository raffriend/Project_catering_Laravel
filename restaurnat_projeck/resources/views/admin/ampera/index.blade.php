@extends('layouts.admin')

@section('title', 'Kasir Restoran Ampera')

@section('page-title', 'Kasir Ampera (Point of Sales)')

@section('page-actions')
<span class="badge bg-primary fs-6 px-3 py-2">
    <i class="fa fa-cash-register me-1"></i> Mode Kasir Aktif
</span>
@endsection

@section('content')
@if(request('last_order'))
    @php
        $lastOrder = \App\Models\Order::with('items')->find(request('last_order'));
    @endphp
    @if($lastOrder)
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="alert-heading mb-1"><i class="fa fa-check-circle me-2"></i>Transaksi {{ $lastOrder->order_number }} Berhasil!</h5>
                    <p class="mb-0">Total: <strong>{{ $lastOrder->formatted_total }}</strong> | Kembalian: <strong>Rp {{ number_format($lastOrder->change_amount, 0, ',', '.') }}</strong></p>
                </div>
                <div>
                    <a href="{{ route('admin.ampera.receipt', $lastOrder->id) }}" target="_blank" class="btn btn-dark btn-sm me-2">
                        <i class="fa fa-print me-1"></i> Cetak Struk Kasir
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif
@endif

<div class="row g-4">
    <!-- KOLOM KIRI: KATALOG MENU AMPERA -->
    <div class="col-lg-7 col-xl-8">
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-3">
                <!-- Filter Kategori & Pencarian -->
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap gap-1">
                            <a href="{{ route('admin.ampera.index') }}" class="btn btn-sm {{ !request('category_id') ? 'btn-primary' : 'btn-outline-secondary' }}">
                                Semua Menu
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('admin.ampera.index', ['category_id' => $cat->id]) }}" class="btn btn-sm {{ request('category_id') == $cat->id ? 'btn-primary' : 'btn-outline-secondary' }}">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('admin.ampera.index') }}" method="GET" class="d-flex">
                            @if(request('category_id'))
                                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                            @endif
                            <div class="input-group input-group-sm">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama menu..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Grid Menu Item -->
                <div class="row g-3" style="max-height: 650px; overflow-y: auto;">
                    @forelse($menus as $menu)
                        <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                            <div class="card h-100 border rounded-3 shadow-none menu-card text-center p-2" 
                                 onclick="addToCart({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $menu->price }})"
                                 style="cursor: pointer; transition: all 0.2s;">
                                <div class="overflow-hidden rounded-2 mb-2" style="height: 90px;">
                                    <img src="{{ asset($menu->image ?? 'img/menu-1.jpg') }}" alt="{{ $menu->name }}" class="w-100 h-100" style="object-fit: cover;">
                                </div>
                                <h6 class="mb-1 fs-6 text-truncate" title="{{ $menu->name }}">{{ $menu->name }}</h6>
                                <span class="badge bg-light text-muted small mb-1">{{ $menu->category->name ?? 'Menu' }}</span>
                                <div class="fw-bold text-primary">{{ $menu->formatted_price }}</div>
                                <button type="button" class="btn btn-sm btn-outline-primary mt-2 w-100">
                                    <i class="fa fa-plus me-1"></i> Tambah
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="fa fa-utensils fa-3x mb-2"></i>
                            <p>Tidak ada menu yang tersedia untuk kategori ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Transaksi Ampera Terakhir Hari Ini -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="fa fa-history text-secondary me-2"></i>Transaksi Ampera Hari Ini</h6>
                <span class="badge bg-success">{{ $todayCount }} Transaksi | Total: Rp {{ number_format($todayTotalSales, 0, ',', '.') }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 250px;">
                    <table class="table table-sm table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Jam</th>
                                <th>Pelanggan</th>
                                <th>Item Belanja</th>
                                <th>Total</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($todayTransactions as $tx)
                                <tr>
                                    <td><strong>{{ $tx->order_number }}</strong></td>
                                    <td>{{ $tx->created_at->format('H:i') }}</td>
                                    <td>{{ $tx->customer_name }}</td>
                                    <td class="small">
                                        @foreach($tx->items as $it)
                                            <span class="badge bg-light text-dark border">{{ $it->item_name }} ({{ $it->quantity }}x)</span>
                                        @endforeach
                                    </td>
                                    <td class="fw-bold text-primary">{{ $tx->formatted_total }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.ampera.receipt', $tx->id) }}" target="_blank" class="btn btn-sm btn-outline-dark" title="Cetak Struk">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3 text-muted">Belum ada transaksi ampera hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- KOLOM KANAN: KERANJANG KASIR & PEMBAYARAN -->
    <div class="col-lg-5 col-xl-4">
        <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 20px;">
            <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white"><i class="fa fa-shopping-cart text-warning me-2"></i>Keranjang Kasir</h5>
                <button type="button" class="btn btn-sm btn-outline-light" onclick="clearCart()">
                    <i class="fa fa-trash me-1"></i> Reset
                </button>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('admin.ampera.store') }}" method="POST" id="posForm">
                    @csrf

                    <!-- Pilihan Layanan & Pelanggan -->
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold mb-1">Tipe Pesanan</label>
                            <select name="service_type" id="service_type" class="form-select form-select-sm" required>
                                <option value="dine_in" selected>🍽️ Makan di Tempat</option>
                                <option value="take_away">🛍️ Bungkus (Takeaway)</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold mb-1">Nama / No Meja</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control form-control-sm" placeholder="Contoh: Meja 03 / Bpk Andi">
                        </div>
                    </div>

                    <!-- List Keranjang Belanja -->
                    <div class="border rounded p-2 mb-3 bg-light" style="min-height: 180px; max-height: 250px; overflow-y: auto;" id="cartList">
                        <div class="text-center text-muted py-5" id="emptyCartNotice">
                            <i class="fa fa-shopping-basket fa-2x mb-2 text-secondary"></i>
                            <p class="small mb-0">Klik menu di sebelah kiri untuk menambahkan ke keranjang transaksi.</p>
                        </div>
                        <div id="cartItemsContainer"></div>
                    </div>

                    <!-- Ringkasan Finansial -->
                    <div class="bg-light p-3 rounded mb-3 border">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Belanja:</span>
                            <span class="fw-bold fs-5 text-dark" id="displaySubtotal">Rp 0</span>
                            <input type="hidden" name="total_amount" id="total_amount" value="0">
                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold mb-1">Metode Pembayaran <span class="text-danger">*</span></label>
                        <select name="payment_method" id="payment_method" class="form-select form-select-sm mb-2" onchange="togglePaymentInputs()" required>
                            <option value="cash" selected>💵 Tunai (Cash)</option>
                            <option value="qris">📱 QRIS (Scan Barcode)</option>
                            <option value="transfer">🏦 Transfer Bank</option>
                        </select>
                    </div>

                    <!-- Input Tunai & Kembalian -->
                    <div id="cashInputSection">
                        <div class="mb-2">
                            <label class="form-label small fw-bold mb-1">Uang Diterima (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="cash_received" id="cash_received" class="form-control form-control-lg fw-bold text-success" placeholder="0" min="0" oninput="calculateChange()">
                        </div>

                        <!-- Shortcut Uang Pas & Pecahan Cepat -->
                        <div class="d-flex flex-wrap gap-1 mb-3">
                            <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setCashPas()">Uang Pas</button>
                            <button type="button" class="btn btn-xs btn-outline-secondary" onclick="addCash(10000)">+10rb</button>
                            <button type="button" class="btn btn-xs btn-outline-secondary" onclick="addCash(20000)">+20rb</button>
                            <button type="button" class="btn btn-xs btn-outline-secondary" onclick="addCash(50000)">+50rb</button>
                            <button type="button" class="btn btn-xs btn-outline-secondary" onclick="addCash(100000)">+100rb</button>
                        </div>

                        <div class="d-flex justify-content-between align-items-center bg-white p-2 rounded border mb-3">
                            <span class="fw-bold text-muted small">Kembalian:</span>
                            <span class="fw-bold fs-5 text-danger" id="displayChange">Rp 0</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="notes" class="form-control form-control-sm" placeholder="Catatan transaksi (opsional)">
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 py-3 fw-bold shadow-sm" id="btnSubmitPos" disabled>
                        <i class="fa fa-check-circle me-2"></i> Bayar & Cetak Struk
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .menu-card:hover {
        border-color: #FEA116 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.08) !important;
    }
    .btn-xs {
        padding: 0.15rem 0.5rem;
        font-size: 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script>
    let cart = {};

    function addToCart(id, name, price) {
        if (cart[id]) {
            cart[id].qty += 1;
        } else {
            cart[id] = {
                id: id,
                name: name,
                price: price,
                qty: 1
            };
        }
        renderCart();
    }

    function updateQty(id, delta) {
        if (cart[id]) {
            cart[id].qty += delta;
            if (cart[id].qty <= 0) {
                delete cart[id];
            }
        }
        renderCart();
    }

    function removeFromCart(id) {
        if (cart[id]) {
            delete cart[id];
        }
        renderCart();
    }

    function clearCart() {
        cart = {};
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cartItemsContainer');
        const emptyNotice = document.getElementById('emptyCartNotice');
        const displaySubtotal = document.getElementById('displaySubtotal');
        const totalAmountInput = document.getElementById('total_amount');
        const btnSubmit = document.getElementById('btnSubmitPos');

        container.innerHTML = '';
        let total = 0;
        let count = 0;

        for (const id in cart) {
            count++;
            const item = cart[id];
            const itemSubtotal = item.price * item.qty;
            total += itemSubtotal;

            const div = document.createElement('div');
            div.className = 'd-flex justify-content-between align-items-center mb-2 pb-2 border-bottom';
            div.innerHTML = `
                <div class="flex-grow-1 me-2 text-truncate">
                    <strong class="d-block small text-truncate">${item.name}</strong>
                    <small class="text-muted">Rp ${item.price.toLocaleString('id-ID')} x ${item.qty}</small>
                    <input type="hidden" name="items[${count}][menu_id]" value="${item.id}">
                    <input type="hidden" name="items[${count}][quantity]" value="${item.qty}">
                </div>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-2 py-0 me-1" onclick="updateQty(${item.id}, -1)">-</button>
                    <span class="fw-bold px-1 small">${item.qty}</span>
                    <button type="button" class="btn btn-outline-secondary btn-sm px-2 py-0 me-2" onclick="updateQty(${item.id}, 1)">+</button>
                    <span class="fw-bold text-dark small me-2" style="min-width: 65px; text-align: right;">Rp ${itemSubtotal.toLocaleString('id-ID')}</span>
                    <button type="button" class="btn btn-link text-danger p-0" onclick="removeFromCart(${item.id})"><i class="fa fa-times"></i></button>
                </div>
            `;
            container.appendChild(div);
        }

        if (count === 0) {
            emptyNotice.style.display = 'block';
            btnSubmit.disabled = true;
        } else {
            emptyNotice.style.display = 'none';
            btnSubmit.disabled = false;
        }

        displaySubtotal.innerText = 'Rp ' + total.toLocaleString('id-ID');
        totalAmountInput.value = total;

        calculateChange();
    }

    function togglePaymentInputs() {
        const method = document.getElementById('payment_method').value;
        const cashSection = document.getElementById('cashInputSection');
        if (method === 'cash') {
            cashSection.style.display = 'block';
        } else {
            cashSection.style.display = 'none';
        }
        calculateChange();
    }

    function calculateChange() {
        const method = document.getElementById('payment_method').value;
        const total = parseFloat(document.getElementById('total_amount').value) || 0;
        const cashInput = document.getElementById('cash_received');
        const displayChange = document.getElementById('displayChange');

        if (method !== 'cash') {
            displayChange.innerText = 'Rp 0';
            return;
        }

        const received = parseFloat(cashInput.value) || 0;
        const change = received - total;

        if (change >= 0) {
            displayChange.className = 'fw-bold fs-5 text-success';
            displayChange.innerText = 'Rp ' + change.toLocaleString('id-ID');
        } else {
            displayChange.className = 'fw-bold fs-5 text-danger';
            displayChange.innerText = '- Rp ' + Math.abs(change).toLocaleString('id-ID');
        }
    }

    function setCashPas() {
        const total = parseFloat(document.getElementById('total_amount').value) || 0;
        document.getElementById('cash_received').value = total;
        calculateChange();
    }

    function addCash(amount) {
        let current = parseFloat(document.getElementById('cash_received').value) || 0;
        document.getElementById('cash_received').value = current + amount;
        calculateChange();
    }
</script>
@endpush

