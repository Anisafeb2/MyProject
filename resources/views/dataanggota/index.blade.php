@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
<div class="container">
    <h1>Data Anggota</h1>

    <div class="top-bar">
        <a href="{{ route('dataanggota.create') }}" class="btn-primary" title="Tambah Anggota">
            <i class="bi bi-person-plus-fill"></i> Tambah Anggota
        </a>

        <input type="text" id="searchInput" placeholder="Cari anggota..." aria-label="Cari anggota" />
    </div>

    <div id="alert-container"></div>

    <div class="table-card">
        <table id="anggotaTable" aria-describedby="Daftar anggota yang tersedia">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggotas as $anggota)
                <tr id="row-{{ $anggota->id }}">
                    <td>
                        @if ($anggota->foto)
                        <img src="{{ asset('uploads/' . $anggota->foto) }}" alt="Foto {{ $anggota->nama }}" class="foto-thumb" />
                        @else
                        <span class="empty-message">Tidak ada</span>
                        @endif
                    </td>
                    <td>{{ $anggota->nama }}</td>
                    <td>{{ $anggota->email }}</td>
                    <td>{{ $anggota->alamat }}</td>
                    <td>{{ $anggota->nomor_hp }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('dataanggota.edit', $anggota->id) }}" class="btn-action btn-edit" title="Edit {{ $anggota->nama }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button class="btn-action btn-delete" data-id="{{ $anggota->id }}" title="Hapus {{ $anggota->nama }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-message">Belum ada data anggota.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $anggotas->links() }}
    </div>
</div>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

{{-- JQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function(){
    $('.btn-delete').click(function(){
        if(!confirm('Yakin ingin menghapus data ini?')) return;

        let id = $(this).data('id');
        let token = '{{ csrf_token() }}';

        $.ajax({
            url: '/dataanggota/' + id,
            type: 'POST',
            data: {
                _method: 'DELETE',
                _token: token
            },
            success: function(){
                $('#row-' + id).fadeOut(() => $('#row-' + id).remove());
                $('#alert-container').html(`<div class="alert-success" role="alert">Data anggota berhasil dihapus.</div>`);
            },
            error: function(){
                alert('Gagal menghapus data anggota.');
            }
        });
    });

    $('#searchInput').on('input', function(){
        let val = $(this).val().toLowerCase();
        $('#anggotaTable tbody tr').filter(function(){
            let text = $(this).text().toLowerCase();
            $(this).toggle(text.indexOf(val) > -1);
        });
    });
});
</script>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f9fafb;
    color: #344054;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.container {
    max-width: 1100px;
    margin: 50px auto;
    padding: 0 20px;
}

h1 {
    font-weight: 800;
    font-size: 2.4rem;
    color: #0f172a;
    margin-bottom: 2rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    user-select: none;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
}

.top-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.top-bar a.btn-primary {
    background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
    border: none;
    padding: 12px 28px;
    font-weight: 700;
    border-radius: 14px;
    color: white;
    box-shadow: 0 12px 24px rgb(99 102 241 / 0.45);
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    user-select: none;
    white-space: nowrap;
}
.top-bar a.btn-primary:hover {
    transform: scale(1.05);
    box-shadow: 0 20px 40px rgb(99 102 241 / 0.65);
}

#searchInput {
    flex: 1 1 300px;
    max-width: 400px;
    padding: 10px 15px;
    border-radius: 14px;
    border: 2px solid #ddd;
    font-size: 1rem;
    outline-offset: 2px;
    transition: border-color 0.3s ease;
}

#searchInput:focus {
    border-color: #6366f1;
    box-shadow: 0 0 8px #6366f1;
}

.table-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.25);
    padding: 30px 40px;
    margin-top: 10px;
    overflow-x: auto;
}

/* Table Style */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 18px;
    font-size: 1rem;
    font-weight: 500;
    color: #334155;
}

thead th {
    background: #e0e7ff;
    padding: 18px 20px;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #4338ca;
    border-radius: 12px 12px 0 0;
    user-select: none;
    text-align: center;
}

tbody tr {
    background: #fff;
    box-shadow: 0 10px 20px -10px rgba(99, 102, 241, 0.2);
    border-radius: 16px;
    transition: box-shadow 0.3s ease, transform 0.2s ease;
    cursor: default;
}
tbody tr:hover {
    box-shadow: 0 20px 40px -5px rgba(99, 102, 241, 0.35);
    transform: translateY(-5px);
}

tbody td {
    padding: 18px 20px;
    text-align: center;
    vertical-align: middle;
    border-top: none !important;
    user-select: none;
}

/* Foto Bulat */
.foto-thumb {
    width: 52px;
    height: 52px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #c7d2fe;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    transition: transform 0.3s ease;
}
.foto-thumb:hover {
    transform: scale(1.15);
    box-shadow: 0 8px 20px rgba(99, 102, 241, 0.7);
    cursor: pointer;
}

/* Aksi Button Group */
.action-buttons {
    display: flex;
    justify-content: center;
    gap: 12px;
}

.btn-action {
    font-weight: 700;
    padding: 10px 18px;
    border-radius: 14px;
    font-size: 1.1rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border: none;
    cursor: pointer;
    user-select: none;
    transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    min-width: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.btn-edit {
    background: #facc15;
    color: #78350f;
    box-shadow: 0 8px 25px rgba(250, 204, 21, 0.45);
}
.btn-edit:hover {
    background: #b45309;
    color: #facc15;
    transform: scale(1.08);
    box-shadow: 0 15px 40px rgba(180, 83, 9, 0.8);
}
.btn-delete {
    background: #ef4444;
    color: white;
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.5);
}
.btn-delete:hover {
    background: #b91c1c;
    box-shadow: 0 15px 40px rgba(185, 28, 28, 0.85);
    transform: scale(1.08);
}

/* Alert sukses */
.alert-success {
    background: #d1fae5;
    border-radius: 16px;
    color: #065f46;
    font-weight: 700;
    font-size: 1.1rem;
    padding: 14px 22px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(22, 163, 74, 0.3);
    margin-bottom: 20px;
    user-select: none;
}

/* Empty message */
.empty-message {
    font-weight: 700;
    font-size: 1.05rem;
    font-style: italic;
    color: #999;
    user-select: none;
}

/* Responsive for small screens */
@media (max-width: 600px) {
    h1 {
        font-size: 1.8rem;
    }
    .top-bar {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
    }
    #searchInput {
        max-width: 100%;
    }
    .action-buttons {
        gap: 8px;
    }
    .btn-action {
        padding: 8px 14px;
        font-size: 1rem;
        min-width: 50px;
    }
    tbody td {
        padding: 12px 10px;
        font-size: 0.9rem;
    }
}
</style>
@endsection
