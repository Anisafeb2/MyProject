<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeminjamanBuku extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_bukus'; // sesuaikan dengan nama tabel di database

    protected $fillable = [
        'anggota_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'foto', // untuk menyimpan nama file foto
    ];

    // Relasi ke Data Anggota
    public function anggota()
    {
        return $this->belongsTo(DataAnggota::class, 'anggota_id');
    }

    // Relasi ke Data Buku
    public function buku()
    {
        return $this->belongsTo(DataBuku::class, 'buku_id');
    }
}
