<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-red-900 text-white w-64 p-5 flex flex-col">
            <h1 class="text-2xl font-extrabold pl-6 pt-6 pb-4 border-b border-white/20">
                <span class="text-white">Si</span><span class="text-[#FFF8DC]">MON</span>
            </h1>
            <ul>
                <li class="rounded">
                    <a href="/admin/dashboard" class="flex items-center gap-2 p-3 hover:bg-red-800 rounded transition duration-200">
                        🏠 <span>Dashboard</span>
                    </a>
                </li>
                <li class="p-3 mt-2 hover:bg-red-800 rounded relative group">
                    📂 Master Data ▾
                    <ul class="absolute left-0 top-full bg-red-800 w-full hidden group-hover:block rounded-md shadow-lg">
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="{{ route('admin.dosen.index') }}">👨‍🏫 Data Dosen</a>
                        </li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="{{ route('admin.mhs.index') }}">🎓 Data Mahasiswa</a>
                        </li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="{{ route('admin.kls.index') }}">📖 Data Kelas</a>
                        </li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="{{ route('admin.matkul.index') }}">🖥️ Data Mata Kuliah</a>
                        </li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="{{ route('admin.hadir.index') }}">📄 Data Kehadiran</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-5">
            <!-- Navbar -->
            <div class="flex justify-between items-center bg-white p-4 shadow-md rounded-lg">
                <h2 class="text-lg font-semibold text-gray-800">📊 Sistem Monitoring Kehadiran Mahasiswa</h2>
                
                <!-- Dropdown dengan JavaScript -->
                <div class="relative" id="dropdownContainer">
                    <button onclick="toggleDropdown()" class="flex items-center gap-2 focus:outline-none cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Halo, Selamat Datang !</span>
                        <img src="../assets/img/icon-profil.jpg" alt="Admin" class="w-8 h-8 rounded-full">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="dropdownMenu" class="absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-48 hidden z-50">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200">Profil Saya</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200">Pengaturan</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="button" onclick="confirmLogoutSwal()" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-200">
                                Log Out
                            </button>
                        </form> 
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="mt-5 bg-white p-6 rounded shadow-lg">
                <div class="grid grid-cols-3 gap-6">
                    <div class="text-center p-5 border rounded-lg shadow">
                        <div class="text-5xl">👨‍🏫</div>
                        <div class="text-2xl font-bold" id="totalDosen">60</div>
                        <p class="mt-2">Total Data Dosen</p>
                    </div>
                    <div class="text-center p-5 border rounded-lg shadow">
                        <div class="text-5xl">🎓</div>
                        <div class="text-2xl font-bold" id="totalMahasiswa">2208</div>
                        <p class="mt-2">Total Data Mahasiswa</p>
                    </div>
                    <div class="text-center p-5 border rounded-lg shadow">
                        <div class="text-5xl">📖</div>
                        <div class="text-2xl font-bold" id="totalKelas">30</div>
                        <p class="mt-2">Total Data Kelas</p>
                    </div>
                    <div class="text-center p-5 border rounded-lg shadow">
                        <div class="text-5xl">🖥️</div>
                        <div class="text-2xl font-bold" id="totalMataKuliah">24</div>
                        <p class="mt-2">Total Data Mata Kuliah</p>
                    </div>
                    <div class="text-center p-5 border rounded-lg shadow">
                        <div class="text-5xl">📄</div>
                        <div class="text-2xl font-bold" id="totalKehadiran">145</div>
                        <p class="mt-2">Total Data Kehadiran</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Dropdown -->
    <script>
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownContainer = document.getElementById('dropdownContainer');

        function toggleDropdown() {
            dropdownMenu.classList.toggle('hidden');
        }

        // Tutup dropdown saat klik di luar area dropdown
        document.addEventListener('click', function(event) {
            if (!dropdownContainer.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Script konfirmasi logout
        function confirmLogoutSwal() {
            Swal.fire({
                title: 'Yakin ingin logout?',
                text: "Anda akan keluar dari sesi saat ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</body>
</html>