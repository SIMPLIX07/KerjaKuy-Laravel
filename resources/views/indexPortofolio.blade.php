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

        {{-- Sidebar --}}
        <div class="cstm-sidebar p-4 text-white">
            <h4 class="mb-4">Pengaturan</h4>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link cstm-nav-link" href="{{ route('pelamar.settings') }}" role="tab">
                    <i class="fas fa-user-circle me-2"></i> Akun
                </a>
                <a class="nav-link cstm-nav-link" href="{{ route('cv.index') }}" role="tab">
                    <i class="fas fa-file-alt me-2"></i> CV
                </a>
                <a class="nav-link cstm-nav-link active" href="{{ route('portofolio.index') }}" role="tab">
                    <i class="fas fa-briefcase me-2"></i> Portofolio
                </a>
                <a class="nav-link cstm-nav-link" href="#" role="tab">
                    <i class="fas fa-shield-alt me-2"></i> Keamanan
                </a>
            </div>
        </div>

        {{-- Konten Portofolio --}}
        <div class="flex-grow-1 p-5 bg-white">
            <div class="w-full mx-auto">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="mb-4">Daftar Portofolio</h2>

                    <a href="{{ route('portofolio.create') }}"
                        class="px-5 py-2 rounded-lg text-white font-semibold !no-underline"
                        style="background-color:#1FACA2 ">
                        + Tambah Portofolio
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <hr class="mb-8 border-gray-200">

                <div x-data="portofolioModal()" class="space-y-4">
                    <div class="flex flex-col gap-6">
                        @forelse ($portofolios as $p)
                            <div @click="openDetail(@js($p))"
                                class="cursor-pointer w-full border-2 border-[#1FACA2] px-8 py-4 rounded-2xl flex justify-between hover:bg-[#1FACA2]/5 transition">

                                <div class="flex gap-4">
                                    <img src="/assets/cv/assets/folder.svg" class="w-10">
                                    <div>
                                        <p class="font-bold text-lg text-gray-800">{{ $p->judul }}</p>
                                        <p class="text-gray-600">{{ $p->kategori ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="flex gap-3 my-auto" @click.stop>
                                    <form action="{{ route('portofolio.destroy', $p->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 px-4 py-2 !rounded-md text-white font-semibold">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-gray-500">Belum ada portofolio.</div>
                        @endforelse
                    </div>

                    <div x-show="showDetail" x-cloak x-transition
                        class="fixed inset-0 bg-black/50 flex items-center justify-center z-[1050]">

                        <div class="bg-white w-full max-w-2xl rounded-xl p-6 shadow-2xl" @click.outside="closeAll()">

                            <h2 class="text-2xl font-bold text-[#1FACA2]" x-text="portofolio.judul"></h2>
                            <p class="text-gray-600" x-text="portofolio.kategori ?? '-' "></p>

                            <div class="flex flex-col gap-2 text-sm mt-4 border-t pt-4">
                                <p>
                                    <b>Teknologi:</b>
                                    <span x-text="portofolio.teknologi ?? '-' "></span>
                                </p>
                                <p>
                                    <b>Link Demo:</b>
                                    <span x-text="portofolio.link_demo ?? '-' "></span>
                                </p>
                                <p>
                                    <b>Link Repo:</b>
                                    <span x-text="portofolio.link_repo ?? '-' "></span>
                                </p>
                                <p>
                                    <b>Tanggal:</b>
                                    <span x-text="(portofolio.tanggal_mulai ?? '-') + ' - ' + (portofolio.tanggal_selesai ?? '-')"></span>
                                </p>
                                <p class="col-span-2">
                                    <b>Deskripsi:</b>
                                    <span x-text="portofolio.deskripsi ?? '-' "></span>
                                </p>
                            </div>

                            <button @click="closeAll()"
                                class="mt-6 w-full bg-[#1FACA2] text-white py-2 rounded-lg font-bold">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function portofolioModal() {
            return {
                showDetail: false,
                portofolio: {},
                openDetail(data) {
                    this.portofolio = data;
                    this.showDetail = true;
                },
                closeAll() {
                    this.showDetail = false;
                    this.portofolio = {};
                }
            }
        }
    </script>
</body>

</html>
