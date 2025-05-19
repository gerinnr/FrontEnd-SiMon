<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-xl font-bold text-center mb-4">Edit Data Mahasiswa</h2>

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

        <form action="{{ route('admin.mhs.update', $mahasiswa['npm'])}}" method="POST">
            @csrf
            @method('PUT')

            <!-- NPM -->
            <label class="block mb-2">NPM</label>
            <input type="number" name="npm" value="{{ old('npm', $mahasiswa['npm']) }}" 
                   class="w-full p-2 border rounded mb-4 @error('npm') border-red-500 @enderror" required>
            @error('npm')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Nama Mahasiswa -->
            <label class="block mb-2">Nama Mahasiswa</label>
            <input type="text" name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $mahasiswa['nama_mahasiswa']) }}" 
                   class="w-full p-2 border rounded mb-4 @error('nama_mahasiswa') border-red-500 @enderror" required>
            @error('nama_mahasiswa')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Email -->
            <label class="block mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $mahasiswa['email']) }}" 
                   class="w-full p-2 border rounded mb-4 @error('email') border-red-500 @enderror" required>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Pilih User -->
            <label class="block mb-2">Pilih User</label>
            <select name="id_user" 
                    class="w-full p-2 border rounded mb-4 @error('id_user') border-red-500 @enderror" 
                    required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $u)
                    <option value="{{ $u['id_user'] }}" 
                        {{ old('id_user', $mahasiswa['username']) == $u['username'] ? 'selected' : '' }}>
                        {{ $u['username'] }}
                    </option>
                @endforeach
            </select>
            @error('id_user')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Pilih Kode Kelas -->
            <label class="block mb-2">Pilih Kode Kelas</label>
            <select name="kode_kelas" 
                    class="w-full p-2 border rounded mb-4 @error('kode_kelas') border-red-500 @enderror" 
                    required>
                <option value="">-- Pilih Kode Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k['kode_kelas'] }}" 
                        {{ old('kode_kelas', $mahasiswa['nama_kelas'] ?? '') == $k['nama_kelas'] ? 'selected' : '' }}>
                        {{ $k['kode_kelas'] }}
                    </option>
                @endforeach
            </select>
            @error('kode_kelas')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Simpan Perubahan</button>
        </form>
        <a href="/admin/mahasiswa" class="block text-center mt-4 text-blue-500">Kembali</a>
    </div>
</body>
</html>