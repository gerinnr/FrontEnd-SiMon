<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Monitoring Kehadiran Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="text-center bg-[#f3f3eb] p-10 rounded-lg shadow-lg w-full h-full flex flex-col justify-center items-center">
        <h1 class="text-4xl font-bold mb-2">Selamat Datang di Sistem Monitoring Kehadiran Mahasiswa</h1>
        <p class="text-gray-600 text-xl mb-6">Silakan pilih opsi di bawah ini untuk melanjutkan.</p>
        <div class="flex justify-center gap-14 mt-6">
            <div class="text-center">
            <a href="{{ route('admin.login') }}" class="text-center hover:opacity-80">
                <img class="w-24 h-24 mx-auto mb-2" src="../assets/img/admin-login.png" alt="Admin"> 
                <p class="text-lg font-semibold">Admin</p>
            </a>
            </div>
            <div class="text-center">
            <a href="{{ route('dosen.login-dosen') }}" class="text-center hover:opacity-80">
                <img class="w-24 h-24 mx-auto mb-2" src="../assets/img/dosen-logo.png" alt="Dosen">
                <p class="text-lg font-semibold">Dosen</p>
            </a>
            </div>
            <div class="text-center">
            <a href="{{ route('mahasiswa.login-mhs') }}" class="text-center hover:opacity-80">
                <img class="w-24 h-24 mx-auto mb-2" src="../assets/img/mahasiswa-login.png" alt="Mahasiswa">
                <p class="text-lg font-semibold">Mahasiswa</p>
            </a>
            </div>
        </div>
    </div>
</body>
</html>