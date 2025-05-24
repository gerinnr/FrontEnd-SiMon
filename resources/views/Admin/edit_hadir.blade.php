<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Data Kehadiran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="bg-red-900 text-white w-64 p-5 flex flex-col overflow-y-auto">
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
                        <li class="pl-6 p-2 hover:bg-red-700 rounded"><a href="{{ route('admin.dosen.index') }}">👨‍🏫 Data Dosen</a></li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded"><a href="{{ route('admin.mhs.index') }}">🎓 Data Mahasiswa</a></li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded"><a href="{{ route('admin.kls.index') }}">📖 Data Kelas</a></li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded"><a href="{{ route('admin.matkul.index') }}">🖥️ Data Mata Kuliah</a></li>
                        <li class="pl-6 p-2 hover:bg-red-700 rounded"><a href="{{ route('admin.hadir.index') }}">📄 Data Kehadiran</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-5 flex flex-col">
            <!-- Navbar -->
            <div class="flex justify-between items-center bg-white p-4 shadow-md rounded-lg mb-6">
                <h2 class="text-lg font-semibold text-gray-800">📊 Sistem Monitoring Kehadiran Mahasiswa</h2>
                <div class="relative" id="dropdownContainer">
                    <button onclick="toggleDropdown()" class="flex items-center gap-2 focus:outline-none cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Halo, Selamat Datang !</span>
                        <img src="../assets/img/icon-profil.jpg" alt="Admin" class="w-8 h-8 rounded-full">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg>
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

            <!-- Form Edit Section -->
            <div class="flex justify-center items-center flex-grow">
                <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                    <h2 class="text-xl font-bold text-center mb-4">Edit Data Kehadiran</h2>

                    @if (session('success'))
                        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.hadir.update', $kehadiran['id_kehadiran'] ?? '') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label class="block mb-2">NPM</label>
                        <select name="npm" id="npm" class="w-full p-2 border rounded mb-4" required onchange="isiNama()">
                            <option value="">-- Pilih NPM --</option>
                            @foreach ($mahasiswa as $mhs)
                                <option value="{{ $mhs['npm'] }}" data-nama="{{ $mhs['nama_mahasiswa'] ?? '' }}" {{ (old('npm', $kehadiran['npm'] ?? '') == $mhs['npm']) ? 'selected' : '' }}>
                                    {{ $mhs['npm'] }} - {{ $mhs['nama_mahasiswa'] ?? '' }}
                                </option>
                            @endforeach
                        </select>

                        <label class="block mb-2">Nama Mahasiswa</label>
                        <input type="text" id="nama_mahasiswa" class="w-full p-2 border rounded mb-4 bg-gray-100" value="{{ old('nama_mahasiswa', '') }}" readonly>

                        <label class="block mb-2">Tanggal</label>
                        <input type="date" name="tanggal" class="w-full p-2 border rounded mb-4" value="{{ old('tanggal', $kehadiran['tanggal'] ?? '') }}" required>

                        <label class="block mb-2">Pertemuan</label>
                        <input type="number" name="pertemuan" class="w-full p-2 border rounded mb-4" value="{{ old('pertemuan', $kehadiran['pertemuan'] ?? '') }}" required>

                        <label class="block mb-2">Status</label>
                        <select name="status" class="w-full p-2 border rounded mb-4" required>
                            <option value="">-- Pilih Status --</option>
                            @foreach (['Hadir', 'Alpha', 'Izin', 'Sakit'] as $status)
                                <option value="{{ $status }}" {{ old('status', $kehadiran['status'] ?? '') == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>

                        <label class="block mb-2">Mata Kuliah</label>
                        <select name="kode_matkul" class="w-full p-2 border rounded mb-4 @error('kode_matkul') border-red-500 @enderror" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach($matkul as $m)
                                <option value="{{ $m['kode_matkul'] }}" {{ old('kode_matkul', $kehadiran['nama_matkul'] ?? '') == $m['nama_matkul'] ? 'selected' : '' }}>
                                    {{ $m['kode_matkul'] }} - {{ $m['nama_matkul'] ?? '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('kode_matkul')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <label class="block mb-2">Nama Dosen</label>
                        <select name="nidn" id="nidn" class="w-full p-2 border rounded mb-4" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach ($dosen as $dsn)
                                <option value="{{ $dsn['nidn'] }}" {{ old('nidn', $kehadiran['nama_dosen'] ?? '') == $dsn['nama_dosen'] ? 'selected' : '' }}>
                                    {{ $dsn['nidn'] }} - {{ $dsn['nama_dosen'] ?? '' }}
                                </option>
                            @endforeach
                        </select>

                        <label class="block mb-2">Nama Kelas</label>
                        <select name="kode_kelas" class="w-full p-2 border rounded mb-4" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $kls)
                                <option value="{{ $kls['kode_kelas'] }}" {{ old('kode_kelas', $kehadiran['nama_kelas'] ?? '') == $kls['nama_kelas'] ? 'selected' : '' }}>
                                    {{ $kls['kode_kelas'] }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Simpan Perubahan</button>
                    </form>

                    <a href="{{ route('admin.hadir.index') }}" class="block text-center mt-4 text-blue-500">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function isiNama() {
            const npmSelect = document.getElementById('npm');
            const selectedOption = npmSelect.options[npmSelect.selectedIndex];
            const nama = selectedOption.getAttribute('data-nama') || '';
            document.getElementById('nama_mahasiswa').value = nama;
        }

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

        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const container = document.getElementById('dropdownContainer');
            if (!container.contains(event.target)) {
                document.getElementById('dropdownMenu').classList.add('hidden');
            }
        });

        window.onload = function() {
            isiNama();
        };
    </script>
</body>
</html>