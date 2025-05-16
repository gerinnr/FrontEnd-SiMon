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
}
