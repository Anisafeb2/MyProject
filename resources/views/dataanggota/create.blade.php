@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Data Anggota</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada masalah pada inputanmu.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dataanggota.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Nomor HP</label>
            <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp') }}" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('dataanggota.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
