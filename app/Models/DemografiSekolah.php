<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemografiSekolah extends Model
{
    use HasFactory;

    protected $table = 'demografi_sekolah';
    protected $primaryKey = 'id_sekolah';

    protected $fillable = [
        'user_id',
        'tahun',
        'jumlah_smp',
        'jumlah_sma',
        'jumlah_sd',
        'jumlah_paud',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
