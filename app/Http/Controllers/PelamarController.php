<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Hash;

class PelamarController extends Controller
{
    // REGISTER
    public function store(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required',
        'username'     => 'required|unique:pelamars,username',
        'email'        => 'required|email|unique:pelamars,email',
        'password'     => 'required|min:3',
        'keahlian'     => 'nullable'
    ]);

    session()->flush();

    $pelamar = Pelamar::create([
        'nama_lengkap' => $request->nama_lengkap,
        'username'     => $request->username,
        'email'        => $request->email,
        'password'     => Hash::make($request->password),
        'foto_profil'  => null
    ]);

    session([
        'pelamar_id'       => $pelamar->id,
        'pelamar_username' => $pelamar->username,
        'pelamar_nama'     => $pelamar->nama_lengkap,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Akun pelamar berhasil dibuat!',
    ]);
}


    // LOGIN
    public function login(Request $request)
    {
        $pelamar = Pelamar::where('username', $request->username)->first();

        if (!$pelamar) {
            return response()->json(['success' => false, 'message' => 'Username tidak ditemukan']);
        }

        if (!Hash::check($request->password, $pelamar->password)) {
            return response()->json(['success' => false, 'message' => 'Password salah']);
        }

        session([
            'pelamar_id' => $pelamar->id,
            'pelamar_username' => $pelamar->username,
            'pelamar_nama' => $pelamar->nama_lengkap,
        ]);

        return response()->json(['success' => true]);
    }
}
