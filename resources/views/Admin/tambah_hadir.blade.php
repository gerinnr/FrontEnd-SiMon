<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kehadiran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold text-center mb-4">Tambah Data Kehadiran</h2>

        <!-- Alert untuk pesan sukses -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Alert untuk pesan error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Error dari validasi Laravel -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.hadir.store') }}" method="POST">
            @csrf

            <!-- NPM (Mahasiswa) -->
            <label class="block mb-2">NPM</label>
            <select name="npm" id="npm" class="w-full p-2 border rounded mb-4" required onchange="isiNama()">
                <option value="">-- Pilih NPM --</option>
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs['npm'] }}" data-nama="{{ $mhs['nama_mahasiswa'] }}">
                        {{ $mhs['npm'] }}
                    </option>
                @endforeach
            </select>

            <!-- Nama Mahasiswa (readonly) -->
            <label class="block mb-2">Nama Mahasiswa</label>
            <input type="text" id="nama_mahasiswa" class="w-full p-2 border rounded mb-4 bg-gray-100" readonly>

            <label class="block mb-2">Tanggal</label>
            <input type="date" name="tanggal" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Pertemuan</label>
            <input type="number" name="pertemuan" class="w-full p-2 border rounded mb-4" required>

            <!-- Status -->
            <label class="block mb-2">Status</label>
            <select name="status" class="w-full p-2 border rounded mb-4" required>
                <option value="">-- Pilih Status --</option>
                <option value="Hadir">Hadir</option>
                <option value="Alpha">Alpha</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
            </select>

            <!-- Pilih Kode Matakuliah -->
            <label class="block mb-2">Pilih Mata Kuliah</label>
            <select name="kode_matkul" 
                    class="w-full p-2 border rounded mb-4 @error('kode_matkul') border-red-500 @enderror" 
                    required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach($matkul as $m)
                    <option value="{{ $m['kode_matkul'] }}" 
                        {{ old('kode_matkul') == $m['kode_matkul'] ? 'selected' : '' }}>
                        {{ $m['kode_matkul'] }}
                    </option>
                @endforeach
            </select>
            @error('kode_matkul')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Dosen (NIDN) -->
            <label class="block mb-2">Dosen (NIDN)</label>
            <select name="nidn" id="nidn" class="w-full p-2 border rounded mb-4" required onchange="isiNamaDosen()">
                <option value="">-- Pilih Dosen --</option>
                @foreach ($dosen as $dsn)
                    <option value="{{ $dsn['nidn'] }}" data-nama="{{ $dsn['nama_dosen'] }}">
                        {{ $dsn['nidn'] }}
                    </option>
                @endforeach
            </select>


            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Tambah Data</button>
        </form>
        <a href="{{ route('admin.hadir.index') }}" class="block text-center mt-4 text-blue-500">Kembali</a>
    </div>

    <script>
    function isiNama() {
        const npmSelect = document.getElementById('npm');
        const selectedOption = npmSelect.options[npmSelect.selectedIndex];
        const nama = selectedOption.getAttribute('data-nama') || '';
        document.getElementById('nama_mahasiswa').value = nama;
    }
</script>

</body>
</html>