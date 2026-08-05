<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitusLembaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_situs',
        'url_situs',
        'logo',
        'deskripsi',
    ];
}
