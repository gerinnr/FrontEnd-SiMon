<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mata Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-xl font-bold text-center mb-4">Tambah Data Mata Kuliah</h2>
        <form action="{{ route('admin.matkul.store') }}" method="POST">
            @csrf
            <label class="block mb-2">Kode Mata Kuliah</label>
            <input type="text" name="kode_matkul" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Nama Mata Kuliah</label>
            <input type="text" name="nama_matkul" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">SKS</label>
            <input type="number" name="sks" class="w-full p-2 border rounded mb-4" required>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Tambah Data</button>
        </form>
        <a href="{{ route('admin.matkul.index') }}" class="block text-center mt-4 text-blue-500">Kembali</a>
    </div>
</body>
</html>