<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potensi extends Model
{
    use HasFactory;

    // Jika nama tabelmu tidak default ("potensis"), uncomment baris ini
    // protected $table = 'potensis';

    protected $fillable = [
        'user_id',
        'jenis_potensi',
        'judul',
        'deskripsi',
        'gambar',
        'tanggal_post',
    ];

    protected $casts = [
        'tanggal_post' => 'datetime',
    ];

    /**
     * Enum values for jenis_potensi.
     */
    public const JENIS_POTENSI = [
        'pertanian',
        'pariwisata',
        'perekonomian',
        'lainnya',
    ];

    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
