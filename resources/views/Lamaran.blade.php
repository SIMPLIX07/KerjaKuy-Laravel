<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaKuy</title>
    <link rel="stylesheet" href="/assets/LamaranAnda/Lamaran.css">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="/assets/LamaranAnda/asset/KerjaKuy.png" alt="Kerjakuy Logo" class="logo-img">
                <span class="brand-text">KerjaKuy</span>
            </div>

            <div class="nav-menu">
                <a href="/home-pelamar" class="nav-link">Lowongan Kerja</a>
                <a href="/lamaran-anda" class="nav-link active">Lamaran Anda</a>
            </div>

            <div class="nav-user">
                <span class="user-margin"><a class="nav-user" href="/setting">{{ session('pelamar_nama') }}</a></span>
            </div>
        </div>
    </nav>

    <div class="search-bar-container">
        <div class="search-bar">
            <input type="text" placeholder="Cari pekerjaan yang dilamar" class="search-input">
            <button class="search-button">Cari</button>
        </div>
    </div>

    <div class="lamaran-wrapper">
        <div class="cards-container" id="cardsContainer"></div>

        <div class="kelola-wrapper">
            <button class="kelola-btn" onclick="window.location.href='/kelola'">Kelola</button>
        </div>
    </div>

    <script src="/assets/LamaranAnda/Lamaran.js"></script>
</body>

</html>