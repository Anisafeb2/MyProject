@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Data Buku</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada masalah dengan inputanmu.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('databuku.store') }}" method="POST" enctype="multipart/form-data" onsubmit="this.querySelector('button[type=submit]').disabled = true; this.querySelector('button[type=submit]').innerText = 'Menyimpan...';">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" class="form-control" value="{{ old('penulis') }}" required>
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}" required>
        </div>

        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Buku</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('databuku.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
