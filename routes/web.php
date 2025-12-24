<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\AuthPelamarController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\LowonganController;



Route::get('/', function () {
    session()->flush();
    return view('index');
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


Route::get('/lamaran-anda', function () {
    return view('Lamaran');
});

Route::get('/kelola', function () {
    return view('Kelola');
});

Route::get('/pelamar/setting', function () {
    return view('setting');
})->name('pelamar.settings');

Route::get('/home-perusahaan', [LowonganController::class, 'index']);

Route::post('/register/pelamar', [PelamarController::class, 'store'])->name('register.pelamar');
Route::post('/login/pelamar', [PelamarController::class, 'login'])->name('login.pelamar');
Route::post('/login/perusahaan', [PerusahaanController::class, 'login'])->name('login.perusahaan');
Route::post('/register/perusahaan', [PerusahaanController::class, 'register'])->name('register.perusahaan');
Route::post('/lowongan/tambah', [LowonganController::class, 'store'])->name('lowongan.store');
Route::post('/lamaran/terima/{id}', [PerusahaanController::class, 'terimaPelamar'])->name('lamaran.terima');
Route::get('/karyawanPerusahaan', [PerusahaanController::class, 'kategoriKaryawan']);
Route::get('/perusahaan/pengaturan', [PerusahaanController::class, 'showPengaturanAkun'])->name('perusahaan.settings');
Route::post('/perusahaan/pengaturan', [PerusahaanController::class, 'updatePengaturanAkun'])->name('perusahaan.settings.update');
Route::post('/perusahaan/logout', [PerusahaanController::class, 'logout'])->name('perusahaan.logout');
Route::get('/lowongan/{id}', [LowonganController::class, 'detail'])->name('lowongan.detail');


Route::get('/lowongan-perusahaan', function () {
    return view('homePelamar.lowongan');
});


Route::get('/lowongan/tambah', function () {
    return view('lowongan.tambahLowongan');
});
