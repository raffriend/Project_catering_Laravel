@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('page_title', 'Kategori Menu')

@section('content')
<div class="card border-0 shadow-sm rounded-3 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Daftar Kategori Menu</h5>
            <small class="text-muted">Kelola pengelompokan menu rumah makan & katering CV. Kedai Agung</small>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle me-1"></i> Tambah Kategori
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th>Deskripsi</th>
                    <th>Total Menu</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($category->image)
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="rounded me-3" style="width: 45px; height: 45px; object-fit: cover;">
                                @else
                                    <div class="rounded me-3 bg-light d-flex align-items-center justify-content-center text-muted" style="width: 45px; height: 45px;">
                                        <i class="fa fa-tag"></i>
                                    </div>
                                @endif
                                <div>
                                    <strong class="d-block">{{ $category->name }}</strong>
                                </div>
                            </div>
                        </td>
                        <td><code>{{ $category->slug }}</code></td>
                        <td><small class="text-muted">{{ Str::limit($category->description, 50) ?? '-' }}</small></td>
                        <td>
                            <span class="badge bg-secondary">{{ $category->menus_count }} Menu</span>
                        </td>
                        <td>
                            @if($category->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada kategori. Silakan tambahkan kategori baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

