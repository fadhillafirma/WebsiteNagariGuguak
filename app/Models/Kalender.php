<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    use HasFactory;

    protected $table = 'kalenders';

    protected $fillable = [
        'user_id',
        'nama_kegiatan',
        'jam_mulai',
        'jam_akhir',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
