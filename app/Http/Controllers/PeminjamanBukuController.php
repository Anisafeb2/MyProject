<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanBuku;
use App\Models\DataAnggota;
use App\Models\DataBuku;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class PeminjamanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamans = PeminjamanBuku::with('anggota', 'buku')->latest()->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggotas = DataAnggota::all();
        $bukus = DataBuku::all();
        return view('peminjaman.create', compact('anggotas', 'bukus'));
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    $request->validate([
        'anggota_id' => 'required|exists:data_anggotas,id',
        'buku_id' => 'required|exists:data_bukus,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date',
        'status' => 'required|in:dipinjam,dikembalikan',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        $imageFile = $request->file('foto');
        $filename = time() . '.' . $imageFile->getClientOriginalExtension();
        $path = public_path('uploads/' . $filename);

        $manager = new ImageManager(new GdDriver());
        $image = $manager->read($imageFile->getRealPath());
        $image->resize(400, 400)->save($path);

        $data['foto'] = $filename;
    }

    PeminjamanBuku::create($data);

    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil disimpan.');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $peminjaman = PeminjamanBuku::findOrFail($id);
        $anggotas = DataAnggota::all();
        $bukus = DataBuku::all();
        return view('peminjaman.edit', compact('peminjaman', 'anggotas', 'bukus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $peminjaman = PeminjamanBuku::findOrFail($id);

    $request->validate([
        'anggota_id' => 'required|exists:data_anggotas,id',
        'buku_id' => 'required|exists:data_bukus,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date',
        'status' => 'required|in:dipinjam,dikembalikan',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        $image = $request->file('foto');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('uploads/' . $filename);

        // Pakai Intervention Image (jika belum pake, jangan lupa `use Intervention\Image\Facades\Image;` di atas)
        $manager = new ImageManager(new GdDriver());
        $img = $manager->read($image->getRealPath());
        $img->resize(400, 400)->save($path);


        // Hapus foto lama kalau ada
        if ($peminjaman->foto && file_exists(public_path('uploads/' . $peminjaman->foto))) {
            unlink(public_path('uploads/' . $peminjaman->foto));
        }

        $data['foto'] = $filename;
    } else {
        // Kalau foto gak diupload, jangan update kolom foto
        unset($data['foto']);
    }

    $peminjaman->update($data);

    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $peminjaman = PeminjamanBuku::findOrFail($id);
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
