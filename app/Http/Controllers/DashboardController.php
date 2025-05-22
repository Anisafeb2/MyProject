<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBuku;
use App\Models\DataAnggota;
use App\Models\PeminjamanBuku;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalBuku = DataBuku::count();
        $totalAnggota = DataAnggota::count();
        $totalPeminjaman = PeminjamanBuku::count();

        // Hitung peminjaman aktif (status 'dipinjam')
        $peminjamanAktif = PeminjamanBuku::where('status', 'dipinjam')->count();
        // Hitung peminjaman yang sudah dikembalikan (status 'dikembalikan')
        // Kirim data ke view dashboard
        return view('dashboard.index', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'peminjamanAktif'
        ));
    }
}
