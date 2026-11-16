@extends('layouts.public')

@section('title', 'Dashboard Pelanggan')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Dashboard Pelanggan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Dashboard Saya</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <!-- Sambutan & Ringkasan Akun -->
        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <h3 class="mb-1 text-dark">Halo, <span class="text-primary">{{ $user->name }}</span>! 👋</h3>
                <p class="text-muted mb-0">Selamat datang di portal pelanggan CV. Kedai Agung. Kelola pesanan katering dan ulasan Anda di sini.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('order.form') }}" class="btn btn-primary py-2 px-4 shadow-sm">
                    <i class="fa fa-plus-circle me-1"></i> Pesan Katering Baru
                </a>
            </div>
        </div>

        <!-- 4 Statistik Cepat -->
        <div class="row g-3 mb-5">
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-light text-center h-100">
                    <div class="text-primary mb-2">
                        <i class="fa fa-3x fa-shopping-bag"></i>
                    </div>
                    <h2 class="fw-bold mb-0 text-dark">{{ $totalOrders }}</h2>
                    <span class="text-muted small">Total Pesanan Katering</span>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-light text-center h-100">
                    <div class="text-warning mb-2">
                        <i class="fa fa-3x fa-clock"></i>
                    </div>
                    <h2 class="fw-bold mb-0 text-dark">{{ $processingOrders }}</h2>
                    <span class="text-muted small">Pesanan Dalam Proses</span>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-light text-center h-100">
                    <div class="text-success mb-2">
                        <i class="fa fa-3x fa-check-circle"></i>
                    </div>
                    <h2 class="fw-bold mb-0 text-dark">{{ $completedOrders }}</h2>
                    <span class="text-muted small">Pesanan Selesai</span>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-light text-center h-100">
                    <div class="text-danger mb-2">
                        <i class="fa fa-3x fa-wallet"></i>
                    </div>
                    <h2 class="fw-bold mb-0 text-dark">{{ $unpaidOrders }}</h2>
                    <span class="text-muted small">Menunggu Pelunasan</span>
                </div>
            </div>
        </div>

        <!-- Nav Tabs -->
        <ul class="nav nav-pills nav-fill mb-4 border rounded p-2 bg-light shadow-sm" id="customerTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold py-3" id="orders-tab" data-bs-toggle="pill" data-bs-target="#orders" type="button" role="tab">
                    <i class="fa fa-box me-2"></i> Riwayat & Status Pesanan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold py-3" id="testimonial-tab" data-bs-toggle="pill" data-bs-target="#testimonial" type="button" role="tab">
                    <i class="fa fa-star me-2 text-warning"></i> Testimoni & Ulasan Anda
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold py-3" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab">
                    <i class="fa fa-user-edit me-2"></i> Data Profil & Alamat
                </button>
            </li>
        </ul>

        <div class="tab-content" id="customerTabContent">
            <!-- TAB 1: RIWAYAT & STATUS PESANAN -->
            <div class="tab-pane fade show active" id="orders" role="tabpanel">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold"><i class="fa fa-list text-primary me-2"></i>Daftar Pesanan Katering Anda</h5>
                        <span class="badge bg-primary">{{ $orders->total() }} Pesanan</span>
                    </div>
                    <div class="card-body p-0">
                        @if($orders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No. Pesanan</th>
                                            <th>Tgl Pengiriman</th>
                                            <th>Menu / Paket</th>
                                            <th>Total Tagihan</th>
                                            <th>Status Pesanan</th>
                                            <th>Pembayaran</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $ord)
                                            <tr>
                                                <td>
                                                    <strong class="text-primary">{{ $ord->order_number }}</strong>
                                                    <div class="text-muted small">{{ $ord->created_at->format('d M Y, H:i') }}</div>
                                                    @if($ord->bonus_info)
                                                        <span class="badge bg-warning text-dark mt-1">
                                                            <i class="fa fa-gift me-1"></i>{{ $ord->bonus_info }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="fw-bold">{{ $ord->delivery_date ? $ord->delivery_date->format('d M Y') : '-' }}</div>
                                                    <small class="text-muted"><i class="fa fa-clock me-1"></i>{{ $ord->delivery_time ?? '-' }} WIB</small>
                                                    <div class="small text-muted text-truncate" style="max-width: 180px;">
                                                        <i class="fa fa-map-marker-alt text-danger me-1"></i>{{ $ord->delivery_address }}
                                                    </div>
                                                </td>
                                                <td>
                                                    @foreach($ord->items as $item)
                                                        <div class="small">
                                                            • <strong>{{ $item->item_name }}</strong> ({{ $item->quantity }}x)
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="fw-bold text-dark">{{ $ord->formatted_total }}</div>
                                                    @if($ord->payment_status !== 'lunas')
                                                        <small class="text-danger d-block">
                                                            Sisa: {{ $ord->formatted_remaining }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    {!! $ord->status_badge !!}
                                                </td>
                                                <td>
                                                    {!! $ord->payment_status_badge !!}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group-vertical btn-group-sm">
                                                        <a href="{{ route('order.summary', $ord->order_number) }}" class="btn btn-outline-primary mb-1">
                                                            <i class="fa fa-receipt me-1"></i> Nota / Invoice
                                                        </a>
                                                        <a href="{{ route('order.tracking', ['order_number' => $ord->order_number]) }}" class="btn btn-outline-info mb-1">
                                                            <i class="fa fa-truck me-1"></i> Lacak Status
                                                        </a>
                                                        @if($ord->payment_status !== 'lunas')
                                                            <button type="button" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#payModal{{ $ord->id }}">
                                                                <i class="fa fa-wallet me-1"></i> Lunasi / Bayar
                                                            </button>
                                                        @endif
                                                    </div>

                                                    <!-- Modal Pelunasan Pembayaran -->
                                                    @if($ord->payment_status !== 'lunas')
                                                        <div class="modal fade" id="payModal{{ $ord->id }}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered text-start">
                                                                <div class="modal-content">
                                                                    <form action="{{ route('customer.order.pay', $ord->id) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="modal-header bg-dark text-white">
                                                                            <h5 class="modal-title text-white">
                                                                                <i class="fa fa-wallet text-warning me-2"></i>Pelunasan / Bayar Pesanan
                                                                            </h5>
                                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="alert alert-light border small mb-3">
                                                                                <div><strong>No. Pesanan:</strong> {{ $ord->order_number }}</div>
                                                                                <div><strong>Total Tagihan:</strong> {{ $ord->formatted_total }}</div>
                                                                                <div class="text-danger"><strong>Sisa Belum Lunas:</strong> {{ $ord->formatted_remaining }}</div>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Jenis Pembayaran <span class="text-danger">*</span></label>
                                                                                <select name="payment_type" class="form-select" required>
                                                                                    <option value="pelunasan" selected>Pelunasan Sisa Tagihan</option>
                                                                                    <option value="dp">Uang Muka (DP)</option>
                                                                                    <option value="full">Pembayaran Penuh (Full)</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Nominal yang Dibayarkan (Rp) <span class="text-danger">*</span></label>
                                                                                <input type="number" name="amount" class="form-control" value="{{ (int)$ord->remainingPayment() }}" min="1" required>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Metode Pembayaran <span class="text-danger">*</span></label>
                                                                                <select name="payment_method" class="form-select" required>
                                                                                    <option value="transfer">Transfer Bank (BCA / Mandiri / BRI)</option>
                                                                                    <option value="qris">QRIS (GoPay, OVO, Dana, ShopeePay)</option>
                                                                                    <option value="cash">Tunai / Bayar di Tempat (COD)</option>
                                                                                </select>
                                                                                <div class="small text-muted mt-1">
                                                                                    Rekening Transfer: <strong>BCA 123-456-7890</strong> a.n CV. Kedai Agung
                                                                                </div>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Upload Bukti Transfer / Struk <span class="text-danger">*</span></label>
                                                                                <input type="file" name="proof_image" class="form-control" accept="image/*" required>
                                                                                <small class="text-muted">Format: JPG, PNG, JPEG (Maks. 3MB)</small>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label class="form-label">Catatan Tambahan (Opsional)</label>
                                                                                <textarea name="notes" class="form-control" rows="2" placeholder="Contoh: Transfer via m-BCA atas nama Budi"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-success text-white">
                                                                                <i class="fa fa-upload me-1"></i> Kirim Bukti Pembayaran
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-3">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fa fa-box-open fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">Anda belum memiliki pesanan katering</h5>
                                <p class="text-muted small">Pesan katering lezat untuk acara kantor, syukuran, atau makan siang Anda sekarang juga.</p>
                                <a href="{{ route('order.form') }}" class="btn btn-primary py-2 px-4 mt-2">
                                    <i class="fa fa-shopping-cart me-2"></i>Pesan Katering Sekarang
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- TAB 2: TESTIMONI & ULASAN PELANGGAN -->
            <div class="tab-pane fade" id="testimonial" role="tabpanel">
                <div class="row g-4">
                    <!-- Form Kirim Testimoni -->
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-dark text-white py-3">
                                <h5 class="mb-0 text-white"><i class="fa fa-pen text-warning me-2"></i>Tulis Ulasan & Testimoni</h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="text-muted small mb-3">Bagikan pengalaman Anda menikmati hidangan & layanan CV. Kedai Agung. Ulasan Anda akan ditampilkan di halaman utama website kami!</p>

                                <form action="{{ route('customer.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Penilaian Bintang <span class="text-danger">*</span></label>
                                        <select name="rating" class="form-select form-select-lg text-warning fw-bold" required>
                                            <option value="5" selected>⭐⭐⭐⭐⭐ (5/5) Sangat Puas</option>
                                            <option value="4">⭐⭐⭐⭐ (4/5) Puas</option>
                                            <option value="3">⭐⭐⭐ (3/5) Cukup</option>
                                            <option value="2">⭐⭐ (2/5) Kurang</option>
                                            <option value="1">⭐ (1/5) Sangat Kurang</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Profesi / Keterangan Pemesan</label>
                                        <input type="text" name="customer_title" class="form-control" placeholder="Contoh: Katering Kantor PT. ABC / Ibu Rumah Tangga">
                                        <small class="text-muted">Akan ditampilkan di bawah nama Anda</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Pesan Ulasan / Pengalaman Anda <span class="text-danger">*</span></label>
                                        <textarea name="comment" class="form-control" rows="4" placeholder="Ceritakan kepuasan Anda mengenai rasa masakan, porsi, ketepatan waktu pengiriman, atau bonus bolunya..." required minlength="10"></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Foto Anda / Foto Makanan (Opsional)</label>
                                        <input type="file" name="photo" class="form-control" accept="image/*">
                                        <small class="text-muted">Maksimal ukuran foto 2MB</small>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-3">
                                        <i class="fa fa-paper-plane me-2"></i>Kirim Testimoni Saya
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Testimoni yang Pernah Dikirim -->
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 fw-bold"><i class="fa fa-comments text-primary me-2"></i>Ulasan Anda Sebelumnya</h5>
                            </div>
                            <div class="card-body p-4">
                                @if($myTestimonials->count() > 0)
                                    @foreach($myTestimonials as $testi)
                                        <div class="border rounded-3 p-3 mb-3 bg-light position-relative">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <div class="fs-5">{!! $testi->stars_html !!}</div>
                                                    <strong class="d-block text-dark">{{ $testi->customer_name }}</strong>
                                                    <small class="text-muted">{{ $testi->customer_title }}</small>
                                                </div>
                                                <form action="{{ route('customer.testimonial.destroy', $testi->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus Testimoni">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <p class="text-muted mb-2 fst-italic">"{{ $testi->comment }}"</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">{{ $testi->created_at->format('d M Y, H:i') }}</small>
                                                <span class="badge bg-success"><i class="fa fa-check me-1"></i>Ditampilkan di Website</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-4 text-muted">
                                        <i class="fa fa-comment-dots fa-3x mb-3 text-secondary"></i>
                                        <h6>Belum ada ulasan yang Anda kirimkan.</h6>
                                        <p class="small">Tuliskan pengalaman Anda pada formulir di sebelah kiri untuk membantu kami terus menyajikan yang terbaik!</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: PROFIL & ALAMAT PENGIRIMAN -->
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 fw-bold"><i class="fa fa-user text-primary me-2"></i>Perbarui Data Diri & Alamat Pengiriman</h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('customer.profile.update') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Email (Tidak dapat diubah)</label>
                                            <input type="email" class="form-control bg-light" value="{{ $user->email }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Nomor HP / WhatsApp <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Alamat Utama Pengiriman Katering <span class="text-danger">*</span></label>
                                        <textarea name="address" class="form-control" rows="3" required>{{ old('address', $user->address) }}</textarea>
                                        <small class="text-muted">Alamat ini otomatis terisi saat Anda mengisi form pemesanan katering.</small>
                                    </div>

                                    <hr class="my-4">
                                    <h6 class="fw-bold mb-3"><i class="fa fa-lock text-primary me-2"></i>Ganti Kata Sandi (Kosongkan jika tidak ingin diubah)</h6>

                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Password Baru</label>
                                            <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Konfirmasi Password Baru</label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        <i class="fa fa-save me-2"></i>Simpan Perubahan Profil
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Tab switching if hash is present
    document.addEventListener("DOMContentLoaded", function() {
        if (window.location.hash) {
            let hash = window.location.hash;
            if (hash === '#testimoni') {
                let tabTrigger = new bootstrap.Tab(document.querySelector('#testimonial-tab'));
                tabTrigger.show();
            } else if (hash === '#profil') {
                let tabTrigger = new bootstrap.Tab(document.querySelector('#profile-tab'));
                tabTrigger.show();
            }
        }
    });
</script>
@endpush

