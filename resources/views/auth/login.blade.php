@extends('layouts.public')

@section('title', 'Masuk ke Akun')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Masuk</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Login</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-sm-5">
                        <div class="text-center mb-4">
                            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Selamat Datang</h5>
                            <h3 class="mb-2">Masuk ke Akun Anda</h3>
                            <p class="text-muted small">Kelola pesanan katering & transaksi Anda di CV. Kedai Agung</p>
                        </div>

                        @if(session('info'))
                            <div class="alert alert-info alert-dismissible fade show small mb-3" role="alert">
                                <i class="fa fa-info-circle me-1"></i> {{ session('info') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                                <label for="email"><i class="fa fa-envelope text-primary me-2"></i>Alamat Email</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                                <label for="password"><i class="fa fa-lock text-primary me-2"></i>Kata Sandi</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="remember">
                                        Ingat Saya
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 py-3 mb-3" type="submit">
                                <i class="fa fa-sign-in-alt me-2"></i> Masuk Sekarang
                            </button>

                            <div class="text-center mt-3">
                                <span class="text-muted small">Belum memiliki akun?</span>
                                <a href="{{ route('register') }}" class="fw-bold text-primary small">Daftar di sini</a>
                            </div>

                            <div class="alert alert-light border mt-4 mb-0 small">
                                <strong><i class="fa fa-key text-primary me-1"></i> Akun Pengujian:</strong>
                                <ul class="list-unstyled mb-0 mt-2">
                                    <li class="mb-1"><span class="badge bg-warning text-dark me-1">Pemilik</span> <code>pemilik@kedaiagung.com</code> / <code>admin123</code></li>
                                    <li class="mb-1"><span class="badge bg-info text-dark me-1">Kasir</span> <code>kasir@kedaiagung.com</code> / <code>kasir123</code></li>
                                    <li><span class="badge bg-secondary me-1">Pelanggan</span> <code>pelanggan@gmail.com</code> / <code>pelanggan123</code></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
