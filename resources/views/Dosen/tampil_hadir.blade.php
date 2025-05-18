<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kehadiran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-red-900 text-white w-64 p-5 flex flex-col overflow-y-auto h-screen">
            <h1 class="text-2xl font-extrabold pl-6 pt-6 pb-4 border-b border-white/20">
            <span class="text-white">Si</span><span class="text-[#FFF8DC]">MON</span>
            </h1>
            <ul>
                <li class="rounded">
                    <a href="/dosen/dashboard" class="flex items-center gap-2 p-3 hover:bg-red-800 rounded transition duration-200">
                        🏠 <span>Dashboard</span>
                    </a>
                </li>
                <li class="p-3 mt-2 hover:bg-red-800 rounded relative group">
                    📂 Master Data ▾
                    <ul class="absolute left-0 top-full bg-red-800 w-full hidden group-hover:block rounded-md shadow-lg">
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="/dosen/mahasiswa">🎓 Data Mahasiswa</a>
                        </li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded">
                            <a href="">📄 Data Kehadiran</a>
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
                
                <!-- Dropdown -->
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

            <!-- Data Kehadiran -->
            <div class="w-full bg-white p-6 rounded-lg shadow-md mt-6">
                <h2 class="text-4xl font-semibold text-gray-700 mb-4 text-center">Data Kehadiran</h2>
                <!-- Tambah Data -->
                <a href="{{ route('dosen.hadir.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg w-20 text-center">Tambah Data</a>
                <!-- Search Bar -->
                <input type="text" id="searchInput" placeholder="Search..." class="w-50 p-2 mb-4 border rounded-lg">

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border p-2">No</th>
                                <th class="border p-2">ID Kehadiran</th>
                                <th class="border p-2">NPM</th>
                                <th class="border p-2">Nama Mahasiswa</th>
                                <th class="border p-2">Tanggal</th>
                                <th class="border p-2">Pertemuan</th>
                                <th class="border p-2">Status</th>
                                <th class="border p-2">Nama MataKuliah</th>
                                <th class="border p-2">Nama Dosen</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="kehadiranTableBody">
                            @foreach ($kehadiran as $index => $hadir)
                            <tr>
                            <td class="border p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border p-2 text-center">{{ $hadir['id_kehadiran'] }}</td>
                            <td class="border p-2 text-center">{{ $hadir['npm'] }}</td>
                            <td class="border p-2">{{ $hadir['nama_mahasiswa'] }}</td>
                            <td class="border p-2">{{ $hadir['tanggal'] }}</td>
                            <td class="border p-2 text-center">{{ $hadir['pertemuan'] }}</td>
                            <td class="border p-2">{{ $hadir['status'] }}</td>
                            <td class="border p-2">{{ $hadir['nama_matkul'] }}</td>
                            <td class="border p-2">{{ $hadir['nama_dosen'] }}</td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('dosen.hadir.edit', $hadir['id_kehadiran']) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                <form action="{{ route('dosen.hadir.destroy', $hadir['id_kehadiran']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-between items-center mt-4">
                        <button id="prevPage" class="bg-gray-400 text-white px-3 py-1 rounded hover:bg-gray-500">Back</button>
                        <span id="pageInfo" class="text-gray-700">Page 1</span>
                        <button id="nextPage" class="bg-gray-400 text-white px-3 py-1 rounded hover:bg-gray-500">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <script>
        //konfirmasi logout
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

        //dropdown
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownContainer = document.getElementById('dropdownContainer');

        function toggleDropdown() {
            dropdownMenu.classList.toggle('hidden');
        }

        // perintah tutup dropdown kalo klik di luar area dropdown
        document.addEventListener('click', function(event) {
        if (!dropdownContainer.contains(event.target) && !event.target.closest('#dropdownContainer')) {
            dropdownMenu.classList.add('hidden');
        }
        });

        // search 
        document.getElementById('searchInput').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#kehadiranTableBody tr');

            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                const match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
                row.style.display = match ? '' : 'none';
            });
        });

        // fungsi halaman
        document.addEventListener('DOMContentLoaded', function () {
        const rowsPerPage = 7; // ini buat jumlah baris per halaman
        const tableBody = document.getElementById('kehadiranTableBody');
        const rows = Array.from(tableBody.querySelectorAll('tr'));
        const prevPageBtn = document.getElementById('prevPage');
        const nextPageBtn = document.getElementById('nextPage');
        const pageInfo = document.getElementById('pageInfo');

        let currentPage = 1;
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        function showPage(page) {
            currentPage = page;
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            // tampil baris sesuai halaman
            rows.forEach((row, index) => {
                row.style.display = (index >= start && index < end) ? '' : 'none';
            });

            // update info halaman
            pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;

            // buat atur status tombol
            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = currentPage === totalPages;
        }

        // ini buat tombol back
        prevPageBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                showPage(currentPage - 1);
            }
        });

        // kalo ini tombol next
        nextPageBtn.addEventListener('click', () => {
            if (currentPage < totalPages) {
                showPage(currentPage + 1);
            }
        });

        // tampil halaman pertama saat load
        showPage(1);
    });
        </script>
</body>
</html>