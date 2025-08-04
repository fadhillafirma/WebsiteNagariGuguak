<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jorong extends Model
{
    use HasFactory;

    protected $table = 'jorong';
    protected $primaryKey = 'id_jorong';

    protected $fillable = [
        'user_id',
        'nama_jorong',
        'kepala_jorong',
        'deskripsi_jorong',
        'foto_kepala_jorong',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendudukJorong()
    {
        return $this->hasMany(DemografiPendudukJorong::class, 'jorong_id', 'id_jorong');
    }
}
