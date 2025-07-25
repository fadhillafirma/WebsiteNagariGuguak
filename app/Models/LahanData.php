<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LahanData extends Model
{
    use HasFactory;

    // Jika nama tabel tidak sesuai konvensi Laravel
    protected $table = 'lahan_data';

    // Jika primary key bukan 'id'
    protected $primaryKey = 'id_lahan_data';

    // Jika tidak menggunakan timestamps (created_at & updated_at)
    public $timestamps = false;

    // Field yang dapat diisi secara massal
    protected $fillable = [
        'lahan_jenis_id',
        'tahun',
        'luas_ha',
        'produktif_ha',
        'tidak_produktif_ha',
    ];

    /**
     * Relasi: Setiap data lahan dimiliki oleh satu jenis lahan
     */
    public function lahanJenis()
    {
        return $this->belongsTo(LahanJenis::class, 'lahan_jenis_id', 'id_lahan_jenis');
    }
}
