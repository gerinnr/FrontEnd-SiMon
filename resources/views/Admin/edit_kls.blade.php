<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-xl font-bold text-center mb-4">Edit Data Kelas</h2>

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

        <form action="{{ route('admin.kls.update', $kelas['kode_kelas']) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Kode Kelas -->
            <label for="kode_kelas" class="block text-sm font-medium text-gray-700 mb-1">Kode Kelas</label>
            <input type="text" name="kode_kelas" id="kode_kelas"
                class="w-full p-2 border rounded mb-3 @error('kode_kelas') border-red-500 @enderror"
                value="{{ old('kode_kelas', $kelas['kode_kelas']) }}" required>
            @error('kode_kelas')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Nama Kelas -->
            <label for="nama_kelas" class="block text-sm font-medium text-gray-700 mb-1">Nama Kelas</label>
            <input type="text" name="nama_kelas" id="nama_kelas"
                class="w-full p-2 border rounded mb-3 @error('nama_kelas') border-red-500 @enderror"
                value="{{ old('nama_kelas', $kelas['nama_kelas']) }}" required>
            @error('nama_kelas')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Simpan Perubahan</button>
        </form>
        <a href="{{ route('admin.kls.index') }}" class="block text-center mt-4 text-blue-500">Kembali</a>
    </div>
</body>
</html>