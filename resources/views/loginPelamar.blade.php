<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelamar</title>
    <link rel="stylesheet" href="/assets/LoginPelamar/login.css">
</head>
<body>
    <div class="container">
        <h2>Login Pelamar</h2>

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

        <form action="{{ route('login.pelamar') }}" method="POST">
            @csrf

            <div class="username">
                <label for="username">Username</label>
                <input type="text" name="username" id="usn" placeholder="Masukkan Username" value="{{ old('username') }}">
            </div>

            <div class="password">
                <label for="password">Password</label>
                <input type="password" name="password" id="pass" placeholder="Masukkan Password">
            </div>

            <div class="link">
                <label id="forgot"><a href="#">Lupa password?</a></label>
                <label id="register"><a href="/register/pelamar">Belum punya akun?</a></label>
            </div>

            <button type="submit" id="next">Lanjut</button>
        </form>
    </div>
</body>
</html>
