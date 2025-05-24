<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kehadiran Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            font-size: 12px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 4px 0;
            font-size: 16px;
        }

        .header p {
            margin: 2px 0;
            font-size: 11px;
        }

        h2.title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        td.text-left {
            text-align: left;
        }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="header">
        <h3>KEMENTERIAN PENDIDIKAN, TINGGI, SAINS, DAN TEKNOLOGI</h3>
        <h3>POLITEKNIK NEGERI CILACAP</h3>
        <p>Jalan Dr. Soetomo No. 1, Sidakaya - Cilacap 53212 Jawa Tengah</p>
        <p>Telepon: (0282) 533329, Fax: (0282) 537992</p>
        <p>Website: www.pnc.ac.id | Email: sekretariat@pnc.ac.id</p>
    </div>

    <!-- Judul -->
    <h2 class="title">Data Kehadiran Mahasiswa</h2>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Kehadiran</th>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Tanggal</th>
                <th>Pertemuan</th>
                <th>Status</th>
                <th>Mata Kuliah</th>
                <th>Nama Dosen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kehadiran as $index => $hadir)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $hadir['id_kehadiran'] }}</td>
                <td>{{ $hadir['npm'] }}</td>
                <td class="text-left">{{ $hadir['nama_mahasiswa'] }}</td>
                <td>{{ $hadir['tanggal'] }}</td>
                <td>{{ $hadir['pertemuan'] }}</td>
                <td>{{ $hadir['status'] }}</td>
                <td class="text-left">{{ $hadir['nama_matkul'] }}</td>
                <td class="text-left">{{ $hadir['nama_dosen'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
