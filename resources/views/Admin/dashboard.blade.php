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
                <li class="p-3 hover:bg-red-800 rounded">Dashboard</li>
                <li class="p-3 mt-2 hover:bg-red-800 rounded relative group">
                    Master Data  ▾
                    <ul class="absolute left-0 top-full bg-red-800 w-full hidden group-hover:block rounded-md shadow-lg">
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="/admin/tampil_datadosen">Data Dosen</a>
                        </li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">Data Mahasiswa</li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">Data Kelas</li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">Data Mata Kuliah</li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">Data Kehadiran</li>
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

            <!-- Dashboard Content -->
            <div class="mt-5 bg-white p-6 rounded shadow-lg">
                <div class="grid grid-cols-3 gap-6">
                    <div class="text-center p-5 border rounded-lg shadow">
                        <div class="text-5xl">👨‍🏫</div>
                        <div class="text-2xl font-bold" id="totalDosen">0</div>
                        <p class="mt-2">Data Dosen</p>
                    </div>
                    <div class="text-center p-5 border rounded-lg shadow">
                        <div class="text-5xl">🎓</div>
                        <div class="text-2xl font-bold" id="totalMahasiswa">0</div>
                        <p class="mt-2">Data Mahasiswa</p>
                    </div>
                    <div class="text-center p-5 border rounded-lg shadow">
                        <div class="text-5xl">📖</div>
                        <div class="text-2xl font-bold" id="totalKelas">0</div>
                        <p class="mt-2">Data Kelas</p>
                    </div>
                    <div class="text-center p-5 border rounded-lg shadow">
                        <div class="text-5xl">🖥️</div>
                        <div class="text-2xl font-bold" id="totalMataKuliah">0</div>
                        <p class="mt-2">Data Mata Kuliah</p>
                    </div>
                    <div class="text-center p-5 border rounded-lg shadow">
                        <div class="text-5xl">📄</div>
                        <div class="text-2xl font-bold" id="totalKehadiran">0</div>
                        <p class="mt-2">Data Kehadiran</p>
                    </div>
                </div>
            </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const profileButton = document.getElementById("profileButton");
            const profileDropdown = document.getElementById("profileDropdown");

            profileButton.addEventListener("click", function(event) {
                event.stopPropagation();
                profileDropdown.classList.toggle("hidden");
            });

            document.addEventListener("click", function(event) {
                if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileDropdown.classList.add("hidden");
                }
            });
        });

        document.getElementById("totalDosen").innerText = 60;
        document.getElementById("totalMahasiswa").innerText = 2208;
        document.getElementById("totalKelas").innerText = 20;
        document.getElementById("totalMataKuliah").innerText = 22;
        document.getElementById("totalKehadiran").innerText = 300;
    </script>
</body>
</html>