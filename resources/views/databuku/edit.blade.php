@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f5f7fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .container {
        max-width: 600px;
        margin: 40px auto 80px;
        background: #fff;
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        transition: box-shadow 0.3s ease;
    }

    .container:hover {
        box-shadow: 0 18px 40px rgba(0,0,0,0.15);
    }

    h3 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 700;
        font-size: 1.9rem;
        color: #5a3680;
        letter-spacing: 1px;
        position: relative;
    }

    h3::after {
        content: "";
        display: block;
        width: 80px;
        height: 3px;
        background: #764ba2;
        margin: 8px auto 0;
        border-radius: 3px;
    }

    label.form-label {
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
        display: block;
        font-size: 1.1rem;
    }

    input.form-control[type="text"],
    input.form-control[type="number"],
    input.form-control[type="file"] {
        padding: 12px 15px;
        font-size: 1.1rem;
        border-radius: 12px;
        border: 2px solid #ddd;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        width: 100%;
        box-sizing: border-box;
        color: #444;
    }

    input.form-control:focus {
        border-color: #764ba2;
        box-shadow: 0 0 8px rgba(118, 75, 162, 0.5);
        outline: none;
    }

    .mb-3 {
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #fdecea;
        border: 1px solid #f5c6cb;
        color: #a94442;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 25px;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .alert-danger strong {
        font-weight: 700;
    }

    ul {
        margin-top: 10px;
        padding-left: 20px;
    }

    ul li {
        margin-bottom: 5px;
        font-size: 0.95rem;
    }

    img {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-top: 10px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #764ba2, #5a3680);
        border: none;
        border-radius: 14px;
        padding: 14px 0;
        font-size: 1.2rem;
        font-weight: 700;
        color: white;
        width: 48%;
        cursor: pointer;
        box-shadow: 0 6px 16px rgba(118, 75, 162, 0.6);
        transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a3680, #4b2a66);
        box-shadow: 0 8px 20px rgba(74, 54, 128, 0.9);
    }

    .btn-secondary {
        background-color: #bbb;
        border: none;
        border-radius: 14px;
        padding: 14px 0;
        font-size: 1.2rem;
        font-weight: 600;
        color: #444;
        width: 48%;
        cursor: pointer;
        margin-left: 4%;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #999;
        color: #222;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    @media(max-width: 576px) {
        .container {
            margin: 20px 15px 40px;
            padding: 25px 20px;
        }
        .btn-primary, .btn-secondary {
            width: 100%;
            margin-left: 0;
            margin-bottom: 12px;
        }
        .button-group {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>

<div class="container">
    <h3>Edit Data Buku</h3>

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

    <form action="{{ route('databuku.update', $databuku->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $databuku->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis', $databuku->penulis) }}" required>
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" name="penerbit" id="penerbit" class="form-control" value="{{ old('penerbit', $databuku->penerbit) }}" required>
        </div>

        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" value="{{ old('tahun_terbit', $databuku->tahun_terbit) }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', $databuku->stok) }}" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Buku (Opsional)</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
            @if ($databuku->foto)
                <p class="mt-2">Foto saat ini:</p>
                <img src="{{ asset('uploads/' . $databuku->foto) }}" alt="Foto Buku" width="120">
            @endif
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('databuku.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
