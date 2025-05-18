<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KehadiranController extends Controller
{
   
   
    public function index()
    {
        $response = Http::get('http://localhost:8080/kehadiran1');
        $data = $response->json();

        return view('admin.tampil_hadir', ['kehadiran' => $data]);
    }

    /**
     * Menampilkan detail data kehadiran berdasarkan ID (GET)
     */
    // public function show($id)
    // {
    //     $response = Http::get("{$this->baseUrl}/{$id}");

    //     if ($response->successful()) {
    //         $data = $response->json();
    //         return view('kehadiran.show', ['data' => $data]);
    //     } else {
    //         abort(404, 'Data tidak ditemukan');
    //     }
    // }
     public function create()
    {
        $mahasiswa = Http::get('http://localhost:8080/mahasiswa')->json();
        $matkul = Http::get('http://localhost:8080/matkul')->json();
        $dosen = Http::get('http://localhost:8080/dosen')->json();
        $kelas = Http::get('http://localhost:8080/kelas')->json();

        return view('admin.tambah_hadir', [
            'mahasiswa' => $mahasiswa,
            'matkul' => $matkul,
            'dosen' => $dosen,
            'kelas' => $kelas,
        ]);
    }
    /**
     * Menyimpan data kehadiran baru (POST)
     */
    public function store(Request $request)
    {
        $response = Http::asForm()->post('http://localhost:8080/kehadiran1', $request->all());

        if ($response->successful()) {
            return redirect()->route('admin.hadir.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return back()->with('error', 'Gagal menambahkan data')->withInput();
        }
    }

    public function edit($id_kehadiran)
{
    // Ambil data kehadiran yang akan diedit
    $response = Http::get("http://localhost:8080/kehadiran1/{$id_kehadiran}");
    if (!$response->successful()) {
        abort(404, 'Data tidak ditemukan');
    }
    $kehadiran = $response->json();

    // Ambil data pendukung untuk dropdown
    $mahasiswa = Http::get('http://localhost:8080/mahasiswa')->json();
    $matkul = Http::get('http://localhost:8080/matkul')->json();
    $dosen = Http::get('http://localhost:8080/dosen')->json();
    $kelas = Http::get('http://localhost:8080/kelas')->json();

    return view('admin.edit_hadir', [
        'kehadiran' => $kehadiran,
        'mahasiswa' => $mahasiswa,
        'matkul' => $matkul,
        'dosen' => $dosen,
        'kelas' => $kelas,
    ]);
}

    /**
     * Memperbarui data kehadiran berdasarkan ID (PUT)
     */
public function update(Request $request, $id_kehadiran)
{
    $request->validate([
        'npm' => 'required',
        'tanggal' => 'required|date',
        'pertemuan' => 'required|integer',
        'status' => 'required',
        'kode_matkul' => 'required',
        'nidn' => 'required',
        'kode_kelas' => 'required',
    ]);

    // Ambil hanya field yang diperlukan
    $data = $request->only([
        'npm',
        'tanggal',
        'pertemuan',
        'status',
        'kode_matkul',
        'nidn',
        'kode_kelas',
    ]);

    $response = Http::put("http://localhost:8080/kehadiran1/{$id_kehadiran}", $data);

    if ($response->successful()) {
        return redirect()->route('admin.hadir.index')->with('success', 'Data berhasil diperbarui');
    } else {
        // Hapus atau ubah ke log setelah debug
        // dd($response->body());

        return back()->with('error', 'Gagal memperbarui data')->withInput();
    }
}

    /**
     * Menghapus data kehadiran berdasarkan ID (DELETE)
     */
    public function destroy($id_kehadiran)
    {
        $response = Http::delete("http://localhost:8080/kehadiran1/{$id_kehadiran}");

        if ($response->successful()) {
            return redirect()->route('admin.hadir.index')->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('error', 'Gagal menghapus data');
        }
    }
}
