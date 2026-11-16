@extends('layouts.admin')

@section('title', 'Ubah / Koreksi Pesanan ' . $order->order_number)

@section('page-title')
Ubah / Koreksi Pesanan <span class="text-primary">{{ $order->order_number }}</span>
@endsection

@section('page-actions')
<a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm">
    <i class="fa fa-arrow-left me-1"></i> Kembali ke Detail
</a>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold"><i class="fa fa-edit text-warning me-2"></i>Formulir Koreksi & Ubah Pesanan</h5>
            <span class="badge {{ $order->isAmpera() ? 'bg-dark' : 'bg-primary' }}">
                Tipe: {{ $order->order_type }}
            </span>
        </div>
        <p class="text-muted small mb-0 mt-1">Gunakan formulir ini jika terdapat perubahan pesanan, kesalahan jumlah porsi, koreksi menu, atau penyesuaian alamat kirim dari pelanggan.</p>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" id="editOrderForm">
            @csrf
            @method('PUT')

            <!-- Data Pemesan & Pengiriman -->
            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa fa-user me-2 text-primary"></i>1. Data Pemesan & Pengiriman</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Pemesan <span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', $order->customer_name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nomor HP / WhatsApp <span class="text-danger">*</span></label>
                    <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone', $order->customer_phone) }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Alamat Pengiriman</label>
                    <textarea name="delivery_address" class="form-control" rows="2">{{ old('delivery_address', $order->delivery_address) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tanggal Pengiriman</label>
                    <input type="date" name="delivery_date" class="form-control" value="{{ old('delivery_date', $order->delivery_date?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jam Pengiriman</label>
                    <input type="time" name="delivery_time" class="form-control" value="{{ old('delivery_time', $order->delivery_time) }}">
                </div>
            </div>

            <!-- Status Pesanan & Pembayaran -->
            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa fa-toggle-on me-2 text-primary"></i>2. Status Pesanan & Pembayaran</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Status Pesanan <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="masuk" {{ old('status', $order->status) === 'masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="dikonfirmasi" {{ old('status', $order->status) === 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="diproses" {{ old('status', $order->status) === 'diproses' ? 'selected' : '' }}>Diproses (Sedang Dimasak)</option>
                        <option value="dikirim" {{ old('status', $order->status) === 'dikirim' ? 'selected' : '' }}>Dikirim (Dalam Perjalanan)</option>
                        <option value="selesai" {{ old('status', $order->status) === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ old('status', $order->status) === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Status Pembayaran <span class="text-danger">*</span></label>
                    <select name="payment_status" class="form-select" required>
                        <option value="belum_bayar" {{ old('payment_status', $order->payment_status) === 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="dp" {{ old('payment_status', $order->payment_status) === 'dp' ? 'selected' : '' }}>DP (Uang Muka)</option>
                        <option value="lunas" {{ old('payment_status', $order->payment_status) === 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Catatan Khusus Pesanan</label>
                    <textarea name="notes" class="form-control" rows="2" placeholder="Catatan selera rasa, pedas/tidak, dll">{{ old('notes', $order->notes) }}</textarea>
                </div>
            </div>

            <!-- Daftar Item Pesanan -->
            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa fa-utensils me-2 text-primary"></i>3. Rincian Item Menu & Paket</h6>

            <div class="table-responsive mb-3">
                <table class="table table-bordered align-middle" id="itemsTable">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Item / Menu / Paket</th>
                            <th style="width: 180px;">Harga Satuan (Rp)</th>
                            <th style="width: 120px;">Jumlah (Qty)</th>
                            <th style="width: 180px;">Subtotal (Rp)</th>
                            <th style="width: 60px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="itemsTableBody">
                        @foreach($order->items as $idx => $item)
                            <tr id="row_{{ $idx }}">
                                <td>
                                    <input type="text" name="items[{{ $idx }}][item_name]" class="form-control form-control-sm fw-bold" value="{{ $item->item_name }}" required>
                                    <input type="hidden" name="items[{{ $idx }}][menu_id]" value="{{ $item->menu_id }}">
                                    <input type="hidden" name="items[{{ $idx }}][catering_package_id]" value="{{ $item->catering_package_id }}">
                                </td>
                                <td>
                                    <input type="number" name="items[{{ $idx }}][unit_price]" class="form-control form-control-sm text-end unit-price-input" value="{{ (int)$item->unit_price }}" oninput="recalcRow({{ $idx }})" required>
                                </td>
                                <td>
                                    <input type="number" name="items[{{ $idx }}][quantity]" class="form-control form-control-sm text-center qty-input" value="{{ $item->quantity }}" min="1" oninput="recalcRow({{ $idx }})" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm text-end bg-light fw-bold row-subtotal" id="subtotal_{{ $idx }}" value="Rp {{ number_format($item->subtotal, 0, ',', '.') }}" readonly>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeRow({{ $idx }})" title="Hapus Item">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tombol Tambah Item -->
            <div class="d-flex flex-wrap gap-2 mb-4">
                <div class="dropdown">
                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fa fa-plus me-1"></i> Tambah Menu Masakan
                    </button>
                    <ul class="dropdown-menu shadow" style="max-height: 250px; overflow-y: auto;">
                        @foreach($menus as $m)
                            <li>
                                <a class="dropdown-item small" href="javascript:void(0)" onclick="addItemRow('{{ addslashes($m->name) }}', {{ $m->price }}, {{ $m->id }}, null)">
                                    {{ $m->name }} - Rp {{ number_format($m->price, 0, ',', '.') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn btn-outline-success btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fa fa-box-open me-1"></i> Tambah Paket Katering
                    </button>
                    <ul class="dropdown-menu shadow" style="max-height: 250px; overflow-y: auto;">
                        @foreach($packages as $p)
                            <li>
                                <a class="dropdown-item small" href="javascript:void(0)" onclick="addItemRow('{{ addslashes($p->name) }}', {{ $p->price_per_package }}, null, {{ $p->id }})">
                                    {{ $p->name }} - Rp {{ number_format($p->price_per_package, 0, ',', '.') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Ringkasan Total & Diskon -->
            <div class="bg-light p-3 rounded-3 border mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="text-muted small">Promo / Bonus Otomatis:</div>
                        <div class="fw-bold text-warning" id="promoBonusPreview">
                            @if($order->total_amount >= 50 || $order->items->sum('quantity') >= 50)
                                🎁 Gratis 1 Loyang Bolu Panggang Lembut (Promo >= 50 Box)
                            @else
                                <span class="text-muted fw-normal">Tidak ada bonus promo</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="text-muted small">Total Tagihan Baru:</div>
                        <h3 class="fw-bold text-primary mb-0" id="totalPreview">
                            {{ $order->formatted_total }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary px-4">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary px-4 fw-bold">
                    <i class="fa fa-save me-1"></i> Simpan Perubahan Pesanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let rowIndex = {{ $order->items->count() }};

    function recalcRow(idx) {
        const row = document.getElementById('row_' + idx);
        if (!row) return;

        const price = parseFloat(row.querySelector('.unit-price-input').value) || 0;
        const qty = parseInt(row.querySelector('.qty-input').value) || 0;
        const lineTotal = price * qty;

        document.getElementById('subtotal_' + idx).value = 'Rp ' + lineTotal.toLocaleString('id-ID');
        recalcGrandTotal();
    }

    function removeRow(idx) {
        const row = document.getElementById('row_' + idx);
        if (row) {
            row.remove();
            recalcGrandTotal();
        }
    }

    function addItemRow(name, price, menuId, packageId) {
        rowIndex++;
        const tbody = document.getElementById('itemsTableBody');
        const tr = document.createElement('tr');
        tr.id = 'row_' + rowIndex;
        tr.innerHTML = `
            <td>
                <input type="text" name="items[${rowIndex}][item_name]" class="form-control form-control-sm fw-bold" value="${name}" required>
                <input type="hidden" name="items[${rowIndex}][menu_id]" value="${menuId || ''}">
                <input type="hidden" name="items[${rowIndex}][catering_package_id]" value="${packageId || ''}">
            </td>
            <td>
                <input type="number" name="items[${rowIndex}][unit_price]" class="form-control form-control-sm text-end unit-price-input" value="${price}" oninput="recalcRow(${rowIndex})" required>
            </td>
            <td>
                <input type="number" name="items[${rowIndex}][quantity]" class="form-control form-control-sm text-center qty-input" value="1" min="1" oninput="recalcRow(${rowIndex})" required>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm text-end bg-light fw-bold row-subtotal" id="subtotal_${rowIndex}" value="Rp ${price.toLocaleString('id-ID')}" readonly>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeRow(${rowIndex})" title="Hapus Item">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
        recalcGrandTotal();
    }

    function recalcGrandTotal() {
        let total = 0;
        let totalQty = 0;

        const rows = document.querySelectorAll('#itemsTableBody tr');
        rows.forEach(r => {
            const price = parseFloat(r.querySelector('.unit-price-input').value) || 0;
            const qty = parseInt(r.querySelector('.qty-input').value) || 0;
            total += (price * qty);
            totalQty += qty;
        });

        document.getElementById('totalPreview').innerText = 'Rp ' + total.toLocaleString('id-ID');

        const promoPreview = document.getElementById('promoBonusPreview');
        if (totalQty >= 50) {
            promoPreview.innerHTML = '🎁 Gratis 1 Loyang Bolu Panggang Lembut (Promo >= 50 Box)';
        } else {
            promoPreview.innerHTML = '<span class="text-muted fw-normal">Tidak ada bonus promo</span>';
        }
    }
</script>
@endpush

