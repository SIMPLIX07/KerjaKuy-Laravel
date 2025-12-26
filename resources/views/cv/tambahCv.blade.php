<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaKuy - Buat CV</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto mt-12 bg-white p-8 rounded-xl shadow-lg">

        <h1 class="text-2xl font-bold mb-6 text-[#1FACA2]">
            Buat CV
        </h1>

        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-[#1FACA2]/10 text-[#1FACA2]">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('cv.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Data Pribadi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Umur</label>
                    <input type="number" name="umur" required
                        class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                               focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Kontak</label>
                    <input type="text" name="kontak" required
                        class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                               focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">
                </div>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Title</label>
                <input type="text" name="title" required
                    class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                           focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Subtitle</label>
                <input type="text" name="subtitle" required
                    class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                           focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Tentang Saya</label>
                <textarea name="tentang_saya" rows="4" required
                    class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                           focus:outline-none focus:ring-2 focus:ring-[#1FACA2]"></textarea>
            </div>

            <!-- Pendidikan -->
            <div class="border-t pt-6">
                <h2 class="text-lg font-semibold mb-4 text-[#1FACA2]">
                    Pendidikan
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Universitas</label>
                        <input type="text" name="universitas" required
                            class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                       focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Jurusan</label>
                        <input type="text" name="jurusan" required
                            class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                       focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block mb-1 font-medium text-gray-700">Jenjang Pendidikan</label>
                    <input type="text" name="pendidikan" required placeholder="Contoh: S1, D3, SMA"
                        class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">
                </div>
            </div>

            <!-- Skill -->
            <div class="border-t pt-6">
                <h2 class="text-lg font-semibold mb-4 text-[#1FACA2]">
                    Skill (Maksimal 3)
                </h2>

                @for ($i = 0; $i < 3; $i++)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                        <input type="text" name="skill[{{ $i }}][skill]" placeholder="Nama Skill"
                            class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">

                        <input type="number" name="skill[{{ $i }}][kemampuan]" min="1" max="100"
                            placeholder="Kemampuan (1-100)"
                            class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">
                    </div>
                @endfor
            </div>

            <!-- Pengalaman -->
            <div class="border-t pt-6">
                <h2 class="text-lg font-semibold mb-4 text-[#1FACA2]">
                    Pengalaman (Maksimal 3)
                </h2>

                @for ($i = 0; $i < 3; $i++)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                        <input type="text" name="pengalaman[{{ $i }}][pengalaman]"
                            placeholder="Nama Pengalaman"
                            class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">

                        <input type="text" name="pengalaman[{{ $i }}][durasi]"
                            placeholder="Durasi (contoh: 6 bulan)"
                            class="w-full border border-[#1FACA2] rounded-lg px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-[#1FACA2]">
                    </div>
                @endfor
            </div>

            <button type="submit"
                class="w-full bg-[#1FACA2] hover:bg-[#178f86]
                       text-white font-semibold py-3 rounded-lg transition">
                Simpan CV
            </button>

        </form>
    </div>

</body>

</html>
