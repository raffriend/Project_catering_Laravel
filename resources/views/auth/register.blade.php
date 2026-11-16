@extends('layouts.public')

@section('title', 'Daftar Akun Baru')

@section('hero')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Daftar Akun</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Registrasi</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-sm-5">
                        <div class="text-center mb-4">
                            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Daftar Pelanggan</h5>
                            <h3 class="mb-2">Buat Akun CV. Kedai Agung</h3>
                            <p class="text-muted small">Daftar untuk memudahkan pemesanan katering dan pelacakan pesanan Anda</p>
                        </div>

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus>
                                <label for="name"><i class="fa fa-user text-primary me-2"></i>Nama Lengkap</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                                        <label for="email"><i class="fa fa-envelope text-primary me-2"></i>Email</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>
                                        <label for="phone"><i class="fa fa-phone text-primary me-2"></i>No. HP / WhatsApp</label>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Alamat Pengiriman" style="height: 90px" required>{{ old('address') }}</textarea>
                                <label for="address"><i class="fa fa-map-marker-alt text-primary me-2"></i>Alamat Lengkap (Domisili / Kantor)</label>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-2 mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                                        <label for="password"><i class="fa fa-lock text-primary me-2"></i>Kata Sandi</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password" required>
                                        <label for="password_confirmation"><i class="fa fa-shield-alt text-primary me-2"></i>Ulangi Sandi</label>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 py-3 mb-3" type="submit">
                                <i class="fa fa-user-plus me-2"></i> Daftar Sekarang
                            </button>

                            <div class="text-center mt-3">
                                <span class="text-muted small">Sudah memiliki akun?</span>
                                <a href="{{ route('login') }}" class="fw-bold text-primary small">Masuk di sini</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

