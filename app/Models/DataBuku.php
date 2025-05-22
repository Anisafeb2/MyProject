<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBuku extends Model
{

    protected $fillable = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok', 'foto'
    ];
}
