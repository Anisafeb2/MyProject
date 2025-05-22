<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAnggota;
use Illuminate\Validation\Rule;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class DataAnggotaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DataAnggota::query();

        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('nomor_hp', 'like', "%{$search}%");
        }

        $anggotas = $query->paginate(10);

        return view('dataanggota.index', compact('anggotas', 'search'));
    }

    public function create()
    {
        return view('dataanggota.create');
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'nullable|email|unique:data_anggotas,email',
        'alamat' => 'required|string|max:500',
        'nomor_hp' => 'required|string|max:20',
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


    // Simpan data anggota ke database
    DataAnggota::create($data);

    // Redirect dengan pesan sukses
    return redirect()->route('dataanggota.index')->with('success', 'Data berhasil disimpan');
}

    public function edit($id)
    {
        $dataanggota = DataAnggota::findOrFail($id);
        return view('dataanggota.edit', compact('dataanggota'));
    }

    public function update(Request $request, $id)
    {
        $dataanggota = DataAnggota::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('data_anggotas')->ignore($dataanggota->id)],
            'alamat' => 'required|string|max:500',
            'nomor_hp' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $data = $request->only(['nama', 'email', 'alamat', 'nomor_hp']);

        if ($request->hasFile('foto')) {
        // Hapus foto lama
        if ($dataanggota->foto && file_exists(public_path('uploads/' . $dataanggota->foto))) {
            unlink(public_path('uploads/' . $dataanggota->foto));
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

        $dataanggota->update($data);

        return redirect()->route('dataanggota.index')->with('success', 'Data anggota berhasil diupdate');
    }

    public function destroy($id)
    {
        $dataanggota = DataAnggota::findOrFail($id);

        if ($dataanggota->foto && file_exists(public_path('uploads/' . $dataanggota->foto))) {
            unlink(public_path('uploads/' . $dataanggota->foto));
        }

        $dataanggota->delete();

        return response()->json(['success' => true]);
    }
}
