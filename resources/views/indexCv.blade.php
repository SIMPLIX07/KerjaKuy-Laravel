<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <link rel="stylesheet" href="/assets/menuSettings/setting.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="leftBar">
        <div class="header">
            <div class="fotoSetting">
                <img src="/assets/menuSettings/assets/defaultProfile.png" alt="">
            </div>
            <h2>Settings</h2>
        </div>

        <hr>

        <div class="barContent">
            <div class="general">
                <div class="profil">
                    <div class="iconProfil">
                        <img src="/assets/menuSettings/assets/user.png" alt="">
                    </div>
                    <label>Profil</label>
                </div>
            </div>

            <div class="general">
                <div class="profil">
                    <div class="iconProfil">
                        <img src="/assets/menuSettings/assets/user.png" alt="">
                    </div>
                    <label>CV</label>
                </div>
            </div>

            <div class="System">
                <div class="LogOut">
                    <div class="iconLogOut">
                        <img src="/assets/menuSettings/assets/logout.png" alt="">
                    </div>
                    <label>Log Out</label>
                </div>
            </div>

            <div class="back">
                <a href="/home-pelamar">
                    <img src="/assets/menuSettings/assets/back.png" alt="">
                </a>
            </div>
        </div>
    </div>

    <a class="absolute bottom-10 right-10 p-5 bg-blue-400 rounded-xl font-bold text-white cursor-pointer"
        href="{{ route('cv.create', $pelamar->id) }}">
            Tambah CV
    </a>


    <script src="/assets/menuSettings/setting.js"></script>
</body>

</html>
