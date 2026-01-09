<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Pelamar</title>
    <link rel="stylesheet" href="/assets/SignupPelamar/signPelamar.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up Pelamar</h2>

        @if ($errors->any())
            <div style="color:red; margin-bottom:10px;">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div style="color:green; margin-bottom:10px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('register.pelamar') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="fullname">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="fullname" placeholder="Masukkan Nama Lengkap" value="{{ old('nama_lengkap') }}">
            </div>

            <div class="form-group">
                <label for="usn">Username</label>
                <input type="text" name="username" id="usn" placeholder="Masukkan Username" value="{{ old('username') }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan Email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" name="password" id="pass" placeholder="Masukkan Password">
            </div>

            <div class="form-group">
                <label for="conf">Konfirmasi Password</label>
                <input type="password" name="conf" id="conf" placeholder="Konfirmasi Password">
            </div>

            <div class="form-group">
                <label for="skills">Keahlian</label>
                <input type="text" name="keahlian" id="skills" placeholder="Masukkan Keahlian (pisahkan dengan koma)" value="{{ old('keahlian') }}">
            </div>

            <button type="submit" id="next">Lanjut</button>
        </form>
    </div>
</body>
</html>
