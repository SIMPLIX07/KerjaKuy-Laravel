<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\Keahlian;
use GuzzleHttp\RedirectMiddleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PelamarController extends Controller
{
    // REGISTER
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username'     => 'required|unique:pelamars,username',
            'email'        => 'required|email|unique:pelamars,email',
            'no_telp'      => 'nullable|numeric',
            'password'     => 'required|min:3',
            'conf'         => 'required|same:password',
            'keahlian'     => 'nullable'
        ]);

        // Simpan pelamar
        $pelamar = Pelamar::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'no_telp'      => $request->no_telp,
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

        // login sessions
        session([
            'pelamar_id'       => $pelamar->id,
            'pelamar_username' => $pelamar->username,
            'pelamar_nama'     => $pelamar->nama_lengkap,
            'pelamar_foto'     => $pelamar->foto_profil,
        ]);

        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('openPasswordModal', true);
        }

        $pelamar = Pelamar::find(session('pelamar_id'));

        if (!$pelamar) {
            return redirect('/login/pelamar');
        }

        if (!Hash::check($request->password_lama, $pelamar->password)) {
            return back()
                ->withErrors(['password_lama' => 'Password lama salah'])
                ->with('openPasswordModal', true);
        }

        $pelamar->password = Hash::make($request->password_baru);
        $pelamar->save();

        return back()->with('success_password', 'Password berhasil diperbarui');
    }



    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $pelamar = Pelamar::where('username', $request->username)->first();

        if (!$pelamar || !Hash::check($request->password, $pelamar->password)) {
            return back()->withErrors([
                'login' => 'Username atau password salah'
            ])->withInput();
        }

        session([
            'pelamar_id'       => $pelamar->id,
            'pelamar_username' => $pelamar->username,
            'pelamar_nama'     => $pelamar->nama_lengkap,
            'pelamar_foto'     => $pelamar->foto_profil,
        ]);

        return redirect()->route('home');
    }

    //setting
    public function settings()
    {
        $pelamar = Pelamar::with('keahlians')->find(session('pelamar_id'));

        if (!$pelamar) {
            return redirect('/login/pelamar');
        }

        $keahlianString = $pelamar->keahlians->pluck('nama_keahlian')->implode(', ');

        return view('setting', compact('pelamar', 'keahlianString'));
    }

    public function updateProfil(Request $request)
    {
        $pelamar = Pelamar::findOrFail(session('pelamar_id'));

        $request->validate([
            'nama_lengkap' => 'required',
            'username'     => 'required|unique:pelamars,username,' . $pelamar->id,
            'email'        => 'required|email|unique:pelamars,email,' . $pelamar->id,
            'no_telp'      => 'nullable|numeric',
            'foto_profil'  => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $fotoProfilPath = $pelamar->foto_profil;

        if ($request->hasFile('foto_profil')) {
            if ($pelamar->foto_profil) {
                Storage::delete('public/profil/' . $pelamar->foto_profil);
            }

            $fotoProfilPath = $request->file('foto_profil')->store(
                'pelamar/profil',
                'public'
            );
        }

        $pelamar->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'foto_profil' => $fotoProfilPath,
            'no_telp'      => $request->no_telp,
        ]);

        if ($request->keahlian) {
            Keahlian::where('pelamar_id', $pelamar->id)->delete();
            $skills = array_map('trim', explode(',', $request->keahlian));
            foreach ($skills as $skill) {
                if (!empty($skill)) {
                    Keahlian::create([
                        'pelamar_id' => $pelamar->id,
                        'nama_keahlian' => $skill,
                    ]);
                }
            }
        }

        session([
            'pelamar_nama'     => $pelamar->nama_lengkap,
            'pelamar_username' => $pelamar->username,
            'pelamar_foto'     => $fotoProfilPath,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function destroy()
    {
        $pelamarId = session('pelamar_id');

        if (!$pelamarId) {
            return redirect('/login/pelamar');
        }
        Keahlian::where('pelamar_id', $pelamarId)->delete();
        $pelamar = Pelamar::find($pelamarId);
        if ($pelamar && $pelamar->foto_profil) {
            Storage::disk('public')->delete($pelamar->foto_profil);
        }
        Pelamar::where('id', $pelamarId)->delete();
        session()->flush();
        return redirect('/')->with('success', 'Akun berhasil dihapus');
    }
}
