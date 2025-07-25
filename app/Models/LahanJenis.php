<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LahanJenis extends Model
{
    use HasFactory;

    protected $table = 'lahan_jenis';
    protected $primaryKey = 'id_lahan_jenis';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nama_lahan',
        'kategori',
        'deskripsi',
    ];

    /**
     * ENUM Options untuk kategori.
     * Cocokkan dengan enum di migration.
     */
    public const KATEGORI_ENUM = [
        'sawah',
        'perkebunan',
        'lainnya',
    ];

    /**
     * Relasi: Jenis lahan dimiliki oleh seorang user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Jenis lahan memiliki banyak data lahan
     */
    public function lahanData()
    {
        return $this->hasMany(LahanData::class, 'lahan_jenis_id', 'id_lahan_jenis');
    }
}
