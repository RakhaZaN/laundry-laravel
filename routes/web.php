<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PublicController::class, 'index']);

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
    'middleware' => 'guest'
], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register/store', [AuthController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::get('/', function () {
        return view('menu.admin');
    })->name('menu');

    Route::resource('/users', UserController::class)->name('as', 'users');
    Route::resource('/layanan', LayananController::class)->name('as', 'layanan')->except('show');
    Route::resource('/reviews', ReviewController::class)->name('as', 'reviews')->only(['index', 'destroy']);
    Route::resource('/laporan', LaporanController::class)->name('as', 'laporan')->only(['index', 'store', 'destroy']);
    // Route::get('/laporan/pesanan', [LaporanController::class, 'pesanan'])->name('laporan.pesanan');
});

Route::group([
    'prefix' => 'kasir',
    'as' => 'kasir.',
    'middleware' => ['auth', 'role:kasir']
], function () {
    Route::get('/', [PesananController::class, 'index'])->name('menu');
    Route::resource('/pesanan', PesananController::class)->name('as', 'pesanan')->only(['index', 'create', 'store']);
    Route::put('/pesanan/{transaksi}/approve', [PesananController::class, 'approveTransaksi'])->name('pesanan.approve');
    Route::put('/pesanan/{transaksi}/cancel', [PesananController::class, 'cancelPesanan'])->name('pesanan.cancel');
    Route::resource('/laporan', LaporanController::class)->name('as', 'laporan')->only('store');
});


Route::group([
    'prefix' => 'pelanggan',
    'as' => 'pelanggan.',
    'middleware' => ['auth', 'role:pelanggan'],
], function () {
    Route::get('/', [PelangganController::class, 'index'])->name('menu');
    Route::get('/profil', [PelangganController::class, 'profil'])->name('profil');
    Route::put('/profil/{user}', [UserController::class, 'update'])->name('profil.update');
    Route::resource('/pesanan', PesananController::class)->name('as', 'pesanan')->only(['create', 'store', 'edit', 'update']);
    Route::get('/pesanan/my', [PelangganController::class, 'myPesanan'])->name('my');
    Route::get('/pesanan/{pesanan}/pembayaran', [PesananController::class, 'payment'])->name('pembayaran');
    Route::put('/pesanan/{transaksi}/cancel', [PesananController::class, 'cancelPesanan'])->name('pesanan.cancel');
    Route::post('/upload-bukti/{transaksi}', [PesananController::class, 'uploadProof'])->name('upload');
    Route::get('/review', [ReviewController::class, 'edit'])->name('review');
    Route::post('/review/save', [ReviewController::class, 'createOrUpdate'])->name('review.save');
});

Route::get('/about', [PublicController::class, 'about']);
Route::get('/services', [PublicController::class, 'services']);
