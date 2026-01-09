<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perusahaan</title>
    <link rel="stylesheet" href="/assets/LoginPerusahaan/login.css">
</head>
<body>
    <div class="container">
        <h2>Login Perusahaan</h2>

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

        <form action="{{ route('login.perusahaan') }}" method="POST">
            @csrf

            <div class="username">
                <label for="username">Email Perusahaan</label>
                <input type="email" name="email" id="usn" placeholder="Masukkan Email Perusahaan" value="{{ old('email') }}">
            </div>

            <div class="password">
                <label for="password">Password</label>
                <input type="password" name="password" id="pass" placeholder="Masukkan Password">
            </div>

            <div class="link">
                <label id="forgot"><a href="#">Lupa password?</a></label>
                <label id="register"><a href="/register/perusahaan">Belum punya akun?</a></label>
            </div>

            <button type="submit" id="next">Lanjut</button>
        </form>
    </div>
</body>
</html>
