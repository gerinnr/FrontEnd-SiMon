<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kehadiran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-xl font-bold text-center mb-4">Edit Data Kehadiran</h2>
        <form action="" method="POST">
        <label class="block mb-2">NPM</label>
            <input type="number" name="npm" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Nama Mahasiswa</label>
            <input type="text" name="nama_mahasiswa" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Tanggal</label>
            <input type="date" name="tanggal" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Pertemuan</label>
            <input type="number" name="pertemuan" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Status</label>
            <input type="text" name="status" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Nama Mata Kuliah</label>
            <input type="text" name="nama_matkul" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Nama Dosen</label>
            <input type="text" name="nama_dosen" class="w-full p-2 border rounded mb-4" required>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Simpan</button>
        </form>
        <a href="/admin/tampil_hadir" class="block text-center mt-4 text-blue-500">Kembali</a>
    </div>
</body>
</html>