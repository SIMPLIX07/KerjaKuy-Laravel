<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\AuthPelamarController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\CVController;


Route::get('/', function () {
    session()->flush();
    return view('index');
});

Route::get('/lamar', function () {
    return view('lamar');
});

Route::get('/login/pelamar', function () {
    return view('loginPelamar');
});

Route::get('/login/perusahaan', function () {
    return view('loginPerusahaan');
});

Route::get('/register/pelamar', function () {
    return view('signPelamar');
});

Route::get('/register/perusahaan', function () {
    return view('signPerusahaan');
});

Route::get('/home-pelamar', [LowonganController::class, 'listPelamar']);


//DAFTAR
Route::get('/pilihRole', function () {
    return view('daftarPelamar/pilihRole');
});


Route::get('/lamaran-anda', [LamaranController::class, 'index']);


Route::get('/kelola', function () {
    return view('Kelola');
});

Route::get('/pelamar/setting', function () {
    return view('setting');
})->name('pelamar.settings');

// Pelamar
Route::post('/register/pelamar', [PelamarController::class, 'store'])->name('register.pelamar');
Route::post('/login/pelamar', [PelamarController::class, 'login'])->name('login.pelamar');
Route::get('/pelamar/cv', [LamaranController::class, 'getCvPelamar']);
Route::post('/lamaran/insert', [LamaranController::class, 'insertLamaran']);

// Lowongan
Route::post('/lowongan/tambah', [LowonganController::class, 'store'])->name('lowongan.store');
Route::get('/lowongan/tambah', [LowonganController::class, 'create'])->name('lowongan.create');
Route::post('/lamaran/terima/{id}', [PerusahaanController::class, 'terimaPelamar'])->name('lamaran.terima');
Route::get('/karyawanPerusahaan', [PerusahaanController::class, 'kategoriKaryawan']);

// CV
Route::resource('/cv', CVController::class);
Route::get('/pelamar/{pelamar}/cv/create', [CVController::class, 'create'])
    ->name('cv.create');
Route::post('/pelamar/{pelamar}/cv', [CVController::class, 'store'])
    ->name('cv.store');

// Perusahaan
Route::get('/home-perusahaan', [LowonganController::class, 'index']);
Route::post('/login/perusahaan', [PerusahaanController::class, 'login'])->name('login.perusahaan');
Route::post('/register/perusahaan', [PerusahaanController::class, 'register'])->name('register.perusahaan');
Route::get('/perusahaan/pengaturan', [PerusahaanController::class, 'showPengaturanAkun'])->name('perusahaan.settings');
Route::post('/perusahaan/pengaturan', [PerusahaanController::class, 'updatePengaturanAkun'])->name('perusahaan.settings.update');
Route::post('/perusahaan/logout', [PerusahaanController::class, 'logout'])->name('perusahaan.logout');
Route::get('/lowongan/{id}', [LowonganController::class, 'detail'])->name('lowongan.detail');
Route::post('/lamaran/store', [LamaranController::class, 'insertLamaran']);



Route::get('/lowongan-perusahaan', function () {
    return view('homePelamar.lowongan');
});

Route::get('/lowongan/tambah', function () {
    return view('lowongan.tambahLowongan');
});


