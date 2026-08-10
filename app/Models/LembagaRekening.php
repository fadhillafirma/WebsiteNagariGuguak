<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaRekening extends Model
{
    use HasFactory;

    protected $fillable = [
        'lembaga_id',
        'nama_bank',
        'nomor_rekening',
        'atas_nama',
    ];

    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class);
    }
}
