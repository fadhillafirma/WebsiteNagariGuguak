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
        'subdomain',          // <-- penghubung ke subdomain URL (misal: 'upz', 'bumnag')
        'foto_lembaga',
        'deskripsi',
        'struktur_organisasi',
        'nama_ketua',
    ];

    /**
     * Relasi ke admin/user pengelola lembaga ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: satu lembaga memiliki banyak berita.
     */
    public function beritas()
    {
        return $this->hasMany(LembagaBerita::class, 'lembaga_id');
    }

    /**
     * Relasi: satu lembaga memiliki banyak program kerja.
     */
    public function programs()
    {
        return $this->hasMany(LembagaProgram::class, 'lembaga_id');
    }

    /**
     * Relasi: satu lembaga memiliki banyak tugas.
     */
    public function tugas()
    {
        return $this->hasMany(LembagaTugas::class, 'lembaga_id');
    }
}
