<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

// app/Models/Publikasi.php

class Publikasi extends Model
{
    use HasFactory;

    protected $table = 'publikasi';
    protected $primaryKey = 'id_artikel';

    protected $fillable = [
        'user_id',
        'judul',
        'penulis', 
        'deskripsi',
        'foto',
        'jenis',
        'tanggal_update',
    ];

    protected $casts = [
        'tanggal_update' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

