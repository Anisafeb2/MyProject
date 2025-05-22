<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBuku;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class DataBukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DataBuku::query();

        if ($search) {
            $query
                ->where('judul', 'like', "%{$search}%")
                ->orWhere('penulis', 'like', "%{$search}%")
                ->orWhere('penerbit', 'like', "%{$search}%");
        }

        $bukus = $query->paginate(10);

        return view('databuku.index', compact('bukus'));
    }

    public function create()
    {
        return view('databuku.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil data kecuali foto dulu
        $data = $request->except('foto');

        // Handle foto jika ada
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // ✅ Inisialisasi manager versi 3 dengan GdDriver
            $manager = new ImageManager(new GdDriver());

            // ✅ Resize dan simpan
            $img = $manager->read($image->getRealPath());
            $img->resize(300, 400)->save(public_path('uploads/' . $filename));

            $data['foto'] = $filename;
        }

        // Simpan ke DB (asumsi model Buku)
        DataBuku::create($data);

        return redirect()->route('databuku.index')->with('success', 'Data buku berhasil disimpan');
    }

    public function show(DataBuku $databuku)
    {
        return view('databuku.show', compact('databuku'));
    }

    public function edit(DataBuku $databuku)
{
    return view('databuku.edit', compact('databuku'));
}

    public function update(Request $request, DataBuku $databuku)
{
    $request->validate([
        'judul' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required|numeric',
        'stok' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok']);

    if ($request->hasFile('foto')) {
        // Hapus foto lama
        if ($databuku->foto && file_exists(public_path('uploads/' . $databuku->foto))) {
            unlink(public_path('uploads/' . $databuku->foto));
        }

        $image = $request->file('foto');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('uploads/' . $filename);

        // Gunakan ImageManager (Intervention v3)
        $manager = new ImageManager(new GdDriver());
        $img = $manager->read($image->getRealPath());
        $img->resize(300, 400)->save($path);

        $data['foto'] = $filename;
    }

    $databuku->update($data);

    return redirect()->route('databuku.index')->with('success', 'Data buku berhasil diperbarui');
}


    public function destroy(DataBuku $databuku)
    {
        if ($databuku->foto && file_exists(public_path('uploads/' . $databuku->foto))) {
            unlink(public_path('uploads/' . $databuku->foto));
        }

        $databuku->delete();

        return redirect()->route('databuku.index')->with('success', 'Data buku berhasil dihapus');
    }
}
