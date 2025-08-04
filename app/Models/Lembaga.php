<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lembaga',
        'foto_lembaga',
        'deskripsi',
        'struktur_organisasi',
        'nama_ketua',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
