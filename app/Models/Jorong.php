<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jorong extends Model
{
    use HasFactory;

    protected $table = 'jorong'; // Nama tabel (bukan jamak)
    protected $primaryKey = 'id_jorong'; // Primary key-nya

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'nama_jorong',
        'kepala_jorong',
        'deskripsi_jorong',
        'foto_kepala_jorong',
        'foto_jorong',

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
