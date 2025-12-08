<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\Keahlian;
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
            'conf'         => 'required|same:password',
            'keahlian'     => 'nullable'
        ]);

        session()->flush();

        // Simpan pelamar
        $pelamar = Pelamar::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'foto_profil'  => null
        ]);

        // Simpan keahlian pelamar
        if ($request->keahlian) {
            $skills = array_map('trim', explode(',', $request->keahlian));

            foreach ($skills as $skill) {
                Keahlian::create([
                    'pelamar_id'    => $pelamar->id,
                    'nama_keahlian' => $skill
                ]);
            }
        }

        // Auto login session
        session([
            'pelamar_id'       => $pelamar->id,
            'pelamar_username' => $pelamar->username,
            'pelamar_nama'     => $pelamar->nama_lengkap,
        ]);

        return redirect('/home-pelamar')->with('success', 'Registrasi berhasil!');
    }

    // LOGIN
    public function login(Request $request)
    {
        $pelamar = Pelamar::where('username', $request->username)->first();

        if (!$pelamar) {
            return back()->withErrors(['username' => 'Username tidak ditemukan']);
        }

        if (!Hash::check($request->password, $pelamar->password)) {
            return back()->withErrors(['password' => 'Password salah']);
        }

        session([
            'pelamar_id'       => $pelamar->id,
            'pelamar_username' => $pelamar->username,
            'pelamar_nama'     => $pelamar->nama_lengkap,
        ]);

        return redirect('/home-pelamar');
    }
}
