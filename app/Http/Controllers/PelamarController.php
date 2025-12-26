<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\Keahlian;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

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

        // login session
        session([
            'pelamar_id'       => $pelamar->id,
            'pelamar_username' => $pelamar->username,
            'pelamar_nama'     => $pelamar->nama_lengkap,
        ]);

        return redirect('/home-pelamar')->with('success', 'Registrasi berhasil!');
    }

    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            $response = Http::post('http://localhost:3001/login-pelamar', [
                'username' => $request->username,
                'password' => $request->password,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'login' => 'Server login sedang tidak tersedia'
            ]);
        }
        if ($response->failed()) {
            return back()->withErrors([
                'login' => $response->json()['message'] ?? 'Login gagal'
            ]);
        }
        $data = $response->json();

        session([
            'pelamar_id'       => $data['id'],
            'pelamar_username' => $data['username'],
            'pelamar_nama'     => $data['nama'],
        ]);

        return redirect('/home-pelamar');
    }
}
