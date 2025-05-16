<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MatkulController;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Matkul;
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
    return view('homepage');
});

Route::get('/admin/login', [LoginController::class, 'admin_create'])->name('admin.login');
Route::get('/mahasiswa/login', [LoginController::class, 'mahasiswa_create'])->name('mahasiswa.login');
Route::get('/dosen/login', [LoginController::class, 'dosen_create'])->name('dosen.login');

// Proses login
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/login/auth', [LoginController::class, 'login'])->name('login.auth');

// Logout
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// Dashboard berdasarkan level dengan middleware
Route::middleware(['auth', 'level:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('Admin.dashboard');
    })->name('admin.dashboard');

       // CRUD Dosen
       Route::prefix('admin')->group(function () {
       Route::get('/tampil_dosen', [DosenController::class, 'index'])->name('admin.dosen.index');
       Route::get('/tambah_dosen', [DosenController::class, 'create'])->name('admin.dosen.create');
       Route::post('/tambah_dosen', [DosenController::class, 'store'])->name('admin.dosen.store');
       // Route::get('/{id_user}', [DosenController::class, 'show'])->name('admin.dosen.show');
       Route::get('/edit_dosen/{nidn}', [DosenController::class, 'edit'])->name('admin.dosen.edit');
       Route::put('/edit_dosen/{nidn}', [DosenController::class, 'update'])->name('admin.dosen.update');
       Route::delete('/tampil_dosen/{nidn}', [DosenController::class, 'destroy'])->name('admin.dosen.destroy');
    });

        //CRUD Mahasiswa
        Route::prefix('admin')->group(function () {
        Route::get('/tampil_mhs', [MahasiswaController::class, 'index'])->name('admin.mhs.index');
        Route::get('/tambah_mhs', [MahasiswaController::class, 'create'])->name('admin.mhs.create');
        Route::post('/tambah_mhs', [MahasiswaController::class, 'store'])->name('admin.mhs.store');
        // Route::get('/{id_user}', [MahasiswaController::class, 'show'])->name('admin.mhs.show');
        Route::get('/edit_mhs/{npm}', [MahasiswaController::class, 'edit'])->name('admin.mhs.edit');
        Route::put('/edit_mhs/{npm}', [MahasiswaController::class, 'update'])->name('admin.mhs.update');
        Route::delete('/tampil_mhs/{npm}', [MahasiswaController::class, 'destroy'])->name('admin.mhs.destroy');
    });

        //CRUD Kelas
        Route::prefix('admin')->group(function () {
        Route::get('/tampil_kls', [KelasController::class, 'index'])->name('admin.kls.index');
        Route::get('/tambah_kls', [KelasController::class, 'create'])->name('admin.kls.create');
        Route::post('/tambah_kls', [KelasController::class, 'store'])->name('admin.kls.store');
        // Route::get('/{id_user}', [KelasController::class, 'show'])->name('admin.kls.show');
        Route::get('/edit_kls/{kode_kelas}', [KelasController::class, 'edit'])->name('admin.kls.edit');
        Route::put('/edit_kls/{kode_kelas}', [KelasController::class, 'update'])->name('admin.kls.update');
        Route::delete('/tampil_kls/{kode_kelas}', [KelasController::class, 'destroy'])->name('admin.kls.destroy');
    });

        //CRUD Matkul
        Route::prefix('admin')->group(function () {
        Route::get('/tampil_matkul', [MatkulController::class, 'index'])->name('admin.matkul.index');
        Route::get('/tambah_matkul', [MatkulController::class, 'create'])->name('admin.matkul.create');
        Route::post('/tambah_matkul', [MatkulController::class, 'store'])->name('admin.matkul.store');
        // Route::get('/{id_user}', [MatkulController::class, 'show'])->name('admin.matkul.show');
        Route::get('/edit_matkul/{kode_matkul}', [MatkulController::class, 'edit'])->name('admin.matkul.edit');
        Route::put('/edit_matkul/{kode_matkul}', [MatkulController::class, 'update'])->name('admin.matkul.update');
        Route::delete('/tampil_matkul/{kode_matkul}', [MatkulController::class, 'destroy'])->name('admin.matkul.destroy');
    });

        //CRUD Kehadiran
        Route::prefix('admin')->group(function () {
        Route::get('/tampil_hadir', [KehadiranController::class, 'index'])->name('admin.hadir.index');
        Route::get('/tambah_hadir', [KehadiranController::class, 'create'])->name('admin.hadir.create');
        Route::post('/tambah_hadir', [KehadiranController::class, 'store'])->name('admin.hadir.store');
        // Route::get('/{id_kehadiran}', [KehadiranController::class, 'show'])->name('admin.hadir.show');
        Route::get('/edit_hadir/{id_kehadiran}', [KehadiranController::class, 'edit'])->name('admin.hadir.edit');
        Route::put('/edit_hadir/{id_kehadiran}', [KehadiranController::class, 'update'])->name('admin.hadir.update');
        Route::delete('/tampil_hadir/{id_kehadiran}', [KehadiranController::class, 'destroy'])->name('admin.hadir.destroy');
    });
        
});

// Dashboard berdasarkan level dengan middleware
Route::middleware(['auth', 'level:dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return view('Dosen.dashboard');
    })->name('dosen.dashboard');
});

// Dashboard berdasarkan level dengan middleware
Route::middleware(['auth', 'level:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('Mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
});