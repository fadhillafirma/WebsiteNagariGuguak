<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaBerita extends Model
{
    use HasFactory;

    protected $table = 'lembaga_berita';

    protected $fillable = [
        'lembaga_id',
        'judul',
        'isi_berita',
        'foto',
        'dokumen',
        'kategori',
        'penulis',
        'status',
        'tanggal_tayang',
    ];

    protected $casts = [
        'tanggal_tayang' => 'datetime',
    ];

    /**
     * Relasi: berita ini dimiliki oleh satu lembaga.
     */
    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'lembaga_id');
    }

    /**
     * Scope: hanya ambil berita yang sudah tayang.
     */
    public function scopeTayang($query)
    {
        return $query->where('status', 'tayang')->orderByDesc('tanggal_tayang');
    }
}
