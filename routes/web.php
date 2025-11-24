<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\AuthPelamarController;


Route::get('/', function () {
    return view('index');
});



Route::get('/lamar', function() {
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

Route::get('/lamaran-anda', function () {
    return view('Lamaran');
});

Route::get('/kelola', function () {
    return view('Kelola');
});

Route::get('/setting', function () {
    return view('setting');
});

Route::post('/register/pelamar', [PelamarController::class, 'store'])->name('pelamar.store');
Route::post('/login/pelamar', [PelamarController::class, 'login'])->name('pelamar.login');
