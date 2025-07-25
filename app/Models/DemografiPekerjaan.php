<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemografiPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'demografi_pekerjaan';
    protected $primaryKey = 'id_pekerjaan';

    protected $fillable = [
        'user_id',
        'tahun',
        'petani',
        'pegawai_negeri',
        'karyawan_swasta',
        'pedagang',
        'tni',
        'pensiunan',
        'aparat_pemerintahan',
        'pekerjaan_lain',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'petani' => 'integer',
        'pegawai_negeri' => 'integer',
        'karyawan_swasta' => 'integer',
        'pedagang' => 'integer',
        'tni' => 'integer',
        'pensiunan' => 'integer',
        'aparat_pemerintahan' => 'integer',
        'pekerjaan_lain' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Atribut turunan: total semua kolom pekerjaan
    public function getTotalAttribute(): int
    {
        return ($this->petani ?? 0)
            + ($this->pegawai_negeri ?? 0)
            + ($this->karyawan_swasta ?? 0)
            + ($this->pedagang ?? 0)
            + ($this->tni ?? 0)
            + ($this->pensiunan ?? 0)
            + ($this->aparat_pemerintahan ?? 0)
            + ($this->pekerjaan_lain ?? 0);
    }
}
