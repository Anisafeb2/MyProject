@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-dark-emphasis">📚 Koleksi Buku Perpustakaan</h2>
        <a href="{{ route('databuku.create') }}" class="btn btn-success shadow rounded-pill px-4">+ Tambah Buku</a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-pill text-center">{{ session('success') }}</div>
    @endif

    {{-- Search Bar --}}
    <form action="{{ route('databuku.index') }}" method="GET" class="d-flex mb-5 gap-2 justify-content-center">
        <input
            type="text"
            name="search"
            class="form-control rounded-pill px-4 py-2 shadow-sm"
            placeholder="🔍 Cari judul atau penulis..."
            value="{{ request('search') }}"
            style="max-width: 350px;"
        >
        <button type="submit" class="btn btn-primary rounded-pill shadow-sm px-4">Cari</button>
        <a href="{{ route('databuku.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm px-4">Reset</a>
    </form>

    {{-- Card Grid Layout --}}
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($bukus as $buku)
        <div class="col">
            <div class="card h-100 shadow border-0 rounded-4 overflow-hidden hover-scale" style="transition: transform 0.3s ease;">
                @if($buku->foto)
                    <img src="{{ asset('uploads/' . $buku->foto) }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Foto Buku">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                        <span class="text-muted">Tidak ada gambar</span>
                    </div>
                @endif
                <div class="card-body px-4 py-3">
                    <h5 class="card-title fw-semibold text-dark">{{ $buku->judul }}</h5>
                    <p class="mb-1 text-muted"><i class="bi bi-person"></i> {{ $buku->penulis }}</p>
                    <p class="mb-1 text-muted"><i class="bi bi-building"></i> {{ $buku->penerbit }}</p>
                    <p class="mb-1 text-muted"><i class="bi bi-calendar"></i> {{ $buku->tahun_terbit }}</p>
                    <p class="mb-0">
                        <span class="badge bg-info-subtle text-dark rounded-pill">Stok: {{ $buku->stok }}</span>
                    </p>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex justify-content-between px-4 py-3">
                    <a href="{{ route('databuku.edit', $buku->id) }}" class="btn btn-warning btn-sm rounded-pill px-3">Edit</a>
                    <form action="{{ route('databuku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm rounded-pill px-3">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center rounded-3 shadow-sm">
                📭 Data buku tidak ditemukan.
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $bukus->appends(['search' => request('search')])->links() }}
    </div>
</div>

{{-- CSS Hover Effect --}}
<style>
    .hover-scale:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
