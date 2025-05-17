<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Untuk request ke API backend CodeIgniter

class KehadiranController extends Controller
{
    //Menampilkan semua dosen
    public function index()
    {
        $response = Http::get('http://localhost:8080/kehadiran1');

        if ($response->successful()) {
            $data = $response->json();

            // Pastikan ini hanya mengambil data dosen, bukan keseluruhan response
            return view('admin.tampil_hadir', ['kehadiran' => $data ?? []]);
        }

        return view('admin.tampil_hadir', ['kehadiran' => [], 'error' => 'Gagal mengambil data dosen']);
    }

    // Menampilkan form tambah data kehadiran
    public function create()
    {
        // Ambil data mahasiswa, matkul, dan dosen dari API backend
        $responseMahasiswa = Http::get('http://localhost:8080/mahasiswa');
        $responseMatkul = Http::get('http://localhost:8080/matkul');
        $responseDosen = Http::get('http://localhost:8080/dosen');

        // Cek apakah semua response API berhasil
        if ($responseMahasiswa->successful() && $responseMatkul->successful() && $responseDosen->successful()) {
            $mahasiswa = $responseMahasiswa->json()['data'] ?? $responseMahasiswa->json();
            $matkul = $responseMatkul->json()['data'] ?? $responseMatkul->json();
            $dosen = $responseDosen->json()['data'] ?? $responseDosen->json();

            return view('admin.tambah_hadir', compact('mahasiswa', 'matkul', 'dosen'));
        }

        // Jika salah satu gagal, kembalikan ke halaman sebelumnya dengan pesan error
        return back()->withErrors(['msg' => 'Gagal mengambil data mahasiswa, mata kuliah, atau dosen']);
    }


    // Simpan data kehadiran baru
public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'npm' => 'required|string',
        'tanggal' => 'required|date',
        'pertemuan' => 'required|integer',
        'status' => 'required|in:Hadir,Alpha,Izin,Sakit',
        'kode_matkul' => 'required|string',
        'nidn' => 'required|string',
    ]);

    // Cek kehadiran dengan tanggal yang sama (jika perlu validasi unik lokal)
    $checkResponse = Http::get('http://localhost:8080/kehadiran1', [
        'npm' => $validatedData['npm'],
        'tanggal' => $validatedData['tanggal'],
        'kode_matkul' => $validatedData['kode_matkul']
    ]);

    if ($checkResponse->successful()) {
        $existing = collect($checkResponse->json()['data'] ?? [])->first(function ($item) use ($validatedData) {
            return $item['tanggal'] === $validatedData['tanggal'] &&
                   $item['npm'] === $validatedData['npm'] &&
                   $item['kode_matkul'] === $validatedData['kode_matkul'];
        });

        if ($existing) {
            return back()->withErrors(['msg' => 'Data kehadiran pada tanggal tersebut sudah ada.'])->withInput();
        }
    }

    // Kirim data ke API CodeIgniter
    $response = Http::post('http://localhost:8080/kehadiran1', $validatedData);

    // Cek respons dari backend
    if ($response->successful()) {
        return redirect()->route('admin.hadir.index')->with('success', 'Data kehadiran berhasil ditambahkan');
    }

    // Ambil pesan error dari respons API jika ada
    $errorMessage = $response->json()['messages']['error'] ?? 'Gagal menambahkan data kehadiran';
    return back()->with('error', $errorMessage)->withInput();
}

      // Tampilkan form edit kehadiran
    public function edit($id_kehadiran)
    {
        $response = Http::get("http://localhost:8080/kehadiran1/{$id_kehadiran}");
        if (!$response->successful()) {
            return redirect()->route('admin.hadir.index')->withErrors(['msg' => 'Gagal mengambil data kehadiran']);
        }
        $kehadiran = $response->json();

        // Ambil data mahasiswa, matkul, dosen supaya dropdown terisi
        $mahasiswa = Http::get('http://localhost:8080/mahasiswa')->json() ?? [];
        $matkul = Http::get('http://localhost:8080/matkul')->json() ?? [];
        $dosen = Http::get('http://localhost:8080/dosen')->json() ?? [];

        return view('admin.edit_hadir', compact('kehadiran', 'mahasiswa', 'matkul', 'dosen'));
    }

    // Mengupdate data kehadiran
    public function update(Request $request, $id_kehadiran)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pertemuan' => 'required|integer',
            'status' => 'required|in:Hadir,Alpha,Izin,Sakit',
            'npm' => 'required|string',
            'kode_matkul' => 'required|string|max:10',
            'nidn' => 'required|string'
        ]);

        $data = $request->only(['npm', 'tanggal', 'pertemuan', 'status', 'kode_matkul', 'nidn']);

        $response = Http::put("http://localhost:8080/kehadiran1/{$id_kehadiran}", $data);

        if ($response->successful()) {
            return redirect()->route('admin.hadir.index')->with('success', 'Data kehadiran berhasil diperbarui');
        }

        return back()->withErrors(['msg' => 'Gagal memperbarui data kehadiran'])->withInput();
    }

    // Delete data kehadiran
    public function destroy($id_kehadiran)
    {
        $response = Http::delete("http://localhost:8080/kehadiran1/{$id_kehadiran}");

        if ($response->successful()) {
            return redirect()->route('admin.hadir.index')->with('success', 'Data kehadiran berhasil dihapus');
        }

        return back()->withErrors(['msg' => 'Gagal menghapus data kehadiran']);
    }
}