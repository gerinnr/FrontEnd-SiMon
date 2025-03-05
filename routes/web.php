<?php

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
    return view('Admin.homepage');
});

Route::get('/admin/login', function () {
    return view('Admin.login'); // Sesuaikan dengan path file Blade login
})->name('admin.login');

Route::get('/dosen/login-dosen', function () {
    return view('Dosen.login-dosen'); // Sesuaikan dengan path file Blade login
})->name('dosen.login-dosen');

Route::get('/mahasiswa/login-mhs', function () {
    return view('Mahasiswa.login-mhs'); // Sesuaikan dengan path file Blade login
})->name('mahasiswa.login-mhs');

Route::get('/admin/dashboard', function () {
    return view('Admin.dashboard'); // Sesuaikan dengan path file Blade login
})->name('admin.dashboard');

Route::get('/admin/tampil_datadosen', function () {
    return view('Admin.tampil_datadosen');
})->name('admin.tampil_datadosen');