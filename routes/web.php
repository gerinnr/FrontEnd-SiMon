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

Route::get('/admin/dashboard', function () {
    return view('Admin.dashboard'); // Sesuaikan dengan path file Blade login
})->name('admin.dashboard');

Route::get('/admin/tampil_datadosen', function () {
    return view('Admin.tampil_datadosen');
})->name('admin.tampil_datadosen');

Route::get('/admin/tampil_datamhs', function () {
    return view('Admin.tampil_datamhs');
})->name('admin.tampil_datamhs');

Route::get('/admin/tampil_datakls', function () {
    return view('Admin.tampil_datakls');
})->name('admin.tampil_datakls');

Route::get('/admin/tampil_datamatkul', function () {
    return view('Admin.tampil_datamatkul');
})->name('admin.tampil_datamatkul');

Route::get('/admin/tampil_datahadir', function () {
    return view('Admin.tampil_datahadir');
})->name('admin.tampil_datahadir');

Route::get('/admin/tambah_datadosen', function () {
    return view('Admin.tambah_datadosen');
})->name('admin.tambah_datadosen');

Route::get('/admin/tambah_datamhs', function () {
    return view('Admin.tambah_datamhs');
})->name('admin.tambah_datamhs');

Route::get('/admin/tambah_datakls', function () {
    return view('Admin.tambah_datakls');
})->name('admin.tambah_datakls');

Route::get('/admin/tambah_datamatkul', function () {
    return view('Admin.tambah_datamatkul');
})->name('admin.tambah_datamatkul');

Route::get('/admin/tambah_datahadir', function () {
    return view('Admin.tambah_datahadir');
})->name('admin.tambah_datahadir');

Route::get('/admin/edit_datadosen', function () {
    return view('Admin.edit_datadosen');
})->name('admin.edit_datadosen');

Route::get('/admin/edit_datamhs', function () {
    return view('Admin.edit_datamhs');
})->name('admin.edit_datamhs');

Route::get('/admin/edit_datakls', function () {
    return view('Admin.edit_datakls');
})->name('admin.edit_datakls');

Route::get('/admin/edit_datamatkul', function () {
    return view('Admin.edit_datamatkul');
})->name('admin.edit_datamatkul');

Route::get('/admin/edit_datahadir', function () {
    return view('Admin.edit_datahadir');
})->name('admin.edit_datahadir');



Route::get('/dosen/dashboard', function () {
    return view('Dosen.dashboard'); // Sesuaikan dengan path file Blade login
})->name('dosen.dashboard');

Route::get('/dosen/login-dosen', function () {
    return view('Dosen.login-dosen'); // Sesuaikan dengan path file Blade login
})->name('dosen.login-dosen');

Route::get('/dosen/tampil_datadosen', function () {
    return view('Dosen.tampil_datadosen');
})->name('dosen.tampil_datadosen');

Route::get('/dosen/tampil_datamhs', function () {
    return view('Dosen.tampil_datamhs');
})->name('dosen.tampil_datamhs');

Route::get('/dosen/tampil_datakls', function () {
    return view('Dosen.tampil_datakls');
})->name('dosen.tampil_datakls');

Route::get('/dosen/tampil_datamatkul', function () {
    return view('Dosen.tampil_datamatkul');
})->name('dosen.tampil_datamatkul');

Route::get('/dosen/tampil_datahadir', function () {
    return view('Dosen.tampil_datahadir');
})->name('dosen.tampil_datahadir');

Route::get('/dosen/tambah_datamhs', function () {
    return view('Dosen.tambah_datamhs');
})->name('dosen.tambah_datamhs');

Route::get('/dosen/tambah_datahadir', function () {
    return view('Dosen.tambah_datahadir');
})->name('dosen.tambah_datahadir');

Route::get('/dosen/edit_datamhs', function () {
    return view('Dosen.edit_datamhs');
})->name('dosen.edit_datamhs');

Route::get('/dosen/edit_datahadir', function () {
    return view('Dosen.edit_datahadir');
})->name('dosen.edit_datahadir');



Route::get('/mahasiswa/login-mhs', function () {
    return view('Mahasiswa.login-mhs'); // Sesuaikan dengan path file Blade login
})->name('mahasiswa.login-mhs');

Route::get('/mahasiswa/dashboard', function () {
    return view('Mahasiswa.dashboard'); // Sesuaikan dengan path file Blade login
})->name('mahasiswa.dashboard');

Route::get('/mahasiswa/tampil_datadosen', function () {
    return view('Mahasiswa.tampil_datadosen');
})->name('mahasiswa.tampil_datadosen');

Route::get('/mahasiswa/tampil_datamhs', function () {
    return view('Mahasiswa.tampil_datamhs');
})->name('mahasiswa.tampil_datamhs');

Route::get('/mahasiswa/tampil_datakls', function () {
    return view('Mahasiswa.tampil_datakls');
})->name('mahasiswa.tampil_datakls');

Route::get('/mahasiswa/tampil_datamatkul', function () {
    return view('Mahasiswa.tampil_datamatkul');
})->name('mahasiswa.tampil_datamatkul');

Route::get('/mahasiswa/tampil_datahadir', function () {
    return view('Mahasiswa.tampil_datahadir');
})->name('mahasiswa.tampil_datahadir');