<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
    <div class="d-flex" style="min-height: 100vh;">

        {{-- Sisi Kiri: Sidebar (Sama dengan Settings) --}}
        <div class="cstm-sidebar p-4 text-white">
            <h4 class="mb-4">Pengaturan</h4>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link cstm-nav-link" href="{{ route('pelamar.settings') }}" role="tab">
                    <i class="fas fa-user-circle me-2"></i> Akun
                </a>
                <a class="nav-link cstm-nav-link active" href="{{ route('cv.index') }}" role="tab">
                    <i class="fas fa-file-alt me-2"></i> CV
                </a>
                <a class="nav-link cstm-nav-link" href="#" role="tab">
                    <i class="fas fa-shield-alt me-2"></i> Keamanan
                </a>
            </div>
        </div>

        {{-- Sisi Kanan: Konten CV --}}
        <div class="flex-grow-1 p-5 bg-white">
            <div class="w-full mx-auto">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="mb-4">Daftar CV</h2>

                    <a href="{{ route('cv.create') }}"
                        class="px-5 py-2 rounded-lg text-white font-semibold no-underline"
                        style="background-color:#1FACA2">
                        + Tambah CV
                    </a>
                </div>

                <hr class="mb-8 border-gray-200">

                <div x-data="cvModal()" class="space-y-4">
                    <div class="flex flex-col gap-6">
                        @foreach ($cvs as $cv)
                            <div @click="openDetail(@js($cv))"
                                class="cursor-pointer w-full border-2 border-[#1FACA2] px-8 py-4 rounded-2xl flex justify-between hover:bg-[#1FACA2]/5 transition">

                                <div class="flex gap-4">
                                    <img src="/assets/cv/assets/folder.svg" class="w-10">
                                    <div>
                                        <p class="font-bold text-lg text-gray-800">{{ $cv->title }}</p>
                                        <p class="text-gray-600">{{ $cv->subtitle }}</p>
                                    </div>
                                </div>

                                <div class="flex gap-3 my-auto" @click.stop>
                                    <a href="{{ route('cv.edit', $cv->id) }}"
                                        class="bg-[#1FACA2] px-4 py-2 rounded-md text-white font-semibold no-underline">
                                        Edit
                                    </a>

                                    <button @click="openDelete({{ $cv->id }})"
                                        class="bg-red-500 px-4 py-2 rounded-md text-white font-semibold">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div x-show="showDetail" x-cloak x-transition
                        class="fixed inset-0 bg-black/50 flex items-center justify-center z-[1050]">

                        <div class="bg-white w-full max-w-2xl rounded-xl p-6 shadow-2xl" @click.outside="closeAll()">

                            <!-- Header -->
                            <h2 class="text-2xl font-bold text-[#1FACA2]" x-text="cv.title"></h2>
                            <p class="text-gray-600" x-text="cv.subtitle"></p>

                            <!-- Info Utama -->
                            <div class="flex flex-col gap-2 text-sm mt-4 border-t pt-4">
                                <p><b>Umur:</b> <span x-text="cv.umur ?? '-'"></span></p>
                                <p><b>Kontak:</b> <span x-text="cv.kontak ?? '-'"></span></p>
                                <p class="col-span-2">
                                    <b>Tentang Saya:</b>
                                    <span x-text="cv.tentang_saya ?? '-'"></span>
                                </p>
                            </div>

                            <!-- Pendidikan -->
                            <div class="mt-4 border-t pt-4">
                                <h3 class="font-semibold text-[#1FACA2] mb-2">🎓 Pendidikan</h3>

                                <template x-if="cv.pendidikans?.length">
                                    <ul class="list-disc ml-6 space-y-1">
                                        <template x-for="p in cv.pendidikans" :key="p.id">
                                            <li>
                                                <span x-text="p.universitas"></span> —
                                                <span x-text="p.jurusan"></span>
                                                (<span x-text="p.tingkat"></span>)
                                            </li>
                                        </template>
                                    </ul>
                                </template>

                                <template x-if="!cv.pendidikans?.length">
                                    <p class="text-gray-400">Belum ada pendidikan</p>
                                </template>
                            </div>

                            <!-- Pengalaman -->
                            <div class="mt-4 border-t pt-4">
                                <h3 class="font-semibold text-[#1FACA2] mb-2">💼 Pengalaman</h3>

                                <template x-if="cv.pengalamans?.length">
                                    <ul class="list-disc ml-6 space-y-1">
                                        <template x-for="p in cv.pengalamans" :key="p.id">
                                            <li>
                                                <span x-text="p.posisi"></span> -
                                                <span x-text="p.perusahaan"></span>
                                                (<span x-text="p.durasi"></span>)
                                            </li>
                                        </template>
                                    </ul>
                                </template>

                                <template x-if="!cv.pengalamans?.length">
                                    <p class="text-gray-400">Belum ada pengalaman</p>
                                </template>
                            </div>

                            <!-- Skill -->
                            <div class="mt-4 border-t py-4">
                                <h3 class="font-semibold text-[#1FACA2] mb-2">🛠 Skill</h3>

                                <template x-if="cv.skills?.length">
                                    <div class="flex flex-wrap gap-2">
                                        <template x-for="s in cv.skills" :key="s.id">
                                            <span class="px-3 py-1 bg-[#1FACA2]/10 text-[#1FACA2] rounded-full text-sm"
                                                x-text="s.skill">
                                            </span>
                                        </template>
                                    </div>
                                </template>

                                <template x-if="!cv.skills?.length">
                                    <p class="text-gray-400">Belum ada skill</p>
                                </template>
                            </div>

                            <!-- Close -->
                            <button @click="closeAll()"
                                class="mt-6 w-full bg-[#1FACA2] text-white py-2 rounded-lg font-bold">
                                Tutup
                            </button>
                        </div>
                    </div>

                    <div x-show="showDelete" x-cloak x-transition
                        class="fixed inset-0 bg-black/50 flex items-center justify-center z-[1050]">
                        <div class="bg-white w-full max-w-md rounded-xl p-6 text-center shadow-2xl"
                            @click.outside="closeAll()">
                            <h2 class="text-xl font-bold text-red-600">Hapus CV?</h2>
                            <p class="my-4 text-gray-600">Data CV ini akan dihapus permanen.</p>
                            <div class="flex gap-4">
                                <button @click="closeAll()" class="w-1/2 border rounded-lg py-2 hover:bg-gray-50">
                                    Batal
                                </button>
                                <form :action="`/cv/${deleteId}`" method="POST" class="w-1/2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-full bg-red-500 text-white py-2 rounded-lg font-bold">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function cvModal() {
            return {
                showDetail: false,
                showDelete: false,
                cv: {},
                deleteId: null,
                openDetail(data) {
            console.log(data); 
            this.cv = data;
            this.showDetail = true;
        },
                openDelete(id) {
                    this.deleteId = id;
                    this.showDelete = true;
                },
                closeAll() {
                    this.showDetail = false;
                    this.showDelete = false;
                    this.cv = {};
                    this.deleteId = null;
                }
                
            }
        }
        
    </script>
</body>

</html>
