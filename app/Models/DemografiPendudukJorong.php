<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemografiPendudukJorong extends Model
{
    use HasFactory;

    protected $table = 'demografi_penduduk_jorong';
    protected $primaryKey = 'id_penduduk_jorong';

    protected $fillable = [
        'user_id',
        'jorong_id',
        'tahun',
        'kk',
        'laki_laki',
        'perempuan',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'kk' => 'integer',
        'laki_laki' => 'integer',
        'perempuan' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jorong()
    {
        return $this->belongsTo(Jorong::class, 'jorong_id', 'id_jorong');
    }

    // total penduduk (laki + perempuan)
    public function getJumlahAttribute(): int
    {
        return (int)($this->laki_laki ?? 0) + (int)($this->perempuan ?? 0);
    }
}
