<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAnggota extends Model
{
    use HasFactory;

    protected $table = 'data_anggotas';

    protected $fillable = ['nama', 'email', 'alamat', 'nomor_hp', 'foto'];
}

