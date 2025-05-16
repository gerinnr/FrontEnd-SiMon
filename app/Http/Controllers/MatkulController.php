<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class MatkulController extends Controller
{
    //Menampilkan semua matkul
     public function index()
     {
         $response = Http::get('http://localhost:8080/matkul');
 
         if ($response->successful()) {
             $data = $response->json();
             return view('admin.tampil_matkul', ['matakuliah' => $data ?? []]);
         }
 
         return view('admin.tampil_matkul', ['matakuliah' => [], 'error' => 'Gagal mengambil data mata kuliah']);
     }

     // Menampilkan form tambah matkul
    public function create()
    {
        return view('admin.tambah_matkul');
    }

    // Menyimpan data matkul baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'kode_matkul' => 'required',
            'nama_matkul' => 'required',
            'sks' => 'required|integer'
        ]);
    
        // Kirim data ke API CodeIgniter
        $response = Http::post('http://localhost:8080/matkul', $validated);
    
        // Jika berhasil
        if ($response->successful()) {
            return redirect()->route('admin.matkul.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
        }
    
        // Jika gagal, tampilkan pesan error
        return back()->withErrors(['msg' => $response->json()['messages']['error'] ?? 'Gagal menambah data.'])->withInput();
    }    

    // Menampilkan form edit matkul
    public function edit($kode_matkul)
    {
        $response = Http::get("http://localhost:8080/matkul/{$kode_matkul}");

        if ($response->successful()) {
            $matkul = $response->json();
            return view('admin.edit_matkul', ['matkul' => $matkul]);
        }

        return redirect()->route('admin.matkul.index')->withErrors(['error' => 'Data tidak ditemukan.']);
    }

    // Menyimpan update data matkul
    public function update(Request $request, $kode_matkul)
    {
        $response = Http::put("http://localhost:8080/matkul/{$kode_matkul}", [
            'kode_matkul' => $request->kode_matkul,
            'nama_matkul' => $request->nama_matkul,
            'sks'         => $request->sks,
        ]);

        if ($response->status() === 200) {
            return redirect()->route('admin.matkul.index')->with('success', 'Data berhasil diperbarui.');
        }

        return back()->withErrors(['error' => 'Gagal memperbarui data.'])->withInput();
    }

    // Menghapus data matkul
    public function destroy($kode_matkul)
    {
        $response = Http::delete("http://localhost:8080/matkul/{$kode_matkul}");

        if ($response->status() === 200) {
            return redirect()->route('admin.matkul.index')->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->route('admin.matkul.index')->withErrors(['error' => 'Gagal menghapus data.']);
    }
}