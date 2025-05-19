<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class KehadiranController extends Controller
{
   
   
    public function index()
    {
        try {
            $response = Http::get('http://localhost:8080/kehadiran1');

            if ($response->successful()) {
                $data = $response->json();

                // Cek level user untuk memilih tampilan
                if (Auth::user()->level === 'admin') {
                    return view('admin.tampil_hadir', ['kehadiran' => $data ?? []]);
                } elseif (Auth::user()->level === 'dosen') {
                    return view('dosen.tampil_hadir', ['kehadiran' => $data ?? []]);
                } elseif (Auth::user()->level === 'mahasiswa') {
                    return view('mahasiswa.tampil_hadir', ['kehadiran' => $data ?? []]);
                } else {
                    return back()->withErrors(['error' => 'Akses ditolak']);
                }
            }

            return back()->withErrors(['error' => 'Gagal mengambil data mahasiswa']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    
    public function show($id_kehadiran)
    {
        $response = Http::get("http://localhost:8080/kehadiran1/{$id_kehadiran}");

        if ($response->successful()) {
            $data = $response->json();

            if (Auth::user()->level === 'admin') {
                return view('admin.tampil_hadir', ['kehadiran' => $data]);
            } elseif (Auth::user()->level === 'dosen') {
                return view('dosen.tampil_hadir', ['kehadiran' => $data]);
            }
        }

        return back()->withErrors(['error' => 'Data tidak ditemukan']);
    }

     public function create()
    {
        $mahasiswa = Http::get('http://localhost:8080/mahasiswa')->json();
        $matkul = Http::get('http://localhost:8080/matkul')->json();
        $dosen = Http::get('http://localhost:8080/dosen')->json();
        $kelas = Http::get('http://localhost:8080/kelas')->json();

        if (Auth::user()->level === 'admin') {
            return view('admin.tambah_hadir', compact('mahasiswa', 'matkul', 'dosen', 'kelas'));
        } elseif (Auth::user()->level === 'dosen') {
            return view('dosen.tambah_hadir', compact('mahasiswa', 'matkul', 'dosen', 'kelas'));
        }

        return back()->withErrors(['error' => 'Akses ditolak']);
    }
    
     // Menyimpan data kehadiran baru (POST)
     
    public function store(Request $request)
    {
        $response = Http::asForm()->post('http://localhost:8080/kehadiran1', $request->all());

      if ($response->successful()) {
            if (Auth::user()->level === 'admin') {
                return redirect()->route('admin.hadir.index')->with('success', 'Data berhasil ditambahkan');
            } elseif (Auth::user()->level === 'dosen') {
                return redirect()->route('dosen.hadir.index')->with('success', 'Data berhasil ditambahkan');
            }
        }

        return back()->with('error', 'Gagal menambahkan data')->withInput();
    }

    public function edit($id_kehadiran)
{
    // Ambil data kehadiran yang akan di edit
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

    if (Auth::user()->level === 'admin') {
            return view('admin.edit_hadir', compact('kehadiran', 'mahasiswa', 'matkul', 'dosen', 'kelas'));
        } elseif (Auth::user()->level === 'dosen') {
            return view('dosen.edit_hadir', compact('kehadiran', 'mahasiswa', 'matkul', 'dosen', 'kelas'));
        }

        return back()->withErrors(['error' => 'Akses ditolak']);
}


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
            if (Auth::user()->level === 'admin') {
                return redirect()->route('admin.hadir.index')->with('success', 'Data berhasil diperbarui');
            } elseif (Auth::user()->level === 'dosen') {
                return redirect()->route('dosen.hadir.index')->with('success', 'Data berhasil diperbarui');
            }
        }

        return back()->withErrors(['error' => 'Gagal memperbarui data'])->withInput();
    }

    
    // Menghapus data kehadiran berdasarkan ID (DELETE)
    public function destroy($id_kehadiran)
    {
        $response = Http::delete("http://localhost:8080/kehadiran1/{$id_kehadiran}");

        if ($response->successful()) {
            if (Auth::user()->level === 'admin') {
                return redirect()->route('admin.hadir.index')->with('success', 'Data berhasil dihapus');
            } elseif (Auth::user()->level === 'dosen') {
                return redirect()->route('dosen.hadir.index')->with('success', 'Data berhasil dihapus');
            }
        }

        return back()->withErrors(['error' => 'Gagal menghapus data']);
    }
}
