@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    .container {
        max-width: 600px;
        background: #fff;
        padding: 40px 45px;
        border-radius: 20px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        font-family: 'Poppins', sans-serif;
        margin-top: 40px;
        margin-bottom: 40px;
    }

    h3 {
        color: #5c3ca6;
        font-weight: 700;
        font-size: 2.4rem;
        margin-bottom: 30px;
        text-align: center;
        letter-spacing: 1px;
        position: relative;
    }
    h3::after {
        content: "";
        display: block;
        width: 90px;
        height: 4px;
        background: linear-gradient(90deg, #5c3ca6, #9c64d3);
        border-radius: 5px;
        margin: 10px auto 0;
        box-shadow: 0 0 10px #9c64d3aa;
    }

    .alert-danger {
        background: #ffe3e6;
        color: #b02a37;
        border-radius: 12px;
        padding: 18px 24px;
        font-weight: 600;
        margin-bottom: 30px;
        box-shadow: 0 0 15px #f9b0b7aa;
    }

    .form-label {
        font-weight: 600;
        font-size: 1.1rem;
        color: #5c3ca6;
        margin-bottom: 8px;
        user-select: none;
    }

    input.form-control, textarea.form-control {
        width: 100%;
        padding: 14px 16px;
        border-radius: 14px;
        border: 2px solid #d8cffa;
        font-size: 1.1rem;
        background-color: #f9f7ff;
        color: #4a3c8c;
        box-shadow: inset 0 2px 8px #d8cffa;
        transition: border-color 0.3s ease, background-color 0.3s ease;
        resize: vertical;
    }
    input.form-control:focus, textarea.form-control:focus {
        outline: none;
        border-color: #7b57e4;
        background-color: #fff;
        box-shadow: 0 0 10px 3px #b9aaffaa;
    }

    img {
        display: block;
        margin-bottom: 12px;
        border-radius: 20px;
        max-width: 120px;
        box-shadow: 0 6px 18px rgba(92, 60, 166, 0.3);
        transition: transform 0.3s ease;
    }
    img:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 28px rgba(92, 60, 166, 0.5);
    }

    .btn-primary, .btn-secondary {
        border-radius: 20px;
        padding: 14px 30px;
        font-weight: 700;
        font-size: 1.2rem;
        cursor: pointer;
        user-select: none;
        transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
        border: none;
        min-width: 140px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #5c3ca6, #9c64d3);
        color: white;
        box-shadow: 0 8px 24px #9c64d3aa;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #7b57e4, #b498ff);
        box-shadow: 0 12px 30px #b498ffcc;
        transform: translateY(-3px);
    }
    .btn-primary:active {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px #9c64d3aa;
    }

    .btn-secondary {
        background: #ccc;
        color: #444;
        box-shadow: 0 4px 12px #bbb;
    }
    .btn-secondary:hover {
        background: #aaa;
        color: #222;
        transform: translateY(-3px);
    }
    .btn-secondary:active {
        transform: translateY(-1px);
    }

    form > .btn-group {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-top: 30px;
    }

    @media (max-width: 576px) {
        .container {
            padding: 30px 25px;
        }
        form > .btn-group {
            flex-direction: column;
        }
        .btn-primary, .btn-secondary {
            width: 100%;
            min-width: unset;
        }
    }
</style>

<div class="container" role="main" aria-label="Form edit data anggota">
    <h3>Edit Data Anggota</h3>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Ups!</strong> Ada masalah pada inputanmu.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dataanggota.update', $dataanggota->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $dataanggota->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $dataanggota->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $dataanggota->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Nomor HP</label>
            <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" value="{{ old('nomor_hp', $dataanggota->nomor_hp) }}" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label><br>
            @if ($dataanggota->foto)
                <img src="{{ asset('uploads/' . $dataanggota->foto) }}" alt="Foto anggota {{ $dataanggota->nama }}">
            @endif
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route('dataanggota.index') }}" class="btn-secondary" role="button">Batal</a>
        </div>
    </form>
</div>
@endsection
