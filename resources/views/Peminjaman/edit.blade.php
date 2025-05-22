@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Peminjaman Buku</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="anggota_id" class="form-label">Nama Anggota</label>
            <select name="anggota_id" class="form-select" required>
                @foreach ($anggotas as $anggota)
                    <option value="{{ $anggota->id }}" {{ $peminjaman->anggota_id == $anggota->id ? 'selected' : '' }}>
                        {{ $anggota->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="buku_id" class="form-label">Judul Buku</label>
            <select name="buku_id" class="form-select" required>
                @foreach ($bukus as $buku)
                    <option value="{{ $buku->id }}" {{ $peminjaman->buku_id == $buku->id ? 'selected' : '' }}>
                        {{ $buku->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" value="{{ $peminjaman->tanggal_kembali }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto (Opsional)</label><br>
            @if ($peminjaman->foto)
                <img src="{{ asset('uploads/' . $peminjaman->foto) }}" alt="Foto" width="80" height="80" class="mb-2"><br>
            @endif
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
