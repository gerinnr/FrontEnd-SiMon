<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
     // Menampilkan semua mahasiswa
     public function index()
     {
         $response = Http::get('http://localhost:8080/mahasiswa');
 
         if ($response->successful()) {
             $data = $response->json();
             return view('admin.tampil_mhs', ['mahasiswas' => $data ?? []]);
         }
 
         return view('admin.tampil_mhs', ['mahasiswas' => [], 'error' => 'Gagal mengambil data mahasiswa']);
     }

    // Menampilkan form tambah mahasiswa
    public function create() {
        return view('admin.tambah_mhs');
    }

    // Menyimpan data mahasiswa baru ke backend API
    public function store(Request $request) {
        // Simpan input sementara ke session jika validasi gagal
        Session::flash('nama_mahasiswa', $request->nama_mahasiswa);
        Session::flash('email', $request->email);
        Session::flash('id_user', $request->id_user);
        Session::flash('kode_kelas', $request->kode_kelas);

        // Validasi input
        $request->validate([
            'nama_mahasiswa' => 'required|string',
            'email' => 'required|email',
            'id_user' => 'required|numeric',
            'kode_kelas' => 'required|string',
        ]);

        // Kirim data ke API CodeIgniter
        $response = Http::post('http://localhost:8080/mahasiswa', [
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'email' => $request->email,
            'id_user' => $request->id_user,
            'kode_kelas' => $request->kode_kelas,
        ]);

        // Cek respons dari backend
        if ($response->successful()) {
            return redirect('/admin/tampil_mhs')->with('success', 'Data mahasiswa berhasil ditambahkan');
        } else {
            return back()->with('error', 'Gagal menambahkan data mahasiswa');
        }
    }

    // Menampilkan form edit mahasiswa berdasarkan NPM
    public function edit($npm) {
        $response = Http::get("http://localhost:8080/mahasiswa/{$npm}");

        if ($response->successful()) {
            $mahasiswa = $response->json();
            return view('admin.edit_mhs', compact('mahasiswa'));
        } else {
            return back()->with('error', 'Gagal mengambil data untuk diedit');
        }
    }

    // Mengirim data update mahasiswa ke backend
    public function update(Request $request, $npm) {
        // Validasi input
        $request->validate([
            'nama_mahasiswa' => 'required|string',
            'email' => 'required|email',
            'id_user' => 'required|numeric',
            'kode_kelas' => 'required|string',
        ]);

        // Kirim data ke API untuk update
        $response = Http::put("http://localhost:8080/mahasiswa/{$npm}", [
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'email' => $request->email,
            'id_user' => $request->id_user,
            'kode_kelas' => $request->kode_kelas,
        ]);

        // Cek hasil respons
        if ($response->successful()) {
            return redirect('/admin/tampil_mhs')->with('success', 'Data mahasiswa berhasil diupdate');
        } else {
            return back()->with('error', 'Gagal mengupdate data mahasiswa');
        }
    }

    // Menghapus data mahasiswa berdasarkan NPM
    public function destroy($npm) 
    {
        $response = Http::delete("http://localhost:8080/mahasiswa/$npm");

        if ($response->successful()) {
            return redirect('/admin/tampil_mhs')->with('success', 'Data mahasiswa berhasil dihapus');
        } else {
            return back()->with('error', 'Gagal menghapus data mahasiswa');
        }
    }
}
