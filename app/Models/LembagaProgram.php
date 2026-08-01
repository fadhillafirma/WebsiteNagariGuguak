<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaProgram extends Model
{
    use HasFactory;

    protected $table = 'lembaga_program';

    protected $fillable = [
        'lembaga_id',
        'nama_program',
        'kategori',
        'deskripsi',
        'penerima_manfaat',
        'alokasi_dana',
        'foto',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'alokasi_dana'    => 'decimal:2',
    ];

    /**
     * Relasi: program ini dimiliki oleh satu lembaga.
     */
    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'lembaga_id');
    }

    /**
     * Scope: hanya ambil program yang aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
