<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MatkulController;
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

// Halaman Utama
Route::get('/', function () {
    return view('homepage');
});

// Login
Route::get('/admin/login', [LoginController::class, 'admin_create'])->name('admin.login');
Route::get('/mahasiswa/login', [LoginController::class, 'mahasiswa_create'])->name('mahasiswa.login');
Route::get('/dosen/login', [LoginController::class, 'dosen_create'])->name('dosen.login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/login/auth', [LoginController::class, 'login'])->name('login.auth');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'level:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('Admin.dashboard');
    })->name('admin.dashboard');

    // Resource Controllers
    Route::resource('/admin/dosen', DosenController::class)->names([
        'index' => 'admin.dosen.index',
        'create' => 'admin.dosen.create',
        'store' => 'admin.dosen.store',
        'show' => 'admin.dosen.show',
        'edit' => 'admin.dosen.edit',
        'update' => 'admin.dosen.update',
        'destroy' => 'admin.dosen.destroy',
    ]);

    Route::resource('/admin/mahasiswa', MahasiswaController::class)->names([
        'index' => 'admin.mhs.index',
        'create' => 'admin.mhs.create',
        'store' => 'admin.mhs.store',
        'show' => 'admin.mhs.show',
        'edit' => 'admin.mhs.edit',
        'update' => 'admin.mhs.update',
        'destroy' => 'admin.mhs.destroy',
    ]);

    Route::resource('/admin/kelas', KelasController::class)->names([
        'index' => 'admin.kls.index',
        'create' => 'admin.kls.create',
        'store' => 'admin.kls.store',
        'show' => 'admin.kls.show',
        'edit' => 'admin.kls.edit',
        'update' => 'admin.kls.update',
        'destroy' => 'admin.kls.destroy',
    ]);

    Route::resource('/admin/matkul', MatkulController::class)->names([
        'index' => 'admin.matkul.index',
        'create' => 'admin.matkul.create',
        'store' => 'admin.matkul.store',
        'show' => 'admin.matkul.show',
        'edit' => 'admin.matkul.edit',
        'update' => 'admin.matkul.update',
        'destroy' => 'admin.matkul.destroy',
    ]);

    Route::resource('/admin/kehadiran', KehadiranController::class)->names([
        'index' => 'admin.hadir.index',
        'create' => 'admin.hadir.create',
        'store' => 'admin.hadir.store',
        'show' => 'admin.hadir.show',
        'edit' => 'admin.hadir.edit',
        'update' => 'admin.hadir.update',
        'destroy' => 'admin.hadir.destroy',
    ]);
});

// Dosen Routes
Route::middleware(['auth', 'level:dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return view('Dosen.dashboard');
    })->name('dosen.dashboard');
});

// Mahasiswa Routes
Route::middleware(['auth', 'level:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('Mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
});
