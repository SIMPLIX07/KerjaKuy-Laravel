<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="/assets/index/index.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav>
        <div class="left">
            <img src="/assets/index/asset/logo.png" alt="">
            <label for="">KerjaKuy</label>
        </div>
        <div class="mid">
            <ul>
                <li>
                    <a href="">Download</a>
                </li>
                <li>
                    <a href="">Blog</a>
                </li>
                <li>
                    <a href="">Tentang</a>
                </li>
                <li>
                    <a href="">Dukungan</a>
                </li>
            </ul>
        </div>
        <div class="right">
            <ul>
                <li>
                    <div class="dropdown">
                        <a href="/pilihRole">
                            <button id="daftar">Daftar</button>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button id="login">Login</button>
                        <div class="dropdown-content">
                            <a href="/login/pelamar">Pelamar</a>
                            <a href="/login/perusahaan">Perusahaan</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="konten1">
        <h1>KerjaKuy</h1>
        <p id="isi">Tempat anda menemukan</p>
        <p id="isi">Pekerjaan impian anda</p>
    </div>
    <div class="flex flex-row bg-white text-black py-60 px-40">
        <div class="flex flex-col justify-center gap-6">
            <h2 class="font-bold text-4xl">Tentang Kami</h2>
            <p class="text-lg">
                Kami Menyediakan Platform Untuk Menemukan Pekerjaan Impian Anda, Dengan Langkah Langkah Yang Mudah dan Praktis
            </p>
            <button class="cursor-pointer bg-green-400 p-2 w-36 text-white rounded-xl">Lebih Banyak</button>
        </div>
        <img class="w-6/12" src="/assets/index/asset/person.jpg" alt="">
    </div>

    <div class="w-screen flex flex-row justify-center py-60 px-40">
        <div class="">
            <h3 class="text-center font-bold text-4xl">Akses Penuh</h3>

            <div class="grid grid-cols-3 py-20 gap-5 justify-items-center">
                <div class="p-5 border border-white rounded-xl flex flex-col gap-3">
                    <div class="border border-white rounded-full w-15 flex flex-row justify-center">
                        <img src="/assets/index/asset/assessment.svg" alt="" class="p-3">
                    </div>
                    <div>
                        <p class="text-xl">Kemudahan</p>
                        <p>Peroses Melamar Yang Instan Dan Mudah</p>
                    </div>
                </div>
                <div class="p-5 border border-white rounded-xl flex flex-col gap-3">
                    <div class="border border-white rounded-full w-15 flex flex-row justify-center">
                        <img src="/assets/index/asset/assessment.svg" alt="" class="p-3">
                    </div>
                    <div>
                        <p class="text-xl">Lowongan</p>
                        <p>Peroses Melamar Yang Instan Dan Mudah</p>
                    </div>
                </div>
                <div class="p-5 border border-white rounded-xl flex flex-col gap-3">
                    <div class="border border-white rounded-full w-15 flex flex-row justify-center">
                        <img src="/assets/index/asset/assessment.svg" alt="" class="p-3">
                    </div>
                    <div>
                        <p class="text-xl">Lokasi</p>
                        <p>Peroses Melamar Yang Instan Dan Mudah</p>
                    </div>
                </div>
                <div class="p-5 border border-white rounded-xl flex flex-col gap-3">
                    <div class="border border-white rounded-full w-15 flex flex-row justify-center">
                        <img src="/assets/index/asset/assessment.svg" alt="" class="p-3">
                    </div>
                    <div>
                        <p class="text-xl">Status</p>
                        <p>Peroses Melamar Yang Instan Dan Mudah</p>
                    </div>
                </div>
                <div class="p-5 border border-white rounded-xl flex flex-col gap-3">
                    <div class="border border-white rounded-full w-15 flex flex-row justify-center">
                        <img src="/assets/index/asset/assessment.svg" alt="" class="p-3">
                    </div>
                    <div>
                        <p class="text-xl">Jadwal</p>
                        <p>Peroses Melamar Yang Instan Dan Mudah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-screen bg-white flex flex-row justify-center py-60 px-40">
        <div class="text-black">
            <h3 class="text-center font-bold text-4xl">Testimoni</h3>

            <div class="grid grid-cols-2 py-20 gap-5 justify-items-center">
                <div class=" p-5 border border-black rounded-xl flex flex-col gap-3">
                    <div class="flex flex-row gap-4">
                        <img src="/assets/index/asset/mengamuk.png" alt="" class="rounded-full w-16 h-16 ">
                        <div>
                            <p>Jefri Owen</p>
                            <div class="flex flex-row gap-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <p>*</p>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <p>"Design Bersih Mencari Lamaran Pekerjaan Jadi Lebih Mudah Mantap Deh Pokoknya"</p>
                </div>

                <div class=" p-5 border border-black rounded-xl flex flex-col gap-3">
                    <div class="flex flex-row gap-4">
                        <img src="/assets/index/asset/mengamuk.png" alt="" class="rounded-full w-16 h-16 ">
                        <div>
                            <p>Jefri Owen</p>
                            <div class="flex flex-row gap-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <p>*</p>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <p>"Design Bersih Mencari Lamaran Pekerjaan Jadi Lebih Mudah Mantap Deh Pokoknya"</p>
                </div>

                <div class=" p-5 border border-black rounded-xl flex flex-col gap-3">
                    <div class="flex flex-row gap-4">
                        <img src="/assets/index/asset/mengamuk.png" alt="" class="rounded-full w-16 h-16 ">
                        <div>
                            <p>Jefri Owen</p>
                            <div class="flex flex-row gap-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <p>*</p>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <p>"Design Bersih Mencari Lamaran Pekerjaan Jadi Lebih Mudah Mantap Deh Pokoknya"</p>
                </div>

                <div class=" p-5 border border-black rounded-xl flex flex-col gap-3">
                    <div class="flex flex-row gap-4">
                        <img src="/assets/index/asset/mengamuk.png" alt="" class="rounded-full w-16 h-16 ">
                        <div>
                            <p>Jefri Owen</p>
                            <div class="flex flex-row gap-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <p>*</p>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <p>"Design Bersih Mencari Lamaran Pekerjaan Jadi Lebih Mudah Mantap Deh Pokoknya"</p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-screen py-60 px-40">
        <div class="flex flex-col gap-5">
            <p class=" font-bold text-4xl">Ayo</p>
            <p class="font-bold text-6xl">Bergabung <br>Bersama Kami</p>
        </div>

        <div class="flex flex-row pt-60 justify-center gap-44">
            <div class="flex flex-col gap-5">
                <p class="font-semibold text-lg">Pelamar</p>
                <div class="text-gray-300 flex flex-col gap-5">
                    <a href="/">Cari Lowongan</a>
                    <a href="/">Rekomendasi</a>
                    <a href="/">Kategori Populer</a>
                    <a href="/">Lihat Profile</a>
                    <a href="/">Download Apllikasi</a>
                </div>
            </div>
            <div class="flex flex-col gap-5">
                <p class="font-semibold text-lg">Pelamar</p>
                <div class="text-gray-300 flex flex-col gap-5">
                    <a href="/">Cari Lowongan</a>
                    <a href="/">Rekomendasi</a>
                    <a href="/">Kategori Populer</a>
                    <a href="/">Lihat Profile</a>
                    <a href="/">Download Apllikasi</a>
                </div>
            </div>
            <div class="flex flex-col gap-5">
                <p class="font-semibold text-lg">Pelamar</p>
                <div class="text-gray-300 flex flex-col gap-5">
                    <a href="/">Cari Lowongan</a>
                    <a href="/">Rekomendasi</a>
                    <a href="/">Kategori Populer</a>
                    <a href="/">Lihat Profile</a>
                    <a href="/">Download Apllikasi</a>
                </div>
            </div>
            <div class="flex flex-col gap-5">
                <p class="font-semibold text-lg">Pelamar</p>
                <div class="text-gray-300 flex flex-col gap-5">
                    <a href="/">Cari Lowongan</a>
                    <a href="/">Rekomendasi</a>
                    <a href="/">Kategori Populer</a>
                    <a href="/">Lihat Profile</a>
                    <a href="/">Download Apllikasi</a>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/index/asset/index.js"></script>
</body>

</html>
