<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <link rel="stylesheet" href="/assets/menuSettings/setting.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
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

    <div class="w-full mx-auto px-6 py-10">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar CV</h1>

            <a href="{{ route('cv.create') }}" class="px-5 py-2 rounded-lg text-white font-semibold"
                style="background-color:#1FACA2">
                + Tambah CV
            </a>
        </div>

        <div x-data="cvModal()" class="space-y-4">

            <div class="flex flex-col gap-6">
                @foreach ($cvs as $cv)
                    <!-- CARD CV -->
                    <div @click="openDetail(@js($cv))"
                        class="cursor-pointer w-full border-2 border-[#1FACA2]
               px-8 py-4 rounded-2xl flex justify-between
               hover:bg-[#1FACA2]/5 transition">

                        <div class="flex gap-4">
                            <img src="/assets/cv/assets/folder.svg" class="w-10">
                            <div>
                                <p class="font-bold text-lg">{{ $cv->title }}</p>
                                <p class="text-gray-600">{{ $cv->subtitle }}</p>
                            </div>
                        </div>

                        <div class="flex gap-3 my-auto" @click.stop>
                            <a href="{{ route('cv.edit', $cv->id) }}"
                                class="bg-[#1FACA2] px-4 py-2 rounded-md text-white font-semibold cursor-pointer">
                                Edit
                            </a>

                            <button @click="openDelete({{ $cv->id }})"
                                class="bg-red-500 px-4 py-2 rounded-md text-white font-semibold cursor-pointer">
                                Delete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- MODAL DETAIL -->
            <div x-show="showDetail" x-cloak x-transition
                class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

                <div class="bg-white w-full max-w-2xl rounded-xl p-6" @click.outside="closeAll()">

                    <h2 class="text-2xl font-bold text-[#1FACA2]" x-text="cv.title"></h2>
                    <p class="text-gray-600 mb-4" x-text="cv.subtitle"></p>

                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <p><b>Umur:</b> <span x-text="cv.umur"></span></p>
                        <p><b>Kontak:</b> <span x-text="cv.kontak"></span></p>
                        <p><b>Universitas:</b> <span x-text="cv.universitas"></span></p>
                        <p><b>Jurusan:</b> <span x-text="cv.jurusan"></span></p>
                        <p><b>Pendidikan:</b> <span x-text="cv.pendidikan"></span></p>
                    </div>

                    {{-- <div class="mt-4">
                        <h3 class="font-semibold text-[#1FACA2]">Tentang Saya</h3>
                        <p x-text="cv.tentang_saya"></p>
                    </div>

                    <div class="mt-4">
                        <h3 class="font-semibold text-[#1FACA2]">Skill</h3>
                        <ul class="list-disc ml-6">
                            <template x-for="s in cv.skills">
                                <li x-text="`${s.skill} (${s.kemampuan}%)`"></li>
                            </template>
                        </ul>
                    </div> --}}

                    <div class="mt-4">
                        <h3 class="font-semibold text-[#1FACA2]">Pengalaman</h3>
                        <ul class="list-disc ml-6">
                            <template x-for="p in cv.pengalamans">
                                <li x-text="`${p.pengalaman} - ${p.durasi}`"></li>
                            </template>
                        </ul>
                    </div>

                    <button @click="closeAll()" class="mt-6 w-full bg-[#1FACA2] text-white py-2 rounded-lg">
                        Tutup
                    </button>
                </div>
            </div>

            <!-- MODAL DELETE -->
            <div x-show="showDelete" x-cloak x-transition
                class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

                <div class="bg-white w-full max-w-md rounded-xl p-6 text-center" @click.outside="closeAll()">

                    <h2 class="text-xl font-bold text-red-600">Hapus CV?</h2>
                    <p class="my-4">Data CV ini akan dihapus permanen.</p>

                    <div class="flex gap-4">
                        <button @click="closeAll()" class="w-1/2 border rounded-lg py-2">
                            Batal
                        </button>

                        <form :action="`/cv/${deleteId}`" method="POST" class="w-1/2">
                            @csrf
                            @method('DELETE')
                            <button class="w-full bg-red-500 text-white py-2 rounded-lg">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <script>
            function cvModal() {
                return {
                    showDetail: false,
                    showDelete: false,
                    cv: {},
                    deleteId: null,

                    openDetail(data) {
                        this.cv = data
                        this.showDetail = true
                    },

                    openDelete(id) {
                        this.deleteId = id
                        this.showDelete = true
                    },

                    closeAll() {
                        this.showDetail = false
                        this.showDelete = false
                        this.cv = {}
                        this.deleteId = null
                    }
                }
            }
        </script>
        <script src="/assets/menuSettings/setting.js"></script>
</body>

</html>
