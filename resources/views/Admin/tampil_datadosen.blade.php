<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-red-900 text-white w-64 p-5 flex flex-col">
            <h1 class="text-xl font-bold mb-5">SiMON</h1>
            <ul>
                <li class="p-3 hover:bg-red-800 rounded">
                    <a href="/admin/dashboard">Dashboard</a>
                </li>
                <li class="p-3 mt-2 hover:bg-red-800 rounded relative group">
                    Master Data
                    <ul class="absolute left-0 top-full bg-red-800 w-full hidden group-hover:block rounded-md shadow-lg">
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="/admin/tampil_datadosen">Data Dosen</a>
                        </li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="#">Data Mahasiswa</a>
                        </li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="#">Data Kelas</a>
                        </li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="#">Data Mata Kuliah</a>
                        </li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="#">Data Kehadiran</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-5">
            <!-- Navbar -->
            <div class="flex justify-between items-center bg-white p-4 shadow-md rounded-lg">
                <h2 class="text-lg font-semibold text-gray-800">Sistem Monitoring Kehadiran Mahasiswa</h2>
                <div class="relative">
                    <button id="profileButton" class="flex items-center gap-2 focus:outline-none cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Halo, Selamat Datang !</span>
                        <img src="../assets/img/icon-profil.jpg" alt="Admin" class="w-8 h-8 rounded-full">
                        <svg class="w-4 h-4 text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="profileDropdown" class="absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-48 hidden">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200">Profil Saya</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200">Pengaturan</a>
                        <a href="#" class="block px-4 py-2 text-red-600 hover:bg-gray-200">Log Out</a>
                    </div>
                </div>
            </div>

            <!-- Data Dosen -->
            <div class="max-w-4xl mx-auto bg-white p-4 rounded-lg shadow-md mt-6">
                <h2 class="text-4xl font-semibold text-gray-700 mb-4 text-center">Data Dosen</h2>

                <!-- Form Tambah Data -->
                <form id="dosen-form" class="mb-4 grid grid-cols-4 gap-2">
                    <button type="submit" class="bg-blue-500 text-white px-2 py-2 rounded-lg w-20">Tambah</button>
                </form>

                <!-- Search Bar -->
                <input type="text" id="search" placeholder="Cari nama dosen..." class="w-full p-2 mb-4 border rounded-lg">

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border p-2">No</th>
                                <th class="border p-2">NIDN</th>
                                <th class="border p-2">Nama Dosen</th>
                                <th class="border p-2">Mata Kuliah</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- Data akan diisi lewat JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Dropdown -->
    <!-- <script>
        document.getElementById("profileButton").addEventListener("click", function() {
            document.getElementById("profileDropdown").classList.toggle("hidden");
        });
    </script> -->
</body>
</html>
