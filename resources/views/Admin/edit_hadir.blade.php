<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Data Kehadiran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold text-center mb-4">Edit Data Kehadiran</h2>

        <!-- Alert sukses -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Alert error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.hadir.update', $kehadiran['id_kehadiran'] ?? '') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- NPM -->
            <label class="block mb-2">NPM</label>
            <select name="npm" id="npm" class="w-full p-2 border rounded mb-4" required onchange="isiNama()">
                <option value="">-- Pilih NPM --</option>
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs['npm'] }}" 
                        data-nama="{{ $mhs['nama_mahasiswa'] ?? '' }}"
                        {{ (old('npm', $kehadiran['npm'] ?? '') == $mhs['npm']) ? 'selected' : '' }}>
                        {{ $mhs['npm'] }} - {{ $mhs['nama_mahasiswa'] ?? '' }}
                    </option>
                @endforeach
            </select>

            <!-- Nama Mahasiswa (readonly) -->
            <label class="block mb-2">Nama Mahasiswa</label>
            <input type="text" id="nama_mahasiswa" class="w-full p-2 border rounded mb-4 bg-gray-100" 
                value="{{ old('nama_mahasiswa', '') }}" readonly>

            <!-- Tanggal -->
            <label class="block mb-2">Tanggal</label>
            <input type="date" name="tanggal" class="w-full p-2 border rounded mb-4" 
                value="{{ old('tanggal', $kehadiran['tanggal'] ?? '') }}" required>

            <!-- Pertemuan -->
            <label class="block mb-2">Pertemuan</label>
            <input type="number" name="pertemuan" class="w-full p-2 border rounded mb-4" 
                value="{{ old('pertemuan', $kehadiran['pertemuan'] ?? '') }}" required>

            <!-- Status -->
            <label class="block mb-2">Status</label>
            <select name="status" class="w-full p-2 border rounded mb-4" required>
                <option value="">-- Pilih Status --</option>
                @foreach (['Hadir', 'Alpha', 'Izin', 'Sakit'] as $status)
                    <option value="{{ $status }}" {{ old('status', $kehadiran['status'] ?? '') == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>

            <!-- Mata Kuliah -->
            <label class="block mb-2">Pilih Mata Kuliah</label>
            <select name="kode_matkul" class="w-full p-2 border rounded mb-4 @error('kode_matkul') border-red-500 @enderror" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach($matkul as $m)
                    <option value="{{ $m['kode_matkul'] }}" {{ old('kode_matkul', $kehadiran['kode_matkul'] ?? '') == $m['kode_matkul'] ? 'selected' : '' }}>
                        {{ $m['kode_matkul'] }} - {{ $m['nama_matkul'] ?? '' }}
                    </option>
                @endforeach
            </select>
            @error('kode_matkul')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Dosen -->
            <label class="block mb-2">Dosen (NIDN)</label>
            <select name="nidn" id="nidn" class="w-full p-2 border rounded mb-4" required>
                <option value="">-- Pilih Dosen --</option>
                @foreach ($dosen as $dsn)
                    <option value="{{ $dsn['nidn'] }}" {{ old('nidn', $kehadiran['nidn'] ?? '') == $dsn['nidn'] ? 'selected' : '' }}>
                        {{ $dsn['nidn'] }} - {{ $dsn['nama_dosen'] ?? '' }}
                    </option>
                @endforeach
            </select>

            <!-- Kelas -->
            <label class="block mb-2">Kelas</label>
            <select name="kode_kelas" class="w-full p-2 border rounded mb-4" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $kls)
                    <option value="{{ $kls['kode_kelas'] }}" {{ old('kode_kelas', $kehadiran['kode_kelas'] ?? '') == $kls['kode_kelas'] ? 'selected' : '' }}>
                        {{ $kls['kode_kelas'] }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Simpan Perubahan</button>
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

    window.onload = function() {
        isiNama();
    };
    </script>
</body>
</html>