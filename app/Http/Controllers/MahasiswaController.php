<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
     // Menampilkan semua mahasiswa
     public function index()
     {
        try {
            $response = Http::get('http://localhost:8080/mahasiswa');

            if ($response->successful()) {
                $data = $response->json();

                // Cek level user untuk memilih tampilan
                if (Auth::user()->level === 'admin') {
                    return view('admin.tampil_mhs', ['mahasiswas' => $data ?? []]);
                } elseif (Auth::user()->level === 'dosen') {
                    return view('dosen.tampil_mhs', ['mahasiswas' => $data ?? []]);
                } else {
                    return back()->withErrors(['error' => 'Akses ditolak']);
                }
            }

            return back()->withErrors(['error' => 'Gagal mengambil data mahasiswa']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Menampilkan form tambah mahasiswa
    public function create()
    {
        // Ambil data user dan kelas dari API backend
        $responseUsers = Http::get('http://localhost:8080/user'); 
        $responseKelas = Http::get('http://localhost:8080/kelas'); 

        // Cek apakah kedua response API berhasil
        if ($responseUsers->successful() && $responseKelas->successful()) {
            $users = $responseUsers->json();
            $kelas = $responseKelas->json();
            return view('admin.tambah_mhs', compact('users', 'kelas'));
        }

        // Jika gagal, arahkan kembali ke halaman sebelumnya dengan pesan error
        return back()->withErrors(['msg' => 'Gagal mengambil data user atau kelas']);
    }

    // Menyimpan data mahasiswa baru ke backend API
    public function store(Request $request) 
    {
        // Validasi input
        $validatedData = $request->validate([
            'npm' => 'required|numeric',
            'nama_mahasiswa' => 'required|string',
            'email' => 'required|email',
            'id_user' => 'required|numeric|unique:mahasiswa,id_user',
            'kode_kelas' => 'required|string',
        ]);

        // Kirim data ke API CodeIgniter
        $response = Http::asForm()->post('http://localhost:8080/mahasiswa', $validatedData);

        // Cek respons dari backend
        if ($response->successful()) {
            return redirect()->route('admin.mhs.index')->with('success', 'Data mahasiswa berhasil ditambahkan');
        }

        // Ambil pesan error dari respons API jika ada
        $errorMessage = $response->json()['messages']['error'] ?? 'Gagal menambahkan data mahasiswa';
        return back()->with('error', $errorMessage)->withInput();
    }


    // Menampilkan form edit mahasiswa berdasarkan NPM
        public function edit($npm) {
        // Ambil data mahasiswa, user, dan kelas dari API backend
        $responseMahasiswa = Http::get("http://localhost:8080/mahasiswa/$npm");
        $responseUsers = Http::get('http://localhost:8080/user'); 
        $responseKelas = Http::get('http://localhost:8080/kelas'); 

        if (
            $responseMahasiswa->successful() &&
            $responseUsers->successful() &&
            $responseKelas->successful()
        ) {
            $mahasiswa = $responseMahasiswa->json();
            $users = $responseUsers->json();
            $kelas = $responseKelas->json();
            return view('admin.edit_mhs', compact('mahasiswa', 'users', 'kelas'));
        }

        return back()->withErrors(['msg' => 'Gagal mengambil data untuk edit mahasiswa']);
    }


    // Mengirim data update mahasiswa ke backend
    public function update(Request $request, $npm) {
        // Validasi input
        $request->validate([
            'npm' => 'required|numeric',
            'nama_mahasiswa' => 'required|string',
            'email' => 'required|email',
                'id_user' => [
            'required',
            'numeric',
            Rule::unique('mahasiswa', 'id_user')->ignore($npm, 'npm'), // abaikan data yang sedang diupdate
        ],
            'kode_kelas' => 'required|string',
        ]);

        // Kirim data ke API untuk update
        $response = Http::put("http://localhost:8080/mahasiswa/{$npm}", [
            'npm' => $request->npm,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'email' => $request->email,
            'id_user' => $request->id_user,
            'kode_kelas' => $request->kode_kelas,
        ]);

        // Cek hasil respons
        if ($response->successful()) {
            return redirect()->route('admin.mhs.index')->with('success', 'Data mahasiswa berhasil diupdate');
        } else {
            return back()->with('error', 'Gagal mengupdate data mahasiswa');
        }
    }

    // Menghapus data mahasiswa berdasarkan NPM
    public function destroy($npm) 
    {
        $response = Http::delete("http://localhost:8080/mahasiswa/$npm");

        if ($response->successful()) {
            return redirect('/admin/mahasiswa/index')->with('success', 'Data mahasiswa berhasil dihapus');
        } else {
            return back()->with('error', 'Gagal menghapus data mahasiswa');
        }
    }
    public function show($npm) 
    {
        $response = Http::get("http://localhost:8080/mahasiswa/$npm");

        if ($response->successful()) {
            return redirect('/admin/tampil_mhs')->with('success', 'Data mahasiswa berhasil dihapus');
        } else {
            return back()->with('error', 'Gagal menghapus data mahasiswa');
        }
    }
}
