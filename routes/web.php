<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('index');
});

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

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index')->middleware(['auth', 'role:admin']);

Route::get('/kasir', function () {
    return view('kasir.index');
})->name('kasir')->middleware(['auth', 'role:kasir']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/blog/detail', function () {
    return view('blog_detail');
});

Route::get('/contact', function () {
    return view('contact');
});
