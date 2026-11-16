<?php

use App\Http\Controllers\Admin\AmperaController as AdminAmperaController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CateringPackageController as AdminPackageController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DailyMenuController as AdminDailyMenuController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\MenuController as PublicMenuController;
use App\Http\Controllers\Public\OrderController as PublicOrderController;
use App\Http\Controllers\Public\OrderTrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Pelanggan & Tamu)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/menu', [PublicMenuController::class, 'index'])->name('menu');
Route::get('/katering', [HomeController::class, 'catering'])->name('catering');
Route::get('/promo', [HomeController::class, 'promo'])->name('promo');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

// Pemesanan (Otomatis diarahkan login jika belum punya akun)
Route::get('/pesan-katering', [PublicOrderController::class, 'showForm'])->name('order.form');
Route::post('/pesan-katering', [PublicOrderController::class, 'submitOrder'])->name('order.submit');
Route::get('/pesanan/{order_number}', [PublicOrderController::class, 'summary'])->name('order.summary');

// Lacak Pesanan (Khusus pengguna login)
Route::get('/lacak-pesanan', [OrderTrackingController::class, 'index'])->name('order.tracking');
Route::post('/lacak-pesanan/{order_number}/upload-pembayaran', [OrderTrackingController::class, 'uploadPayment'])->name('order.payment.upload');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Customer Protected Routes (Dashboard Pelanggan & Testimoni)
|--------------------------------------------------------------------------
*/
Route::prefix('customer')->as('customer.')->middleware(['auth', 'customer'])->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
    Route::post('/profile', [CustomerDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/testimonial', [CustomerDashboardController::class, 'storeTestimonial'])->name('testimonial.store');
    Route::delete('/testimonial/{testimonial}', [CustomerDashboardController::class, 'destroyTestimonial'])->name('testimonial.destroy');
    Route::post('/orders/{order}/pay', [CustomerDashboardController::class, 'payOrder'])->name('order.pay');
});

/*
|--------------------------------------------------------------------------
| Manager / Admin Protected Routes (Pemilik & Kasir)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Modul Kasir Restoran Ampera (POS Offline)
    Route::get('/ampera', [AdminAmperaController::class, 'index'])->name('ampera.index');
    Route::post('/ampera', [AdminAmperaController::class, 'store'])->name('ampera.store');
    Route::get('/ampera/{order}/receipt', [AdminAmperaController::class, 'receipt'])->name('ampera.receipt');

    // Modul Menu & Kategori
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('menus', AdminMenuController::class);
    Route::resource('daily-menus', AdminDailyMenuController::class)->only(['index', 'store', 'destroy']);
    Route::resource('packages', AdminPackageController::class);

    // Modul Pesanan (Bisa mengubah pesanan jika ada kesalahan)
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::get('/orders/{order}/invoice', [AdminOrderController::class, 'invoice'])->name('orders.invoice');

    // Modul Pembayaran & Pelunasan
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [AdminPaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{payment}/verify', [AdminPaymentController::class, 'verify'])->name('payments.verify');

    // Modul Pelanggan & Promo
    Route::resource('customers', AdminCustomerController::class);
    Route::resource('promotions', AdminPromotionController::class);

    // Modul Laporan Penjualan (HANYA UNTUK PEMILIK, KASIR DIBLOKIR)
    Route::middleware('owner')->group(function () {
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    });
});
