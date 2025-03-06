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
        <form action="" method="POST">
            <label class="block mb-2">NPM</label>
            <input type="number" name="npm" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Nama Mahasiswa</label>
            <input type="text" name="nama" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="w-full p-2 border rounded mb-4" required>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Simpan</button>
        </form>
        <a href="/admin/tampil_datamhs" class="block text-center mt-4 text-blue-500">Kembali</a>
    </div>
</body>
</html>