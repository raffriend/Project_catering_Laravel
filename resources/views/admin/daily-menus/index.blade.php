@extends('layouts.admin')

@section('title', 'Menu Harian')
@section('page_title', 'Kelola Menu Harian (Ampera)')

@section('content')
<div class="row g-4">
    <!-- Form Tambah Menu Harian -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <h5 class="fw-bold mb-3"><i class="fa fa-plus-circle text-primary me-2"></i>Jadwalkan Menu Harian</h5>
            <form action="{{ route('admin.daily-menus.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Menu Makanan <span class="text-danger">*</span></label>
                    <select name="menu_id" class="form-select @error('menu_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Menu --</option>
                        @foreach($menus as $m)
                            <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->formatted_price }})</option>
                        @endforeach
                    </select>
                    @error('menu_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Hari Tayang / Jadwal <span class="text-danger">*</span></label>
                    <select name="day_of_week" class="form-select @error('day_of_week') is-invalid @enderror" required>
                        <option value="Setiap Hari">Setiap Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Catatan Waktu Saji</label>
                    <input type="text" name="notes" class="form-control" placeholder="Contoh: Mulai siap pukul 08.00">
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                    <label class="form-check-label fw-bold" for="is_active">Aktifkan Menu Harian</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">
                    <i class="fa fa-calendar-check me-1"></i> Tambahkan ke Menu Harian
                </button>
            </form>
        </div>
    </div>

    <!-- Table Daftar Menu Harian -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <h5 class="fw-bold mb-3"><i class="fa fa-calendar-day text-primary me-2"></i>Daftar Jadwal Menu Harian</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Menu</th>
                            <th>Kategori</th>
                            <th>Hari</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 80px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dailyMenus as $daily)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($daily->menu->image ?? 'img/menu-1.jpg') }}" alt="" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        <strong>{{ $daily->menu->name ?? '-' }}</strong>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark border">{{ $daily->menu->category->name ?? '-' }}</span></td>
                                <td><span class="badge bg-primary">{{ $daily->day_of_week }}</span></td>
                                <td><strong class="text-success">{{ $daily->menu->formatted_price ?? '-' }}</strong></td>
                                <td>
                                    @if($daily->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.daily-menus.destroy', $daily->id) }}" method="POST" onsubmit="return confirm('Hapus menu harian ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Belum ada menu yang dijadwalkan sebagai menu harian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $dailyMenus->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

