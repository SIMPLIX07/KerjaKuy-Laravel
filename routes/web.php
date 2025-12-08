<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\AuthPelamarController;
use App\Http\Controllers\PerusahaanController;



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

Route::get('/home-pelamar', function () {
    return view('home');
});

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

Route::get('/setting', function () {
    return view('setting');
});

Route::get('/home-perusahaan', function () {
    return view('homePerusahaan');
});


Route::post('/register/pelamar', [PelamarController::class, 'store'])->name('register.pelamar');
Route::post('/login/pelamar', [PelamarController::class, 'login'])->name('login.pelamar');
Route::post('/login/perusahaan', [PerusahaanController::class, 'login'])->name('login.perusahaan');



