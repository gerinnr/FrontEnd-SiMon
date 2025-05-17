<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DosenController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/dosen');
        if ($response->successful()) {
            $data = $response->json();
            return view('admin.tampil_dosen', ['dosen' => $data]);
        }
        return view('admin.tampil_dosen', ['dosen' => [], 'error' => 'Gagal mengambil data dosen']);
    }

    public function create()
{
    $response = Http::get('http://localhost:8080/user'); // Sesuaikan endpoint API user

    if ($response->successful()) {
        $users = $response->json();
        return view('admin.tambah_dosen', compact('users'));
    }

    return view('admin.tambah_dosen', ['users' => []])->withErrors(['msg' => 'Gagal mengambil data user']);
}

    public function store(Request $request){
    $response = Http::asForm()->post('http://localhost:8080/dosen', [
    'nidn' => $request->nidn,
    'nama_dosen' => $request->nama_dosen,
    'id_user' => $request->id_user,
]);


        if ($response->successful()) {
            return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan');
        }

        // 💥 Debug responsenya
        $error = $response->json()['messages']['error'] ?? 'Gagal menambahkan dosen';

return back()->withErrors(['msg' => 'Gagal menambahkan dosen: ' . $error])->withInput();


    }

    public function edit($nidn)
{
    // Ambil data dosen berdasarkan NIDN
    $dosenResponse = Http::get("http://localhost:8080/dosen/{$nidn}");

    // Ambil data user
    $userResponse = Http::get("http://localhost:8080/user");

    // Cek apakah kedua response berhasil
    if ($dosenResponse->successful() && $userResponse->successful()) {
        $dosen = $dosenResponse->json();
        $users = $userResponse->json();

        return view('admin.edit_dosen', compact('dosen', 'users'));
    }

    return redirect()->route('admin.dosen.index')
        ->withErrors(['msg' => 'Data dosen atau user gagal diambil']);
}


    public function update(Request $request, $nidn)
{
    // Validasi data
    $request->validate([
        'nidn' => 'required|numeric',
        'nama_dosen' => 'required|string',
        'id_user' => 'required|exists:user,id_user', // Perbaiki di sini
    ]);

    // Kirim data ke backend CodeIgniter
    $response = Http::put("http://localhost:8080/dosen/{$nidn}", [
        'nidn' => $request->nidn,
        'nama_dosen' => $request->nama_dosen,
        'id_user' => $request->id_user,
    ]);

    // Periksa apakah update berhasil
    if ($response->successful()) {
        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil diperbarui');
    }

    // Jika gagal, kembalikan pesan error
    return back()->withErrors(['msg' => 'Gagal memperbarui data dosen'])->withInput();
}


    public function destroy($nidn)
    {
        $response = Http::delete("http://localhost:8080/dosen/{$nidn}");
        if ($response->successful()) {
            return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus');
        }

        return redirect()->route('admin.dosen.index')->withErrors(['msg' => 'Gagal menghapus dosen']);
    }
}