<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dosen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-xl font-bold text-center mb-4">Edit Data Dosen</h2>

        <!-- Alert untuk pesan sukses -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Alert untuk pesan error -->
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
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

        <form action="{{ route('admin.dosen.update', $dosen['nidn']) }}" method="POST">
            @csrf
            @method('PUT') 
            
            <!-- NIDN -->
            <label class="block mb-2">NIDN</label>
            <input type="number" name="nidn" 
                value="{{ old('nidn', $dosen['nidn']) }}"
                class="w-full p-2 border rounded mb-4 @error('nidn') border-red-500 @enderror" required>
            @error('nidn')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Nama Dosen -->
            <label class="block mb-2">Nama Dosen</label>
            <input type="text" name="nama_dosen"
                value="{{ old('nama_dosen', $dosen['nama_dosen']) }}"
                class="w-full p-2 border rounded mb-4 @error('nama_dosen') border-red-500 @enderror" required>
            @error('nama_dosen')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror


            <!-- Pilih User -->
            <label class="block mb-2">Username</label>
            <select name="id_user" class="w-full p-2 border rounded mb-4" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user['id_user'] }}"
                        {{ old('id_user', $dosen['username'] ?? '') == $user['username'] ? 'selected' : '' }}>
                        {{ $user['username'] }}
                    </option>
                @endforeach
            </select>
            @error('id_user')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Simpan Perubahan</button>
        </form>
        <a href="{{ route('admin.dosen.index') }}" class="block text-center mt-4 text-blue-500">Kembali</a>
    </div>
</body>
</html>
