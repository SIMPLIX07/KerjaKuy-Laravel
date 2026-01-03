<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaKuy - Detail CV</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .display-box {
            @apply w-full border border-[#1FACA2] rounded-lg px-3 py-2 bg-gray-50 text-gray-800 min-h-[42px] flex items-center;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen pb-12">

    <div class="max-w-3xl mx-auto mt-12 bg-white p-8 rounded-xl shadow-lg">

        <h1 class="text-2xl font-bold mb-6 text-[#1FACA2]">
            Resume: {{ $cv->pelamar->nama }}
        </h1>

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Umur</label>
                    <div class="display-box">{{ $cv->umur }} Tahun</div>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Kontak</label>
                    <div class="display-box">{{ $cv->kontak }}</div>
                </div>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Title</label>
                <div class="display-box font-bold text-[#1FACA2]">{{ $cv->title }}</div>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Subtitle</label>
                <div class="display-box">{{ $cv->subtitle }}</div>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Tentang Saya</label>
                <div
                    class="w-full border border-[#1FACA2] rounded-lg px-3 py-2 bg-gray-50 text-gray-800 leading-relaxed">
                    {{ $cv->tentang_saya }}
                </div>
            </div>

            <div class="border-t pt-6">
                <h2 class="text-lg font-semibold mb-4 text-[#1FACA2]">
                    Pendidikan
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Universitas</label>
                        <div class="display-box">{{ $cv->universitas }}</div>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Jurusan</label>
                        <div class="display-box">{{ $cv->jurusan }}</div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block mb-1 font-medium text-gray-700">Jenjang Pendidikan</label>
                    <div class="display-box">{{ $cv->pendidikan }}</div>
                </div>
            </div>

            @if($cv->skills->count() > 0)
                <div class="border-t pt-6">
                    <h2 class="text-lg font-semibold mb-4 text-[#1FACA2]">
                        Skill
                    </h2>

                    @foreach ($cv->skills as $skill)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                            <div class="display-box">{{ $skill->skill }}</div>
                            <div class="display-box">Kemampuan: {{ $skill->kemampuan }}%</div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($cv->pengalamans->count() > 0)
                <div class="border-t pt-6">
                    <h2 class="text-lg font-semibold mb-4 text-[#1FACA2]">
                        Pengalaman
                    </h2>

                    @foreach ($cv->pengalamans as $pengalaman)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                            <div class="display-box">{{ $pengalaman->pengalaman }}</div>
                            <div class="display-box">Durasi: {{ $pengalaman->durasi }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</body>

</html>