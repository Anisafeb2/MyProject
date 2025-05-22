@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Peminjaman Buku</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="anggota_id" class="form-label">Nama Anggota</label>
            <select name="anggota_id" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach ($anggotas as $anggota)
                    <option value="{{ $anggota->id }}" {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                        {{ $anggota->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="buku_id" class="form-label">Judul Buku</label>
            <select name="buku_id" class="form-select" required>
                <option value="">-- Pilih Buku --</option>
                @foreach ($bukus as $buku)
                    <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                        {{ $buku->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" value="{{ old('tanggal_pinjam') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" value="{{ old('tanggal_kembali') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="dikembalikan" {{ old('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto (Opsional)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
