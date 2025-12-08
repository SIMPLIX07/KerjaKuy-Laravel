<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Hash;

class PerusahaanController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $perusahaan = Perusahaan::where('email', $request->email)->first();

        if (!$perusahaan || !Hash::check($request->password, $perusahaan->password)) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        session([
            'perusahaan_id'   => $perusahaan->id,
            'perusahaan_nama' => $perusahaan->nama_perusahaan,
            'perusahaan_email'=> $perusahaan->email
        ]);

        return redirect('/karyawanPerusahaan');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'email'           => 'required|email|unique:perusahaans,email',
            'password'        => 'required|min:3'
        ]);

        $perusahaan = Perusahaan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'email'           => $request->email,
            'password'        => Hash::make($request->password)
        ]);

        session([
            'perusahaan_id'   => $perusahaan->id,
            'perusahaan_nama' => $perusahaan->nama_perusahaan,
            'perusahaan_email'=> $perusahaan->email
        ]);

        return redirect('/karyawanPerusahaan')->with('success', 'Registrasi perusahaan berhasil');
    }
}
