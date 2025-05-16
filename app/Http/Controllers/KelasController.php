<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class KelasController extends Controller
{
    //Menampilkan semua kelas
     public function index()
     {
         $response = Http::get('http://localhost:8080/kelas');
 
         if ($response->successful()) {
             $data = $response->json();
             return view('admin.tampil_kls', ['kelas' => $data ?? []]);
         }

         return view('admin.tampil_kls', ['kelas' => [], 'error' => 'Gagal mengambil data kelas']);
     }

// Tampilkan form tambah kelas
    public function create()
    {
        return view('admin.tambah_kls');
    }

    // Simpan data kelas baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kelas' => 'required',
            'nama_kelas' => 'required',
        ]);

        $response = Http::asForm()->post( 'http://localhost:8080/kelas', $validated);

        if ($response->successful()) {
            return redirect()->route('admin.kls.index')->with('success', 'Data kelas berhasil ditambahkan.');
        }

        return back()->withErrors(['msg' => 'Gagal menambahkan data kelas'])->withInput();
    }

    // Tampilkan form edit kelas
    public function edit($kode_kelas)
    {
        $response = Http::get("http://localhost:8080/kelas/{$kode_kelas}");

        if ($response->successful()) {
            $kelas = $response->json();
            return view('admin.edit_kls', compact('kelas'));
        }

        return redirect()->route('admin.kls.index')->withErrors(['msg' => 'Data kelas tidak ditemukan.']);
    }


    // Update data kelas
    public function update(Request $request, $kode_kelas)
    {
        $validated = $request->validate([
            'kode_kelas' => 'required',
            'nama_kelas' => 'required',
        ]);

      try {
        $response = Http::put("http://localhost:8080/kelas/{$kode_kelas}", $validated);

        if ($response->successful()) {
            return redirect()->route('admin.kls.index')->with('success', 'Data kelas berhasil diupdate.');
        }
        return back()->withErrors(['msg' => 'Gagal mengupdate data kelas'])->withInput();
            } catch (\Exception $e) {
        return back()->withErrors(['msg' => 'Server tidak merespons. Silakan coba lagi nanti.'])->withInput();
    }
    }


    // Hapus data kelas
    public function destroy($kode_kelas)
    {
        $response = Http::delete("http://localhost:8080/kelas/{$kode_kelas}");

        if ($response->successful()) {
            return redirect()->route('admin.kls.index')->with('success', 'Data kelas berhasil dihapus.');
        }

        return redirect()->route('admin.kls.index')->withErrors(['msg' => 'Gagal menghapus data kelas.']);
    }
}
