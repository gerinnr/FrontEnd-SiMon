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

    return view('admin.tambah_dosen', ['users' => []])->withErrors(['msg' => 'Gagal mengambil data user']);
}

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required',
            'nama_dosen' => 'required',
            'id_user' => 'required',
        ]);

        $response = Http::asJson()->post('http://localhost:8080/dosen', [
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
            'id_user' => $request->id_user,
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan');
        }

        return back()->withErrors(['msg' => 'Gagal menambahkan dosen'])->withInput();
    }

    public function edit()
    {
        $response = Http::get("http://localhost:8080/dosen");
        if ($response->successful()) {
            $dosen = $response->json();
            return view('admin.edit_dosen', compact('users'));
        }
        return redirect()->route('admin.dosen.index', ['users' => []])->withErrors(['msg' => 'Data dosen tidak ditemukan']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nidn' => 'required',
            'nama_dosen' => 'required',
            'username' => 'required',
        ]);

        $response = Http::post("http://localhost:8080/dosen", [
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
            'username' => $request->id_user,

        ]);

        if ($response->successful()) {
            return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil diperbarui');
        }

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