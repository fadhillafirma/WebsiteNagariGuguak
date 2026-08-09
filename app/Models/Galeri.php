<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';
    protected $primaryKey = 'id_foto';

    protected $fillable = [
        'user_id',
        'foto',
        'deskripsi',
        'tanggal_post',
    ];

    protected $casts = [
        'tanggal_post' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
