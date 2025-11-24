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
        <div class="form-group">
            <label for="fullname">Nama Lengkap</label>
            <input type="text" id="fullname" placeholder="Masukkan Nama Lengkap">
        </div>
        <div class="form-group">
            <label for="usn">Username</label>
            <input type="text" id="usn" placeholder="Masukkan Username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Masukkan Email">
        </div>
        <div class="form-group password-wrapper">
            <label for="pass">Password</label>
            <div class="password-input">
                <input type="password" id="pass" placeholder="Masukkan Password">
                <img src="https://cdn-icons-png.flaticon.com/512/709/709612.png"
                    id="togglePass"
                    class="icon-eye">
            </div>
        </div>

        <div class="form-group password-wrapper">
            <label for="conf">Konfirmasi Password</label>
            <div class="password-input">
                <input type="password" id="conf" placeholder="Konfirmasi Password">
                <img src="https://cdn-icons-png.flaticon.com/512/709/709612.png"
                    id="toggleConf"
                    class="icon-eye">
            </div>
        </div>
        <div class="form-group">
            <label for="skills">Keahlian</label>
            <input type="text" id="skills" placeholder="Masukkan Keahlian (pisahkan dengan koma)">
        </div>
        <button type="submit" id="next">Lanjut</button>
    </div>

    <script src="/assets/SignupPelamar/signPelamar.js"></script>
</body>

</html>