<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaKuy - Edit CV</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto mt-12 bg-white p-8 rounded-xl shadow-lg">

    <h1 class="text-2xl font-bold mb-6 text-[#1FACA2]">
        Edit CV
    </h1>

    <form action="{{ route('cv.update', $cv->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Data Pribadi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Umur</label>
                <input type="number" name="umur" value="{{ $cv->umur }}" required
                    class="w-full border border-[#1FACA2] rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1FACA2]">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Kontak</label>
                <input type="text" name="kontak" value="{{ $cv->kontak }}" required
                    class="w-full border border-[#1FACA2] rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1FACA2]">
            </div>
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Title</label>
            <input type="text" name="title" value="{{ $cv->title }}" required
                class="w-full border border-[#1FACA2] rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1FACA2]">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Subtitle</label>
            <input type="text" name="subtitle" value="{{ $cv->subtitle }}" required
                class="w-full border border-[#1FACA2] rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1FACA2]">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Tentang Saya</label>
            <textarea name="tentang_saya" rows="4" required
                class="w-full border border-[#1FACA2] rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1FACA2]">{{ $cv->tentang_saya }}</textarea>
        </div>

        <!-- Pendidikan -->
        <div class="border-t pt-6">
            <h2 class="text-lg font-semibold mb-4 text-[#1FACA2]">Pendidikan</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="universitas" value="{{ $cv->universitas }}" required
                    class="w-full border border-[#1FACA2] rounded-lg px-3 py-2">

                <input type="text" name="jurusan" value="{{ $cv->jurusan }}" required
                    class="w-full border border-[#1FACA2] rounded-lg px-3 py-2">
            </div>

            <div class="mt-4">
                <input type="text" name="pendidikan" value="{{ $cv->pendidikan }}" required
                    class="w-full border border-[#1FACA2] rounded-lg px-3 py-2">
            </div>
        </div>

        <!-- Skill -->
        <div class="border-t pt-6">
            <h2 class="text-lg font-semibold mb-4 text-[#1FACA2]">Skill (Max 3)</h2>

            @for ($i = 0; $i < 3; $i++)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                    <input type="text" name="skill[{{ $i }}][skill]"
                        value="{{ $cv->skills[$i]->skill ?? '' }}"
                        placeholder="Nama Skill"
                        class="w-full border border-[#1FACA2] rounded-lg px-3 py-2">

                    <input type="number" name="skill[{{ $i }}][kemampuan]"
                        value="{{ $cv->skills[$i]->kemampuan ?? '' }}"
                        placeholder="Kemampuan (1-100)"
                        class="w-full border border-[#1FACA2] rounded-lg px-3 py-2">
                </div>
            @endfor
        </div>

        <!-- Pengalaman -->
        <div class="border-t pt-6">
            <h2 class="text-lg font-semibold mb-4 text-[#1FACA2]">Pengalaman (Max 3)</h2>

            @for ($i = 0; $i < 3; $i++)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                    <input type="text" name="pengalaman[{{ $i }}][pengalaman]"
                        value="{{ $cv->pengalamans[$i]->pengalaman ?? '' }}"
                        placeholder="Nama Pengalaman"
                        class="w-full border border-[#1FACA2] rounded-lg px-3 py-2">

                    <input type="text" name="pengalaman[{{ $i }}][durasi]"
                        value="{{ $cv->pengalamans[$i]->durasi ?? '' }}"
                        placeholder="Durasi"
                        class="w-full border border-[#1FACA2] rounded-lg px-3 py-2">
                </div>
            @endfor
        </div>

        <button type="submit"
            class="w-full bg-[#1FACA2] hover:bg-[#178f86] text-white font-semibold py-3 rounded-lg transition">
            Update CV
        </button>

    </form>
</div>

</body>
</html>
